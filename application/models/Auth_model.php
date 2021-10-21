<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function getSession()
    {
        
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
    }
    
     public function getAllUser()
    {
        $user = $this->db->query("SELECT * FROM user WHERE user.`role_id` = 1
        OR user.`role_id` = 2");
        return $user;
    }
}
