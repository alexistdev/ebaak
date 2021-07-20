<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public $session;
	public $admin;
	public $form_validation;
	public $input;

	/** Constructor dari Class User */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		if ($this->session->userdata('is_user_login') !== TRUE) {
			redirect('Login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('mahasiswa/views/' . $view, $data);
	}

	/** Menampilkan halaman index User */
	public function index()
	{
		$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
		$data['dataMahasiswa'] = $this->admin->get_data_user()->result_array();
		$view ='v_user';
		$this->_template($data,$view);
	}

	/** Tambah Mahasiswa */
	public function tambah()
	{
		$this->form_validation->set_rules(
			'namaJurusan',
			'Nama Jurusan',
			'trim|required',
			[
				'required' => 'Jurusan harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'namaMahasiswa',
			'Nama Mahasiswa',
			'trim|min_length[3]|max_length[100]|required',
			[
				'max_length' => 'Panjang karakter Nama maksimal 100 karakter!',
				'min_length' => 'Panjang karakter Nama minimal 3 karakter!',
				'required' => 'Nama harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'npmMahasiswa',
			'NPM',
			'trim|min_length[5]|max_length[50]|required',
			[
				'max_length' => 'Panjang karakter NPM maksimal 30 karakter!',
				'min_length' => 'Panjang karakter NPM minimal 5 karakter!',
				'required' => 'NPM harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|max_length[50]|valid_email|required',
			[
				'max_length' => 'Panjang karakter Email maksimal 50 karakter!',
				'valid_email' => 'Email yang anda masukkan tidak valid',
				'required' => 'Email harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|min_length[6]|max_length[16]|required',
			[
				'max_length' => 'Panjang karakter Password maksimal 16 karakter!',
				'min_length' => 'Panjang karakter Password minimal 6 karakter!',
				'required' => 'Password harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('pesan', validation_errors());
			$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
			$data['pilihanJurusan'] = $this->admin->get_data_jurusan()->result_array();
			$view = 'v_tambahmahasiswa';
			$this->_template($data, $view);
		}else{
			$kodeJurusan = $this->input->post("namaJurusan", TRUE);
			$namaMahasiswa = $this->input->post("namaMahasiswa", TRUE);
			$npmMahasiswa = $this->input->post("npmMahasiswa", TRUE);
			$email = $this->input->post("email", TRUE);
			$password = $this->input->post("password", TRUE);
			$inPass = md5($password);

			/* tabel user */
			$dataUser = [
				'npm' => $npmMahasiswa,
				'password' => $inPass,
				'status' => 1
			];
			$idUser = $this->admin->simpan_user($dataUser);
			/* tabel detail */
			$dataDetail = [
				'id_user' => $idUser,
				'id_jurusan' => $kodeJurusan,
				'nama' => $namaMahasiswa,
				'email' => $email
			];
			$this->admin->simpan_detail_user($dataDetail);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Menambah data!</div>');
			redirect('Mahasiswa');
		}
	}


	/** private function data mahasiswa */
	private function _dataMahasiswa($id)
	{
		$dataMahasiswa =  $this->admin->get_data_user($id)->result_array();
		foreach($dataMahasiswa as $rowMahasiswa) {
			$data['idUser'] = $rowMahasiswa['id_user'];
			$data['namaMahasiswa'] = $rowMahasiswa['nama'];
			$data['npmMahasiswa'] = $rowMahasiswa['npm'];
			$data['emailMahasiswa'] = $rowMahasiswa['email'];
			$data['npmMahasiswa'] = $rowMahasiswa['npm'];
			$data['npmMahasiswa'] = $rowMahasiswa['npm'];
			$data['jurusan'] = $rowMahasiswa['id_jurusan'];
		}
		$data['pilihanJurusan'] = $this->admin->get_data_jurusan()->result_array();
		return $data;
	}



	/** Edit jurusan */
	public function edit($idx=null)
	{
		$id = $idx;
		$cekId = $this->admin->get_data_user($id)->num_rows();
		if ($idx == null || $idx == '' || $cekId == 0) {
			redirect('Mahasiswa');
		} else {
			$this->form_validation->set_rules(
				'namaJurusan',
				'Nama Jurusan',
				'trim|required',
				[
					'required' => 'Jurusan harus diisi!'
				]
			);
			$this->form_validation->set_rules(
				'namaMahasiswa',
				'Nama Mahasiswa',
				'trim|min_length[3]|max_length[100]|required',
				[
					'max_length' => 'Panjang karakter Nama maksimal 100 karakter!',
					'min_length' => 'Panjang karakter Nama minimal 3 karakter!',
					'required' => 'Nama harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'npmMahasiswa',
				'NPM',
				'trim|min_length[5]|max_length[50]|required',
				[
					'max_length' => 'Panjang karakter NPM maksimal 30 karakter!',
					'min_length' => 'Panjang karakter NPM minimal 5 karakter!',
					'required' => 'NPM harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'email',
				'Email',
				'trim|max_length[50]|valid_email|required',
				[
					'max_length' => 'Panjang karakter Email maksimal 50 karakter!',
					'valid_email' => 'Email yang anda masukkan tidak valid',
					'required' => 'Email harus diisi!'
				]
			);
			$this->form_validation->set_rules(
				'password',
				'Password',
				'trim|min_length[6]|max_length[16]',
				[
					'max_length' => 'Panjang karakter Password maksimal 16 karakter!',
					'min_length' => 'Panjang karakter Password minimal 6 karakter!',
					'required' => 'Email harus diisi!'
				]
			);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', validation_errors());
				$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
				$dataMahasiswa = $this->_dataMahasiswa($id);
				$data = array_merge($data, $dataMahasiswa);
				$view = 'v_editmahasiswa';
				$this->_template($data, $view);
			}else{
				$kodeJurusan = $this->input->post("namaJurusan", TRUE);
				$namaMahasiswa = $this->input->post("namaMahasiswa", TRUE);
				$npmMahasiswa = $this->input->post("npmMahasiswa", TRUE);
				$email = $this->input->post("email", TRUE);
				$password = $this->input->post("password", TRUE);

				if($password != ''){
					$inPass = md5($password);
					/* tabel user */
					$dataUser = [
						'npm' => $npmMahasiswa,
						'password' => $inPass,
					];
					$dataDetail = [
						'id_jurusan' => $kodeJurusan,
						'nama' => $namaMahasiswa,
						'email' => $email
					];
				} else {
					/* tabel user */
					$dataUser = [
						'npm' => $npmMahasiswa,
					];
					$dataDetail = [
						'id_jurusan' => $kodeJurusan,
						'nama' => $namaMahasiswa,
						'email' => $email
					];
				}
				$this->admin->update_user($dataUser,$id);
				$this->admin->update_detail_user($dataDetail,$id);
				$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Berhasil Mengedit data Mahasiswa!</div>');
				redirect('Mahasiswa/edit/'.sanitasi($id));
			}
		}
	}
	/** Tambah Jurusan */
	public function hapus($idx=null)
	{
		$id=$idx;
		$cekId = $this->admin->get_data_user($id)->num_rows();
		if($idx==null || $idx =='' || $cekId == 0){
			redirect('Mahasiswa');
		} else {
			$this->admin->hapus_user($id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data Mahasiswa berhasil dihapus!</div>');
			redirect('Mahasiswa');
		}
	}

	/** Method untuk Logout */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}
