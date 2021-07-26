<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
     {
          parent::__construct();
          $this->load->model('printer');
          $this->load->model('voucher');
          $this->load->model('controller');
          $this->load->model('galileomodel');
          date_default_timezone_set("Asia/Manila");

		if (empty($this->session->user_type) || $this->session->user_type !== "admin"){ 
			redirect(base_url(), 'refresh');
		}
     }
          
    public function index()
    {  
         $data['maintenance_log'] = array();                 
         $this->load->view('admin/header');
         $this->load->view('admin/navigation');
         $this->load->view('admin/home', $data);
         $this->load->view('admin/footer');
    }

   public function voucher(){
        $data['voucher'] = $this->voucher->getVoucherSettings();
        $data['voucher']["voucher_logo"] =  base_url() . $this->voucher->LOGO_PATH . $data['voucher']["voucher_logo"] . "." . $this->voucher->LOGO_FILEEXTENSION;
        $this->load->view('admin/header');
        $this->load->view('admin/navigation');
        $this->load->view('admin/voucher', $data);
        $this->load->view('admin/footer');     
   }

   public function controller(){
     $data['controller'] = $this->controller->getControllerSettings();
     $this->load->view('admin/header');
     $this->load->view('admin/navigation');
     $this->load->view('admin/controller', $data);
     $this->load->view('admin/footer');     
   }

   public function printer(){
     $this->load->model('printer');
     $data['printer'] = $this->printer->getPrinterSettings();
     $this->load->view('admin/header');
     $this->load->view('admin/navigation');
     $this->load->view('admin/printer', $data);
     $this->load->view('admin/footer');     
   }

   public function galileo(){
     $data['galileo'] = $this->galileomodel->getGalileoSettings();
     $this->load->view('admin/header');
     $this->load->view('admin/navigation');
     $this->load->view('admin/galileo', $data);
     $this->load->view('admin/footer');     
   }

   public function reports(){
          $this->load->view('admin/header');
          $this->load->view('admin/navigation');
          $this->load->view('admin/reports');
          $this->load->view('admin/footer');
   }

   
public function check_controller() {
     $controller_ip = $this->input->post('controller_ip');
     $controller_port = $this->input->post('controller_port');
     $controller_username = $this->input->post('controller_username');
     $controller_password = $this->input->post('controller_password');
     $controller_site = $this->input->post('controller_site');
     $controller_version = $this->input->post('controller_version');
 
     $controllerSettings = array(
          "controller_ip" => $controller_ip,
          "controller_port" => $controller_port,
          "controller_username"=> $controller_username,
          "controller_password"=> $controller_password,
          "controller_siteid"=>  $controller_site,
          "controller_version"=> $controller_version
     );
     $isConnected = $this->controller->testConnection($controllerSettings);
     if(!$isConnected){
       return $this->output->set_output(json_encode("Connection failed."));
     }

     return $this->output->set_output(json_encode("Connection Success."));
}


public function save_controller()
    {
          $controller_ip = $this->input->post('controller_ip');
          $controller_port = $this->input->post('controller_port');
          $controller_username = $this->input->post('controller_username');
          $controller_password = $this->input->post('controller_password');
          $controller_site = $this->input->post('controller_site');
          $controller_version = $this->input->post('controller_version');

          $controllerSettings = array(
               "controller_ip"=> $controller_ip,
               "controller_port"=> $controller_port,
               "controller_username"=> $controller_username,
               "controller_password"=> $controller_password,
               "controller_siteid"=> $controller_site,
               "controller_version"=> $controller_version,
               "flag" => 0
          );

          $isSaved = $this->controller->saveController($controllerSettings);

          if(!$isSaved){
               return $this->output->set_output(json_encode("Failed or saving with no changes."));
          }
          return $this->output->set_output(json_encode("Successfuly saved."));
    }

public function save_printer(){
     $printerIP = $this->input->post('printer_ip');
     $printerPort = $this->input->post('printer_port');
     if(!$printerIP || !$printerPort) {
          return $this->output->set_output(json_encode("All Fields are required."));
     }

     $isSaved = $this->printer->savePrinter($printerIP, $printerPort);
     if(!$isSaved){
          return $this->output->set_output(json_encode("Failed saving or saving with no changes."));
     }

     return $this->output->set_output(json_encode("Successfuly saved."));
}

public function check_printer(){
     $printerIP = $this->input->post('printer_ip');
     $printerPort = $this->input->post('printer_port');

     if(!$printerIP || !$printerPort) {
          return $this->output->set_output(json_encode("All Fields are required."));
     }

     $isConnected = $this->printer->testConnection($printerIP, $printerPort);
     if(!$isConnected){
          return $this->output->set_output(json_encode("Cant connect to printer."));
     }

     return $this->output->set_output(json_encode("Connected successfuly."));
}

public function save_galileo(){
     $galileoIP = $this->input->post('galileo_ip');
     if(!$galileoIP) {
          return $this->output->set_output(json_encode("All Fields are required."));
     }

     $isSaved = $this->galileomodel->saveGalileo($galileoIP);
     if(!$isSaved){
          return $this->output->set_output(json_encode("Failed saving or saving with no changes."));
     }

     return $this->output->set_output(json_encode("Successfuly saved."));
}

public function check_galileo(){
     $galileoIP = $this->input->post('galileo_ip');
     if(!$galileoIP) {
          return $this->output->set_output(json_encode("All Fields are required."));
     }

     $isConnected = $this->galileomodel->testConnection($galileoIP);
     if(!$isConnected){
          return $this->output->set_output(json_encode("Cant connect to galileo."));
     }

     return $this->output->set_output(json_encode("Connected successfuly."));
}


public function save_voucher(){
        $config['allowed_types'] = $this->voucher->LOGO_FILEEXTENSION;
        $config['upload_path'] = $this->voucher->LOGO_PATH;
        $config['max_width'] = '600';
        $config['max_height'] = '150';
        $config['file_name'] = "voucherlogo";
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config); 
        if($_FILES['fileToUpload']['size']== 0){
          return $this->output->set_output(json_encode("Voucher logo is required."));                 
        }
            
       if ($this->upload->do_upload('fileToUpload')) {
          $voucher_duration = $this->input->post('hourcoin');
          $bandwidth_limit = $this->input->post('bandwidth_limit');
          $bandwith_updown = $this->input->post('bandwidth_updown');
          $voucher_logo = $config['file_name'];
          $voucher_steps = ltrim($this->input->post('voucher_step'));
          $voucher_notes= ltrim($this->input->post('voucher_notes'));

          $voucherSettings = array( 
               "voucher_duration" => $voucher_duration,
               "bandwidth_limit" => $bandwidth_limit,
               "bandwidth" => $bandwith_updown,
               "voucher_logo" => $voucher_logo,
               "voucher_steps" => $voucher_steps,
               "voucher_notes" => $voucher_notes,
               "flag" => 0
          );

          $isVoucherSettingSaved = $this->voucher->saveVoucher($voucherSettings);
          if (!$isVoucherSettingSaved){
               return $this->output->set_output(json_encode("Failed to saved."));
          }
          return $this->output->set_output(json_encode("Successfuly Saved.")); 
     }else{
          return $this->output->set_output(json_encode($this->upload->display_errors())); 
     }
}


   public function print_free() {
     $this->load->model('unifi');
     $numberOfVouchers = $this->input->post('voucher_num');
          if(empty($numberOfVouchers) || $numberOfVouchers == "0"){
               return $this->output->set_output(json_encode("please provide at least 1 for number of voucher to print"));
          }
          $vouchers = $this->unifi->createVoucher($numberOfVouchers);
          if(count($vouchers) == 0){
               return $this->output->set_output(json_encode("Failed to obtain Voucher."));
          }

          $isPrinted = $this->printer->printVoucher($vouchers, "free");
          if(!$isPrinted){
               return $this->output->set_output(json_encode("Failed printing."));
          }
          return $this->output->set_output(json_encode("Voucher printed!."));
   }
}
