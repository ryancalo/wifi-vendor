<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galileo extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('unifi');
    $this->load->model('printer');
    $this->load->model('wifimodel');
    $this->load->model('galileomodel');
    date_default_timezone_set("Asia/Manila");
  }

  public function print_voucher()
  {
    $token =  $this->input->post('booth_token');
    $voucherQty =  $this->input->post('voucher_qty');
    $galileoIP =  $this->input->post('galileo_ip');
    
    if ($token && $voucherQty && $galileoIP){

      // save galileo ip
      $this->galileomodel->saveGalileo($galileoIP);

      $vouchers = $this->unifi->createVoucher($voucherQty);
      if(count($vouchers) == 0){
            return $this->output->set_output(json_encode("failed to obtain voucher."));
      }

      $isPrinted = $this->printer->printVoucher($vouchers, "paid");
      if(!$isPrinted){
        return $this->output->set_output(json_encode("failed to print."));
      }

      return $this->output->set_output(json_encode("printe success."));
    }
  }


  public function check_peripherals()
  {
    $connectionStatus = $this->wifimodel->checkConnections();
    foreach($connectionStatus as $peripheral => $value){
      if(!$value){
        return $this->output->set_output(json_encode("0"));
        break;
      }
    }

    return $this->output->set_output(json_encode("1"));
  }
}
