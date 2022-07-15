<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_aplikasi');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Mod_user');
        $this->load->model('Mod_login');
    }

    public function index()
    {
        // dead($data);
        $this->load->view('templates/header_front');
        $this->load->view('frontend/index');
        $this->load->view('templates/footer_front');
    }

    public function form_pendaftaran()
    {

        $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->row();

        $this->load->view('templates/header_front');
        $this->load->view('frontend/pendaftaran', $data);
        $this->load->view('templates/footer_front');
    }
    public function pendaftaran()
    {
        $this->form_validation->set_rules('username', 'Nama Panggilan', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('kewarganegaraan', 'Kewarganegaraan', 'trim|required');
        $this->form_validation->set_rules('ber_khusus', 'Berkebutuhan Khusus', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('rt', 'Rt', 'trim|required');
        $this->form_validation->set_rules('rw', 'Rw', 'trim|required');
        $this->form_validation->set_rules('dusun', 'Dusun', 'trim|required');
        $this->form_validation->set_rules('desa', 'Desa', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');
        $this->form_validation->set_rules('tempat_tinggal', 'Tempat Tinggal', 'trim|required');
        $this->form_validation->set_rules('transportasi', 'Transportasi', 'trim|required');
        $this->form_validation->set_rules('anak_keberapa', 'Anak Keberapa', 'trim|required');

        $this->form_validation->set_rules('no_tlp', 'No Telepon', 'trim|required');
        $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'trim|required');
        $this->form_validation->set_rules('berat_badan', 'Berat Badan', 'trim|required');
        $this->form_validation->set_rules('jarak_kesekolah', 'Jarak Kesekolah', 'trim|required');
        $this->form_validation->set_rules('waktu_kesekolah', 'Waktu Kesekolah', 'trim|required');
        $this->form_validation->set_rules('saudara_kandung', 'Saudara Kandung', 'trim|required');

        $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');

        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');

        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
        // tanggal lahir


        $id_user = rand(000, 999);
        if ($this->form_validation->run() == FALSE) {
            $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->row();
            // dead($data['tahun_ajaran']);
            $this->load->view('templates/header_front', $data);
            $this->load->view('frontend/pendaftaran', $data);
            $this->load->view('templates/footer_front', $data);
        } else {

            $save  = array(
                'id_user' => $id_user,
                'username' => $this->input->post('username'),
                'full_name' => $this->input->post('full_name'),
                'no_tlp' => $this->input->post('no_tlp'),
                'password'  => get_hash('123456'),
                'id_level'  => 2,
                'is_active' => 'Y',
            );
            $save1 = array(
                'no_pendaftaran' => $id_user,
                'tanggal_daftar' => $this->input->post('tanggal_daftar'),
                'id_tahun' => $this->input->post('id_tahun'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'agama' => $this->input->post('agama'),
                'kewarganegaraan' => $this->input->post('kewarganegaraan'),
                'ber_khusus' => $this->input->post('ber_khusus'),
                'alamat' => $this->input->post('alamat'),
                'rt' => $this->input->post('rt'),
                'rw' => $this->input->post('rw'),
                'dusun' => $this->input->post('dusun'),
                'desa' => $this->input->post('desa'),
                'kecamatan' => $this->input->post('kecamatan'),
                'kode_pos' => $this->input->post('kode_pos'),
                'tempat_tinggal' => $this->input->post('tempat_tinggal'),
                'transportasi' => $this->input->post('transportasi'),
                'anak_keberapa' => $this->input->post('anak_keberapa'),
                'golongan' => $this->input->post('golongan'),
                'id_verivikasi' => 2,
            );
            // dead($save1);
            $save2 = array(
                'no_pendaftaran' => $id_user,
                'tinggi_badan' => $this->input->post('tinggi_badan'),
                'berat_badan' => $this->input->post('berat_badan'),
                'jarak_kesekolah' => $this->input->post('jarak_kesekolah'),
                'waktu_kesekolah' => $this->input->post('waktu_kesekolah'),
                'saudara_kandung' => $this->input->post('saudara_kandung'),
            );
            $save3 = array(
                'no_pendaftaran' => $id_user,
                'nama_ayah' => $this->input->post('nama_ayah'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
            );
            $save4 = array(
                'no_pendaftaran' => $id_user,
                'nama_ibu' => $this->input->post('nama_ibu'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
            );
            $save5 = array(
                'no_pendaftaran' => $id_user,
                'nama_wali' => $this->input->post('nama_wali'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'pendidikan' => $this->input->post('pendidikan'),
                'pekerjaan' => $this->input->post('pekerjaan'),
            );
            // dead($save1);
            $this->db->insert("tbl_user", $save);
            $this->db->insert("siswa", $save1);
            $this->db->insert("priodik", $save2);
            $this->db->insert("ayah", $save3);
            $this->db->insert("ibu", $save4);
            $this->db->insert("wali", $save5);
            redirect('login/login_siswa');
            $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->row();
            $this->load->view('templates/header_front');
            $this->load->view('frontend/pendaftaran', $data);
            $this->load->view('templates/footer_front');
        }
    }
}
