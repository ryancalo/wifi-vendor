<?php
class Voucher extends CI_Model
{
    public $LOGO_PATH = "public/src/img/";
    public $LOGO_FILEEXTENSION = "png";

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('DB');
    }

    public function getVoucherSettings(){
        $savedConfig = $this->DB->getDataInfo("*", "voucher", array());
        return $savedConfig;
    }

    public function saveVoucher($voucherDetails) {
        $hasSavedDetails = $this->getVoucherSettings();
        if(!$hasSavedDetails){
            return $this->DB->insertData($voucherDetails, "voucher");
        }

        return $this->DB->updateData($voucherDetails, "voucher", array("voucher_id >=" => 0));
    }
}
