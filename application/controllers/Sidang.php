<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidang extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;

	/** Constructor dari Class Login */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('Login');
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
		$data['dataSidang'] = $this->admin->get_data_sidang(null)->result_array();
		$view ='v_sidang';
		$this->_template($data,$view);
	}

	public function selesai($idx=null)
	{
		$id=$idx;
		$cekData = $this->admin->get_data_sidang($id);
		if ($idx == NULL || $idx == '' || $cekData->num_rows() == 0) {
			redirect('Sidang');
		} else {
			$kodeSurat = $cekData->row()->kode_surat;
			$dataSidang = [
				'status_riwayat'=> 1
			];
			$this->admin->update_riwayat($dataSidang,$kodeSurat);
			$this->session->set_flashdata('notif2', '<div class="alert alert-success" role="alert">Surat Sidang telah dinyatakan selesai!</div>');
			redirect('Sidang');
		}
	}

	public function tolak($idx=null)
	{
		$id = $idx;
		$cekData = $this->admin->get_data_sidang($id);
		if ($idx == NULL || $idx == '' || $cekData->num_rows() == 0) {
			redirect('Sidang');
		} else {
			$kodeSurat = $cekData->row()->kode_surat;
			$dataSidang = [
				'status_riwayat' => 2
			];
			$this->admin->update_riwayat($dataSidang, $kodeSurat);
			$this->session->set_flashdata('notif2', '<div class="alert alert-danger" role="alert">Surat sidang ditolak!</div>');
			redirect('Sidang');
		}
	}
}
