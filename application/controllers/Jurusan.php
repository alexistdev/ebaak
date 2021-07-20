<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {
	public $session;
	public $admin;
	public $form_validation;
	public $input;

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
		$data['dataJurusan'] = $this->admin->get_data_jurusan(null)->result_array();
		$view ='v_jurusan';
		$this->_template($data,$view);
	}

	/** Edit jurusan */
	public function edit($idx=null)
	{
		$id = $idx;
		if($idx==null || $idx==''){
			redirect('Jurusan');
		} else {
			$this->form_validation->set_rules(
				'kodeJurusan',
				'Kode Jurusan',
				'trim|min_length[3]|max_length[30]|required',
				[
					'max_length' => 'Panjang karakter Kode Jurusan maksimal 30 karakter!',
					'min_length' => 'Panjang karakter Kode Jurusan minimal 3 karakter!',
					'required' => 'Kode Jurusan harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'namaJurusan',
				'Nama Jurusan',
				'trim|min_length[5]|max_length[50]|is_unique[nama_jurusan]|required',
				[
					'is_unique' => 'Sudah pernah terdaftar di dalam database',
					'max_length' => 'Panjang karakter Nama Jurusan maksimal 50 karakter!',
					'min_length' => 'Panjang karakter Nama Jurusan minimal 5 karakter!',
					'required' => 'Nama Jurusan harus diisi !'
				]
			);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', validation_errors());
				$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
				$dataJurusan = $this->_dataJurusan($id);
				$data = array_merge($data, $dataJurusan);
				$view = 'v_editjurusan';
				$this->_template($data, $view);
			}else{
				$kodeJurusan = strtoupper($this->input->post("kodeJurusan", TRUE));
				$namaJurusan = strtolower($this->input->post("namaJurusan", TRUE));
				$dataJurusan = [
					'kode_jurusan' => $kodeJurusan,
					'nama_jurusan' => $namaJurusan
				];
				$this->admin->update_jurusan($dataJurusan,$id);
				$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Data telah diperbaharui!</div>');
				redirect('Jurusan/edit/'.sanitasi($id));
			}
		}
	}
	/** private function dataJurusan */
	private function _dataJurusan($id)
	{
		$dataJurusan =  $this->admin->get_data_jurusan($id)->result_array();
		foreach($dataJurusan as $rowJurusan) {
			$data['idJurusan'] = $rowJurusan['id_jurusan'];
			$data['kodeJurusan'] = $rowJurusan['kode_jurusan'];
			$data['namaJurusan'] = $rowJurusan['nama_jurusan'];
		}
		return $data;
	}

	/** Tambah Jurusan */
	public function tambah()
	{
		$this->form_validation->set_rules(
			'kodeJurusan',
			'Kode Jurusan',
			'trim|min_length[3]|max_length[30]|required',
			[
				'max_length' => 'Panjang karakter Kode Jurusan maksimal 30 karakter!',
				'min_length' => 'Panjang karakter Kode Jurusan minimal 3 karakter!',
				'required' => 'Kode Jurusan harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'namaJurusan',
			'Nama Jurusan',
			'trim|min_length[5]|max_length[50]|is_unique[jurusan.nama_jurusan]|required',
			[
				'is_unique' => 'Sudah pernah terdaftar di dalam database',
				'max_length' => 'Panjang karakter Nama Jurusan maksimal 50 karakter!',
				'min_length' => 'Panjang karakter Nama Jurusan minimal 5 karakter!',
				'required' => 'Nama Jurusan harus diisi !'
			]
		);

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('pesan', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$view = 'v_tambahjurusan';
			$this->_template($data, $view);
		}else{
			$kodeJurusan = strtoupper($this->input->post("kodeJurusan", TRUE));
			$namaJurusan = strtolower($this->input->post("namaJurusan", TRUE));
			$dataJurusan = [
				'kode_jurusan' => $kodeJurusan,
				'nama_jurusan' => $namaJurusan
			];
			$this->admin->simpan_jurusan($dataJurusan);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Menambah data!</div>');
			redirect('Jurusan');
		}
	}

	/** Tambah Jurusan */
	public function hapus($idx=null)
	{
		$id=$idx;
		$cekDetail = $this->admin->get_data_jurusan($id)->num_rows();
		if($idx==null || $idx =='' || $cekDetail == 0){
			redirect('Jurusan');
		} else {
			$this->admin->hapus_jurusan($id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data Jurusan berhasil dihapus!</div>');
			redirect('Jurusan');
		}
	}
}
