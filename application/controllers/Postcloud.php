<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postcloud extends CI_Controller {

   
 
  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */

  



 public function __construct()

           {


            parent::__construct();
            

            $this->load->model('postmodel');
            $this->load->model('wifimodel');

           date_default_timezone_set("Asia/Manila");
           

              

   }




   public function send_data(){

        $this->send_voucher_record();
        $this->send_logs();
        $this->send_alive_log();
        $this->send_maintenance();
        $this->send_voucher_setting();
        $this->send_controller_setting();
        $this->send_voucher_logo();
        $this->delete_old_alive_log();
   }




//deleting old data

  public function delete_old_alive_log(){
  
              

              $res =  $this->wifimodel->delete_where("alive_log", array("device_name"=> "outside_internet", "flag"=> 1, "log_date<=" => date("Y-m-d H:i", strtotime("-1 hour") ) ) );
              

   }









  private function send_voucher_record(){

        $data = $this->postmodel->get_record("voucher_record");

        $send_data =  $this->postmodel->send_voucher($data);
             if ( $send_data ){
                
                  foreach($send_data as $key => $value){
                       if ($value['response'] == "success"){
                            
                                foreach($data as $key1 => $value1){

                                       foreach($value1 as $key2 => $value2){
                                                
                                                $this->postmodel->update_flag($value2->record_id, "1", "voucher_record", "record_id");

                                       }
                                }

                       }
                       else {
                             echo "Error";
                       }
                  }
             }
        

  }










  private function send_logs(){

    $data = $this->postmodel->get_record("logs");

    $send_data =  $this->postmodel->send_logs($data);
         if ( $send_data ){
            
              foreach($send_data as $key => $value){
                   if ($value['response'] == "success"){
                        
                            foreach($data as $key1 => $value1){

                                   foreach($value1 as $key2 => $value2){
                                            
                                            $this->postmodel->update_flag($value2->log_id, "1", "logs", "log_id");

                                   }
                            }

                   }
                   else {
                         echo "Error";
                   }
              }
         }
    

}







private function send_alive_log(){

    $data = $this->postmodel->get_record("alive_log");
 
    
    $send_data =  $this->postmodel->send_alive_log($data);
         if ( $send_data ){
              print_r($send_data);
              foreach($send_data as $key => $value){
                   if ($value['response'] == "success"){
                        
                            foreach($data as $key1 => $value1){

                                   foreach($value1 as $key2 => $value2){
                                            
                                            $this->postmodel->update_flag($value2->alive_log_id, "1", "alive_log", "alive_log_id");
                                            

                                   }
                            }

                   }
                   else {
                         echo "Error";
                   }
              }
         }
    

}








private function send_maintenance(){

    $data = $this->postmodel->get_record("maintenance");
    
    $send_data =  $this->postmodel->send_maintenance($data);
         if ( $send_data ){
            
              foreach($send_data as $key => $value){
                   if ($value['response'] == "success"){
                        
                            foreach($data as $key1 => $value1){

                                   foreach($value1 as $key2 => $value2){
                                            
                                            $this->postmodel->update_flag($value2->maintenance_id, "1", "maintenance", "maintenance_id");

                                   }
                            }

                   }
                   else {
                         echo "Error";
                   }
              }
         }
    

}





private function send_voucher_setting(){

     $data = $this->postmodel->get_setting("voucher");
       if ( $data ){
          
          $send_data =  $this->postmodel->send_voucher_setting($data);
          
          if ( $send_data ){
               
               foreach($send_data as $key => $value){

                    if ($value['response'] == "success"){
                         
                           $this->send_voucher_logo();
                    }
                    else {
                          echo "Error";
                    }
               }
          }           

       }
           
}







private function send_controller_setting(){

     $data = $this->postmodel->get_setting("controller");
       if ( $data ){
          
          $send_data =  $this->postmodel->send_controller_setting($data);
          
          if ( $send_data ){
               
               foreach($send_data as $key => $value){

                    if ($value['response'] == "success"){
                         
                         $this->postmodel->update_setting_flag("1", "controller");  
                    }
                    else {
                          echo "Error";
                    }
               }
          }           

       }
           
}




private function send_voucher_logo(){

     $data1 = array();
     $tmp = array();

     $voucher = $this->postmodel->get_setting("voucher");
     $token = $this->postmodel->get_token();

              if ( $voucher AND $token){

                        foreach($voucher as $key => $value) {

                              
                                 foreach($value as $key1 => $value1){

                                   $voucher_logo = "public/src/img/" . $value1->voucher_logo . ".png";
                                   $image = base64_encode(file_get_contents($voucher_logo));
                                   $tmp['voucher_image'] = $image;
                                   $tmp['cloud_token'] = $token['cloud_token'];
                                   $tmp['voucher_logo'] = $value1->voucher_logo;
                                   array_push($data1, $tmp);
                                           
                                 }


                        }
                                   

                                           
                    
                    $result = $this->postmodel->send_voucher_logo($data1);
                         if ( $result ){
                                
                              foreach($result as $key => $value){

                                   if ($value['response'] == "success"){
                                        
                                        $this->postmodel->update_setting_flag("1", "voucher");
                                        
                                        
                                   }
                                   else {
                                         echo "Error from cloud";
                                   }
                              }




                              
                                
                         }
                        else {
                             
                             echo "Error";
                        }

                     
             }
      
}


















// this part is for getting data from cloud





public function get_controller(){

              $data = array();
              $tmp = array();

              $token = $this->postmodel->get_token();
                 if ( $token ){
 
                    $tmp['setting'] = "controller";
                    $tmp['cloud_token'] = $token['cloud_token'];
                    array_push($data, $tmp);
                    

                         $result = $this->postmodel->get_cloud_setting($data);

                         if ( $result ){
          
                              $result = $result[0];
                              unset($result['controller_id']);
                              unset($result['cloud_token']);
                              unset($result['date_updated']);
                              print_r($result);
                              $controller = $this->wifimodel->get_data("Controller");
                                if ( $controller ) {
                                   $this->wifimodel->update_data($result, "Controller", "id = 0" );
                                }
                                else {
                                   $this->wifimodel->insert_data($result, "Controller");
                                }
                               
                         }
                         
                        

                 }

              

      
      
}






public function get_voucher(){

     $data = array();
     $tmp = array();

     $token = $this->postmodel->get_token();
        if ( $token ){

           $tmp['setting'] = "voucher";
           $tmp['cloud_token'] = $token['cloud_token'];
           array_push($data, $tmp);
           

                $result = $this->postmodel->get_cloud_setting($data);

                if ( $result ){
 
                     print_r($result);
                }
                
               

        }


        


}











}