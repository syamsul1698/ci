<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('auth_model', 'auth');
        $this->load->model('artikel_model', 'artikel');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();

        $data['artikel'] = $this->artikel->getArtikel();

        $data['judul'] = 'Artikel';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('artikel/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function tambahartikel()
    {
        $data['user'] = $this->auth->getSession();

        $data['artikel'] = $this->artikel->getArtikel();

        $data['judul'] = 'Artikel';

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('isi', 'Berita', 'required|trim');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('artikel/tambah', $data);
            $this->load->view('templates/user_footer');
        } else {

            $upload_gambar = $_FILES['gambar']['name'];

            if ($upload_gambar) {
                $config['upload_path'] = './assets/img/artikel/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    echo $this->upload->display_errors();
                } else {
                    $new_gambar = $this->upload->data('file_name');
                    $data = [
                        'judul' => $this->input->post('judul'),
                        'isi' => $this->input->post('isi'),
                        'gambar' => $new_gambar
                    ];
                }
                $this->db->insert('artikel', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data telah Ditambahkan</div>');
                redirect('artikel');
            }
        }
    }

    public function edit($id)
    {
        $data['user'] = $this->auth->getSession();

        $data['artikel'] = $this->artikel->getaArtikelById($id);

        $data['judul'] = 'Artikel';

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('isi', 'Isi Berita', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('artikel/edit', $data);
            $this->load->view('templates/user_footer');
        } else {
        }
    }

    public function hapus($id)
    {
        $data['artikel'] = $this->artikel->getaArtikelById($id)->row_array();
        $gambar = $data['artikel']['gambar'];

        if ($gambar) {
            unlink(FCPATH . 'assets/img/artikel/' . $gambar);
        }

        $this->db->where('id_artikel', $id);
        $this->db->delete('artikel');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Dihapus</div>');
        redirect('artikel');
    }

    public function get()
    {
        $data = $this->artikel->crud('jam', '', '', 'all')->result();
        $data = $this->artikel->crud('a', 'skolo', $id, 'all')->result();
    }
}
