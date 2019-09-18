<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


    public function __construct()

           {
            parent::__construct();
            $this->load->model('wifimodel');
            date_default_timezone_set("Asia/Manila");

             //check settings
             $controller = $this->wifimodel->get_data("controller");
             $cloud = $this->wifimodel->get_data("cloud");
             $voucher = $this->wifimodel->get_data("voucher");
               if ( $cloud['cloud_token'] != "" ){

                     if ( $controller ) {

                            if ( $voucher ){

                            }
                            else {

                                  redirect(base_url(). $this->session->user_type."/voucher");
                            } 

                     }
                     else {
                           
                         redirect(base_url(). $this->session->user_type."/controller");
                     }
               }
               else {

                       $this->request_token();

               }




          }



    //Pages


    public function index()
    {  

         $data['maintenance_log'] = $this->wifimodel->get_data("maintenance");                 
         $this->load->view('admin/header');
         $this->load->view('admin/navigation');
         $this->load->view('admin/home', $data);
         $this->load->view('admin/footer');

    }



   public function voucher(){


        $data['voucher'] = $this->wifimodel->get_data("voucher");
        $this->load->view('admin/header');
        $this->load->view('admin/navigation');
        $this->load->view('admin/voucher', $data);
        $this->load->view('admin/footer');     

    
   }





   public function controller(){


     $data['controller'] = $this->wifimodel->get_data("controller");
     $this->load->view('admin/header');
     $this->load->view('admin/navigation');
     $this->load->view('admin/controller', $data);
     $this->load->view('admin/footer');     

 
   }



   public function reports(){
    
          $this->load->view('admin/header');
          $this->load->view('admin/navigation');
          $this->load->view('admin/reports');
          $this->load->view('admin/footer');

   }





//GETTING TOKEN FROM CLOUD

//Request Cloud

private function request_token()
{ 
    
       $this->load->model('postmodel');
       $token = $this->postmodel->request_token();
       if ( $token ){
             
              //SAVE TOKEN
              $data = array ( "cloud_token" => $token['token'] );


              $this->wifimodel->update_data($data, "cloud", "id = 1" ); 
       }

}









 
//check connection
public function check_controller() {

               $controller_ip = $this->input->post('controller_ip');
               $controller_port = $this->input->post('controller_port');
               $controller_username = $this->input->post('controller_username');
               $controller_password = $this->input->post('controller_password');
               $controller_site = $this->input->post('controller_site');
               $controller_version = $this->input->post('controller_version');
 




       $data = array(
                     "controller_address" => $controller_ip . ":" . $controller_port,
                     "controller_username"=> $controller_username,
                     "controller_password"=> $controller_password,
                      "controller_siteid"=>  $controller_site,
                      "controller_version"=> $controller_version
                     );

     $respond = $this->wifimodel->test_controller($data);

       if ( $respond == "1" ){

         echo "Connection Success";
          }
       elseif ( $respond == "2" ){
            echo "Username or Password incorrect";
           }
       else {

             echo "Connection Failed";

            }
     

}












  //Inserting or Updating data

    public function save_controller(){


        if ( !empty($this->input->post('controller_ip')) &&  !empty($this->input->post('controller_port')) && !empty($this->input->post('controller_username')) && !empty($this->input->post('controller_password')) 
             && !empty($this->input->post('controller_site')) && !empty($this->input->post('controller_version')) ){
 
                     if ( filter_var($this->input->post('controller_ip'), FILTER_VALIDATE_IP) || filter_var($this->input->post('controller_ip'), FILTER_VALIDATE_URL) ) {

                         $controller_ip = $this->input->post('controller_ip');
                         $controller_port = $this->input->post('controller_port');
                         $controller_username = $this->input->post('controller_username');
                         $controller_password = $this->input->post('controller_password');
                         $controller_site = $this->input->post('controller_site');
                         $controller_version = $this->input->post('controller_version');

                        $data = array(
                            "controller_ip"=> $controller_ip,
                            "controller_port"=> $controller_port,
                            "controller_username"=> $controller_username,
                            "controller_password"=> $controller_password,
                            "controller_siteid"=> $controller_site,
                            "controller_version"=> $controller_version,
                            "flag" => 0
                            );

                       $controller = $this->wifimodel->get_data("controller");
                         if ( $controller ){
                              //update
                              $this->wifimodel->update_data($data, "controller", "id = 0" ); 
                              echo "Controller Settings Successfuly Saved";
                         }
                         else {
                             //insert 

                             $this->wifimodel->insert_data($data, "controller");
                             echo "Controller Settings Successfuly Saved";
                         }


                     }
        

            }



          
         
    }









    public function save_voucher(){

        if(!empty($this->input->post('voucher_step')) && !empty($this->input->post('voucher_notes')) && !empty($this->input->post('hourcoin')) && !empty($this->input->post('bandwidth_limit')) && !empty($this->input->post('bandwidth_updown')) && $_FILES['fileToUpload']['size']!= 0){
             
            $cloud = $this->wifimodel->get_data("cloud");
                
            $config['allowed_types'] = 'png';
            $config['upload_path'] = "public/src/img/";
            $config['max_width'] = '600';
            $config['max_height'] = '150';
            $config['file_name'] = $cloud['cloud_token'];
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);
              if ( $this->upload->do_upload('fileToUpload')) {

                      $voucher_duration = $this->input->post('hourcoin');
                      $bandwidth_limit = $this->input->post('bandwidth_limit');
                      $bandwith_updown = $this->input->post('bandwidth_updown');
                      $voucher_logo = $config['file_name'];
                      $voucher_steps = rtrim($this->input->post('voucher_step'));
                      $voucher_notes= rtrim($this->input->post('voucher_notes'));

                      $data = array( "voucher_duration" => $voucher_duration,
                                     "bandwidth_limit" => $bandwidth_limit,
                                     "bandwidth" => $bandwith_updown,
                                     "voucher_logo" => $voucher_logo,
                                     "voucher_steps" => $voucher_steps,
                                     "voucher_notes" => $voucher_notes,
                                     "flag" => 0
                                    );


                       $voucher = $this->wifimodel->get_data("voucher");
                        
                            if ( $voucher ){
                                //update
                                $this->wifimodel->update_data($data, "voucher", array("voucher_id" => "0") );
                                echo "Voucher Settings Saved";
                             }
                            else {
                                //insert 
                                $this->wifimodel->insert_data($data, "voucher");
                                echo "Voucher Settings Saved";
                            }

              }
              else {
                   
                   print_r( $this->upload->display_errors() ); 
                   echo "Image should only be png with 600px x 150px size";
              }
        
 
          }
     else {
            

 
             echo "All Must be Filled, Or Reselect Image";

                          


          
          }

    }



















    //api
      
       public function get_icon_data(){

                                   $amount_per_voucher = 5;

                                   $controller = $this->wifimodel->get_data("controller");

                                   $today = $this->wifimodel->count_data("voucher_record", "DATE(record_date)=CURDATE() AND voucher_type = 'Paid' " , "*");                                                                                                                                        
                                   $week = $this->wifimodel->count_data("voucher_record", "DATE(record_date)>=CURDATE() -7 AND DATE(record_date)<=CURDATE() AND voucher_type = 'Paid'" , "*");
                                   $yesterday = $this->wifimodel->count_data("voucher_record", "DATE(record_date)>=CURDATE() -1 AND record_date <='" . date("Y-m-d 24:00:00",strtotime("-1 Day") ) .  "'  AND voucher_type = 'Paid'" , "*");
                                   $month = $this->wifimodel->count_data("voucher_record", "MONTH(NOW()) AND YEAR(record_date) = YEAR(NOW()) AND voucher_type = 'Paid' " , "*");
                                   $paper = $this->wifimodel->get_last_value("alive_log", array("device_name" => "printer_paper_status"), "device_status", "log_date");

                                   $last_collection = $this->wifimodel->get_last_value("maintenance", array("maintenance_type"=> "COLLECTION"), "maintenance_date", "maintenance_date");
                                   if ( $last_collection ){
                                       
                                          $in_vault = $this->wifimodel->count_data("voucher_record",array("record_date >=" =>  $last_collection['maintenance_date'], "voucher_type"=> "Paid" ) , "*");
                                            
                                            
                                   }
                                   else {
                                        
                                          $last_collection  = $this->wifimodel->get_first_value("voucher_record", "record_date", "record_date");
                                              if ( $last_collection )  {
                                                    
                                                   $in_vault = $this->wifimodel->count_data("voucher_record", array("record_date >=" =>  $last_collection['record_date'], "voucher_type"=> "Paid" ) , "*");


                                              }
                                              else {

                                                  $in_vault = 0;
                                              } 
                                   }




                                        $printer_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "printer_stat"), "device_status", "log_date");
                                        $printer_send_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "printer_send_stat"), "device_status", "log_date");
                                        $outside_internet = $this->wifimodel->get_last_value("alive_log", array("device_name" => "outside_internet"), "device_status", "log_date");
                                        $galileo_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "galileo_stat"), "device_status", "log_date");
                                        $controller_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "controller_stat"), "device_status", "log_date");
                                        $controller_send_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "controller_send_stat"), "device_status", "log_date");
                                        $printer_paper_status = $this->wifimodel->get_last_value("alive_log", array("device_name" => "printer_paper_status"), "device_status", "log_date");

                                            if ($printer_stat['device_status'] == "1" && $printer_send_stat['device_status'] == "1" && $outside_internet['device_status'] != "None" && $galileo_stat['device_status'] == "1" && $controller_stat['device_status'] == "1" && $controller_send_stat['device_status'] != "ERROR" && $printer_paper_status['device_status'] > "0") {

                                                 $conn_stat = "OK";

                                            }
                                            else {
                                                  
                                                 $conn_stat = "ERROR";
                                            }




                                   $data = array( 'controller_username' => $controller['controller_username'],
                                                  'controller_password' => $controller['controller_password'],
                                                  'controller_address' => $controller['controller_ip'] . ":" . $controller['controller_port'],
                                                  'controller_siteid' => $controller['controller_siteid'],
                                                  'controller_version' => '4.7.6'
                                                  );

                                   $active_user = $this->wifimodel->get_active_user($data);

                                   $result_data = array(
                                                        "today" => (int)$today * $amount_per_voucher,                                                       
                                                        "yesterday" => (int)$yesterday * $amount_per_voucher,
                                                        "week" => (int)$week * $amount_per_voucher,
                                                        "month" => (int)$month * $amount_per_voucher,
                                                        "in_vault" => (int)$in_vault*$amount_per_voucher,
                                                        "active_user" => $active_user,
                                                        "paper"=> $paper['device_status'] ."%",
                                                        "conn_stat" => $conn_stat                                                       
                                                        );

                                   echo json_encode($result_data);
                   
 
       }






    public function get_graph_data(){

               if ( $this->input->post('duration') ){
                     $duration = $this->input->post('duration');
                     $amount_per_voucher = 5;
                         if ( $duration == "today" ){
                              $start_time = date("Y-m-d 00:00:01");
                              $end_time = date("Y-m-d 24:00:00");
                              $result = array();

                              while ( strtotime($start_time) <= strtotime($end_time) ) {

                                   $temp = array();
                                   $to = date("Y-m-d H:i:00", strtotime($start_time . " + 1hour ") );

                                   $data = $this->wifimodel->count_data("voucher_record", array("record_date >=" => $start_time, "record_date <=" => $to, "voucher_type" => "Paid" ) , "*"); 
                                   $data1 = $this->wifimodel->count_data("voucher_record", array("record_date >=" => $start_time, "record_date <=" => $to, "voucher_type" => "Free" ) , "*"); 

                                   array_push($temp, (int)$data*$amount_per_voucher);
                                   array_push($temp, date("H:i", strtotime($start_time)) );
                                   array_push($temp, (int)$data1*$amount_per_voucher);
                                   $start_time = date("Y-m-d H:i:01",  strtotime($to));

                                   array_push($result, $temp);


                               }

                               echo json_encode($result);
                         }
                       elseif ( $duration == "week" ) {

                                   $start_time = date("Y-m-d 00:00:01", strtotime("- 7days"));
                                   $end_time = date("Y-m-d 24:00:00");
                                   $result = array();

                                   while ( strtotime($start_time) <= strtotime($end_time) ) {

                                        $temp = array();
                                        $to = date("Y-m-d H:i:00", strtotime($start_time . " + 1 day ") );

                                        $data = $this->wifimodel->count_data("voucher_record", array("record_date >=" => $start_time, "record_date <=" => $to, "voucher_type" => "Paid" ) , "*"); 
                                        $data1 = $this->wifimodel->count_data("voucher_record", array("record_date >=" => $start_time, "record_date <=" => $to, "voucher_type" => "Free" ) , "*"); 

                                        array_push($temp, (int)$data*$amount_per_voucher);
                                        array_push($temp, date("M d", strtotime($start_time)) );
                                        array_push($temp, (int)$data1*$amount_per_voucher);
                                        $start_time = date("Y-m-d H:i:01",  strtotime($to));

                                        array_push($result, $temp);


                                   }
                               echo json_encode($result);                             

                       }
                      elseif ( $duration == "month" ){

                                        $start_time = date("Y-m-01 00:00:01");
                                        $end_time = date("Y-m-d 24:00:00");
                                        $result = array();

                                        while ( strtotime($start_time) <= strtotime($end_time) ) {

                                             $temp = array();
                                             $to = date("Y-m-d H:i:00", strtotime($start_time . " + 1 day ") );

                                             $data = $this->wifimodel->count_data("voucher_record", array("record_date >=" => $start_time, "record_date <=" => $to, "voucher_type" => "Paid" ) , "*"); 
                                             $data1 = $this->wifimodel->count_data("voucher_record", array("record_date >=" => $start_time, "record_date <=" => $to, "voucher_type" => "Free" ) , "*"); 

                                             array_push($temp, (int)$data*$amount_per_voucher);
                                             array_push($temp, date("d", strtotime($start_time)) );
                                             array_push($temp, (int)$data1*$amount_per_voucher);
                                             $start_time = date("Y-m-d H:i:01",  strtotime($to));

                                             array_push($result, $temp);


                                        }
                                   echo json_encode($result);      
                              
                      }
               }
                

    }






   public function print_free() {

           
              if ( !empty($this->input->post('voucher_num')) ){

                    $voucher_num = $this->input->post('voucher_num');
                    $controller = $this->wifimodel->get_data("controller");
                    $printer = $this->wifimodel->get_data("printer");
                    $voucher = $this->wifimodel->get_data("voucher");
                        if ( $controller && $printer && $voucher ){
      
                                   $epson = new phpepson; 
                                   $data = array('controller_username' => $controller['controller_username'],
                                             'controller_password' => $controller['controller_password'],
                                             'controller_address' => $controller['controller_ip'] . ":" . $controller['controller_port'],
                                             'controller_siteid' => $controller['controller_siteid'],
                                             'controller_version' => '4.7.6',
                                             'voucher_duration' => $voucher['voucher_duration'],
                                             'voucher_num' => $voucher_num,
                                             'bandwidth' => $voucher['bandwidth'],
                                             'bandwidth_limit' => $voucher['bandwidth_limit']);
                                   
                                   $vouchers = $this->wifimodel->create_voucher($data);
                                  
                                       foreach ($vouchers as $voucher_code ){                  
                                             $logo = 'public/src/img/' .  $voucher['voucher_logo'] . ".png";

                                                  try {

                                                       $print = $epson->print_paid($logo, $voucher_code, $voucher['voucher_duration'], $printer['printer_ip'], $printer['printer_port'], $voucher['voucher_steps'], $voucher['voucher_notes']);
                                                       $record_data = array('voucher' => $voucher_code,
                                                                                'voucher_type' => 'Free',
                                                                                'record_date' => date("Y-m-d H:i:s"),
                                                                                'flag' => 0);

                                                       $this->wifimodel->insert_data($record_data, 'voucher_record');
                                                                 

                                                  }
                                                  catch(Exception $e) {

                                                       $detail =  'Message: ' .$e->getMessage();
                                                       $log_data = array('subject' => 'Printer',
                                                                           'log_details' => $detail,
                                                                           'log_date' => date("Y-m-d H:i:s"),
                                                                           'flag' => 0);

                                                       $this->wifimodel->insert_data($log_data, 'logs');


                                                       
                                                  }                               
                                             }
                        }

              }

      
   }











}