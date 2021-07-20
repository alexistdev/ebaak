<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{

	public $api;

	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function login_post()
	{
		$npm = $this->post('npm');
		$password = md5($this->post('password'));
		$cekUser = $this->api->cek_login($npm, $password)->num_rows();

		if ($cekUser != 0) {
			$row = $this->api->data_user($npm)->row();
			$token = $this->_angkaUnik();
			$data_session =[
				'status' => 'berhasil',
				'message' => 'berhasil',
				'token' => $token,
				'id_user' => $row->id_user,
				'npm' => $row->npm
			];
			/* Mengupdate token */
			$dataToken = [
				'token' => $token
			];
			$this->api->simpan_token($dataToken,$npm);
			$this->response(
				$data_session,
				200
			);
		} else {
			$this->response([
				'status' => 'gagal',
				'message' => 'NPM atau Password yang anda masukkan salah'
			], 404);
		}
	}

	/** Mendapatkan angka unik */
	private function _angkaUnik($length = 5)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function akun_get($id = null)
	{
		if (!empty($id)) {
			$getAkun =  $this->api->data_akun($id);
			if($getAkun->num_rows() !=0 ){
				foreach($getAkun->result_array() as $row){
					$data['npm'] =$row['npm'];
					$data['token'] =$row['token'];
					$data['nama_jurusan'] =$row['nama_jurusan'];
					$data['nama'] =$row['nama'];
					$data['email'] =$row['email'];
				};
				$this->response($data, 200);
			} else {
				$this->response([
					'status' => 'gagal',
					'message' => 'data kosong!'
				], 404);
			}

		} else {
			$this->response([
				'status' => 'gagal',
				'message' => 'id tidak ditemukan , error!'
			], 404);

		}
	}
	public function akun_put($id){
		$email = $this->put('email');
		$nama = $this->put('nama');
		$password = $this->put('password');
		$getAkun =  $this->api->data_akun($id);
		if($getAkun->num_rows() !=0 ){
			if($password != 0){
				$dataDetail =[
					'nama' => $nama,
					'email' => $email
				];
				$dataUser = [
					'password' => md5($password)
				];
				$this->api->update_password($dataUser,$id);
			} else {
				$dataDetail =[
					'nama' => $nama,
					'email' => $email
				];
			}
			$update = $this->api->update_detail_user($dataDetail,$id);
			if ($update) {
				$data = [
					'status' => 'berhasil',
					'message' => 'Data berhasil diperbaharui'
				];
				$this->response($data, 200);
			} else {
				$this->response([
					'status' => 'gagal',
					'message' => 'Gagal menyimpan ke dalam server!'
				], 404);
			}
		}else{
			$this->response([
				'status' => 'gagal',
				'message' => 'data kosong!'
			], 404);
		}
	}

}
