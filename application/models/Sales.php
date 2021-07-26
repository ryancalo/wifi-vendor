<?php
class Sales extends CI_Model
{
    public $PRICE_PER_VOUCHER = 5;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('DB');
    }

    public function newSale($voucherCode, $vocuherType){
        return $this->DB->insertData(array("voucher" => $voucherCode, "voucher_type" => $vocuherType, "record_date" => date("Y-m-d h:i")), "voucher_record");
    }
}
