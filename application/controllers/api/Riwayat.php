<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Riwayat extends RestController
{
	public $api;
	public $upload;

	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function tampil_get()
	{
		$idUser = $this->GET('id_user');
		$getUser = $this->api->data_akun($idUser);
		if($getUser->num_rows() != 0){
			$getRiwayat = $this->api->data_riwayat($idUser);
//			foreach($getRiwayat->result_array() as $row){
//					$data['id_riwayat'] = $row['id_riwayat'];
//					$data['nama_surat'] = $row['nama_surat'];
//					$data['tanggal_surat'] = date("d-m-Y", strtotime($row['tanggal_surat']));
//					$data['kode_surat'] = $row['kode_surat'];
//					$status = $row['status_riwayat'];
//					if($status == 1){
//						$data['status_riwayat'] = "SELESAI";
//					} else {
//						$data['status_riwayat'] = "PENDING";
//					}
//					$data['type'] = $row['type'];
//			};
			if($getRiwayat->num_rows() != 0){
				$data = [
					'status' => 'success',
					'result' => $getRiwayat->result_array(),


					'message' => 'Data berhasil didapatkan'
				];
				$this->response($data, 200);
			} else {
				$dataResponse = [
					'status' => 'failed',
					'result' => [],
					'message' => 'data kosong!'
				];
				$this->response($dataResponse, 404);
			}
		}else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}
}
