<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerjapraktek_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;
	public $upload;

	/** Constructor dari Class Kerjapraktek_user */
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

	/** Menampilkan halaman index Kerjapraktek_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'namaInstansi',
			'Nama Instansi',
			'trim|required',
			[
				'required' => 'Nama Instansi harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'ditujukan',
			'Ditujukan',
			'trim|required',
			[
				'required' => 'Kolom ditujukan kepada siapa, harus diisi!'
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
			'keterangan',
			'Keterangan',
			'trim|required',
			[
				'required' => 'Keterangan harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'tanggalPenelitian',
			'Tanggal Penelitian',
			'trim|required',
			[
				'required' => 'Tanggal Penelitian harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'tanggalAkhir',
			'Tanggal Akhir',
			'trim|required',
			[
				'required' => 'Tanggal Akhir harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_kerjapraktek';
			$this->_template($data, $view);
		} else {
			$getdatakp = $this->admin->get_kp_iduser($this->idUser);
			if($getdatakp->num_rows() != 0){
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Kerja Praktek sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {
				$namaInstansi= $this->input->post("namaInstansi", TRUE);
				$ditujukan= $this->input->post("ditujukan", TRUE);
				$alamat= $this->input->post("alamat", TRUE);
				$keterangan= $this->input->post("keterangan", TRUE);
				$tanggalPenelitian= $this->input->post("tanggalPenelitian", TRUE);
				$tanggalAkhir= $this->input->post("tanggalAkhir", TRUE);

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
					$dataKp = [
						'id_user' => $this->idUser,
						'nama_instansi' => $namaInstansi,
						'ditujukan' => $ditujukan,
						'alamat_instansi' => $alamat,
						'tanggal_mulai' => date("Y-m-d",strtotime($tanggalPenelitian)),
						'tanggal_berakhir' => date("Y-m-d", strtotime($tanggalAkhir)),
						'keterangan' => $keterangan,
						'lampiran' => base_url()."file/".$namaFile.".rar",
						'kode_surat' => $kodeSurat
					];
					$this->admin->simpan_kp($dataKp);
					/** Menyimpan ke dalam tabel riwayat_surat */
					$tglNow = date("Y-m-d");
					$dataRiwayat =[
						'id_user' => $this->idUser,
						'nama_surat' => "Surat Kerja Praktek",
						'tanggal_surat' => $tglNow,
						'kode_surat' => $kodeSurat,
						'status_riwayat' => 3,
						'type' => 6
					];
					$this->admin->simpan_riwayat($dataRiwayat);
					$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Permohonan Kerja Praktek berhasil didaftarkan, silahkan ditunggu proses selanjutnya!</div>');
					redirect("mahasiswa/riwayat");
				}
			}
		}
	}
}
