<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galileo extends CI_Controller {


    public function __construct()

           {
            parent::__construct();
            $this->load->model('wifimodel');
            date_default_timezone_set("Asia/Manila");
           }
     




   public function index(){

         //$controller =  $this->wifimodel->get_data('controller');
         $voucher = $this->wifimodel->get_data('voucher');
         //$printer = $this->wifimodel->get_data('Printer');
         //print_r($this->wifimodel->check_connection());
         // print_r($voucher);

         echo $voucher['voucher_logo'];
         

   }










    public function print_voucher(){

               
                $action = $this->input->post('action');
                $token =  $this->input->post('booth_token');
                $galileo_ip =  $this->input->post('galileoip');

                    if ( $action && $token && $galileo_ip ){

                         
                        $controller = $this->wifimodel->get_data('controller');
                        $printer = $this->wifimodel->get_data('printer');
                        $voucher = $this->wifimodel->get_data('voucher');
                        $cloud = $this->wifimodel->get_data('cloud');

                          //check if all has value
                            if ( $controller && $printer && $voucher && $cloud ){
                                  
                                     if ( $action == "printvoucher" ){


                                           //save galileo ip
                                                   
                                            $galileo = $this->wifimodel->update_data(array("galileo_ip"=> $galileo_ip), "galileo", array("id"=> 1));

                                            $epson = new phpepson; 
                                            $data = array('controller_username' => $controller['controller_username'],
                                                          'controller_password' => $controller['controller_password'],
                                                          'controller_address' => $controller['controller_ip'] . ":" . $controller['controller_port'],
                                                          'controller_siteid' => $controller['controller_siteid'],
                                                          'controller_version' => $controller['controller_version'],
                                                          'voucher_duration' => $voucher['voucher_duration'],
                                                          'voucher_num' => '1',
                                                          'bandwidth' => $voucher['bandwidth'],
                                                          'bandwidth_limit' => $voucher['bandwidth_limit']);
                                             
                                            $vouchers = $this->wifimodel->create_voucher($data);
                                              if ( $vouchers ){

                                                        foreach ($vouchers as $voucher_code) {
                                                                                                       
                                                              

                                                            $logo = 'public/src/img/' .  $voucher['voucher_logo'] . ".png";

                                                            try {

                                                                $print = $epson->print_paid($logo, $voucher_code, $voucher['voucher_duration'], $printer['printer_ip'], $printer['printer_port'], $voucher['voucher_steps'], $voucher['voucher_notes']);
                                                                $record_data = array('voucher' => $voucher_code,
                                                                                     'voucher_type' => 'Paid',
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
                                            else{
                                                  //Umable to create voucher
                                                  //save log


                                                    $log_data = array('subject' => 'Controller',
                                                    'log_details' => "Creating Voucher Failed",
                                                    'log_date' => date("Y-m-d H:i:s"),
                                                    'flag' => 0);

                                                     $this->wifimodel->insert_data($log_data, 'logs');


                                            }

                                     }
                                    elseif( $action == "getcon" ) {
                                        //if action sent by galileo is to check connection
                                        //things to check
                                        //Outside Connection
                                        //Printer *ping and *send
                                        //Galileo
                                        //Controller
                                        //paper status     
                                         
                                        


                                        $printer_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "printer_stat"), "device_status", "log_date");
                                        $printer_send_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "printer_send_stat"), "device_status", "log_date");
                                        $outside_internet = $this->wifimodel->get_last_value("alive_log", array("device_name" => "outside_internet"), "device_status", "log_date");
                                        $galileo_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "galileo_stat"), "device_status", "log_date");
                                        $controller_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "controller_stat"), "device_status", "log_date");
                                        $controller_send_stat = $this->wifimodel->get_last_value("alive_log", array("device_name" => "controller_send_stat"), "device_status", "log_date");
                                        $printer_paper_status = $this->wifimodel->get_last_value("alive_log", array("device_name" => "printer_paper_status"), "device_status", "log_date");

                                            if ($printer_stat['device_status'] == "1" && $printer_send_stat['device_status'] == "1" && $outside_internet['device_status'] != "None" && $galileo_stat['device_status'] == "1" && $controller_stat['device_status'] == "1" && $controller_send_stat['device_status'] != "ERROR" && $printer_paper_status['device_status'] > "0") {

                                                 echo 1;

                                            }
                                            else {
                                                  
                                                 echo 0;
                                            }

                                    }
                                     


                            }


                    } 



    }







public function button_event(){

        if ( $this->input->post('action') ){

           $action = $this->input->post('action');
           $printer = $this->wifimodel->get_data("Printer");
           $voucher = $this->wifimodel->get_data("voucher");
           $controller = $this->wifimodel->get_data("Controller");
           $voucher_logo = 'public/src/img/' . $voucher['voucher_logo'];

           $amount_per_record = 5;

              if ( $printer && $controller){
                   $epson = new phpepson;

                     if ( $action == "changepaper" ){

                              try {

                                     $voucher_logo = 'public/src/img/' . $voucher['voucher_logo'];

                                     $maintenance_data = array(
                                                               "maintenance_type" => "CHANGE PAPER",
                                                               "maintenance_details" => "",
                                                               "maintenance_date" => date("Y-m-d H:i"),
                                                               "flag" => 0
                                                               );
                                     $print =  $epson->print_changepaper($voucher_logo, $printer['printer_ip'], $printer['printer_port']);
                                     $update_paper = $this->wifimodel->update_data(array("printer_paper"=> date("Y-m-d H:i")), "printer", array("id"=> 0 ));
                                     $save_maintenance_log = $this->wifimodel->insert_data($maintenance_data, "maintenance");

                              }
                              catch(Exception $e){

                                $detail =  'Message: ' .$e->getMessage();
                                $log_data = array('subject' => 'Printer',
                                                  'log_details' => $detail,
                                                  'log_date' => date("Y-m-d H:i:s"),
                                                  'flag' => 0);

                                $this->wifimodel->insert_data($log_data, 'logs');                                    

                              }
                        
                          
                       
                     } 
                  elseif ( $action == "collectvault" ) {

                       
                               try {

                                $last_collection = $this->wifimodel->get_last_value("maintenance", array("maintenance_type"=> "COLLECTION"), "maintenance_date", "maintenance_date");
                                     if ( $last_collection ){
                                         
                                            $collection = $this->wifimodel->count_data("voucher_record", array("record_date >=" =>  $last_collection['maintenance_date'], "voucher_type"=> "Paid" ) , "*");
                                            $print =  $epson->print_collect_report($voucher_logo, $printer['printer_ip'], $printer['printer_port'], $last_collection['maintenance_date'], (int)$collection*$amount_per_record );

                                            $maintenance_data = array(
                                                                    "maintenance_type" => "COLLECTION",
                                                                    "maintenance_details" => "Colletion amount: " . (int)$collection*$amount_per_record,
                                                                    "maintenance_date" => date("Y-m-d H:i"),
                                                                    "flag" => 0
                                                                    ); 
                                            $save_maintenance_log = $this->wifimodel->insert_data($maintenance_data, "maintenance");
                                              
                                              
                                     }
                                     else {
                                          
                                            $last_collection  = $this->wifimodel->get_first_value("voucher_record", "record_date", "record_date");
                                                if ( $last_collection )  {
                                                      
                                                     $collection = $this->wifimodel->count_data("voucher_record", array("record_date >=" =>  $last_collection['record_date'], "voucher_type"=> "Paid" ), "*");
                                                     $print =  $epson->print_collect_report($voucher_logo, $printer['printer_ip'], $printer['printer_port'], $last_collection['record_date'], (int)$collection*$amount_per_record );


                                                     $maintenance_data = array(
                                                                            "maintenance_type" => "COLLECTION",
                                                                            "maintenance_details" => "Colletion amount: " . (int)$collection*$amount_per_record,
                                                                            "maintenance_date" => date("Y-m-d H:i"),
                                                                            "flag" => 0
                                                                            ); 
                                                      $save_maintenance_log = $this->wifimodel->insert_data($maintenance_data, "maintenance");


                                                } 
                                     }

                               }
                               catch(Exception $e){

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





?>