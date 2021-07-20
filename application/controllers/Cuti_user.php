<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;

	/** Constructor dari Class Cuti_user */
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

	/** Menampilkan halaman index Cuti_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'tahunAkademik',
			'Tahun Akademik',
			'trim|required',
			[
				'required' => 'Tahun Akademik harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'alasanCuti',
			'Alasan Cuti',
			'trim|required',
			[
				'required' => 'Alasan Cuti harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_cuti';
			$this->_template($data, $view);
		}else{
			/** Mengecek apakah sudah ada surat cuti */
			$getCuti = $this->admin->get_cuti_iduser($this->idUser);
			if($getCuti->num_rows() != 0){
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Cuti sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {
				$tahunAkademik = $this->input->post("tahunAkademik", TRUE);
				$alasanCuti = $this->input->post("alasanCuti", TRUE);
				$kodeSurat = angkaUnik();
				/** Menyimpan ke dalam tabel surat_cuti */
				$dataCuti = [
					'id_user' => $this->idUser,
					'tahun_akademik' => $tahunAkademik,
					'alasan_cuti' => $alasanCuti,
					'kode_surat' => $kodeSurat
				];
				$this->admin->simpan_cuti($dataCuti);

				/** Menyimpan ke dalam tabel riwayat_surat */
				$tglNow = date("Y-m-d");
				/** Memasukkan ke dalam tabel riwayat_surat */
				$dataRiwayat =[
					'id_user' => $this->idUser,
					'nama_surat' => "Surat Permohonan Cuti",
					'tanggal_surat' => $tglNow,
					'kode_surat' => $kodeSurat,
					'status_riwayat' => 3,
					'type' => 3
				];
				$this->admin->simpan_riwayat($dataRiwayat);
				$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Permohonan Cuti Akademik berhasil didaftarkan, silahkan ditunggu proses selanjutnya!</div>');
				redirect("mahasiswa/riwayat");
			}
		}
	}

}
