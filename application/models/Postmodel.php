<?php


class Postmodel extends CI_Model
{
  private function get_cloud()
  {
    $this->db->select('*');
    $this->db->from('cloud');
    $result = $this->db->get();

    if ($result->num_rows() > 0) {

      $data = array();
      foreach ($result->result() as $key => $value) {

        $data['cloud_ip'] = $value->cloud_ip;
        $data['cloud_port'] = $value->cloud_port;
        $data['cloud_token'] = $value->cloud_token;
      }
      return $data;
    } else {

      return false;
    }
  }

  private function send_data($address, $data)
  {
    $data = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $address);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result != "") {
      $result = json_decode($result, true);
      return $result;
    } else {
      return false;
    }
  }



  public function update_flag($record_id, $flag, $table, $field)
  {
    $flag = array("flag" => $flag);
    $this->db->where($field, $record_id);
    $this->db->update($table, $flag);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }


  public function update_setting_flag($flag, $table)
  {
    $flag = array("flag" => $flag);
    $this->db->update($table, $flag);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }


  public function get_record($table)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {
      $tmp = array();
      $cloud_token = $cloud['cloud_token'];


      $this->db->select('*');
      $this->db->from($table);
      $this->db->where("flag", "0");
      $result = $this->db->get();

      if ($result->num_rows() > 0) {

        $tmp[$cloud_token] = $result->result();

        return $tmp;
      } else {

        return false;
      }
    }
  }


  public function get_token()
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      return $cloud;
    }
  }


  public function get_setting($table)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {
      $tmp = array();
      $cloud_token = $cloud['cloud_token'];


      $this->db->select('*');
      $this->db->from($table);
      $this->db->where("flag", "0");
      $result = $this->db->get();

      if ($result->num_rows() > 0) {

        $tmp[$cloud_token] = $result->result();

        return $tmp;
      } else {

        return false;
      }
    }
  }



  public function send_voucher($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/received_voucher";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    }
  }



  public function send_voucher_logo($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/received_voucher_logo";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    }
  }



  public function send_logs($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/received_logs";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    }
  }


  public function send_alive_log($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/received_alive_log";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    }
  }


  public function send_maintenance($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/received_maintenance";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    }
  }


  public function send_voucher_setting($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/received_voucher_setting";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    } else {
      return "error";
    }
  }


  public function send_controller_setting($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {

      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/received_controller_setting";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    } else {
      return "error";
    }
  }


  //get data from cloud
  public function get_cloud_setting($data)
  {

    $cloud = $this->get_cloud();
    if ($cloud) {
      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/get_setting";
      $send_to_cloud = $this->send_data($address, $data);
      return $send_to_cloud;
    } else {
      return "error";
    }
  }


  public function request_token()
  {

    $cloud = $this->get_cloud();
    if ($cloud) {
      $address = $cloud['cloud_ip'] . ":" . $cloud['cloud_port'] . "/postapi/request_token";
      $send_to_cloud = $this->send_data($address, "");
      return $send_to_cloud;
    } else {
      return "error";
    }
  }
}
