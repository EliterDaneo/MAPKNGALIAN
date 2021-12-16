<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //model pengguna
    public function ListManagementUsers()
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->order_by('id_user', 'DESC');
        return $this->db->get()->result();
    }

    public function EditUsers($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('id_user', $data);
    }

    public function DeleteUsers($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('tbl_user', $data);
    }

    public function getUsers()
    {

        $query = "SELECT * FROM tbl_user";
        return $this->db->query($query)->result();
    }

    public function getGuru()
    {

        $query = "SELECT * FROM tbl_guru";
        return $this->db->query($query)->result();
    }

    public function getSiswa()
    {

        $query = "SELECT * FROM tbl_siswa";
        return $this->db->query($query)->result();
    }

    public function getKelas()
    {

        $query = "SELECT * FROM tbl_kelas ";
        return $this->db->query($query)->result();
    }

    //Settings Logo
    public function detailLogo()
    {
        $this->db->select('*');
        $this->db->from('tbl_logo');
        $this->db->order_by('id_logo', 1);
        return $this->db->get()->row();
    }

    public function save_logo($data)
    {
        $this->db->where('id_logo', $data['id_logo']);
        $this->db->update('tbl_logo', $data);
    }

    // Structure
    public function detailstruktur()
    {
        $this->db->select('*');
        $this->db->from('tbl_struktur');
        $this->db->order_by('id_struktur', 1);
        return $this->db->get()->row();
    }

    public function save_struktur($data)
    {
        $this->db->where('id_struktur', $data['id_struktur']);
        $this->db->update('tbl_struktur', $data);
    }

    //model website
    public function detailWebsite()
    {
        $this->db->select('*');
        $this->db->from('tbl_seting');
        $this->db->order_by('id', 1);
        return $this->db->get()->row();
    }

    public function save_settingWebsite($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_seting', $data);
    }

    //pengaturan berita
    public function listsBerita()
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_berita.id_user', 'left');
        $this->db->order_by('id_berita', 'DESC');
        return $this->db->get()->result();
    }

    public function tambahBerita($data)
    {
        $this->db->insert('tbl_berita', $data);
    }

    public function detailBerita($id_berita)
    {
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->where('id_berita', $id_berita);
        return $this->db->get()->row();
    }

    public function editBerita($data)
    {
        $this->db->where('id_berita', $data['id_berita']);
        $this->db->update('tbl_berita', $data);
    }

    public function deleteBerita($data)
    {
        $this->db->where('id_berita', $data['id_berita']);
        $this->db->delete('tbl_berita', $data);
    }

    //model Settings
    public function detailSettings()
    {
        $this->db->select('*');
        $this->db->from('tbl_seting');
        $this->db->order_by('id', 1);
        return $this->db->get()->row();
    }

    public function save_seting($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_seting', $data);
    }

    //pengunjung

    public function statistik_pengujung()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(pengunjung_tanggal,'%d') AS tgl,COUNT(pengunjung_ip) AS jumlah FROM tbl_pengunjung WHERE MONTH(pengunjung_tanggal)=MONTH(CURDATE()) GROUP BY DATE(pengunjung_tanggal)");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function visitor_this_year()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(pengunjung_tanggal,'%M') AS bulan,COUNT(pengunjung_ip) AS jumlah FROM tbl_pengunjung WHERE YEAR(pengunjung_tanggal)=YEAR(CURDATE()) GROUP BY MONTH(pengunjung_tanggal)");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function get_all_visitors()
    {
        $hsl = $this->db->query("SELECT * FROM tbl_pengunjung");
        return $hsl;
    }

    public function get_sum_visitor_last_year()
    {
        $hsl = $this->db->query("SELECT COUNT(pengunjung_ip) AS visitor_last_year FROM tbl_pengunjung WHERE YEAR(pengunjung_tanggal)=YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))");
        return $hsl;
    }

    public function get_sum_visitor_this_year()
    {
        $hsl = $this->db->query("SELECT COUNT(pengunjung_ip) AS jumlah FROM tbl_pengunjung WHERE YEAR(pengunjung_tanggal)=YEAR(CURDATE())");
        return $hsl;
    }

    public function get_average_perbulan()
    {
        $hsl = $this->db->query("SELECT COUNT(pengunjung_ip)/COUNT(DISTINCT MONTH(pengunjung_tanggal)) AS jumlah FROM tbl_pengunjung WHERE YEAR(pengunjung_tanggal)=YEAR(CURDATE())");
        return $hsl;
    }

    public function get_sum_visitor_this_month()
    {
        $hsl = $this->db->query("SELECT COUNT(pengunjung_ip) AS jumlah FROM tbl_pengunjung WHERE MONTH(pengunjung_tanggal)=MONTH(CURDATE())");
        return $hsl;
    }

    public function get_sum_visitor_last_month()
    {
        $hsl = $this->db->query("SELECT COUNT(pengunjung_ip) AS jumlah FROM tbl_pengunjung WHERE MONTH(pengunjung_tanggal)=MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))");
        return $hsl;
    }

    public function get_average_perday()
    {
        $hsl = $this->db->query("SELECT COUNT(pengunjung_ip)/COUNT(DISTINCT DAY(pengunjung_tanggal)) AS jumlah FROM tbl_pengunjung WHERE MONTH(pengunjung_tanggal)=MONTH(CURDATE())");
        return $hsl;
    }

    public function simpan_user_agent($user_ip, $agent)
    {
        $hsl = $this->db->query("INSERT INTO tbl_pengunjung (pengunjung_ip,pengunjung_perangkat) VALUES('$user_ip','$agent')");
        return $hsl;
    }

    public function cek_ip($user_ip)
    {
        $hsl = $this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_ip='$user_ip' AND DATE(pengunjung_tanggal)=CURDATE()");
        return $hsl;
    }

    public function count_visitor()
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Other';
        }
        $cek_ip = $this->db->query("SELECT * FROM tbl_pengunjung WHERE pengunjung_ip='$user_ip' AND DATE(pengunjung_tanggal)=CURDATE()");
        if ($cek_ip->num_rows() <= 0) {
            $hsl = $this->db->query("INSERT INTO tbl_pengunjung (pengunjung_ip,pengunjung_perangkat) VALUES('$user_ip','$agent')");
            return $hsl;
        }
    }

    //Settings Sarpras
    public function listSarpras()
    {
        $this->db->select('*');
        $this->db->from('tbl_sarpras');
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_sarpras.id_user', 'left');
        $this->db->order_by('id_sarpras', 'DESC');
        return $this->db->get()->result();
    }

    public function AddSarpras($data)
    {
        $this->db->insert('tbl_sarpras', $data);
    }

    public function sarpras()
    {
        $this->db->select('*');
        $this->db->from('tbl_sarpras');
        $this->db->order_by('id_sarpras', 1);
        return $this->db->get()->row();
    }

    public function EditSarpras($data)
    {
        $this->db->where('id_sarpras', $data['id_sarpras']);
        $this->db->update('tbl_sarpras', $data);
    }

    public function DeleteSarpras($data)
    {
        $this->db->where('id_sarpras', $data['id_sarpras']);
        $this->db->delete('tbl_sarpras', $data);
    }

    //model galery
    public function listsGalery()
    {
        $this->db->select('tbl_galery.*,count(tbl_foto.id_galery)as jml_foto');
        $this->db->from('tbl_galery');
        $this->db->join('tbl_foto', 'tbl_foto.id_galery = tbl_galery.id_galery', 'left');
        $this->db->group_by('tbl_galery.id_galery');
        $this->db->order_by('tbl_galery.id_galery', 'DESC');
        return $this->db->get()->result();
    }

    public function listsFotoGalery($id_galery)
    {
        $this->db->select('*');
        $this->db->from('tbl_foto');
        $this->db->where('id_galery', $id_galery);
        $this->db->order_by('foto', 'DESC');
        return $this->db->get()->result();
    }

    public function tambahGalery($data)
    {
        $this->db->insert('tbl_galery', $data);
    }

    public function tambah_foto($data)
    {
        $this->db->insert('tbl_foto', $data);
    }

    public function editGalery($data)
    {
        $this->db->where('id_galery', $data['id_galery']);
        $this->db->update('tbl_galery', $data);
    }

    public function detailGalery($id_galery)
    {
        $this->db->select('*');
        $this->db->from('tbl_galery');
        $this->db->where('id_galery', $id_galery);
        return $this->db->get()->row();
    }

    public function detailFotoGalery($id_foto)
    {
        $this->db->select('*');
        $this->db->from('tbl_foto');
        $this->db->where('id_foto', $id_foto);
        return $this->db->get()->row();
    }

    public function deleteGalery($data)
    {
        $this->db->where('id_galery', $data['id_galery']);
        $this->db->delete('tbl_galery', $data);
    }

    public function deleteFotoGalery($data)
    {
        $this->db->where('id_foto', $data['id_foto']);
        $this->db->delete('tbl_foto', $data);
    }

    //model pengumuman
    public function listsPengumuman()
    {
        $this->db->select('*');
        $this->db->from('tbl_pengumuman');
        $this->db->order_by('id_pengumuman', 'DESC');
        return $this->db->get()->result();
    }

    public function tambahPengumuman($data)
    {
        $this->db->insert('tbl_pengumuman', $data);
    }

    public function detailPengumuman($id_pengumuman)
    {
        $this->db->select('*');
        $this->db->from('tbl_pengumuman');
        $this->db->where('id_pengumuman', $id_pengumuman);
        return $this->db->get()->row();
    }

    public function editPengumuman($data)
    {
        $this->db->where('id_pengumuman', $data['id_pengumuman']);
        $this->db->update('tbl_pengumuman', $data);
    }

    public function deletePengumuman($data)
    {
        $this->db->where('id_pengumuman', $data['id_pengumuman']);
        $this->db->delete('tbl_pengumuman', $data);
    }

    public function getOneUsers($id_user)
    {

        $query = "SELECT * FROM tb_user WHERE id_user = '$id_user' ";
        return $this->db->query($query)->row();
    }

    //model Download
    public function listsDownload()
    {
        $this->db->select('*');
        $this->db->from('tbl_file');
        $this->db->order_by('id_file', 'desc');
        return $this->db->get()->result();
    }

    public function detailDownload($id_file)
    {
        $this->db->select('*');
        $this->db->from('tbl_file');
        $this->db->where('id_file', $id_file);
        return $this->db->get()->row();
    }

    public function tambahDownload($data)
    {
        $this->db->insert('tbl_file', $data);
    }

    public function editDownload($data)
    {
        $this->db->where('id_file', $data['id_file']);
        $this->db->update('tbl_file', $data);
    }

    public function deleteDownload($data)
    {
        $this->db->where('id_file', $data['id_file']);
        $this->db->delete('tbl_file', $data);
    }

    //model Guru
    public function listsGuru()
    {
        $this->db->select('*');
        $this->db->from('tbl_guru');
        $this->db->join('tbl_mapel', 'tbl_mapel.id_mapel = tbl_guru.id_mapel', 'left');
        $this->db->order_by('id_guru', 'DESC');
        return $this->db->get()->result();
    }

    public function tambahGuru($data)
    {
        $this->db->insert('tbl_guru', $data);
    }

    public function detailGuru($id_guru)
    {
        $this->db->select('*');
        $this->db->from('tbl_guru');
        $this->db->join('tbl_mapel', 'tbl_mapel.id_mapel = tbl_guru.id_mapel', 'left');
        $this->db->where('id_guru', $id_guru);
        return $this->db->get()->row();
    }

    public function editGuru($data)
    {
        $this->db->where('id_guru', $data['id_guru']);
        $this->db->update('tbl_guru', $data);
    }

    public function deleteGuru($data)
    {
        $this->db->where('id_guru', $data['id_guru']);
        $this->db->delete('tbl_guru', $data);
    }

    //model mapel
    public function listsMapel()
    {
        $this->db->select('*');
        $this->db->from('tbl_mapel');
        $this->db->order_by('id_mapel', 'desc');
        return $this->db->get()->result();
    }

    public function tambahMapel($data)
    {
        $this->db->insert('tbl_mapel', $data);
    }

    public function editMapel($data)
    {
        $this->db->where('id_mapel', $data['id_mapel']);
        $this->db->update('tbl_mapel', $data);
    }

    public function detailMapel($data)
    {
        $this->db->where('id_mapel', $data['id_mapel']);
        $this->db->update('tbl_mapel', $data);
    }

    public function deleteMapel($data)
    {
        $this->db->where('id_mapel', $data['id_mapel']);
        $this->db->delete('tbl_mapel', $data);
    }

    //model siswa
    public function listsSiswa()
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_siswa.kelas');
        $this->db->order_by('id_siswa', 'DESC');
        return $this->db->get()->result();
    }

    public function tambahSiswa($data)
    {
        $this->db->insert('tbl_siswa', $data);
    }

    public function detailSiswa($id_siswa)
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_kelas', 'tbl_kelas.jenis_kelas = tbl_siswa.kelas', 'left');
        $this->db->where('id_siswa', $id_siswa);
        return $this->db->get()->row();
    }

    public function editSiswa($data)
    {
        $this->db->where('id_siswa', $data['id_siswa']);
        $this->db->update('tbl_siswa', $data);
    }

    public function deleteSiswa($data)
    {
        $this->db->where('id_siswa', $data['id_siswa']);
        $this->db->delete('tbl_siswa', $data);
    }

    //model kelas
    public function listsKelas()
    {
        $this->db->select('*');
        $this->db->from('tbl_kelas');
        $this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_kelas.wali_kelas', 'left');
        $this->db->order_by('id_kelas', 'DESC');
        return $this->db->get()->result();
    }

    public function editKelas($data)
    {
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->update('tbl_kelas', $data);
    }

    public function detailKelas($id_kelas)
    {
        $this->db->select('*');
        $this->db->from('tbl_kelas');
        $this->db->join('tbl_guru', 'tbl_guru.id_guru = tbl_kelas.wali_kelas', 'left');
        $this->db->where('id_kelas', $id_kelas);
        return $this->db->get()->row();
    }

    public function tambahKelas($data)
    {
        $this->db->insert('tbl_kelas', $data);
    }

    public function deleteKelas($data)
    {
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->delete('tbl_kelas', $data);
    }

    //model Nilai
    public function listsNilai()
    {
        $this->db->select('*');
        $this->db->from('tbl_nilai');
        $this->db->join('tbl_mapel', 'tbl_mapel.id_mapel = tbl_nilai.id_mapel');
        $this->db->join('tbl_guru', 'tbl_guru.id_mapel = tbl_nilai.id_mapel');
        $this->db->join('tbl_siswa', 'tbl_siswa.nis = tbl_nilai.nis');
        $this->db->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_nilai.id_kelas');
        return $this->db->get()->result();
    }

    public function namaMapelList($nik)
    {
        $this->db->select('*');
        $this->db->from('tbl_mapel');
        $this->db->join('tbl_guru', 'tbl_guru.id_mapel = tbl_mapel.id_mapel');
        $this->db->where('tbl_guru.nik', $nik);
        return $this->db->get()->row();
    }

    public function namaSiswaList()
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->order_by('id_siswa', 'DESC');
        return $this->db->get()->result();
    }

    public function namaKelasList()
    {
        $this->db->select('*');
        $this->db->from('tbl_kelas');
        $this->db->order_by('id_kelas', 'DESC');
        return $this->db->get()->result();
    }

    public function KirimRequest($data)
    {
        $this->db->insert('tbl_request', $data);
    }

    public function website()
    {

        $query = "SELECT * FROM tbl_logo";
        return $this->db->query($query)->row()->nama_sekolah;
    }
}