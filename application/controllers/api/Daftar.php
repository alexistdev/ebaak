<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Daftar extends RestController {

	public $api;
	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function tambah_post()
	{
		$email = $this->post('email');
		$password = $this->post('password');
		$jurusan = $this->post('jurusan');
		$nama = $this->post('nama');
		$npm = $this->post('npm');
		$inpass = md5($password);
		$getIdJurusan = $this->api->get_data_jurusanbyname($jurusan)->row()->id_jurusan;

		//cek NPM ga boleh sama
		$ceKnpm = $this->api->cek_npm($npm)->num_rows();
		if($ceKnpm != 0){
			$dataHasil = [
				'status' => 'gagal',
				'message' => 'NPM sudah pernah terdaftar sebelumnya!'
			];
			$this->response($dataHasil, 404);
		} else {
			$cekEmail = $this->api->cek_email($email)->num_rows();
			if($cekEmail != 0){
				$dataHasil = [
					'status' => 'gagal',
					'message' => 'Email sudah pernah terdaftar sebelumnya!'
				];
				$this->response($dataHasil, 404);
			} else {
				/* Disimpan ke dalam table user*/
				$dataUser=[
					'npm' => $npm,
					'password' => $inpass,
					'status' => 1
				];
				$idUser = $this->api->simpan_user($dataUser);

				/* Menyimpan detail user*/
				$dataDetail=[
					'id_user' => $idUser,
					'id_jurusan' => $getIdJurusan,
					'nama' => $nama,
					'email' => $email
				];
				$this->api->simpan_detail_user($dataDetail);
				$dataHasil = [
					'status' => 'berhasil',
					'message' => 'Data Mahasiswa berhasil disimpan!'
				];
				$this->response($dataHasil, 200);
			}
		}
	}

	public function tampil_get()
	{
		$getData =  $this->api->get_data_jurusan();
		if($getData->num_rows() !=0 ){
			$dataHasil = [
				'status' => 'berhasil',
				'result' => $getData->result_array(),
				'message' => 'Data berhasil didapatkan'
			];
			$this->response($dataHasil, 200);
		} else {
			$this->response([
				'status' => 'gagal',
				'result' => [],
				'message' => 'data kosong!'
			], 404);
		}
	}
}
