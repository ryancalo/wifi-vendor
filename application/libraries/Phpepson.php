<?php 
require_once dirname(__FILE__) . '/php_epson/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class phpepson
{
   

 public function connect($address, $port)
  {
     try {   
               $connector = new NetworkPrintConnector($address, $port);
               $printer = new Printer($connector);
               return $printer;
         }
     catch(Exception $e) {

               return false;
         }
   }
	



   public function check_connection($address, $port)
   {
      try {   
                $connector = new NetworkPrintConnector($address, $port);
                $printer = new Printer($connector);
                $printer -> close();
                return 1;
          }
      catch(Exception $e) {
 
                return 0;
          }
    }



   public function print_test($logo, $voucher, $hour, $ip, $port, $steps, $note)

     {
     
    $hour =  number_format((float)$hour, 2, '.', '');
 
    $logo = EscposImage::load( $logo, true); 
    
    $printer = $this->connect($ip, $port);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> graphics($logo);
    $printer -> initialize();
    $printer -> setPrintLeftMargin(25);

    $printer -> text("\n");   
    $printer -> setTextSize(1, 1);
    $printer -> text($steps . "\n \n");

    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setTextSize(3, 3);
    $printer -> text($voucher. "\n");
    $printer -> setTextSize(1, 2);
    $printer -> text($hour. " Minute(s) \n \n");
    $printer -> setTextSize(1, 1);
    $printer -> text($note ."\n \n");
    $printer -> text(" THIS IS A PRINT TEST. \n \n");

    $printer -> cut();

    $printer -> close();

	  

}






     public function print_free($logo, $voucher, $hour, $ip, $port, $steps, $note)

         {


              $logo = EscposImage::load( $logo, true); 
              
              $printer = $this->connect($ip, $port);
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> graphics($logo);
              $printer -> initialize();
              $printer -> setPrintLeftMargin(25);

              $printer -> text("\n");   
              $printer -> setTextSize(1, 1);
              $printer -> text($steps . "\n \n");

              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> setTextSize(3, 3);
              $printer -> text($voucher. "\n");
              $printer -> setTextSize(1, 2);
              $printer -> text($hour. " Minutes(s) \n \n");
              $printer -> setTextSize(1, 1);
              $printer -> text($note ."\n \n");
              $printer -> cut();

              $printer -> close();
          
         }




     public function print_paid($logo, $voucher, $hour, $ip, $port, $steps, $note)

         {


              $logo = EscposImage::load( $logo, true); 
              
              $printer = $this->connect($ip, $port);
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> graphics($logo);
              $printer -> initialize();
              $printer -> setPrintLeftMargin(25);

              $printer -> text("\n");   
              $printer -> setTextSize(1, 1);
              $printer -> text($steps . "\n \n");

              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> setTextSize(3, 3);
              $printer -> text($voucher. "\n");
              $printer -> setTextSize(1, 2);
              $printer -> text($hour. " Minutes(s) \n \n");
              $printer -> setTextSize(1, 1);
              $printer -> text($note ."\n \n");
              $printer -> cut();

              $printer -> close();
          
         }










     public function print_earning_report($logo, $ip, $port, $date, $report , $date_printed, $user)

         {


              $logo = EscposImage::load( $logo, true); 
              

              $printer = $this->connect($ip, $port);
              
              


              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> graphics($logo);
              $printer -> initialize();
              $printer -> setPrintLeftMargin(25);

              $printer -> text("\n");   
              $printer -> setTextSize(1, 1);
              $printer -> text(" ----------- WIFI VENDO REPORT -----------\n \n");

              $printer -> setJustification(Printer::JUSTIFY_LEFT);

              $printer -> text("Date Covered: ".$date. "\n");

              $printer -> text("Earned: P" . number_format((float)$report, 2, '.', '') . "\n \n");

              $printer -> text(" ------------------------------------------\n \n");

              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> text($date_printed . "\n");
              $printer -> text($user . "\n \n");
              $printer -> cut();

              $printer -> close();
          
         }







     public function print_config_report($logo, $ip, $port, $controller, $printer_status, $notes )

         {


              $logo = EscposImage::load( $logo, true); 
              
              $printer = $this->connect($ip, $port);
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> graphics($logo);
              $printer -> initialize();
              $printer -> setPrintLeftMargin(25);

              $printer -> text("\n");   
              $printer -> setTextSize(1, 1);
              $printer -> text(" ----------- WIFI VENDO REPORT -----------\n \n");

              $printer -> setJustification(Printer::JUSTIFY_LEFT);

              $printer -> text("Controller: \n" . $controller . "\n \n");
              $printer -> text("Printer: \n" . $printer_status . "\n \n");
              $printer -> text(" ------------------------------------------\n \n");

              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> text($notes . "\n \n");

              $printer -> cut();

              $printer -> close();
          
         }













     public function print_collect_report($logo, $ip, $port, $date, $earned)

         {


              $logo = EscposImage::load( $logo, true); 
              
              $printer = $this->connect($ip, $port);
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> graphics($logo);
              $printer -> initialize();
              $printer -> setPrintLeftMargin(25);

              $printer -> text("\n");   
              $printer -> setTextSize(1, 1);
              $printer -> text("----------- WIFI VENDO REPORT -----------\n \n");

              $printer -> setJustification(Printer::JUSTIFY_LEFT);

              $printer -> text("DATE COVERED:\n" . $date . "\n \n");
              $printer -> text("DATE COLLECTED:\n " . date("Y-m-d h:ia") . "\n \n");
              $printer -> text("EARNED:\n" . $earned . "\n \n ");
              $printer -> text(" ------------------------------------------\n \n");
              $printer-> text("\n \n");




              $printer -> cut();

              $printer -> close();
          
         }







         public function print_changepaper($logo, $ip, $port)

         {


              $logo = EscposImage::load( $logo, true); 
              
              $printer = $this->connect($ip, $port);
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> graphics($logo);
              $printer -> initialize();
              $printer -> setPrintLeftMargin(25);

              $printer -> text("\n");   
              $printer -> setTextSize(1, 1);
              $printer -> text("----------- WIFI VENDO REPORT -----------\n \n");

              $printer -> setJustification(Printer::JUSTIFY_LEFT);

              $printer -> text("DATE CHANGE:\n " . date("Y-m-d h:ia") . "\n \n");
              $printer -> text(" ------------------------------------------\n \n");
              $printer -> setJustification(Printer::JUSTIFY_CENTER);
              $printer -> text("\n \n");



              $printer -> cut();

              $printer -> close();
          
         }














    function checkstatus($host1, $port){


                  $host = trim($host1,"https://wwww.");
                  
                      if($socket =@ fsockopen($host, $port, $errno, $errstr, 20)) {


                          
                          fclose($socket);


                          
                            
                            return true;




                      } else {


                            
                            
                             return false;




                          


                      }
                


               }















}




?>
