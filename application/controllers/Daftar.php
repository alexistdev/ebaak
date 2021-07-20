<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {
	public $session;
	public $form_validation;
	public $login;
	public $input;

	/** Constructor dari Class Login */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'login');
		if ($this->session->userdata('is_login_in') == TRUE) {
			redirect('Member');
		} else if($this->session->userdata('is_user_login') == TRUE){
			redirect('User');
		} else {
			return true;
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('view/' . $view, $data);
	}

	/** Method untuk generate captcha */
	private function _create_captcha()
	{
		$cap = create_captcha(config_captcha());
		$image = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		return $image;
	}

	/** Validasi Captcha */
	public function _check_captcha($string)
	{
		if ($string == $this->session->userdata('captchaword')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_captcha', 'Captcha yang anda masukkan salah!');
			return FALSE;
		}
	}

	/** Menampilkan halaman default login, dengan form validation */
	public function index()
	{
		$this->form_validation->set_rules(
			'namaLengkap',
			'Nama Lengkap',
			'trim|required',
			[
				'required' => 'Nama Lengkap harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|valid_email|is_unique[detail_user.email]',
			[
				'required' => 'Email harus diisi!',
				'is_unique' => 'Email sudah terdaftar'
			]
		);
		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|required|is_unique[user.npm]',
			[
				'required' => 'Username harus diisi!',
				'is_unique' => 'NPM sudah terdaftar'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|required',
			[
				'required' => 'Password harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'captcha',
			'Captcha',
			'trim|callback__check_captcha|required',
			[
				'required' => 'Captcha harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('pesan', validation_errors());
			$data['image'] = $this->_create_captcha();
			$data['title'] = "Daftar | Ebaak - Layanan BAAK Darmajaya";
			$data['jurusan'] = $this->login->get_data_jurusan();
			$view ='v_daftar';
			$this->_template($data,$view);
		} else {
			$namaLengkap = $this->input->post('namaLengkap', TRUE);
			$email = $this->input->post('email', TRUE);
			$jurusan = $this->input->post('jurusan', TRUE);
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			/** Memasukkan ke dalam tabel user */
			$dataUser = [
				'npm' => $username,
				'password' => md5($password),
				'token' => angkaUnik(),
				'status' => 1
			];
			$idUser = $this->login->simpan_user($dataUser);
			$dataDetail = [
				'id_user' => $idUser,
				'id_jurusan' => $jurusan,
				'nama' => $namaLengkap,
				'email' => $email
			];
			$this->login->simpan_detail_user($dataDetail);
			$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Akun berhasil Dibuat!</div>');
			redirect("Login");
		}
	}

}
