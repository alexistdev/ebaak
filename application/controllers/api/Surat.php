<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Surat extends RestController
{

	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function keterangan_post()
	{
		$idUser = $this->post('id_user');
		$nik = $this->post('nik_ortu');
		$nama_ortu = $this->post('nama_ortu');
		$pekerjaan_ortu = $this->post('pekerjaan_ortu');
		$alamat = $this->post('alamat');
		$keperluan = $this->post('keperluan');
		$lampiran = $this->post('lampiran');

		$tanggal = date("Y-m-d");
		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataSimpan = [
				'id_user' => $idUser,
				'nik_ortu' => $nik,
				'nama_ortu' => $nama_ortu,
				'pekerjaan_ortu' => $pekerjaan_ortu,
				'alamat' => $alamat,
				'tanggal' => $tanggal,
				'keperluan' => $keperluan,
				'lampiran' => $lampiran,
				'kode_surat' => $kodeSurat,
				'status' => 2
			];
			$this->api->simpan_surat_keterangan($dataSimpan);
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Keterangan",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 2
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);
		}else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}

	private function angkaUnik($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function sidang_post()
	{
		$idUser = $this->post('id_user');
		$judul = $this->post('judul');
		$pembimbing = $this->post('pembimbing');
		$penguji1 = $this->post('penguji1');
		$penguji2 = $this->post('penguji2');
		$nidn_pembimbing = $this->post('nidn_pembimbing');
		$nomor_sk = $this->post('nomor_sk');
		$tanggal_sk = date("Y-m-d",strtotime($this->post('tanggal_sk')));
		$tanggal_acc = date("Y-m-d",strtotime($this->post('tanggal_acc')));
		$jumlah_bimbingan = $this->post('jumlah_bimbingan');
		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataSuratSidang =[
				'id_user' => $idUser,
				'judul' => $judul,
				'pembimbing' => $pembimbing,
				'penguji1' => $penguji1,
				'penguji2' => $penguji2,
				'nidn_pembimbing' => $nidn_pembimbing,
				'nomor_sk' => $nomor_sk,
				'tanggal_sk' => $tanggal_sk,
				'tanggal_acc' => $tanggal_acc,
				'jumlah_bimbingan' => $jumlah_bimbingan,
				'kode_surat' => $kodeSurat
			];

			$this->api->simpan_surat_sidang($dataSuratSidang);
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Pendaftaran Sidang",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 1
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);
		} else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}

	public function cuti_post()
	{
		$idUser = $this->post('id_user');
		$tahunAkademik = $this->post('tahun_akademik');
		$alasan = $this->post('alasan_cuti');
		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataCuti = [
				'id_user' => $idUser,
				'tahun_akademik' => $tahunAkademik,
				'alasan_cuti' =>$alasan,
				'kode_surat' => $kodeSurat
			];
			$idSurat = $this->api->simpan_surat_cuti($dataCuti);
			$kodeSurat = $this->api->data_surat_cuti($idSurat)->row()->kode_surat;
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Pendaftaran Cuti Akademik",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 3
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);
		} else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}
	public function aktif_post()
	{
		$idUser = $this->post('id_user');
		$alasan = $this->post('alasan_aktif');
		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataAktif = [
				'id_user' => $idUser,
				'alasan_aktif' => $alasan,
				'kode_surat' => $kodeSurat
			];
			$idSurat = $this->api->simpan_surat_aktif($dataAktif);
			$kodeSurat = $this->api->data_surat_aktif($idSurat)->row()->kode_surat;
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Aktif Akademik",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 4
				];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);
		}else{
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}

	public function penelitian_post()
	{
		$idUser = $this->post('id_user');
		$ditujukan = $this->post('ditujukan');
		$instansi = $this->post('nama_instansi');
		$alamat = $this->post('alamat_instansi');
		$judul = $this->post('judul_penelitian');
		$tanggalMulai = date("Y-m-d",strtotime($this->post('tanggal_mulai')));
		$tanggalAkhir = date("Y-m-d",strtotime($this->post('tanggal_akhir')));
		$lampiran = $this->post('lampiran');
		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataPenelitian =[
					'id_user' =>$idUser,
					'ditujukan' => $ditujukan,
					'nama_instansi' => $instansi,
					'alamat_instansi' => $alamat,
					'judul_penelitian' => $judul,
					'tanggal_mulai' => $tanggalMulai,
					'tanggal_akhir' => $tanggalAkhir,
					'lampiran' => $lampiran,
					'kode_surat' => $kodeSurat
			];
			$this->api->simpan_surat_penelitian($dataPenelitian);
			$dataRiwayat = [
					'id_user' => $idUser,
					'nama_surat' => "Surat Penelitian",
					'tanggal_surat' => date("Y-m-d"),
					'kode_surat' => $kodeSurat,
					'status_riwayat' => 3,
					'type' => 5
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
					'status' => 'sukses',
					'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);

		}else{
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}

	public function kerjapraktek_post()
	{
		$idUser = $this->post('id_user');
		$namaInstansi = $this->post('nama_instansi');
		$ditujukan = $this->post('ditujukan');
		$alamatInstansi= $this->post('alamat_instansi');
		$tanggalMulai = date("Y-m-d",strtotime($this->post('tanggal_mulai')));
		$tanggalBerakhir = date("Y-m-d",strtotime($this->post('tanggal_berakhir')));
		$keterangan = $this->post('keterangan');
		$lampiran= $this->post('lampiran');

		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataKP =[
				'id_user' => $idUser,
				'nama_instansi' => $namaInstansi,
				'ditujukan' => $ditujukan,
				'alamat_instansi' => $alamatInstansi,
				'tanggal_mulai' => $tanggalMulai,
				'tanggal_berakhir' => $tanggalBerakhir,
				'keterangan' => $keterangan,
				'lampiran' => $lampiran,
				'kode_surat' => $kodeSurat
			];
			$this->api->simpan_surat_kp($dataKP);
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Kerja Praktek",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 6
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);

		}else{
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);

		}
	}

	public function pindahkelas_post()
	{
		$idUser = $this->post('id_user');
		$kelasSebelum = $this->post('kelas_sebelum');
		$alasanPindah = $this->post('alasan_pindah');
		$tanggalPengajuan = date("Y-m-d",strtotime($this->post('tanggal_pengajuan')));
		$lampiran= $this->post('lampiran');

		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataPindah =[
				'id_user' => $idUser,
				'kelas_sebelum' => $kelasSebelum,
				'alasan_pindah' => $alasanPindah,
				'tanggal_pengajuan' => $tanggalPengajuan,
				'kode_surat' => $kodeSurat,
				'lampiran' => $lampiran
			];
			$this->api->simpan_surat_pindah_kelas($dataPindah);
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Pindah Kelas",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 7
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);
		} else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}
	public function pindahprodi_post()
	{
		$idUser = $this->post('id_user');
		$namaProdi = $this->post('nama_prodi');
		$alasanPindah = $this->post('alasan_pindah');
		$lampiran= $this->post('lampiran');

		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataProdi = [
				'id_user' => $idUser,
				'nama_prodi' => $namaProdi,
				'alasan_pindah' => $alasanPindah,
				'kode_surat' => $kodeSurat,
				'lampiran' => $lampiran
			];
			$this->api->simpan_surat_pindah_prodi($dataProdi);
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Pindah Program Studi",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 8
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);
		}else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}
	public function tandalulus_post()
	{
		$idUser = $this->post('id_user');
		$tempatLahir = $this->post('tempat_lahir');
		$tanggalLahir = date("Y-m-d",strtotime($this->post('tanggal_lahir')));
		$lampiran= $this->post('lampiran');

		$getUser = $this->api->data_akun($idUser);
		$kodeSurat = $this->angkaUnik();
		if($getUser->num_rows() != 0){
			$dataLulus = [
				'id_user' => $idUser,
				'tempat_lahir' => $tempatLahir,
				'tanggal_lahir' => $tanggalLahir,
				'kode_surat' => $kodeSurat,
				'lampiran' => $lampiran
			];
			$this->api->simpan_surat_lulus($dataLulus);
			$dataRiwayat = [
				'id_user' => $idUser,
				'nama_surat' => "Surat Tanda Lulus Sementara",
				'tanggal_surat' => date("Y-m-d"),
				'kode_surat' => $kodeSurat,
				'status_riwayat' => 3,
				'type' => 9
			];
			$this->api->simpan_riwayat($dataRiwayat);
			$dataResponse = [
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			];
			$this->response($dataResponse, 200);

		}else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}
}

