<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidang_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;

	/** Constructor dari Class Sidang_user */
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

	/** Menampilkan halaman index Sidang_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'judul',
			'Judul',
			'trim|min_length[6]|required',
			[
				'required' => 'Judul harus diisi!',
				'min_length' => 'Judul minimal harus terdiri dari 6 karakter'
			]
		);
		$this->form_validation->set_rules(
			'pembimbing',
			'Pembimbing',
			'trim|required',
			[
				'required' => 'Pembimbing harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'penguji1',
			'Penguji 1',
			'trim|required',
			[
				'required' => 'Penguji 2 harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'penguji2',
			'Penguji 2',
			'trim|required',
			[
				'required' => 'Penguji 2 harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'nidn',
			'NIDN',
			'trim|required',
			[
				'required' => 'Nomor NIDN harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'skbimbingan',
			'SK Bimbingan',
			'trim|required',
			[
				'required' => 'Nomor SK Bimbingan harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'tanggalsk',
			'Tanggal SK',
			'trim|required',
			[
				'required' => 'Tanggal SK Bimbingan harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'tanggalacc',
			'Tanggal ACC',
			'trim|required',
			[
				'required' => 'Tanggal ACC Bimbingan harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'jumlah',
			'Jumlah Bimbingan',
			'trim|required',
			[
				'required' => 'Jumlah Bimbingan harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_sidang';
			$this->_template($data, $view);
		}else {
			/** Mengecek apakah sudah mengajukan surat sidang sebelumnya */
			$getData = $this->admin->get_sidang_iduser($this->idUser);
			if($getData->num_rows() != 0){
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Pendaftaran Sidang sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {
				$judul = $this->input->post('judul', TRUE);
				$pembimbing = $this->input->post('pembimbing', TRUE);
				$penguji1 = $this->input->post('penguji1', TRUE);
				$penguji2 = $this->input->post('penguji2', TRUE);
				$nidn = $this->input->post('nidn', TRUE);
				$skbimbingan = $this->input->post('skbimbingan', TRUE);
				$tanggalsk = $this->input->post('tanggalsk', TRUE);
				$tanggalacc = $this->input->post('tanggalacc', TRUE);
				$jumlah = $this->input->post('jumlah', TRUE);
				$kodeSurat = angkaUnik();
				/** Memasukkan ke dalam tabel surat_sidang */
				$dataSidang = [
					'id_user' => $this->idUser,
					'judul' => $judul,
					'pembimbing' => $pembimbing,
					'penguji1' => $penguji1,
					'penguji2' => $penguji2,
					'nidn_pembimbing' => $nidn,
					'nomor_sk' => $skbimbingan,
					'tanggal_sk' => date("Y-m-d", strtotime($tanggalsk)),
					'tanggal_acc' => date("Y-m-d", strtotime($tanggalacc)),
					'jumlah_bimbingan' => $jumlah,
					'kode_surat' => $kodeSurat
				];
				$this->admin->simpan_sidang($dataSidang);

				$tglNow = date("Y-m-d");
				/** Memasukkan ke dalam tabel riwayat_surat */
				$dataRiwayat =[
					'id_user' => $this->idUser,
					'nama_surat' => "Surat Pendaftaran Sidang",
					'tanggal_surat' => $tglNow,
					'kode_surat' => $kodeSurat,
					'status_riwayat' => 3,
					'type' => 1
				];
				$this->admin->simpan_riwayat($dataRiwayat);
				$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Pendaftaran Sidang berhasil dibuat, silahkan ditunggu proses selanjutnya!</div>');
				redirect("mahasiswa/riwayat");
			}
		}
	}
}
