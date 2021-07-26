<?php
class Galileomodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('DB');
    }

    public function getGalileoSettings(){
        $savedConfig = $this->DB->getDataInfo("*", "galileo", array());
        return $savedConfig;
    }

    public function testConnection($galileoIP){
        exec("ping -c 4 $galileoIP ", $output, $status);
            if ( $status == 0 ) {
                return true;
            } else{
                return false;
            }
    }

    public function saveGalileo($galileoIP) {
        $hasSavedDetails = $this->getGalileoSettings();
        if(!$hasSavedDetails){
            return $this->DB->insertData(array("galileo_ip" => $galileoIP), "galileo");
        }

        return $this->DB->updateData(array("galileo_ip" => $galileoIP), "galileo", array("id >=" => 0));
    }
}
