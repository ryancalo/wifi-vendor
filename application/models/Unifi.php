<?php
class Unifi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");

        $this->load->model('DB');
        $this->load->model('controller');
        $savedControllerConfig = $this->controller->getControllerSettings();
        $this->load->library('phpunifi', $savedControllerConfig);
    }


    public function createVoucher($numberOfVouchers){
        $savedVoucherSettings = $this->voucher->getVoucherSettings();
        $newVouchers = array(
            "minutes" => $savedVoucherSettings["voucher_duration"],
            "count" => $numberOfVouchers,
            "notes" => "wifi vendo",
            "uplink" => $savedVoucherSettings["bandwidth"],
            "downlink" => $savedVoucherSettings["bandwidth"],
            "limit" => $savedVoucherSettings["bandwidth_limit"],
        );
        $vouchers = $this->phpunifi->createVoucher($newVouchers);
        return $vouchers;
    }
}
