<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'application/libraries/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_admin');
        $this->load->model('Mod_user');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function user_data()
    {
        $data['title'] = "User Data";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['user'] = $this->Mod_admin->admin()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/user_data', $data);
    }
    public function insert_admin()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function update_admin()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/user_data');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_admin()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/user_data');
    }

    public function verivikasi()
    {
        $data['title'] = "Verivikasi Data";
        $data['verivikasi'] = $this->Mod_admin->verivikasi()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/verivikasi', $data);
    }

    public function tahun_ajaran()
    {
        $data['title'] = "Tahun Ajaran Data";
        $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->result();
        $data['status'] = ['Y', 'N'];
        $this->template->load('layoutbackend', 'admin/tahun_ajaran', $data);
    }
    public function insert_thajaran()
    {
        $save  = array(
            'id' => rand(00, 99),
            'tahun' => $this->input->post('tahun'),
            'status' => $this->input->post('status'),
        );
        // dead($save);
        $this->db->insert('tahun_ajaran', $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Tambah Tahun Ajaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/tahun_ajaran');
    }

    public function update_tahunajaran()
    {
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'tahun' => $this->input->post('tahun'),
            'status' => $this->input->post('status'),
        );
        // dead($save);
        $this->Mod_user->updatethajaran($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Update Tahun Ajaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/tahun_ajaran');
    }

    public function delete_tahunajaran()
    {
        $id = $this->input->get('id');

        $this->db->delete('tahun_ajaran', array('id' => $id));
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Delete Tahun Ajaran Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/tahun_ajaran');
    }

    public function detail_siswa($id)
    {
        $data['title'] = "Detail Data Siswa";
        $data['detail_siswa'] = $this->Mod_user->siswa_all($id)->result();
        $data['priodik'] = $this->Mod_user->priodik($id)->result();
        $data['ayah'] = $this->Mod_user->ayah($id)->result();
        $data['ibu'] = $this->Mod_user->ibu($id)->result();
        $data['get_id'] = $this->Mod_user->siswa_all($id)->row();

        // dead($id);
        $this->template->load('layoutbackend', 'admin/detail_siswa', $data);
    }
    public function acc_siswa($id)
    {
        $save = array(
            'id_verivikasi' => 1
        );
        // dead($save);
        $this->Mod_user->accsiswa($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Verivikasi Siswa Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }
    public function batal_siswa($id)
    {
        $save = array(
            'id_verivikasi' => 2
        );
        // dead($save);
        $this->Mod_user->accsiswa($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Batal Verivikasi Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }

    public function tidterima_siswa($id)
    {
        $save = array(
            'id_verivikasi' => 3
        );
        // dead($save);
        $this->Mod_user->accsiswa($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Batal Verivikasi Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }
    public function update_ktp()
    {
        if (!empty($_FILES['ktp']['name'])) {
            // $this->_validate();
            $id = $this->input->post('no_pendaftaran');

            $nama = 'KTP' . $id;

            $config['upload_path']   = './assets/foto/scan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('ktp')) {
                $gambar = $this->upload->data();


                $save  = array(
                    'ktp' => $gambar['file_name']
                );
                $g = $this->Mod_user->getktp($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/scan/' . $g['ktp']);
                }
                // dead($save);
                $this->Mod_user->updatektp($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Upload KTP Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('dashboard/index');
            }
        }
    }
    public function update_kk()
    {
        if (!empty($_FILES['kk']['name'])) {
            // $this->_validate();
            $id = $this->input->post('no_pendaftaran');

            $nama = 'KK' . $id;

            $config['upload_path']   = './assets/foto/scan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('kk')) {
                $gambar = $this->upload->data();


                $save  = array(
                    'kk' => $gambar['file_name']
                );
                $g = $this->Mod_user->getkk($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/scan/' . $g['kk']);
                }
                // dead($save);
                $this->Mod_user->updatekk($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Upload KK Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('dashboard/index');
            }
        }
    }
    public function update_akta()
    {
        if (!empty($_FILES['akta']['name'])) {
            // $this->_validate();
            $id = $this->input->post('no_pendaftaran');

            $nama = 'AKTA' . $id;

            $config['upload_path']   = './assets/foto/scan/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('akta')) {
                $gambar = $this->upload->data();


                $save  = array(
                    'akta' => $gambar['file_name']
                );
                $g = $this->Mod_user->getakta($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/scan/' . $g['akta']);
                }
                // dead($save);
                $this->Mod_user->updatekk($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Upload AKTA Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('dashboard/index');
            }
        }
    }


    public function delete_all_datasiswa($id)
    {
        $g = $this->Mod_user->getImageall($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/scan/' . $g['kk']);
            unlink('assets/foto/scan/' . $g['akta']);
            unlink('assets/foto/scan/' . $g['ktp']);
        }

        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->db->delete('siswa', array('no_pendaftaran' => $id));
        $this->db->delete('ayah', array('no_pendaftaran' => $id));
        $this->db->delete('ibu', array('no_pendaftaran' => $id));
        $this->db->delete('priodik', array('no_pendaftaran' => $id));
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Delete Siswa Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/verivikasi');
    }

    public function pembayaran()
    {
        $data['title'] = "Detail Pembayaran Siswa";
        $data['pembayaran'] = $this->Mod_user->pembayaran()->result();
        $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->result();
        $data['gol'] = ['A', 'B'];
        $data['act'] = ['Y', 'N'];
        // dead($id);
        $this->template->load('layoutbackend', 'admin/pembayaran', $data);
    }

    public function insert_pembayaran()
    {
        $save  = array(
            'id' => rand(00, 99),
            'id_tahun' => $this->input->post('id_tahun'),
            'golongan' => $this->input->post('golongan'),
            'sumbangan_awal' => $this->input->post('sumbangan_awal'),
            'seragam' => $this->input->post('seragam'),
            'majalah' => $this->input->post('majalah'),
            'alat_tulis' => $this->input->post('alat_tulis'),
        );
        // dead($save);
        $this->db->insert('pembayaran', $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Tambah Pembayaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/pembayaran');
    }

    public function update_pembayaran()
    {
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'id_tahun' => $this->input->post('id_tahun'),
            'golongan' => $this->input->post('golongan'),
            'sumbangan_awal' => $this->input->post('sumbangan_awal'),
            'seragam' => $this->input->post('seragam'),
            'majalah' => $this->input->post('majalah'),
            'alat_tulis' => $this->input->post('alat_tulis'),
        );
        // dead($save);
        $this->Mod_user->updatepembayaran($id, $save);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Update Pembayaran Berhasil',
                    icon: 'success'
                    });
                </script>");
        redirect('admin/pembayaran');
    }
    public function delete_pembayaran()
    {
        $id = $this->input->get('id');


        $this->db->delete('pembayaran', array('id' => $id));
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Delete Pembayaran Berhasil',
                    icon: 'success'
                    });
                </script>");

        redirect('admin/pembayaran');
    }

    public function cetak_siswa($id)
    {
        $data['title'] = "Detail Pembayaran Siswa";
        $data['detail_siswa'] = $this->Mod_user->siswa_all($id)->result();
        $data['priodik'] = $this->Mod_user->priodik($id)->result();
        $data['ayah'] = $this->Mod_user->ayah($id)->result();
        $data['ibu'] = $this->Mod_user->ibu($id)->result();
        $data['get_id'] = $this->Mod_user->siswa_all($id)->row();
        $data['tahun_ajaran'] = $this->Mod_user->tahun_ajaran()->result();
        $data['pembayaran'] = $this->Mod_user->pembayaran()->result();
        // dead($id);
        $this->load->view('admin/cetak_siswa', $data);
    }

    public function siswa()
    {
        $data['title'] = "Siswa Diterima";
        $data['verivikasi'] = $this->Mod_admin->verifikasiacc()->result();

        // dead($id);
        $this->template->load('layoutbackend', 'admin/siswa', $data);
    }

    function laporan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $id_user = $_GET['id_user'];
                $ket = 'Data Transaksi dari Siswa dengan Nomor Induk ' . $id_user;
                $url_cetak = 'admin/cetak1?&id_user=' . $id_user;
                $url_excel = 'admin/excel1?&id_user=' . $id_user;
                $siswa = $this->Mod_user->view_by_siswa($id_user)->result();
            } else if ($filter == '2') {
                $golongan = $_GET['golongan'];
                $ket = 'Data Per Golongan ' . $golongan;
                $url_cetak = 'admin/cetak2?&golongan=' . $golongan;
                $url_excel = 'admin/excel2?&golongan=' . $golongan;
                $siswa = $this->Mod_user->view_by_golongan($golongan)->result();
            } else if ($filter == '3') {
                $tahun_ajaran = $_GET['tahun_ajaran'];
                $ket = 'Data Per Tahun Ajaran ' . $tahun_ajaran;
                $url_cetak = 'admin/cetak3?&tahun_ajaran=' . $tahun_ajaran;
                $url_excel = 'admin/excel3?&tahun_ajaran=' . $tahun_ajaran;
                $siswa = $this->Mod_user->view_by_tahun_ajaran($tahun_ajaran)->result();
            }
        } else {
            $ket = 'Semua Data Siswa';
            $url_cetak = 'admin/cetak';
            $url_excel = 'admin/excel';
            $siswa = $this->Mod_user->view_all()->result();
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['url_excel'] = base_url($url_excel);
        $data['siswa'] = $siswa;
        // dead($data['siswa']);
        $data['siswa_select'] = $this->Mod_user->siswa()->result();
        $data['tahun_ajaran'] = $this->Mod_user->tahun()->result();
        $data['title'] = 'Laporan Data Siswa Diterima';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->template->load('layoutbackend', 'admin/laporan', $data);
    }
    public function cetak()
    {
        $ket = 'Semua Data Siswa Diterima';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_all()->result();;
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function cetak1()
    {
        $id_user = $_GET['id_user'];
        $ket = 'Data Siswa Dengan Id ' . $id_user;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_by_siswa($id_user)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function cetak2()
    {
        $golongan = $_GET['golongan'];
        $ket = 'Data Siswa Dengan Golongan ' . $golongan;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_by_golongan($golongan)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function cetak3()
    {
        $tahun_ajaran = $_GET['tahun_ajaran'];
        $ket = 'Data Siswa Dengan Tahun Ajaran ' . $tahun_ajaran;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['siswa_all'] = $this->Mod_user->view_by_tahun_ajaran($tahun_ajaran)->result();
        $data['ket'] = $ket;
        $this->load->view('admin/print_siswa', $data);
    }
    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $siswa = $this->Mod_user->view_all()->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     var_dump($siswa);
        // die();
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->no_tlp);
            $sheet->setCellValue('D' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('E' . $numrow, $data->tempat_lahir);
            $sheet->setCellValue('F' . $numrow, $data->tanggal_lahir);
            $sheet->setCellValue('G' . $numrow, $data->agama);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(30); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function excel1()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $id_user = $_GET['id_user'];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI DENGAN ID" . $id_user); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $siswa = $this->Mod_user->view_by_siswa($id_user)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     var_dump($siswa);
        // die();
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->no_tlp);
            $sheet->setCellValue('D' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('E' . $numrow, $data->tempat_lahir);
            $sheet->setCellValue('F' . $numrow, $data->tanggal_lahir);
            $sheet->setCellValue('G' . $numrow, $data->agama);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(30); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel2()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $golongan = $_GET['golongan'];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI DENGAN GOLONGAN " . $golongan); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $siswa = $this->Mod_user->view_by_golongan($golongan)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     var_dump($siswa);
        // die();
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->no_tlp);
            $sheet->setCellValue('D' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('E' . $numrow, $data->tempat_lahir);
            $sheet->setCellValue('F' . $numrow, $data->tanggal_lahir);
            $sheet->setCellValue('G' . $numrow, $data->agama);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(30); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function excel3()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $tahun_ajaran = $_GET['tahun_ajaran'];
        $sheet->setCellValue('A1', "DATA SISWA YANG SUDAH DI VERIFIKASI DENGAN ID TAHUN " . $tahun_ajaran); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $siswa = $this->Mod_user->view_by_tahun_ajaran($tahun_ajaran)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     var_dump($siswa);
        // die();
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->full_name);
            $sheet->setCellValue('C' . $numrow, $data->no_tlp);
            $sheet->setCellValue('D' . $numrow, $data->jenis_kelamin);
            $sheet->setCellValue('E' . $numrow, $data->tempat_lahir);
            $sheet->setCellValue('F' . $numrow, $data->tanggal_lahir);
            $sheet->setCellValue('G' . $numrow, $data->agama);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(30); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }



    public function backup()
    {

        $this->load->dbutil();
        $data['setting_school'] = "DATA";
        $prefs = [
            'format' => 'zip',
            'filename' => $data['setting_school']['setting_value'] . '-' . date("Y-m-d H-i-s") . '.sql'
        ];
        $backup = $this->dbutil->backup($prefs);
        $file_name = $data['setting_school']['setting_value'] . '-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->download($file_name);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
