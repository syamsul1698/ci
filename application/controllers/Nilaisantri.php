<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilaisantri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('mengajar_model', 'mengajar');
        $this->load->model('santri_model', 'santri');
        $this->load->model('nilai_model', 'nilai');
        $this->load->model('kelas_model', 'kelas');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['nilai'] = $this->nilai->getNilaiById();


        $data['judul'] = 'Nilai';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('nilai/santri/index', $data);
        $this->load->view('templates/user_footer');
    }
}
