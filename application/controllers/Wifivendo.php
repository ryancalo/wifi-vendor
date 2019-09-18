<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wifivendo extends CI_Controller {


    public function __construct()

           {
            parent::__construct();
            $this->load->model('wifimodel');
            date_default_timezone_set("Asia/Manila");
           }








      public function index()
           {  
             $this->load->view('admin/header');
             $this->load->view('login');
             $this->load->view('admin/footer');
           }
         








//to take login data
public function userLogin()
   {
     $this->load->model('wifimodel');
       $username = $this->input->post('username');
       $password = $this->input->post('password');
       $result = $this->wifimodel->login_staff($username, $password);
       if($result){

               redirect(base_url(). $this->session->user_type);
                          
       }

       else{
  
           redirect(base_url());

       }





    }






   
     //LOGOUT USER
     public function logout()
         {
             $this->session->sess_destroy();
             redirect(site_url());
         }















     public function check_connection() {

          $status = $this->wifimodel->check_connection();

          foreach($status as $key => $value){
             
                 if ( $key == "date_checked" ){
                       
                 }
                 else{
                     
                     $data = array("device_name" => $key,
                                   "device_status" => $value,
                                   "log_date"=> $status['date_checked'],
                                   "flag" => 0);
                    
                     $last_status = $this->wifimodel->get_last_value("alive_log", array("device_name" => $key), "device_status,alive_log_id", "log_date");
                        if ( $last_status && (string)$last_status['device_status'] == (string)$value ){
                              
                            $this->wifimodel->update_data(array("log_date" => $status['date_checked']), "alive_log", array("alive_log_id" => $last_status['alive_log_id'] ) );

                        }
                        else {
                       
                            $this->wifimodel->insert_data($data, "alive_log");
                            $this->wifimodel->insert_data($data, "alive_log");
                        }
                         
                    


                     
                 }
            
          }
         
     }














}



?>
