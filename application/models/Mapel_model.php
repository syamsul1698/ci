<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_model extends CI_Model
{
    public function getMapel()
    {
        return $this->db->get('mapel')->result();
    }
}
