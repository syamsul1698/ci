<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensantri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('auth_model', 'auth');
        $this->load->model('mengajar_model', 'mengajar');
        $this->load->model('santri_model', 'santri');
        $this->load->model('kelas_model', 'kelas');
        $this->load->model('absen_model', 'absen');
        $this->load->model('pengasuh_model', 'pengasuh');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['absen'] = $this->absen->getAllabsenByID()->result();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();


        $data['judul'] = 'Absen';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar',$data);
        $this->load->view('absen/santri/index', $data);
        $this->load->view('templates/user_footer');
    }
}
