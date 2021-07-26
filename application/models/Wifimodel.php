<?php
class Wifimodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('DB');
        $this->load->model('controller');
        $this->load->model('printer');
        $this->load->model('galileomodel');
    }

    public function login($username, $password)
    {
        $user =  $this->DB->getDataInfo("*", 'users', array('user_name=' => $username));
        if(!$user){
            return false;
        }

        if(!password_verify($password, $user["user_pass"])){
            return false;
        }

        if($user["user_status"] !== "Active"){
            return false;
        }

        $this->session->set_userdata('user_id', $user["user_id"]);
        $this->session->set_userdata('user_name', $user["name"]);
        $this->session->set_userdata('user_type', $user["user_type"]);

        return true;
    }

    public function checkConnections(){
        $controllerSettings = $this->controller->getControllerSettings();
        $printerSettings = $this->printer->getPrinterSettings();
        $galileoSettings = $this->galileomodel->getGalileoSettings();

        $isControllerConnected = $this->controller->testConnection($controllerSettings);
        $isPrinterConnected = $this->printer->testConnection($printerSettings["printer_ip"], $printerSettings["printer_port"]);
        $isGalileoConnected = $this->galileomodel->testConnection($galileoSettings["galileo_ip"]);

        return array(
            "printer_status" => $isPrinterConnected, 
            "controller_status" => $isControllerConnected,
            "galileo_status" => $isGalileoConnected,
        );
    }
}
