<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktif_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;

	/** Constructor dari Class Aktif_user */
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

	/** Menampilkan halaman index Aktif_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'alasanAktif',
			'Alasan Aktif',
			'trim|required',
			[
				'required' => 'Alasan Aktif harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_aktif';
			$this->_template($data, $view);
		} else {
			$getAktif = $this->admin->get_aktif_iduser($this->idUser);
			if($getAktif->num_rows() != 0){
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Aktif Akademik sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {
				$alasanAktif = $this->input->post("alasanAktif", TRUE);
				$kodeSurat = angkaUnik();

				/** Menyimpan ke dalam tabel surat_aktif */
				$dataAktif = [
					'id_user' => $this->idUser,
					'alasan_aktif' => $alasanAktif,
					'kode_surat' => $kodeSurat
				];
				$this->admin->simpan_aktif($dataAktif);

				/** Menyimpan ke dalam tabel riwayat_surat */
				$tglNow = date("Y-m-d");
				$dataRiwayat =[
					'id_user' => $this->idUser,
					'nama_surat' => "Surat Permohonan Aktif Kembali",
					'tanggal_surat' => $tglNow,
					'kode_surat' => $kodeSurat,
					'status_riwayat' => 3,
					'type' => 4
				];
				$this->admin->simpan_riwayat($dataRiwayat);
				$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Permohonan Aktif Akademik berhasil didaftarkan, silahkan ditunggu proses selanjutnya!</div>');
				redirect("mahasiswa/riwayat");
			}
		}
	}

}
