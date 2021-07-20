<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keterangan_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $upload;
	public $idUser;

	/** Constructor dari Class Keterangan_user */
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

	/** Menampilkan halaman index Keterangan_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'nik',
			'NIK',
			'trim|required',
			[
				'required' => 'NIK/NIP harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'namaOrtu',
			'Nama Orang Tua',
			'trim|required',
			[
				'required' => 'Nama Orang Tua harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'pekerjaan',
			'Pekerjaan Orang Tua',
			'trim|required',
			[
				'required' => 'Pekerjaan Orang Tua harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'alamat',
			'Alamat',
			'trim|required',
			[
				'required' => 'Alamat harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'keperluan',
			'Keperluan',
			'trim|required',
			[
				'required' => 'Keperluan harus diisi!'
			]
		);

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_keterangan';
			$this->_template($data, $view);
		}else{
			/** Mengecek apakah sudah ada surat keterangan */
			$getDataKeterangan = $this->admin->get_keterangan_iduser($this->idUser);
			if($getDataKeterangan->num_rows() != 0) {
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Keterangan sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {
				$nik = $this->input->post("nik", TRUE);
				$namaOrtu = $this->input->post("namaOrtu", TRUE);
				$pekerjaan = $this->input->post("pekerjaan", TRUE);
				$alamat = $this->input->post("alamat", TRUE);
				$keperluan = $this->input->post("keperluan", TRUE);
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
					/** Menyimpan ke dalam tabel surat_keterangan */
					$kodeSurat = angkaUnik();
					$dataKeterangan = [
						'id_user' => $this->idUser,
						'nik_ortu' => $nik,
						'nama_ortu' => $namaOrtu,
						'pekerjaan_ortu' => $pekerjaan,
						'alamat' => $alamat,
						'tanggal' => date("Y-m-d"),
						'keperluan' => $keperluan,
						'lampiran' => base_url()."file/".$namaFile.".rar",
						'status' => 3,
						'kode_surat' => $kodeSurat
					];
					$this->admin->simpan_keterangan($dataKeterangan);

					/** Menyimpan ke dalam tabel riwayat_surat */
					$tglNow = date("Y-m-d");
					$dataRiwayat =[
						'id_user' => $this->idUser,
						'nama_surat' => "Surat Keterangan",
						'tanggal_surat' => $tglNow,
						'kode_surat' => $kodeSurat,
						'status_riwayat' => 3,
						'type' => 2
					];
					$this->admin->simpan_riwayat($dataRiwayat);
					$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Keterangan Mahasiswa berhasil didaftarkan, silahkan ditunggu proses selanjutnya!</div>');
					redirect("mahasiswa/riwayat");
				}
			}
		}

	}

}
