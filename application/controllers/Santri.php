<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('auth_model', 'auth');
        $this->load->model('santri_model', 'santri');
        $this->load->model('admin_model', 'admin');
        $this->load->model('kelas_model', 'kelas');
        $this->load->model('pengasuh_model', 'pengasuh');
    }

    public function index()
    {
        $data['user'] = $this->auth->getSession();
        $data['santri'] = $this->santri->getAllSantri();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Siswa';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('santri/index', $data);
        $this->load->view('templates/user_footer');
    }


    public function tambah()
    {
        $data['user'] = $this->auth->getSession();
        $data['kelas'] = $this->kelas->getAllKelasByAsc()->result();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Siswa';

        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'required|trim',
            [
                'required' => 'Kolom %s harus terisi',
            ]
        );
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', [
            'required' => 'Kolom %s harus terisi',
            'is_unique' => '%s sudah terdaftar'
        ]);


        $this->form_validation->set_rules('tempat', 'Tempat', 'required|trim');
        $this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|numeric|is_unique[user.nip]');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|trim|min_length[8]|matches[password]');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('santri/tambah', $data);
            $this->load->view('templates/user_footer');
        } else {
            $upload_gambar = $_FILES['gambar']['name'];

            $pengasuh = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'nis' => htmlspecialchars($this->input->post('nis', true)),
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),

            ];

            $user = [
                'email' => htmlspecialchars($this->input->post('email', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nip' => htmlspecialchars($this->input->post('nis', true)),
                'is_active' => 1,
                'role_id' => 3
            ];
            if ($upload_gambar) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {

                    $new_gambar = $this->upload->data('file_name');
                    $pengasuh['gambar'] = $new_gambar;
                    $user['gambar'] = $new_gambar;
                }
            }
            $this->db->insert('santri', $pengasuh);
            $this->db->insert('user', $user);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data telah Ditambahkan, Silahkan Login</div>');
            redirect('santri');
        }
    }

    public function edit($id)
    {
        $data['user'] = $this->auth->getSession();

        $data['santri'] = $this->santri->getSantriById($id);
        $data['users'] = $this->admin->getUserById($id);
        $data['kelas'] = $this->kelas->getAllKelas()->result();
        $data['pengasuh'] = $this->pengasuh->getPengasuhBynip();

        $data['judul'] = 'Siswa';

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('santri/edit', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit_profil()
    {
        $upload_gambar = $_FILES['gambar']['name'];
        $nip = $this->input->post('nis');

        $santri = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'tempat_lahir' => htmlspecialchars($this->input->post('tempat', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'nis' => htmlspecialchars($this->input->post('nis', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'kelas' => htmlspecialchars($this->input->post('kelas', true)),

        ];

        $user = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'nip' => htmlspecialchars($this->input->post('nis', true)),

        ];
        if ($upload_gambar) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {

                $error = array('error' => $this->upload->display_errors());
                $this->load->view('santri/edit', $error);
            } else {
                $gambar_lama = $this->input->post('hapus_gambar');
                if ($gambar_lama != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                }
                $new_gambar = $this->upload->data('file_name');
                $santri['gambar'] = $new_gambar;
                $user['gambar'] = $new_gambar;
            }
        }
        $this->db->where('nis', $nip);
        $this->db->update('santri', $santri);
        $this->db->where('nip', $nip);
        $this->db->update('user', $user);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data telah Diubah</div>');
        redirect('santri');
    }

    public function hapus($id)
    {
        $data['santri'] = $this->db->get_where('santri', ['id_santri' => $id])->row_array();

        $gambar = $data['santri']['gambar'];

        if ($gambar) {
            unlink(FCPATH . 'assets/img/profile/' . $gambar);
        }

        $this->db->where('nis', $id);
        $this->db->delete('santri');
        $this->db->where('nip', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Telah Dihapus</div>');
        redirect('santri');
    }
}
