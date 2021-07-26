<?php
class Printer extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('DB');

        $this->load->model('voucher');
        $this->load->model('sales');
    }

    public function getPrinterSettings(){
        $savedConfig = $this->DB->getDataInfo("*", "printer", array());
        return $savedConfig;
    }

    public function testConnection($printerIP, $printerPort){
        $this->load->library('phpepson', array("printer_ip" => $printerIP, "printer_port" => $printerPort));
        $isConnected = $this->phpepson->connect();
        if(!$isConnected){
            return false;
        }
        $isConnected->close();
        return true;
    }


    public function savePrinter($printerIP, $printerPort) {
        $hasSavedDetails = $this->getPrinterSettings();
        if(!$hasSavedDetails){
            return $this->DB->insertData(array("printer_ip" => $printerIP, "printer_port" =>  $printerPort), "printer");
        }

        return $this->DB->updateData(array("printer_ip" => $printerIP, "printer_port" =>  $printerPort), "printer", array("id >=" => 0));
    }


    public function printVoucher($vouchers, $voucherType) {
        $printerSettings = $this->getPrinterSettings();
        $voucherDetails = $this->voucher->getVoucherSettings();
        $this->load->library('phpepson', $printerSettings);

        foreach($vouchers as $voucher){
            $voucherDetails = array(
               "voucher_logo" => $this->voucher->LOGO_PATH . "" .$voucherDetails["voucher_logo"] ."." . $this->voucher->LOGO_FILEEXTENSION,
               "voucher_steps" => $voucherDetails["voucher_steps"], 
               "voucher_notes" => $voucherDetails["voucher_notes"],
               "voucher_duration" => $voucherDetails["voucher_duration"],
               "voucher_code" => $voucher,
            );

            $isPrinted = $this->phpepson->printVoucher($voucherDetails);
            if(!$isPrinted){
                return false;
                break;
            }
            $this->sales->newSale($voucher, $voucherType);
        }
        return true;
    }
}
