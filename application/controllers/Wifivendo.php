<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wifivendo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");
        $this->load->model('wifimodel');
    }

    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('login');
        $this->load->view('admin/footer');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->wifimodel->login($username, $password);
        if ($result) {
            redirect(base_url() . $this->session->user_type);
        } else {
            redirect(base_url());
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function check_connection()
    {
        $connectionStatus = $this->wifimodel->checkConnections();
        print_r($connectionStatus);
    }

}
