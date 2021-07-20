<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('view/' . $view, $data);
	}

	public function index()
	{
		$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
		$view = 'v_kebijakan';
		$this->_template($data, $view);
	}
}
