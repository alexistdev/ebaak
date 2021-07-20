<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pindahprodi_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;
	public $upload;

	/** Constructor dari Class Pindahprodi_user */
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

	/** Menampilkan halaman index Pindahprodi_user */
	public function index()
	{

		$this->form_validation->set_rules(
			'proditujuan',
			'Prodi Tujuan',
			'trim|required',
			[
				'required' => 'Prodi Tujuan harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'alasan',
			'Alasan',
			'trim|required',
			[
				'required' => 'Alasan harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notif1', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_pindahprodi';
			$this->_template($data, $view);
		}else{
			$getDataprodi = $this->admin->get_pindahprodi_iduser($this->idUser);
			if ($getDataprodi->num_rows() != 0){
				$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Anda sudah mengajukan Surat Pindah Program Studi sebelumnya!</div>');
				redirect("mahasiswa/riwayat");
			} else {
				$proditujuan= $this->input->post("proditujuan", TRUE);
				$alasan= $this->input->post("alasan", TRUE);
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
					/** Menyimpan ke dalam tabel surat_pindahprodi */
					$kodeSurat = angkaUnik();
					$dataProdi = [
						'id_user' => $this->idUser,
						'nama_prodi' => $proditujuan,
						'alasan_pindah' => $alasan,
						'kode_surat' => $kodeSurat,
						'lampiran' => base_url()."file/".$namaFile.".rar"
					];
					$this->admin->simpan_prodi($dataProdi);
					/** Menyimpan ke dalam tabel riwayat_surat */
					$tglNow = date("Y-m-d");
					$dataRiwayat =[
						'id_user' => $this->idUser,
						'nama_surat' => "Surat Permohonan Pindah Program Studi",
						'tanggal_surat' => $tglNow,
						'kode_surat' => $kodeSurat,
						'status_riwayat' => 3,
						'type' => 8
					];
					$this->admin->simpan_riwayat($dataRiwayat);
					$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Permohonan Pindah Program Studi berhasil didaftarkan, silahkan ditunggu proses selanjutnya!</div>');
					redirect("mahasiswa/riwayat");
				}
			}
		}
	}
}
