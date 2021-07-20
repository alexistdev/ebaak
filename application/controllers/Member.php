<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public $session;

	/** Constructor dari Class Login */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('view/' . $view, $data);
	}

	/** Menampilkan halaman index Member */
	public function index()

	{
		$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
		$view ='v_member';
		$this->_template($data,$view);
	}

	/** Method untuk Logout */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}
