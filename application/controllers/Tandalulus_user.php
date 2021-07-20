<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tandalulus_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;
	public $upload;

	/** Constructor dari Class Tandalulus_user */
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

	/** Menampilkan halaman index Tandalulus_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'tempatlahir',
			'Tempat Lahir',
			'trim|required',
			[
				'required' => 'Tempat Lahir harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'tglLahir',
			'Tanggal Lahir',
			'trim|required',
			[
				'required' => 'Tempat Lahir harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_tandalulus';
			$this->_template($data, $view);
		}else{
			$getDataLulus = $this->admin->get_tandalulus_iduser($this->idUser);
			if($getDataLulus->num_rows() != 0){
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Tanda Lulus Sementara sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {
				$tempatlahir= $this->input->post("tempatlahir", TRUE);
				$tglLahir= $this->input->post("tglLahir", TRUE);
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
					/** Menyimpan ke dalam tabel surat_tanda_lulus */
					$kodeSurat = angkaUnik();
					$dataLulus = [
						'id_user' => $this->idUser,
						'tempat_lahir' => $tempatlahir,
						'tanggal_lahir' => date("Y-m-d", strtotime($tglLahir)),
						'kode_surat' => $kodeSurat,
						'lampiran' => base_url()."file/".$namaFile.".rar"
					];
					$this->admin->simpan_lulus($dataLulus);

					/** Menyimpan ke dalam tabel riwayat_surat */
					$tglNow = date("Y-m-d");
					$dataRiwayat =[
						'id_user' => $this->idUser,
						'nama_surat' => "Surat Permohonan Tanda Lulus Sementara",
						'tanggal_surat' => $tglNow,
						'kode_surat' => $kodeSurat,
						'status_riwayat' => 3,
						'type' => 9
					];
					$this->admin->simpan_riwayat($dataRiwayat);
					$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Surat Permohonan Tanda Lulus Sementara berhasil didaftarkan, silahkan ditunggu proses selanjutnya!</div>');
					redirect("mahasiswa/riwayat");
				}
			}
		}
	}
}
