<?php

class users_model extends CI_Model {

        public function get_user($id,$pwd)
        {       
                $sql = "SELECT * FROM users WHERE userEmail='$id' AND userPassword='$pwd'"; 
                return $this->db->query($sql)->result_array();
        }

        public function get_userByemail($id)
        {       
                $sql = "SELECT * FROM users WHERE userEmail='$id'"; 
                return $this->db->query($sql)->result_array();
        }

        public function get_userByemailedit($email,$id)
        {       
                $sql = "SELECT * FROM users WHERE userEmail='$email' AND userID not like '$id'"; 
                return $this->db->query($sql)->result_array();
        }

        public function get_Alluser()
        {       
                $sql = "SELECT * FROM users"; 
                return $this->db->query($sql)->result_array();
        }

        public function new_User($data)
        {       
                $this->db->insert('users', $data);
        }

        public function edit_user($data,$id)
        {       
                $this->db->where('userID', $id);
                $this->db->update('users', $data); 
        }

        public function delete_user($id)
        {       
                $this->db->where('userID', $id);
                $this->db->delete('users'); 
        }



}


?>