<?php
class Controller extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('DB');
    }

    public function getControllerSettings(){
        $savedConfig = $this->DB->getDataInfo("*", "controller", array());
        return $savedConfig;
    }

    public function testConnection($config){
        $this->load->library('phpunifi', $config);
        $isConnected = $this->phpunifi->testConnection();
        return $isConnected;
    }

    public function saveController($controllerDetails) {
        $hasSavedDetails = $this->getControllerSettings();
        if(!$hasSavedDetails){
            return $this->DB->insertData($controllerDetails, "controller");
        }

        return $this->DB->updateData($controllerDetails, "controller", array("id >=" => 0));
    }
}
