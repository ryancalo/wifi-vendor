<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Db extends CI_Model {
  
    public function __construct(){
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
        date_default_timezone_set("Asia/Manila");
    }

    // getAll gets all data
    public function getAll($table, $param){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($param);
        $res = $this->db->get();
        if ($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }

    // getAllSort gets all data with sorting
    public function getAllSort($field, $table, $param, $sort){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($param);
        $this->db->order_by($sort['field'], $sort['order']);
        $res = $this->db->get();
        if ($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }


    public function countData($field, $table, $param){
        $this->db->select('count('.$field.') as ' . $field);
        $this->db->from($table);
        $this->db->where($param);
        $res = $this->db->get();
        if ($res->num_rows() > 0){
            $data = array();
            foreach( $res->result() as $key => $value ){
                foreach($value as $key1 => $value1){
                    $data[$key1] = $value1;    
                }           
            }           
           return $data;
        }else{
            return false;
        }
    }


    // getAllLike gets all data with like
    public function getAllLike($table, $param, $sort, $limit){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->group_start();
        $this->db->or_like($param);
        $this->db->group_end();
        $this->db->order_by($sort['field'], $sort['order']);
        $this->db->limit($limit);
        $res = $this->db->get();
        if ($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }

    // getAllLimit gets all data with limit
    public function getAllLimit($table, $param, $sort, $limit){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($param);
        $this->db->order_by($sort['field'], $sort['order']);
        $this->db->limit($limit);
        $res = $this->db->get();
        if ($res->num_rows() > 0){
            return $res->result();
        }else{
            return false;
        }
    }

    // getDataInfo gets data that can be access tru data[""], single map
    public function getDataInfo($field, $table, $param){
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($param);
        $res = $this->db->get();
        if ($res->num_rows() > 0){
            $data = array();
                foreach( $res->result() as $key => $value ){
                    foreach($value as $key1 => $value1){
                        $data[$key1] = $value1;    
                    }           
                }           
            return $data;
        }else{
            return false;
        }
    }

     // insertData inserts data to database
     public function insertData($data, $table){
        $this->db->insert($table, $data);
        $db_error = $this->db->error();
        if (!empty($db_error)) {
            log_message('error','Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
        }
        if($this->db->affected_rows() > 0){               
            return $this->db->insert_id();
        }else{
            return false;
        }      
     }

  
    // updateData updates data
     public function updateData($data, $table, $param){
        $this->db->where($param);
        $this->db->update($table, $data);
        $db_error = $this->db->error();

        if (!empty($db_error)) {
            log_message('error','Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
        } 

        if($this->db->affected_rows() > 0){               
               return true;
        }else{
               return false;
        }
     }

     // deleteData deletes data
     public function deleteData($table, $param){
        $this->db->delete($table, $param);
        $db_error = $this->db->error();
        if (!empty($db_error)) {
            log_message('error','Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
        }
        if($this->db->affected_rows() > 0){               
            return true;
        }else{
            return false;
        }
     }


     public function sumRecord($table, $param, $field){
        $this->db->select_sum($field);
        $this->db->from($table);
        $this->db->where($param);
        $res = $this->db->get();
        if ($res->num_rows() > 0){
            //return $res->result();
            $data = array();
                foreach( $res->result() as $key => $value ){
                    foreach($value as $key1 => $value1){
                        if(is_null($value1)){
                            $data[$key1] = 0;
                        }else{
                            $data[$key1] = $value1;
                        }                          
                    }           
                }         
            return $data;
        }else{
            return array($field => 0);
        }
     }

     public function searchRecord($table, $searchTerms, $fields){
         $this->db->distict();
         $this->db->select($fields);
         $this->db->from($table);
         $this->db->where($searchTerms);
         $res = $this->db->get();
         if ($res->num_rows() > 0){       
            return $res->result();
        }else{
            return false;
        }
     }
}


?>