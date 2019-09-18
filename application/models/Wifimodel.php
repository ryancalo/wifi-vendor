<?php


class Wifimodel extends CI_Model {




   public function get_data($table)
      {

       $this->db->select('*');
       $this->db->from($table);
       $result = $this->db->get();
       
         if($result->num_rows()> 0){

            $data = array();

            foreach( $result->result() as $key => $value ){

                foreach($value as $key1 => $value1){
                    $data[$key1] = $value1;    
                }           

             }
           
           return $data;

         }

         else{
              return false;
             }   


      }





   public function get_data_where($table, $param){

          

   }









    public function get_last_value($table, $param, $field, $order_field){

        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($param);
        $this->db->order_by($order_field, "DESC");
        $this->db->limit(1);
        $result = $this->db->get();
        
        if($result->num_rows()> 0){

            $data = array();

            foreach( $result->result() as $key => $value ){

                foreach($value as $key1 => $value1){
                    $data[$key1] = $value1;    
                }           

            }
            
            return $data;

        }

        else{
            return false;
            }           

    }








    public function get_first_value($table, $field, $order_field){

        $this->db->select($field);
        $this->db->from($table);
        $this->db->order_by($order_field, "ASC");
        $this->db->limit(1);
        $result = $this->db->get();
        
        if($result->num_rows()> 0){

            $data = array();

            foreach( $result->result() as $key => $value ){

                foreach($value as $key1 => $value1){
                    $data[$key1] = $value1;    
                }           

            }
            
            return $data;

        }

        else{
            return false;
            }           

    }


















    public function count_data($table, $param, $field){

        $this->db->select('COUNT('.$field. ') as tmp');
        $this->db->from($table);        
        $this->db->where($param);
        $result = $this->db->get();
        if($result->num_rows()> 0){

            foreach ($result->result() as $key => $value) {            
                        return $value->tmp;
            } 

             //return $this->db->last_query();
        }
        else
        {
            return false;
        }       

  }









  public function insert_data($data, $table){


            $this->db->insert($table, $data);
            if($this->db->affected_rows() > 0){               
                return true;
            }
            else{
                   return false;
               }
    
  }















   public function replace_data($data, $table){


        $this->db->replace($table, $data);
        if($this->db->affected_rows() > 0){               
            return true;
        }
        else{
               return false;
           }

   }








  public function update_data($data, $table, $param){

    $this->db->where($param);
    $this->db->update($table, $data); 
    
    if($this->db->affected_rows() > 0){               
           return true;
    }
    else{
           return false;
       }

  }





    public function test_speed(){


            $speed = exec("python public/speedtest/speed.py");
            return $speed;

    }






//Connectivity


        private function validate_host($host){
                    
            if (filter_var($host, FILTER_VALIDATE_URL)) {
                    return true;
            } else {
                    return false;
            }

        }




        private function validate_ip($ip){
        
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return true;
            } else {
                    return false;
            }

        }








     private function paper_status(){

            $printer = $this->get_data('printer');
            $param = array("record_date>=" => $printer['printer_paper']);

             $check_paper = $this->count_data("voucher_record", $param, "*");
             
                 if ( $check_paper ){
                       
                       $percent = ( $check_paper / $printer['paper_length']) * 100;
                       
                       return number_format((100 - $percent), 2, '.', '');
                 }
               else {
                   
                    $percent = round((0 / $printer['paper_length']) * 100);
                    return number_format((100 - $percent), 2, '.', '');     
 
               }
 
 
           
       }




   






    private function check_ping($ip){

                //check weather its a ip or a hostname            
                $check_ip = $this->validate_ip($ip);
                if ( $check_ip ){

                exec("ping -c 4 $ip ", $output, $status);


                    if ( $status == 0 ) {


                            return 1;

                        } else {
                    
                            return 0;
                        }

                }
                else{

                    $check_host = $this->validate_host($ip);
                        if ( $check_host ){
                            $tmp = parse_url($ip);                               
                            $host = $tmp['host'];
                            exec("ping -c 4 $host ", $output, $status);             

                            if ( $status == 0 ) {


                                    return 1;

                            } else {
                    
                                    return 0;
                                    }


                        }
                        else {

                                return 0;

                            }



                }
       

    }









    public function check_connection() {

            $controller = $this->get_data('controller');
            $printer = $this->get_data('printer');
            $galileo = $this->get_data('galileo');

            $controller_stat = $this->check_ping($controller['controller_ip']);
            $printer_stat = $this->check_ping($printer['printer_ip']);
            $galileo_stat = $this->check_ping($galileo['galileo_ip']);
            $outside_internet = $this->check_ping("172.217.31.238");
            $speedTest = $this->test_speed();
            $localhost_stat = $this->check_ping("127.0.0.1");
            $printer_paper = $this->paper_status();

            $epson = New phpepson;
            $printer_send_stat = $epson->check_connection($printer['printer_ip'], $printer['printer_port']);
            
            $controller_data = array('controller_username' => $controller['controller_username'],
                          'controller_password' => $controller['controller_password'],
                          'controller_address' => $controller['controller_ip'] . ":" . $controller['controller_port'],
                          'controller_siteid' => $controller['controller_siteid'],
                          'controller_version' => '4.7.6'
                          );

            $controller_send_stat = $this->get_active_user($controller_data);

            $data =  array("controller_stat" => $controller_stat,
                           "printer_stat" => $printer_stat,
                           "galileo_stat" => $galileo_stat,
                           "outside_internet" =>  $speedTest,
                           "printer_paper_status" => $printer_paper,
                           "printer_send_stat" => $printer_send_stat,
                           "localhost_stat" => $localhost_stat,
                           "controller_send_stat" => $controller_send_stat,
                           "date_checked" => date("Y-m-d H:i"));

            return $data;

    

    }








  //Unifi voucher creation

     public function create_voucher($data){


        $phpunifi = New phpunifi($data['controller_username'], $data['controller_password'], $data['controller_address'], $data['controller_siteid'], $data['controller_version']);

        $login = $phpunifi->login();

           if ( $login AND $login !== 400)
               {

                   $vouchers = $phpunifi->create_voucher($data['voucher_duration'], $data['voucher_num'], 'wifi vendo', $data['bandwidth'], $data['bandwidth'], $data['bandwidth_limit']);
              
                    return $vouchers; 

                   
                 
               }

           else {

                 return false;
           }

     }

   




    public function test_controller($data){

        $phpunifi = New phpunifi($data['controller_username'], $data['controller_password'], $data['controller_address'], $data['controller_siteid'], $data['controller_version']);

        $login = $phpunifi->login();

           if ( $login AND $login !== 400){
                  return 1;                
               }          
           elseif( $login === 400){                 
                    return 2;                                          
                }
           else{                                  
               return 0;
             }
         

    }
 








    public function get_active_user($data){


        $phpunifi = New phpunifi($data['controller_username'], $data['controller_password'], $data['controller_address'], $data['controller_siteid'], $data['controller_version']);
        $login = $phpunifi->login();
        if ( $login AND $login !== 400 )
            {
                $guest = $phpunifi->list_guests();
                $count = 0;
                if ( $guest ){
                      
                    foreach ($guest as $guest_key => $guest_value) {
                        if( $guest_value->expired == 0 AND $guest_value->name == "wifi vendo")
                        {
                           $count++;
                        }
                    }


                }
              return $count;
            }
        else {
             
             return "ERROR";
        }


    }












   public function delete_where($table, $param){
    
 
               $this->db->where($param);
               $this->db->delete($table);

               if($this->db->affected_rows() > 0){               
                     return true;
                }
               else{
                     return false;
                  }


     }












///STAFF LOGIN

//login


public function login_staff($username, $password){
       $query = $this->db->get_where('users', array('user_name=' => $username));
        if($query->num_rows()> 0){
              foreach ($query->result() as $row => $value)
                     {
                       if(password_verify($password, $value->user_pass) && $value->user_status == "Active"){
                               $this->session->set_userdata('user_id', $value->user_id);
                               $this->session->set_userdata('user_name', $value->name);
                               $this->session->set_userdata('user_type', $value->user_type);
                               return true;
                           }
                       else{
                                return false;
                            }
                      }
         }

        else{            
            return false;
         }

    }


















 }

?>