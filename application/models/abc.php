<?php 
    class Abc extends CI_Model {
            public function test(){
                $this->load->database();
               $user = $this->db->query("SELECT * from admin");    
                return $user;
            }               
    }
?>