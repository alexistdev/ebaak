<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;

	/** Constructor dari Class Setting_user */
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

	/** Menampilkan halaman index Setting_user */
	public function index()
	{
		$this->form_validation->set_rules(
			'namaLengkap',
			'Nama Lengkap',
			'trim|min_length[4]|required',
			[
				'min_length' => 'Panjang karakter Nama Lengkap minimal 4 karakter!',
				'required' => 'Nama Lengkap harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|valid_email|required',
			[
				'valid_email' => 'Masukkan email yang valid!',
				'required' => 'Alamat Email harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|min_length[4]|max_length[16]',
			[
				'max_length' => 'Panjang karakter Password maksimal 16 karakter!',
				'min_length' => 'Panjang karakter Password minimal 6 karakter!',
				'required' => 'Password harus diisi!'
			]
		);

		$this->form_validation->set_rules(
			'jurusan',
			'Jurusan',
			'trim|required',
			[
				'required' => 'Jurusan harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('pesan', validation_errors());
			$data = $this->_preparedata();
			$view = 'v_setting';
			$this->_template($data, $view);
		}else{
			$namaLengkap= $this->input->post("namaLengkap", TRUE);
			$email= $this->input->post("email", TRUE);
			$jurusan= $this->input->post("jurusan", TRUE);
			$password= $this->input->post("password", TRUE);
			if(!empty($password)){
				/** Simpan ke detail_user */
				$dataDetail = [
					'id_jurusan' => $jurusan,
					'nama' => $namaLengkap,
					'email' => $email
				];
				/** Simpan password */
				$dataPassword = [
					'password' => md5($password)
				];
				$this->admin->update_user($dataPassword,$this->idUser);
			} else {
				/** Simpan ke detail_user */
				$dataDetail = [
					'id_jurusan' => $jurusan,
					'nama' => $namaLengkap,
					'email' => $email
				];
			}
			$this->admin->update_detail_user($dataDetail,$this->idUser);
			$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Akun berhasil diperbaharui!</div>');
			redirect("mahasiswa/setting");
		}
	}

	private function _preparedata()
	{
		$data = [];
		$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
		$getDataAkun = $this->admin->get_data_user($this->idUser);
		foreach($getDataAkun->result_array() as $rowAkun){
			$data['namaAkun'] = sanitasi($rowAkun['nama']);
			$data['emailAkun'] = sanitasi($rowAkun['email']);
			$data['jurusanAkun'] = sanitasi($rowAkun['id_jurusan']);
		}
		$data['jurusan'] = $this->admin->get_data_jurusan();
		return $data;
	}
}
