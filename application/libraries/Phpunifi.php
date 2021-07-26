<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/Unifi/vendor/autoload.php';

class phpunifi
{
    private $host;
    private $username;
    private $password;
    private $version;
    private $siteID;

    public function __construct($config)
    {
        $this->host = $config["controller_ip"] . ":" . $config["controller_port"];
        $this->username = $config["controller_username"];
        $this->password = $config["controller_password"];
        $this->version = $config["controller_version"];
        $this->siteID = $config["controller_siteid"];
    }

    private function connect()
    {
        $newCon = new UniFi_API\Client($this->username, $this->password, $this->host, $this->siteID, $this->version);
        if (!$newCon->login()) {
            return false;
        }

        return $newCon;
    }

    public function createVoucher($voucherOptions)
    {
        $newCon = $this->connect();
        if (!$newCon) {
            return [];
        }

        $result = $newCon->create_voucher(
            $voucherOptions["minutes"],
            $voucherOptions["count"],
            1,
            $voucherOptions["notes"],
            $voucherOptions["uplink"],
            $voucherOptions["downlink"],
            $voucherOptions["limit"]
        );
        $voucherDetails = $newCon->stat_voucher($result[0]->create_time);
        $vouchers = array();
        foreach($voucherDetails as $voucher => $value){
            array_push($vouchers, $value->code);
        }
        return $vouchers;
    }

    public function testConnection(){
        $newCon = $this->connect();
        if (!$newCon) {
            return false;
        }
        return true;
    }
}
