<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('auth_model', 'auth');
        $this->load->model('pengasuh_model', 'pengasuh');
    }
    public function index()
    {
        $data['user'] = $data['user'] = $this->auth->getSession();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'My Profile';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer');
    }
}
