<?php 




if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/phpmqtt/phpMQTT.php');



class mqttphp
{



   public function connect_tobroker()
    {

       $CI =& get_instance();
       $CI->load->model('wifimodel');

       $cloud = $CI->wifimodel->get_cloud();

        if ( $cloud )

           {

               foreach ($cloud as $key => $value) {
                 
                
                    $server = $value->cloud_ip;     // change if necessary
                    $port = $value->cloud_mqtt_port;
                    $token = $value->cloud_token;




               }

                    $str = "Wifivendo";                        
                    $username = "";                   // set your username
                    $password = "";                   // set your password
                    $client_id = sha1($str); // make sure this is unique for connecting to sever - you could use uniqid()


                    

                    $mqtt = new phpMQTT($server, $port, $client_id);


                    if ($mqtt->connect(true, NULL, $username, $password) ){

                          return $mqtt;

                    } else {
                          return false;
                    }


           }





          




        

    }



   public function send_voucher($topic, $mqtt_msg)

       {
       $CI =& get_instance();
       $CI->load->model('wifimodel');

       $cloud = $CI->wifimodel->get_cloud();

       if ( $cloud )
         {


               foreach ($cloud as $key => $value) {
                 
                    $token = $value->cloud_token;


                }

         
  


           try 
            {

               $mqtt = $this->connect_tobroker();
               if ( $mqtt ) 
                   {

                      $mqtt->publish($topic, $token . "," . $mqtt_msg, 0);
                      $mqtt->close();
                      return true;

                   }
              else
                   {

                      return false;
                   }

             }
             catch(Exeption $e)
               {

                  return 'Message: ' .$e->getMessage();
               } 







       }


    }




 }






?>