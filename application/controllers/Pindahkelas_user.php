<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pindahkelas_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $upload;
	public $idUser;

	/** Constructor dari Class Pindahkelas_user */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		$this->idUser = $this->session->userdata('idUser');
		if ($this->session->userdata('is_user_login') !== TRUE) {
			redirect('Login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('mahasiswa/views/' . $view, $data);
	}

	/** Menampilkan halaman index Pindahkelas_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'kelasSebelumnya',
			'Kelas sebelum',
			'trim|required',
			[
				'required' => 'Kelas sebelum harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'alasan',
			'Alasan pindah',
			'trim|required',
			[
				'required' => 'Alasan pindah harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'tanggal',
			'Tanggal',
			'trim|required',
			[
				'required' => 'Tanggal harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_pindahkelas';
			$this->_template($data, $view);
		} else{
			$getdataKelas = $this->admin->get_pindahkelas_iduser($this->idUser);
			if($getdataKelas->num_rows() != 0){
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Pindah Kelas sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {

				$kelasSebelumnya= $this->input->post("kelasSebelumnya", TRUE);
				$alasan= $this->input->post("alasan", TRUE);
				$tanggal= $this->input->post("tanggal", TRUE);

				$namaFile = angkaUnik();
				/** upload file rar */
				$config['upload_path']          = './file/';
				$config['allowed_types']        = 'rar';
				$config['max_size']             = 8024;
				$config['file_name'] = $namaFile;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('lampiran')){
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">'.$error['error'].'</div>');
					redirect('mahasiswa/keterangan');
				}else{
					/** Menyimpan ke dalam tabel surat_kp */
					$kodeSurat = angkaUnik();
					$dataKelas = [
						'id_user' => $this->idUser,
						'kelas_sebelum' => $kelasSebelumnya,
						'alasan_pindah' => $alasan,
						'tanggal_pengajuan' => date("Y-m-d", strtotime($tanggal)),
						'kode_surat' => $kodeSurat,
						'lampiran' => base_url()."file/".$namaFile.".rar",
					];
					$this->admin->simpan_pindahkelas($dataKelas);
					/** Menyimpan ke dalam tabel riwayat_surat */
					$tglNow = date("Y-m-d");
					$dataRiwayat =[
						'id_user' => $this->idUser,
						'nama_surat' => "Surat Permohonan Pindah Kelas",
						'tanggal_surat' => $tglNow,
						'kode_surat' => $kodeSurat,
						'status_riwayat' => 3,
						'type' => 7
					];
					$this->admin->simpan_riwayat($dataRiwayat);
					$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Permohonan Pindah Kelas berhasil didaftarkan, silahkan ditunggu proses selanjutnya!</div>');
					redirect("mahasiswa/riwayat");
				}
			}
		}
	}
}
