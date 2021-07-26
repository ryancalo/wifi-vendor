<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/php_epson/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class phpepson
{

public function __construct($config)
{
    $this->printer_ip = $config["printer_ip"];
    $this->printer_port = $config["printer_port"];
}


 public function connect()
  {
    try {   
        $connector = new NetworkPrintConnector($this->printer_ip, $this->printer_port);
        $printer = new Printer($connector);
        return $printer;
    }catch(Exception $e) {
        return false;
    }
}
	

public function printVoucher($voucherOptions){
        $logo = EscposImage::load($voucherOptions["voucher_logo"], true); 
        $printer = $this->connect();
        if(!$printer){
            return false;
        }

        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> graphics($logo);
        $printer -> initialize();
        $printer -> setPrintLeftMargin(25);

        $printer -> text("\n");   
        $printer -> setTextSize(1, 1);
        $printer -> text($voucherOptions["voucher_steps"] . "\n \n");

        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> setTextSize(3, 3);
        $printer -> text($voucherOptions["voucher_code"]. "\n");
        $printer -> setTextSize(1, 2);
        $printer -> text($voucherOptions["voucher_duration"]. " Minutes(s) \n \n");
        $printer -> setTextSize(1, 1);
        $printer -> text($voucherOptions["voucher_notes"] ."\n \n");
        $printer -> cut();
        $printer -> close();

        return true;
    }

}

?>
