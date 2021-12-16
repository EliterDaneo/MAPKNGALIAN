<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        /*-- Check Session  --*/
        is_login();
        /*-- untuk mengatasi error confirm form resubmission  --*/
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        $this->load->model('admin_model');
        $this->load->model('contact_model');
    }

    public function index()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'MA PK NGALIAN',
            'title1' => 'Dashboard',
            'logo' => $this->admin_model->detailLogo(),
            'visitor' => $this->admin_model->statistik_pengujung(),
            'isi' => 'Admin/v_admin_dashboard',
        );
        $this->load->view('Admin/Layout/v_wrapper_dashboard', $data, FALSE);
    }

    //controler Management Users
    public function ManagementUsers()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data Pengguna',
            'pengguna' => $this->admin_model->listManagementUsers(),
            'logo' => $this->admin_model->detailLogo(),
            'title1' => 'User Settings',
            'isi' => 'Admin/Settings/admin_users'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function AddUserManagement()
    {

        if ($this->input->post('level') == 'Administrator') {

            $this->form_validation->set_rules('fullnameAdmin', 'FullName', 'required');
            // $this->form_validation->set_rules('emailAdmin','Email','trim|required|valid_email');
            $this->form_validation->set_rules('usernameAdmin', 'Username', 'required|is_unique[tbl_user.username]', [
                'is_unique' => 'Username Sudah Dipakai!'
            ]);
            $this->form_validation->set_rules('passwordAdmin', 'Password', 'required');
        } elseif ($this->input->post('level') == 'Guru') {

            $this->form_validation->set_rules('fullnameGuru', 'FullName', 'required');
            // $this->form_validation->set_rules('emailGuru','Email','trim|required|valid_email');
            $this->form_validation->set_rules('usernameGuru', 'Username', 'required|is_unique[tbl_user.username]', [
                'is_unique' => 'Username Sudah Dipakai!'
            ]);
            $this->form_validation->set_rules('passwordGuru', 'Password', 'required');
        } elseif ($this->input->post('level') == 'Wali') {
            $this->form_validation->set_rules('fullnameWali', 'FullName', 'required');
            // $this->form_validation->set_rules('emailWali','Email','trim|required|valid_email');
            $this->form_validation->set_rules('usernameWali', 'Username', 'required|is_unique[tbl_user.username]', [
                'is_unique' => 'Username Sudah Dipakai!'
            ]);
            $this->form_validation->set_rules('passwordWali', 'Password', 'required');
        } elseif ($this->input->post('level') == 'Siswa') {
            $this->form_validation->set_rules('fullnameSiswa', 'FullName', 'required');
            // $this->form_validation->set_rules('emailSiswa','Email','trim|required|valid_email');
            $this->form_validation->set_rules('usernameSiswa', 'Username', 'required|is_unique[tbl_user.username]', [
                'is_unique' => 'Username Sudah Dipakai!'
            ]);
            $this->form_validation->set_rules('passwordSiswa', 'Password', 'required');
        }

        $this->form_validation->set_rules('level', 'Level', 'required');


        if ($this->form_validation->run() == false) {

            $data = array(
                'parent' => 'Pengguna',
                'page' => 'Data Pengguna Add',
                'isi' => 'Admin/Settings/admin_addmanagement',
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'userAll' => $this->admin_model->getUsers(),
                'guruAll' => $this->admin_model->getGuru(),
                'siswaAll' => $this->admin_model->getSiswa(),
                'logo' => $this->admin_model->detailLogo()
            );

            $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
        } else {

            if ($this->input->post('level') == 'Administrator') {

                $data = [

                    'nama_user' => $this->input->post('fullnameAdmin'),
                    'email' => $this->input->post('emailAdmin'),
                    'username' => $this->input->post('usernameAdmin'),
                    'password' => password_hash($this->input->post('passwordAdmin'), PASSWORD_DEFAULT),
                    'level' => $this->input->post('level')

                ];
            } elseif ($this->input->post('level') == 'Guru') {

                $data = [

                    'nama_user' => $this->input->post('fullnameGuru'),
                    'email' => $this->input->post('emailGuru'),
                    'username' => $this->input->post('usernameGuru'),
                    'password' => password_hash($this->input->post('passwordGuru'), PASSWORD_DEFAULT),
                    'level' => $this->input->post('level')

                ];
            } elseif ($this->input->post('level') == 'Wali') {

                $data = [

                    'nama_user' => $this->input->post('fullnameWali'),
                    'email' => $this->input->post('emailWali'),
                    'username' => $this->input->post('usernameWali'),
                    'password' => password_hash($this->input->post('passwordWali'), PASSWORD_DEFAULT),
                    'level' => $this->input->post('level')

                ];
            } elseif ($this->input->post('level') == 'Siswa') {
                //
                $username = $this->input->post('usernameSiswa');
                $pecahusername = str_replace("siswa", "", $username);
                $foto = $this->db->get_where('tbl_siswa', ['nis' => $pecahusername])->row();

                $data = [

                    'nama_user' => $this->input->post('fullnameSiswa'),
                    'email' => $this->input->post('emailSiswa'),
                    'username' => $this->input->post('usernameSiswa'),
                    'password' => password_hash($this->input->post('passwordSiswa'), PASSWORD_DEFAULT),
                    'level' => $this->input->post('level'),
                    'foto_user' => $foto->foto_siswa,

                ];
            }

            $this->db->insert('tbl_user', $data);
            $this->toastr->success('Data User Telah Ditambahkan!');
            redirect('Admin/ManagementUsers');
        }
    }

    public function pengaturanPenggunaEdit($id_user = null)
    {

        if ($this->form_validation->run() == false) {

            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Data Pengguna',
                'pengguna' => $this->admin_model->listManagementUsers(),
                'logo' => $this->admin_model->detailLogo(),
                'parent' => "Data Pengguna",
                'page' => "Data Pengguna Edit",
                'isi' => 'Admin/Settings/admin_penggunaEdit'
            );
            $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
        } else {

            $data = [

                'full_name' => $this->db->escape_str($this->input->post('fullname', true)),
                'email' => $this->db->escape_str($this->input->post('email', true)),
                'username' => $this->db->escape_str($this->input->post('username', true)),
                'password' => $this->db->escape_str(password_hash($this->input->post('password', true), PASSWORD_DEFAULT)),
                'level' => $this->db->escape_str($this->input->post('level', true))

            ];

            $this->db->where('id_user', $this->input->post('z'));
            $this->db->update('tb_users', $data);
            $this->toastr->success('Data Users  ' . $this->input->post('fullname') . ' dan Wali Telah Di Update!');
            redirect('Admin/ManagementUsers');
        }
    }

    public function fetch_nikGuru()
    {

        if ($this->input->post('idGuru')) {

            $dataGuru = $this->db->get_where('tbl_guru', ['id_guru' => $this->input->post('idGuru')])->row();
            $data['nama'] = $dataGuru->nama_guru;
            $data['nik'] = "guru$dataGuru->nik";
            echo json_encode($data);
        }
    }


    public function fetch_nisnWali()
    {

        if ($this->input->post('nisnWali')) {

            $dataNISNWali = $this->db->get_where('tbl_siswa', ['id_siswa' => $this->input->post('nisnWali')])->row();
            $dataWali = $this->db->get_where('tbl_siswa', ['id_siswa' => $this->input->post('nisnWali')])->row();
            $data['nama'] = $dataWali->wali_siswa;
            $data['nisn'] = "wali$dataNISNWali->nis";
            echo json_encode($data);
        }
    }

    public function fetch_nisnSiswa()
    {
        if ($this->input->post('nisnSiswa')) {

            $dataNISSiswa = $this->db->get_where('tbl_siswa', ['id_siswa' => $this->input->post('nisnSiswa')])->row();
            $data['nama'] = $dataNISSiswa->nama_siswa;
            $data['nisn'] = "siswa$dataNISSiswa->nis";
            echo json_encode($data);
        }
    }

    // Setting Logo
    public function SettingsLogo()
    {
        $this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'required');
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/logo/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('logo')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Settings Logo',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/Settings/admin_settings_logo'
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/logo/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $logo = $this->admin_model->detailLogo();
                if ($logo->logo != "") {
                    unlink('./assets/data/foto/logo/' . $logo->logo);
                }
                //tutup

                $data = array(
                    'id_logo'                         => '1',
                    'nama_sekolah'                 => $this->input->post('nama_sekolah'),
                    'logo'                 => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->save_logo($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Setings Logo Berhasih Di Ubah!!!</div>');
                redirect('Admin/SettingsLogo');
            }
            $data = array(
                'id_logo'                         => '1',
                'nama_sekolah'                 => $this->input->post('nama_sekolah'),
            );
            $this->admin_model->save_logo($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Setings Logo Berhasih Di Ubah!!!</div>');
            redirect('Admin/SettingsLogo');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title'     => 'Settings logo',
            'logo'     => $this->admin_model->detailLogo(),
            'title1'     => 'MA PK NGALIAN',
            'isi'        => 'Admin/Settings/admin_settings_logo'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }
    // Structure
    public function SettingsSturcture()
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/struktur/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('struktur')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Settings Logo',
                    'logo' => $this->admin_model->detailLogo(),
                    'struktur' => $this->admin_model->detailstruktur(),
                    'isi' => 'Admin/Settings/admin_struktur'
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/struktur/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $struktur = $this->admin_model->detailLogo();
                if ($struktur->foto_struktur != "") {
                    unlink('./assets/data/foto/struktur/' . $struktur->foto_struktur);
                }
                //tutup

                $data = array(
                    'id_struktur'                         => '1',
                    'keterangan'                 => $this->input->post('keterangan'),
                    'foto_struktur'                 => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->save_keterangan($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Setings Logo Berhasih Di Ubah!!!</div>');
                redirect('Admin/SettingsSturcture');
            }
            $data = array(
                'id_struktur'                         => '1',
                'keterangan'                 => $this->input->post('keterangan'),
            );
            $this->admin_model->save_struktur($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Setings Logo Berhasih Di Ubah!!!</div>');
            redirect('Admin/SettingsSturcture');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title'     => 'Settings Struktur Organisasi',
            'struktur'     => $this->admin_model->detailstruktur(),
            'logo' => $this->admin_model->detailLogo(),
            'title1'     => 'MA PK NGALIAN',
            'isi'        => 'Admin/Settings/admin_struktur'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    //controler website

    public function SettingsWebsite()
    {

        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('telepon', 'No Telepon', 'required');
        $this->form_validation->set_rules('email', 'Emai', 'required');
        $this->form_validation->set_rules('kepala_sekolah', 'Kepala sekolah', 'required');
        $this->form_validation->set_rules('visi', 'Visi', 'required');
        $this->form_validation->set_rules('misi', 'Misi', 'required');
        $this->form_validation->set_rules('sejarah', 'Sejarah', 'required');
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/sekolah/foto_kapsek/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_kapsek')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Settings Website',
                    'seting' => $this->admin_model->detailWebsite(),
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/Settings/admin_website'
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/sekolah/foto_kapsek/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $seting = $this->admin_model->detailWebsite();
                if ($seting->foto_kapsek != "") {
                    unlink('./assets/data/foto/sekolah/foto_kapsek/' . $seting->foto_kapsek);
                }
                //tutup

                $data = array(
                    'id'                         => '1',
                    'nip'                         => $this->input->post('nip'),
                    'nama_sekolah'                 => $this->input->post('nama_sekolah'),
                    'alamat'                     => $this->input->post('alamat'),
                    'telepon'                     => $this->input->post('telepon'),
                    'email'                        => $this->input->post('email'),
                    'kepala_sekolah'            => $this->input->post('kepala_sekolah'),
                    'visi'                         => $this->input->post('visi'),
                    'misi'                         => $this->input->post('misi'),
                    'sejarah'                     => $this->input->post('sejarah'),
                    'foto_kapsek'                 => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->save_seting($data);
                $this->session->set_flashdata('pesan', 'Settings Web Berhasil Di Update!!');
                redirect('Admin/SettingsWebsite');
            }
            $data = array(
                'id'                         => '1',
                'nip'                         => $this->input->post('nip'),
                'nama_sekolah'                 => $this->input->post('nama_sekolah'),
                'alamat'                     => $this->input->post('alamat'),
                'telepon'                     => $this->input->post('telepon'),
                'email'                        => $this->input->post('email'),
                'kepala_sekolah'            => $this->input->post('kepala_sekolah'),
                'visi'                         => $this->input->post('visi'),
                'misi'                         => $this->input->post('misi'),
                'sejarah'                     => $this->input->post('sejarah'),
            );
            $this->admin_model->save_settingWebsite($data);
            $this->session->set_flashdata('pesan', 'Settings Web Berhasil Di Update!!');
            redirect('Admin/SettingsWebsite');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title'     => 'Settings Website',
            'seting'     => $this->admin_model->detailWebsite(),
            'logo' => $this->admin_model->detailLogo(),
            'title1'     => 'MA PK NGALIAN',
            'isi'        => 'Admin/Settings/admin_website'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }



    //controler News
    public function SettingsNews()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data News',
            'logo' => $this->admin_model->detailLogo(),
            'News' => $this->admin_model->listNews(),
            'isi' => 'Admin/master/SettingsNews/news'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function AddNews()
    {
        $this->form_validation->set_rules('judul_News', 'judul_News', 'required');
        $this->form_validation->set_rules('isi_News', 'isi_News', 'required', array('required' => '%s Harus diisi!!'));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/gambar_News/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar_News')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Tambah News',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/pengaturanNews/AddNews',
                    'error' => $this->upload->display_errors(),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/gambar_News/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'judul_News'                 => $this->input->post('judul_News'),
                    'slug_News'                 => url_title($this->input->post('judul_News'), 'dash', TRUE),
                    'isi_News'                 => $this->input->post('isi_News'),
                    'tanggal_News'            => date('Y-m-d'),
                    'id_user'                    => $this->session->userdata('id_user'),
                    'gambar_News'             => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->AddNews($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">News Berhasil Diposting!!!</div>');
                redirect('Admin/pengaturanNews');
            }
        }

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Tambah News',
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/pengaturanNews/AddNews'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }


    public function EditNews($id_News)
    {
        $this->form_validation->set_rules('judul_News', 'judul_News', 'required');
        $this->form_validation->set_rules('isi_News', 'isi_News', 'required', array('required' => '%s Harus diisi!!'));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/gambar_News/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar_News')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title'         => 'Edit News',
                    'isi'             => 'Admin/master/pengaturanNews/EditNews',
                    'error'         => $this->upload->display_errors(),
                    'logo' => $this->admin_model->detailLogo(),
                    'News'         => $this->admin_model->DetailNews($id_News),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/img/gambar_News/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $News = $this->admin_model->DetailNews($id_News);
                if ($News->gambar_News != "") {
                    unlink('./assets/data/foto/gambar_News/' . $News->gambar_News);
                }
                //tutup
                $data = array(
                    'id_News'                    => $id_News,
                    'judul_News'                 => $this->input->post('judul_News'),
                    'slug_News'                 => url_title($this->input->post('slug_News'), 'dash', TRUE),
                    'isi_News'                 => $this->input->post('isi_News'),
                    'tanggal_News'            => date('Y-m-d'),
                    'id_user'                    => $this->session->userdata('id_user'),
                    'gambar_News'             => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->EditNews($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Edit!!!</div>');
                redirect('Admin/pengaturanNews');
            }
            $data = array(
                'id_News'                    => $id_News,
                'judul_News'                 => $this->input->post('judul_News'),
                'slug_News'                 => url_title($this->input->post('slug_News'), 'dash', TRUE),
                'isi_News'                 => $this->input->post('isi_News'),
                'tanggal_News'            => date('Y-m-d'),
                'id_user'                    => $this->session->userdata('id_user'),
            );
            $this->admin_model->EditNews($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Edit!!!</div>');
            redirect('Admin/pengaturanNews');
        }

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit News',
            'logo' => $this->admin_model->detailLogo(),
            'News' => $this->admin_model->DetailNews($id_News),
            'isi' => 'Admin/master/pengaturanNews/EditNews',
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function DeleteNews($id_News)
    {
        //menghapus foto
        $News = $this->admin_model->DetailNews($id_News);
        if ($News->gambar_News != "") {
            unlink('./assets/data/foto/gambar_News/' . $News->gambar_News);
        }
        //tutup

        $data = array('id_News' => $id_News);
        $this->admin_model->DeleteNews($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Hapus!!!</div>');
        redirect('News');
    }

    public function inbox()
    {
        $this->contact_model->update_status_kontak();
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Inbox',
            'logo' => $this->admin_model->detailLogo(),
            'data' => $this->contact_model->get_all_inbox(),
            'isi' => 'Admin/Massage/v_pesan'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    function hapus_inbox()
    {
        $kode = $this->input->post('kode');
        $this->contact_model->hapus_kontak($kode);
        echo $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil Di Hapus!</div>');
        redirect('Admin/pesan');
    }

    //Sarpras
    public function Sarpras()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data Sarana Prasarana',
            'logo' => $this->admin_model->detailLogo(),
            'sarpras' => $this->admin_model->listSarpras(),
            'isi' => 'Admin/master/Sarpras/HomeSarpras'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function AddSarpras()
    {
        $this->form_validation->set_rules('nama_sarpras', 'judul_News', 'required');
        $this->form_validation->set_rules('keterangan_sarana', 'judul_News', 'required');
        $this->form_validation->set_rules('keterangan_alat', 'judul_News', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/sarpras/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('sarpras')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Tambah Sarpras',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/Sarpras/AddSarpras',
                    'error' => $this->upload->display_errors(),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/sarpras/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nama_sarpras'                 => $this->input->post('judul_News'),
                    'keterangan_sarana'                 => url_title($this->input->post('judul_News'), 'dash', TRUE),
                    'keterangan_alat'                 => $this->input->post('isi_News'),
                    'tanggal'            => date('Y-m-d'),
                    'id_user'                    => $this->session->userdata('id_user'),
                    'foto'             => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->AddNews($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">News Berhasil Diposting!!!</div>');
                redirect('Admin/pengaturanNews');
            }
        }

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Tambah News',
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Sarpras/AddSarpras'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }


    public function EditSarpras($id_News)
    {
        $this->form_validation->set_rules('judul_News', 'judul_News', 'required');
        $this->form_validation->set_rules('isi_News', 'isi_News', 'required', array('required' => '%s Harus diisi!!'));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/gambar_News/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar_News')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title'         => 'Edit News',
                    'isi'             => 'Admin/master/pengaturanNews/EditNews',
                    'error'         => $this->upload->display_errors(),
                    'logo' => $this->admin_model->detailLogo(),
                    'News'         => $this->admin_model->DetailNews($id_News),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/img/gambar_News/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $News = $this->admin_model->DetailNews($id_News);
                if ($News->gambar_News != "") {
                    unlink('./assets/data/foto/gambar_News/' . $News->gambar_News);
                }
                //tutup
                $data = array(
                    'id_News'                    => $id_News,
                    'judul_News'                 => $this->input->post('judul_News'),
                    'slug_News'                 => url_title($this->input->post('slug_News'), 'dash', TRUE),
                    'isi_News'                 => $this->input->post('isi_News'),
                    'tanggal_News'            => date('Y-m-d'),
                    'id_user'                    => $this->session->userdata('id_user'),
                    'gambar_News'             => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->EditNews($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Edit!!!</div>');
                redirect('Admin/pengaturanNews');
            }
            $data = array(
                'id_News'                    => $id_News,
                'judul_News'                 => $this->input->post('judul_News'),
                'slug_News'                 => url_title($this->input->post('slug_News'), 'dash', TRUE),
                'isi_News'                 => $this->input->post('isi_News'),
                'tanggal_News'            => date('Y-m-d'),
                'id_user'                    => $this->session->userdata('id_user'),
            );
            $this->admin_model->EditNews($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Edit!!!</div>');
            redirect('Admin/pengaturanNews');
        }

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit News',
            'logo' => $this->admin_model->detailLogo(),
            'News' => $this->admin_model->DetailNews($id_News),
            'isi' => 'Admin/master/pengaturanNews/EditNews',
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function Deleted($id_News)
    {
        //menghapus foto
        $News = $this->admin_model->DetailNews($id_News);
        if ($News->gambar_News != "") {
            unlink('./assets/data/foto/gambar_News/' . $News->gambar_News);
        }
        //tutup

        $data = array('id_News' => $id_News);
        $this->admin_model->DeleteNews($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Hapus!!!</div>');
        redirect('News');
    }

    //controler galery
    public function pengaturanGalery()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Galery Foto',
            'logo' => $this->admin_model->detailLogo(),
            'galery' => $this->admin_model->listsGalery(),
            'isi' => 'Admin/master/Galery/galery'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahGalery()
    {
        $this->form_validation->set_rules('nama_galery', 'nama_galery', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/sampul/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('sampul')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Tambah Foto Sampul',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/pengaturangalery/tambahgalery',
                    'error' => $this->upload->display_errors(),
                    'galery' => $this->admin_model->listsGalery(),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/sampul/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nama_galery'                 => $this->input->post('nama_galery'),
                    'sampul'                     => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->tambahGalery($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Tambahkan!!!</div>');
                redirect('Admin/pengaturanGalery');
            }
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Tambah Foto Sampul',
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Galery/tambahgalery',
            'mapel' => $this->admin_model->listsGalery(),
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambah_foto($id_galery)
    {
        $this->form_validation->set_rules('ket_foto', 'Keterangan Foto', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/sampul/foto/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $galery = $this->admin_model->detail($id_galery);
                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'logo' => $this->admin_model->detailLogo(),
                    'title' => 'Tambah Foto Galery : ' . $galery->nama_galery,
                    'isi' => 'Admin/master/Galery/tambahfoto',
                    'galery' => $galery,
                    'foto' => $this->admin_model->listsFotoGalery($id_galery),
                    'error' => $this->upload->display_errors(),

                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/sampul/foto/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_galery'                    => $id_galery,
                    'ket_foto'                 => $this->input->post('ket_foto'),
                    'foto'                     => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->tambah_foto($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di ditambah!!!</div>');
                redirect('Admin/tambah_foto/' . $id_galery);
            }
        }
        $galery = $this->admin_model->detailGalery($id_galery);
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'logo' => $this->admin_model->detailLogo(),
            'title' => 'Tambah Foto Galery : ' . $galery->nama_galery,
            'galery' => $galery,
            'foto' => $this->admin_model->listsFotoGalery($id_galery),
            'isi' => 'Admin/master/Galery/tambahfoto',
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }


    public function editGalery($id_galery)
    {
        $this->form_validation->set_rules('nama_galery', 'Nama Galery', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/sampul/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('sampul')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Edit Galery',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/Galery/editgalery',
                    'galery' => $this->admin_model->detailGalery($id_galery),
                    'error' => $this->upload->display_errors(),

                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/sampul/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $galery = $this->admin_model->detailGalery($id_galery);
                if ($galery->sampul != "") {
                    unlink('./assets/data/foto/sampul/' . $galery->sampul);
                }
                //tutup
                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'id_galery'                    => $id_galery,
                    'nama_galery'                 => $this->input->post('nama_galery'),
                    'sampul'                     => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->editGalery($data);
                $this->session->set_flashdata('pesan', 'Data Galery Berhasil Di Ubah!!');
                redirect('Admin/pengaturanGalery');
            }
            $data = array(
                'id_galery'                    => $id_galery,
                'nama_galery'                 => $this->input->post('nama_galery'),
            );
            $this->admin_model->editGalery($data);
            $this->session->set_flashdata('pesan', 'Data Galery Berhasil Di Ubah!!');
            redirect('Admin/pengaturanGalery');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit Galery',
            'logo' => $this->admin_model->detailLogo(),
            'galery' => $this->admin_model->detailGalery($id_galery),
            'isi' => 'Admin/master/Galery/editgalery',
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function deleteGalery($id_galery)
    {
        //menghapus foto
        $galery = $this->admin_model->detailGalery($id_galery);
        if ($galery->sampul != "") {
            unlink('./assets/data/foto/sampul/' . $galery->sampul);
        }
        //tutup

        $data = array('id_galery' => $id_galery);
        $this->admin_model->deleteGalery($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Hapus!!!</div>');
        redirect('Admin/pengaturanGalery');
    }


    public function delete_fotoGalery($id_galery, $id_foto)
    {
        //menghapus foto
        $foto = $this->admin_model->detail_fotoGalery($id_foto);
        if ($foto->foto != "") {
            unlink('./assets/img/foto/' . $foto->foto);
        }
        //tutup

        $data = array('id_foto' => $id_foto);
        $this->admin_model->delete_fotoGalery($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Foto Berhasil Di Hapus!!!</div>');
        redirect('galery/tambah_foto/' . $id_galery);
    }

    //controler pengumuman
    public function pengaturanPengumuman()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Pengumuman',
            'title1' => 'Pengumuman',
            'logo' => $this->admin_model->detailLogo(),
            'pengumuman' => $this->admin_model->listsPengumuman(),
            'isi' => 'Admin/master/Pengumuman/pengumuman'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahPengumuman()
    {

        $this->form_validation->set_rules('judul_pengumuman', 'Judul Pengumuman', 'required');
        $this->form_validation->set_rules('isi_pengumuman', 'Isi Pengumuman', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Tambah Pengumuman',
                'logo' => $this->admin_model->detailLogo(),
                'isi' => 'Admin/master/Pengumuman/pengumumantambah'
            );
            $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'judul_pengumuman' => $this->input->post('judul_pengumuman'),
                'isi_pengumuman' => $this->input->post('isi_pengumuman'),
                'tanggal_pengumuman' => date('Y-m-d'),
            );
            $this->admin_model->tambahPengumuman($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Tambahkan!!!</div>');
            redirect('Admin/pengaturanPengumuman');
        }
    }

    public function editPengumuman($id_pengumuman)
    {

        $this->form_validation->set_rules('judul_pengumuman', 'Judul Pengumuman', 'required');
        $this->form_validation->set_rules('isi_pengumuman', 'Isi Pengumuman', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Edit Pengumuman',
                'logo' => $this->admin_model->detailLogo(),
                'pengumuman' => $this->admin_model->detailPengumuman($id_pengumuman),
                'isi' => 'Admin/master/Pengumuman/pengumumanedit'
            );
            $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'id_pengumuman' => $id_pengumuman,
                'judul_pengumuman' => $this->input->post('judul_pengumuman'),
                'isi_pengumuman' => $this->input->post('isi_pengumuman'),
                'tanggal_pengumuman' => date('Y-m-d'),
            );
            $this->admin_model->editPengumuman($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
            redirect('Admin/pengaturanPengumuman');
        }
    }


    public function deletePengumuman($id_pengumuman)
    {
        $data = array('id_pengumuman' => $id_pengumuman);
        $this->admin_model->deletePengumuman($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!!!</div>');
        redirect('Admin/pengaturanPengumuman');
    }


    //controler Berita
    public function pengaturanBerita()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data Berita',
            'logo' => $this->admin_model->detailLogo(),
            'berita' => $this->admin_model->listsBerita(),
            'isi' => 'Admin/master/Berita/berita'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahBerita()
    {
        $this->form_validation->set_rules('judul_berita', 'judul_berita', 'required');
        $this->form_validation->set_rules('isi_berita', 'isi_berita', 'required', array('required' => '%s Harus diisi!!'));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/gambar_berita/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar_berita')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Tambah Berita',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/Berita/tambahberita',
                    'error' => $this->upload->display_errors(),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/gambar_berita/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'judul_berita'                 => $this->input->post('judul_berita'),
                    'slug_berita'                 => url_title($this->input->post('judul_berita'), 'dash', TRUE),
                    'isi_berita'                 => $this->input->post('isi_berita'),
                    'tanggal_berita'            => date('Y-m-d'),
                    'id_user'                    => $this->session->userdata('id_user'),
                    'gambar_berita'             => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->tambahBerita($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berita Berhasil Diposting!!!</div>');
                redirect('Admin/pengaturanBerita');
            }
        }

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Tambah Berita',
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Berita/tambahberita'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }


    public function editBerita($id_berita)
    {
        $this->form_validation->set_rules('judul_berita', 'judul_berita', 'required');
        $this->form_validation->set_rules('isi_berita', 'isi_berita', 'required', array('required' => '%s Harus diisi!!'));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/gambar_berita/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar_berita')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title'         => 'Edit Berita',
                    'isi'             => 'Admin/master/Berita/editberita',
                    'error'         => $this->upload->display_errors(),
                    'logo' => $this->admin_model->detailLogo(),
                    'berita'         => $this->admin_model->detailBerita($id_berita),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/img/gambar_berita/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $berita = $this->admin_model->detailBerita($id_berita);
                if ($berita->gambar_berita != "") {
                    unlink('./assets/data/foto/gambar_berita/' . $berita->gambar_berita);
                }
                //tutup
                $data = array(
                    'id_berita'                    => $id_berita,
                    'judul_berita'                 => $this->input->post('judul_berita'),
                    'slug_berita'                 => url_title($this->input->post('slug_berita'), 'dash', TRUE),
                    'isi_berita'                 => $this->input->post('isi_berita'),
                    'tanggal_berita'            => date('Y-m-d'),
                    'id_user'                    => $this->session->userdata('id_user'),
                    'gambar_berita'             => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->editBerita($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Edit!!!</div>');
                redirect('Admin/pengaturanBerita');
            }
            $data = array(
                'id_berita'                    => $id_berita,
                'judul_berita'                 => $this->input->post('judul_berita'),
                'slug_berita'                 => url_title($this->input->post('slug_berita'), 'dash', TRUE),
                'isi_berita'                 => $this->input->post('isi_berita'),
                'tanggal_berita'            => date('Y-m-d'),
                'id_user'                    => $this->session->userdata('id_user'),
            );
            $this->admin_model->editBerita($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Edit!!!</div>');
            redirect('Admin/pengaturanBerita');
        }

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit Berita',
            'logo' => $this->admin_model->detailLogo(),
            'berita' => $this->admin_model->detailBerita($id_berita),
            'isi' => 'Admin/master/Berita/editberita',
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function deleteBerita($id_berita)
    {
        //menghapus foto
        $berita = $this->admin_model->detailBerita($id_berita);
        if ($berita->gambar_berita != "") {
            unlink('./assets/data/foto/gambar_berita/' . $berita->gambar_berita);
        }
        //tutup

        $data = array('id_berita' => $id_berita);
        $this->admin_model->deleteBerita($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Hapus!!!</div>');
        redirect('pengaturanBerita');
    }

    //contorler Download
    public function pengaturanDownload()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data File Download',
            'logo' => $this->admin_model->detailLogo(),
            'download' => $this->admin_model->listsDownload(),
            'isi' => 'Admin/master/Download/v_download'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahDownload()
    {
        $this->form_validation->set_rules('nama_file', 'Nama File', 'required');
        $this->form_validation->set_rules('ket_file', 'Keterangan File', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/file/';
            $config['allowed_types']        = 'docx|pdf|txt|doc|pptx|excel';
            $config['max_size']             = 10000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Tambah File Download',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/Download/v_tambahdownload',
                    'error_upload' => $this->upload->display_errors(),
                    'download' => $this->admin_model->listsDownload(),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/file/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nama_file' => $this->input->post('nama_file'),
                    'ket_file'                 => $this->input->post('ket_file'),
                    'file'         => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->tambahDownload($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Tambahkan!!!</div>');
                redirect('Admin/pengaturanDownload');
            }
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Tambah File Download',
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Download/v_tambahdownload',
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function editDownload($id_file)
    {
        $this->form_validation->set_rules('nama_file', 'Nama File', 'required');
        $this->form_validation->set_rules('ket_file', 'Keterangan File', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/file/';
            $config['allowed_types']        = 'docx|pdf|txt|doc|pptx|excel';
            $config['max_size']             = 10000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Edit File Download',
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/Download/v_editDownload',
                    'download' => $this->admin_model->detailDownload($id_file),
                    'error_upload' => $this->upload->display_errors(),
                    'download' => $this->admin_model->listsDownload(),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/file/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $download = $this->admin_model->detailDownload($id_file);
                if ($download->file != "") {
                    unlink('./assets/data/foto/file/' . $download->file);
                }
                //tutup

                $data = array(
                    'id_file'     => $id_file,
                    'nama_file'                 => $this->input->post('nama_file'),
                    'ket_file'                 => $this->input->post('ket_file'),
                    'file'         => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->editDownload($data);
                $this->session->set_flashdata('pesan', 'File Berhasil Di Ubah!!');
                redirect('Admin/pengaturanDownload');
            }
            $data = array(
                'id_file'     => $id_file,
                'nama_file'                 => $this->input->post('nama_file'),
                'ket_file'                 => $this->input->post('ket_file'),
            );
            $this->admin_model->editDownload($data);
            $this->session->set_flashdata('pesan', 'File Berhasil Di Ubah!!');
            redirect('Admin/pengaturanDownload');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit File Download',
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Download/v_editDownload',
            'download' => $this->admin_model->detailDownload($id_file),
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function deleteDownload($id_file)
    {
        //menghapus foto
        $download = $this->admin_model->detailDownload($id_file);
        if ($download->file != "") {
            unlink('./assets/data/foto/file/' . $download->file);
        }
        //tutup

        $data = array('id_file' => $id_file);
        $this->admin_model->deleteDownload($data);
        $this->session->set_flashdata('pesan', 'File berhasil dihapus!!');
        redirect('Admin/pengaturanDownload');
    }

    //controler guru
    public function pengaturanGuru()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'MA PK NGALIAN',
            'guru' => $this->admin_model->listsGuru(),
            'logo' => $this->admin_model->detailLogo(),
            'title1' => 'Data Guru',
            'isi' => 'Admin/master/Guru/v_guru'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahGuru()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama_guru', 'nama_guru', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
        $this->form_validation->set_rules('id_mapel', 'id_mapel', 'required');
        $this->form_validation->set_rules('pendidikan', 'pendidikan', 'required');
        // $this->form_validation->set_rules('foto_guru', 'foto_guru', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/user/img/guru';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_guru')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Tambah Data Guru',
                    'isi' => 'Admin/master/Guru/v_guruTambah',
                    'guru' => $this->admin_model->listsGuru(),
                    'error' => $this->upload->display_errors(),
                    'logo' => $this->admin_model->detailLogo(),
                    'mapel' => $this->admin_model->listsMapel(),
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/user/img/guru/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nik'                 => $this->input->post('nik'),
                    'nama_guru'             => $this->input->post('nama_guru'),
                    'tempat_lahir'         => $this->input->post('tempat_lahir'),
                    'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                    'id_mapel'             => $this->input->post('id_mapel'),
                    'pendidikan'         => $this->input->post('pendidikan'),
                    'foto_guru'         => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->tambahGuru($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!!!</div>');
                redirect('Admin/pengaturanGuru');
            }
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Tambah Data Guru',
            'isi' => 'Admin/master/Guru/v_guruTambah',
            'mapel' => $this->admin_model->listsMapel(),
            'logo' => $this->admin_model->detailLogo(),
            'guru' => $this->admin_model->listsGuru(),
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function editGuru($id_guru)
    {

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama_guru', 'nama_guru', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
        $this->form_validation->set_rules('id_mapel', 'id_mapel', 'required');
        $this->form_validation->set_rules('pendidikan', 'pendidikan', 'required');
        // $this->form_validation->set_rules('foto_guru', 'foto_guru', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/user/img/guru';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_guru')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'MA PK NGALIAN',
                    'title' => 'Edit Data Guru',
                    'error' => $this->upload->display_errors(),
                    'guru' => $this->admin_model->detailGuru($id_guru),
                    'mataPelajaran' => $this->admin_model->listsmataPelajaran(),
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/Guru/v_guruEdit'
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/user/img/guru/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $guru = $this->admin_model->detailGuru($id_guru);
                if ($guru->foto_guru != "") {
                    unlink('./assets/data/foto/user/img/guru/' . $guru->foto_guru);
                }
                //tutup

                $data = array(
                    'id_guru'            => $id_guru,
                    'nik'                 => $this->input->post('nik'),
                    'nama_guru'             => $this->input->post('nama_guru'),
                    'tempat_lahir'         => $this->input->post('tempat_lahir'),
                    'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                    'id_mapel'             => $this->input->post('id_mapel'),
                    'pendidikan'         => $this->input->post('pendidikan'),
                    'foto_guru'         => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->editGuru($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
                redirect('Admin/pengaturanGuru');
            }
            $upload_data                         = array('uploads' => $this->upload->data());
            $config['image_library']              = '.gd2';
            $config['source_image']              = './assets/data/foto/user/img/guru/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_guru'            => $id_guru,
                'nik'                 => $this->input->post('nik'),
                'nama_guru'             => $this->input->post('nama_guru'),
                'tempat_lahir'         => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'id_mapel'             => $this->input->post('id_mapel'),
                'pendidikan'         => $this->input->post('pendidikan'),
            );
            $this->admin_model->editGuru($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
            redirect('Admin/pengaturanGuru');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit Data Guru',
            'mapel' => $this->admin_model->listsMapel(),
            'logo' => $this->admin_model->detailLogo(),
            'guru' => $this->admin_model->detailGuru($id_guru),
            'isi' => 'Admin/master/Guru/v_guruEdit',
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function deleteGuru($id_guru)
    {
        //menghapus foto
        $guru = $this->admin_model->detailGuru($id_guru);
        if ($guru->foto_guru != "") {
            unlink('./assets/data/foto/user/img/guru/' . $guru->foto_guru);
        }
        //tutup

        $data = array('id_guru' => $id_guru);
        $this->admin_model->deleteGuru($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Hapus!!!</div>');
        redirect('Admin/pengaturanGuru');
    }

    //controler mapel
    public function pengaturanMapel()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'MA PK NGALIAN',
            'mapel' => $this->admin_model->listsMapel(),
            'logo' => $this->admin_model->detailLogo(),
            'title1' => 'Data Mapel',
            'isi' => 'Admin/master/Mapel/v_mapel'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahMapel()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'logo' => $this->admin_model->detailLogo(),
        );
        $this->admin_model->tambahMapel(['nama_mapel' => $this->input->post('nama_mapel')]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!!!</div>');
        redirect('Admin/pengaturanMapel');
    }

    public function editMapel($id_mapel)
    {
        $data = array(
            'id_mapel' => $id_mapel,
            'nama_mapel' => $this->input->post('nama_mapel'),
        );
        $this->admin_model->editMapel($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Diubah!!!</div>');
        redirect('Admin/pengaturanMapel');
    }

    public function detailMapel($id_mapel)
    {
        $data = array(
            'id_mapel' => $id_mapel,
            'nama_mapel' => $this->input->post('nama_mapel'),
            'logo' => $this->admin_model->detailLogo(),
        );
        $this->admin_model->detailMapel($data);
        redirect('Admin/peggaturanMapel');
    }

    public function deleteMapel($id_mapel)
    {
        $data = array('id_mapel' => $id_mapel,);
        $this->admin_model->deleteMapel($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!!!</div>');
        redirect('Admin/pengaturanMapel');
    }

    //controler siswa
    public function pengaturanSiswa()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data Siswa',
            'siswa' => $this->admin_model->listsSiswa(),
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Siswa/v_siswa'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahSiswa()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required');
        $this->form_validation->set_rules('nama_siswa', 'nama_siswa', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('wali_siswa', 'wali_kelas', 'required');
        $this->form_validation->set_rules('hp', 'hp', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/user/img/siswa/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_siswa')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Tambah Data Siswa',
                    'kelas' => $this->admin_model->getKelas(),
                    'logo' => $this->admin_model->detailLogo(),
                    'error' => $this->upload->display_errors(),
                    'isi' => 'Admin/master/Siswa/v_tambahSiswa'
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/user/img/guru/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nis'                 => $this->input->post('nis'),
                    'nama_siswa'        => $this->input->post('nama_siswa'),
                    'tempat_lahir'         => $this->input->post('tempat_lahir'),
                    'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                    'kelas'             => $this->input->post('id_kelas'),
                    'wali_siswa'         => $this->input->post('wali_siswa'),
                    'hp'                 => $this->input->post('hp'),
                    'alamat'             => $this->input->post('alamat'),
                    'foto_siswa'         => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->tambahSiswa($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Tambahkan!!!</div>');
                redirect('Admin/pengaturanSiswa');
            }
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Tambah Data siswa',
            'kelas' => $this->admin_model->getKelas(),
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Siswa/v_tambahSiswa'

        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function editSiswa($id_siswa)
    {

        $this->form_validation->set_rules('nis', 'NIS', 'required');
        $this->form_validation->set_rules('nama_siswa', 'nama_siswa', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
        $this->form_validation->set_rules('kelas', 'kelas', 'required');
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './assets/data/foto/user/img/guru/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_siswa')) {

                $data = array(
                    'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                    'title' => 'Edit Data Siswa',
                    'error' => $this->upload->display_errors(),
                    'siswa' => $this->admin_model->detailSiswa($id_siswa),
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Admin/master/Siswa/v_editSiswa'
                );
                $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/user/img/guru/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $siswa = $this->admin_model->detailSiswa($id_siswa);
                if ($siswa->foto_siswa != "") {
                    unlink('./assets/data/foto/user/img/guru/' . $siswa->foto_siswa);
                }
                //tutup

                $data = array(
                    'id_siswa'            => $id_siswa,
                    'nis'                 => $this->input->post('nis'),
                    'nama_siswa'             => $this->input->post('nama_siswa'),
                    'tempat_lahir'         => $this->input->post('tempat_lahir'),
                    'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                    'kelas'             => $this->input->post('kelas'),
                    'foto_siswa'         => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->editSiswa($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
                redirect('Admin/pengaturanSiswa');
            }
            $upload_data                         = array('uploads' => $this->upload->data());
            $config['image_library']              = '.gd2';
            $config['source_image']              = './assets/data/foto/user/img/guru/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_siswa'            => $id_siswa,
                'nis'                 => $this->input->post('nis'),
                'nama_siswa'             => $this->input->post('nama_siswa'),
                'tempat_lahir'         => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'kelas'             => $this->input->post('kelas'),
            );
            $this->admin_model->editSiswa($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
            redirect('Admin/pengaturanSiswa');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit Data Siswa',
            'isi' => 'Admin/master/Siswa/v_editSiswa',
            'siswa' => $this->admin_model->detailSiswa($id_siswa),
            'logo' => $this->admin_model->detailLogo(),
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function deleteSiswa($id_siswa)
    {
        //menghapus foto
        $siswa = $this->admin_model->detailSiswa($id_siswa);
        if ($siswa->foto_siswa != "") {
            unlink('./assets/data/foto/user/img/guru/' . $siswa->foto_siswa);
        }
        //tutup

        $data = array('id_siswa' => $id_siswa);
        $this->admin_model->deleteSiswa($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil Di Hapus!</div>');
        redirect('Admin/pengaturanSiswa');
    }

    //controler kelas
    public function pengaturanKelas()
    {

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'parent' => 'Data Master',
            'title' => 'Data Semua Kelas',
            'kelas' => $this->admin_model->listsKelas(),
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Admin/master/Kelas/v_kelas'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahKelas()
    {
        $this->form_validation->set_rules('wali_kelas', 'Wali Kelas', 'required');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('jenis_kelas', 'Jenis Kelas', 'required');
        $this->form_validation->set_rules('total_siswa', 'Total Siswa', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Tambah Kelas',
                'guru' => $this->admin_model->listsGuru(),
                'logo' => $this->admin_model->detailLogo(),
                'isi' => 'Admin/master/Kelas/v_kelasTambah'
            );
            $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'wali_kelas' => $this->input->post('wali_kelas'),
                'nama_kelas' => $this->input->post('nama_kelas'),
                'jenis_kelas' => $this->input->post('jenis_kelas'),
                'total_siswa' => $this->input->post('total_siswa'),
            );
            $this->admin_model->tambahKelas($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Tambahkan!!!</div>');
            redirect('Admin/pengaturanKelas');
        }
    }

    public function editKelas($id_kelas)
    {

        $this->form_validation->set_rules('wali_kelas', 'Wali Kelas', 'required');
        $this->form_validation->set_rules('jenis_kelas', 'Jenis Kelas', 'required');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('total_siswa', 'Total Siswa', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Edit Kelas',
                'kelas' => $this->admin_model->detailKelas($id_kelas),
                'guru' => $this->admin_model->listsGuru(),
                'logo' => $this->admin_model->detailLogo(),
                'isi' => 'Admin/master/Kelas/v_kelasEdit'
            );
            $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'id_kelas' => $id_kelas,
                'wali_kelas' => $this->input->post('wali_kelas'),
                'jenis_kelas' => $this->input->post('jenis_kelas'),
                'nama_kelas' => $this->input->post('nama_kelas'),
                'total_siswa' => $this->input->post('total_siswa'),
            );
            $this->admin_model->editKelas($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
            redirect('Admin/pengaturanKelas');
        }
    }

    public function deleteKelas($id_kelas)
    {
        $data = array('id_kelas' => $id_kelas);
        $this->admin_model->deleteKelas($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Hapus!!!</div>');
        redirect('Admin/pengaturanKelas');
    }

    //pengaturan Nilai
    public function dashboardNilai()
    {

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data Nilai Siswa',
            'parent' => 'MA PK MAaFIF NGALIAN',
            'logo' => $this->admin_model->detailLogo(),
            'nilai' => $this->admin_model->listsNilai(),
            'isi' => 'Admin/master/Nilai/v_nilai'
        );
        $this->load->view('Admin/Layout/v_wrapper', $data, FALSE);
    }

    public function requestNilai()
    {

        $this->form_validation->set_rules('nis', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('id_nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('nama_mapel', 'Nama Mapel', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');


        $data = [
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'request_siswa' => $this->input->post('nis'),
            'id_nilai' => $this->input->post('id_nilai'),
            'request_guru' => $this->input->post('nik'),
            'request_keterangan' => $this->input->post('keterangan'),
            'request_date' => date('Y-m-d'),
            'request_status_guru' => 0,
        ];
        
        $this->db->insert('tbl_request', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Request Nilai berhasil!!!</div>');
        redirect('Admin/dashboardNilai');
    }
}