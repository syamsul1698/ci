<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id_user' => $id]);
    }
}
