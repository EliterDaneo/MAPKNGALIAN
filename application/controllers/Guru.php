<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
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
        $this->load->model('guru_model');
        $this->load->model('admin_model');
    }

    public function index()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'profile' => $this->guru_model->getProfile(str_replace("guru", "", $this->session->userdata('username'))),
            'logo' => $this->admin_model->detailLogo(),
            'title' => $this->admin_model->website(),
            'title' => 'Web Sekolah',
            'parent' => 'MA PK MAaFIF NGALIAN',
            'isi' => 'Guru/v_guru_dashboard'
        );
        $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
    }

    public function dashboardNilai()
    {

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Data Nilai Siswa',
            'parent' => 'MA PK MAaFIF NGALIAN',
            'nilai' => $this->guru_model->listsNilai(),
            'title' => $this->admin_model->website(),
            'logo' => $this->admin_model->detailLogo(),
            'isi' => 'Guru/pengaturanNilai/DashboardNilai'
        );
        $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
    }

    public function tambahNilai()
    {
        $this->form_validation->set_rules('id_mapel', 'Nama Mapel', 'required');
        $this->form_validation->set_rules('nis', 'Nama Siswa', 'required|is_unique[tbl_nilai.nis]', [
            'is_unique' => 'Nilai Siswa ini Sudah diinputkan'
        ]);
        $this->form_validation->set_rules('id_kelas', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        if ($this->form_validation->run() == FALSE) {


            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Tambah Data Nilai',
                'mapel' => $this->guru_model->namaMapel(str_replace("guru", "", $this->session->userdata('username'))),
                'siswa' => $this->guru_model->namaSiswaAll(),
                'kelas' => $this->guru_model->namaKelasAll(),
                'logo' => $this->admin_model->detailLogo(),
                'title' => $this->admin_model->website(),
                'isi' => 'Guru/pengaturanNilai/tambahNilai'
            );
            $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
        } else {

            $data = array(
                'id_mapel' => $this->input->post('id_mapel'),
                'nis' => $this->input->post('nis'),
                'id_kelas' => $this->input->post('id_kelas'),
                'nilai' => $this->input->post('nilai'),
            );
            $this->guru_model->tambahNilai($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!!!');
            redirect('Guru/dashboardNilai');
        }
    }

    public function editNilai($id_nilai = null)
    {

        $this->form_validation->set_rules('id_mapel', 'Nama Mapel', 'required');
        $this->form_validation->set_rules('nis', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('id_kelas', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data = array(
                'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
                'title' => 'Edit Data Nilai',
                'editNilai' => $this->guru_model->editNilai($id_nilai),
                'mapel' => $this->guru_model->namaMapel(str_replace("guru", "", $this->session->userdata('username'))),
                'siswa' => $this->guru_model->namaSiswaAll(),
                'kelas' => $this->guru_model->namaKelasAll(),
                'logo' => $this->admin_model->detailLogo(),
                'title' => $this->admin_model->website(),
                'isi' => 'Guru/pengaturanNilai/editNilai'
            );
            $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
        } else {

            $data = array(
                'id_nilai' => $id_nilai,
                'id_mapel' => $this->input->post('id_mapel'),
                'nis' => $this->input->post('nis'),
                'id_kelas' => $this->input->post('id_kelas'),
                'nilai' => $this->input->post('nilai'),
            );
            $this->guru_model->updateNilai($data);

            $this->db->where('id_nilai', $id_nilai);
            $this->db->update('tbl_request', ['request_status_siswa' => 0]);
            $this->session->set_flashdata('pesan', 'Data Berhasil Di Update!!!');
            redirect('Guru/dashboardNilai');
        }
    }

    //controler Profile
    public function Profile()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'profile' => $this->guru_model->getProfile(str_replace("guru", "", $this->session->userdata('username'))),
            'logo' => $this->admin_model->detailLogo(),
            'title' => $this->admin_model->website(),
            'parent' => 'Profile',
            'page' => 'Profile Guru',
            'isi' => 'Guru/v_guruProfile'
        );
        $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
    }

   
    public function getNotif(){
		
		$view = $this->input->post('view');
		// $guru = $this->db->get_where('tbl_guru',['nik' => str_replace("guru","", $this->session->userdata('username'))])->row();
		$data = $this->guru_model->getNotif(str_replace("guru","", $this->session->userdata('username')));

		echo json_encode($data);

	}

	public function updateNotif(){

		$request_guru = $this->input->post('guru');
		// $guru = $this->db->get_where('tbl_guru',['nik' => $nik ])->row()->id_guru;

		$updateNotif = [ 

			'request_status_guru' => 1,
		];

		$this->db->where('request_guru', $request_guru);
		$data = $this->db->update('tbl_request',$updateNotif);
		echo json_encode($data);
	}

    // public function deleteNotif($id_request)
    // 	{
    // 		$data = array('id_request' => $id_request );
    // 		$this->guru_model->deleteNotif($data);
    // 		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!!!</div>');
    // 		redirect('Guru/notif');
    // 	}

    public function notif()
    {

        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'allnotif' => $this->guru_model->getAllNotif($this->session->userdata('id_guru')),
            'logo' => $this->admin_model->detailLogo(),
            'title' => $this->admin_model->website(),
            'title' => 'Guru | Notification',
            'page' => 'Notification',
            'isi' => 'Guru/v_guru_notif'
        );
        $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
    }

    public function changePassword()
    {
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row()
        );

        $this->form_validation->set_rules('bb', 'New Password', 'required|trim|min_length[4]|matches[cc]');
        $this->form_validation->set_rules('cc', 'Confirm New Password', 'required|trim|min_length[4]|matches[bb]');

        if ($this->form_validation->run() == false) {
            $data = array(
                'logo' => $this->admin_model->detailLogo(),
                'title' => $this->admin_model->website(),
                'parent' => 'Profile',
                'page' => 'Profile',
                'isi' => 'Guru/pengaturanProfile/GuruProfile'
            );
        } else {


            $new_password = $this->input->post('bb');


            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

            $this->db->set('password', $password_hash);
            $this->db->where('id_user', $this->input->post('dd'));
            $this->db->update('tbl_user');

            $this->toastr->success('<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
            redirect('Guru/profile');
        }
    }

    public function editProfile($id_guru)
    {

        $this->form_validation->set_rules('nik', 'NIK', '');
        $this->form_validation->set_rules('nama_guru', 'nama_guru', '');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', '');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', '');
        $this->form_validation->set_rules('id_mapel', 'id_mapel', '');
        $this->form_validation->set_rules('pendidikan', 'pendidikan', '');
        $this->form_validation->set_rules('alamat', 'Alamat', '');
        $this->form_validation->set_rules('hp', 'No HP', '');
        $this->form_validation->set_rules('moto', 'Moto', '');
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
                    'profile' => $this->guru_model->detailGuru($id_guru),
                    'mataPelajaran' => $this->admin_model->listsmataPelajaran(),
                    'logo' => $this->admin_model->detailLogo(),
                    'isi' => 'Guru/v_guruProfile'
                );
                $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
            } else {
                $upload_data                         = array('uploads' => $this->upload->data());
                $config['image_library']              = '.gd2';
                $config['source_image']              = './assets/data/foto/user/img/Guru/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                //menghapus foto
                $guru = $this->admin_model->detailGuru($id_guru);
                if ($guru->foto_guru != "") {
                    unlink('./assets/data/foto/user/img/Guru/' . $guru->foto_guru);
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
                    'alamat'         => $this->input->post('alamat'),
                    'hp'         => $this->input->post('hp'),
                    'moto'         => $this->input->post('moto'),
                    'foto_guru'         => $upload_data['uploads']['file_name'],
                );
                $this->admin_model->editGuru($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
                redirect('admin/pengaturanGuru');
            }
            $upload_data                         = array('uploads' => $this->upload->data());
            $config['image_library']              = '.gd2';
            $config['source_image']              = './assets/data/foto/user/img/Guru/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_guru'            => $id_guru,
                'nik'                 => $this->input->post('nik'),
                'nama_guru'             => $this->input->post('nama_guru'),
                'tempat_lahir'         => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'id_mapel'             => $this->input->post('id_mapel'),
                'pendidikan'         => $this->input->post('pendidikan'),
                'alamat'         => $this->input->post('alamat'),
                'hp'         => $this->input->post('hp'),
                'moto'         => $this->input->post('moto'),
            );
            $this->admin_model->editGuru($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Di Ubah!!!</div>');
            redirect('admin/pengaturanGuru');
        }
        $data = array(
            'user' => $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row(),
            'title' => 'Edit Data Guru',
            'mapel' => $this->admin_model->listsMapel(),
            'logo' => $this->admin_model->detailLogo(),
            'profile' => $this->guru_model->detailGuru($id_guru),
            'isi' => 'Guru/v_guruProfile',
        );
        $this->load->view('Guru/Layout/v_wrapper', $data, FALSE);
    }
}