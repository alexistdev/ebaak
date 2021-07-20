<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tableAdmin = 'admin';
		$this->tableJurusan = 'jurusan';
		$this->tableUser = 'user';
		$this->tableDetailUser = 'detail_user';
		$this->tableSidang = 'surat_sidang';
		$this->tableRiwayat = 'riwayat_surat';
		$this->tableKeterangan = 'surat_keterangan';
		$this->tableCuti = 'surat_cuti';
		$this->tableAktif = 'surat_aktif';
		$this->tablePenelitian = 'surat_penelitian';
		$this->tableKP = 'surat_kp';
		$this->tableKelas = 'surat_pindah_kelas';
		$this->tableProdi = 'surat_pindah_prodi';
		$this->tableLulus = 'surat_tanda_lulus';
	}

	####################################################################################
	#                                  Tabel riwayat                                   #
	####################################################################################

	public function update_riwayat($data,$kodesurat)
	{
		$this->db->where("kode_surat", $kodesurat);
		$this->db->update($this->tableRiwayat,$data);
	}

	public function simpan_riwayat($data)
	{
		$this->db->insert($this->tableRiwayat,$data);
	}

	/** Data Riwayat */
	public function get_data_riwayat($idUser)
	{
		$this->db->where('id_user', $idUser);
		$this->db->order_by('status_riwayat', "DESC");
		$this->db->order_by('id_riwayat', "DESC");
		return $this->db->get($this->tableRiwayat);
	}

	public function get_data_riwayatbyid($idRiwayat)
	{
		$this->db->where('id_riwayat', $idRiwayat);
		return $this->db->get($this->tableRiwayat);
	}

	public function get_kepemilikan($idUser, $idRiwayat)
	{
		$this->db->where('id_user', $idUser);
		$this->db->where('id_riwayat', $idRiwayat);
		return $this->db->get($this->tableRiwayat);
	}



	####################################################################################
	#                                  Tabel surat tanda lulus                         #
	####################################################################################
	public function get_data_lulus($data)
	{
		$this->db->join($this->tableUser, 'user.id_user=surat_tanda_lulus.id_user');
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_tanda_lulus.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_tanda_lulus.id_user');
		if ($data != null) {
			$this->db->where("$this->tableLulus.id_suratlulus", $data);
		}
		return $this->db->get($this->tableLulus);
	}
	public function get_datatandalulus_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableLulus);
	}


	public function get_tandalulus_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tableLulus);
	}

	public function simpan_lulus($data)
	{
		$this->db->insert($this->tableLulus,$data);
	}


	####################################################################################
	#                                  Tabel surat pindah prodi                        #
	####################################################################################
	public function get_data_pindahprodi($data){
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_pindah_prodi.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_pindah_prodi.id_user');
		if($data != null){
			$this->db->where("$this->tableProdi.id_pindahprodi", $data);
		}
		return $this->db->get($this->tableProdi);
	}
	public function get_datapindahprodi_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableProdi);
	}

	public function get_pindahprodi_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tableProdi);
	}

	public function simpan_prodi($data)
	{
		$this->db->insert($this->tableProdi,$data);
	}

	####################################################################################
	#                                  Tabel surat pindah kelas                        #
	####################################################################################
	public function get_data_pindahkelas($data){
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_pindah_kelas.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_pindah_kelas.id_user');
		if($data != null){
			$this->db->where("$this->tableKelas.id_suratpindah", $data);
		}
		return $this->db->get($this->tableKelas);
	}
	public function get_datapindahkelas_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableKelas);
	}

	public function get_pindahkelas_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tableKelas);
	}

	public function simpan_pindahkelas($data)
	{
		$this->db->insert($this->tableKelas,$data);
	}

	####################################################################################
	#                                  Tabel surat kp                                  #
	####################################################################################
	public function get_data_kp($data){
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_kp.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_kp.id_user');
		if($data != null){
			$this->db->where("$this->tableKP.id_suratkp", $data);
		}
		return $this->db->get($this->tableKP);
	}

	public function get_datakp_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableKP);
	}

	public function get_kp_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tableKP);
	}

	public function simpan_kp($data)
	{
		$this->db->insert($this->tableKP,$data);
	}

	####################################################################################
	#                                  Tabel surat Penelitian                          #
	####################################################################################
	public function get_data_penelitian($data){
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_penelitian.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_penelitian.id_user');
		if($data != null){
			$this->db->where("$this->tablePenelitian.id_penelitian", $data);
		}
		return $this->db->get($this->tablePenelitian);
	}

	public function get_datapenelitian_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tablePenelitian);
	}

	public function get_penelitian_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tablePenelitian);
	}

	public function simpan_penelitian($data)
	{
		$this->db->insert($this->tablePenelitian,$data);
	}

	####################################################################################
	#                                  Tabel surat aktif                               #
	####################################################################################
	public function get_data_aktif($data){
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_aktif.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_aktif.id_user');
		if($data != null){
			$this->db->where("$this->tableAktif.id_surataktif", $data);
		}
		return $this->db->get($this->tableAktif);
	}

	public function get_dataaktif_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableAktif);
	}

	public function get_aktif_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tableAktif);
	}

	public function simpan_aktif($data)
	{
		$this->db->insert($this->tableAktif,$data);
	}

	####################################################################################
	#                                  Tabel surat cuti                                #
	####################################################################################
	public function get_data_cuti($data){
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_cuti.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_cuti.id_user');
		if($data != null){
			$this->db->where("$this->tableCuti.id_suratcuti", $data);
		}
		return $this->db->get($this->tableCuti);
	}
	public function get_datacuti_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableCuti);
	}

	public function get_cuti_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tableCuti);
	}

	public function simpan_cuti($data)
	{
		$this->db->insert($this->tableCuti,$data);
	}
	####################################################################################
	#                                  Tabel surat keterangan                          #
	####################################################################################
	public function get_data_keterangan($data){
		$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_keterangan.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_keterangan.id_user');
		if($data != null){
			$this->db->where("$this->tableKeterangan.id_suratketerangan", $data);
		}
		return $this->db->get($this->tableKeterangan);
	}
	public function get_dataketerangan_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableKeterangan);
	}

	public function get_keterangan_iduser($id)
	{
		$this->db->where('id_user',$id);
		return $this->db->get($this->tableKeterangan);
	}

	public function simpan_keterangan($data)
	{
		$this->db->insert($this->tableKeterangan,$data);
	}

	####################################################################################
	#                                  Tabel surat sidang                              #
	####################################################################################
	public function get_data_sidang($data){
			$this->db->join($this->tableRiwayat, 'riwayat_surat.kode_surat=surat_sidang.kode_surat');
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=surat_sidang.id_user');
		if($data != null){
			$this->db->where("$this->tableSidang.id_suratsidang", $data);
		}
		return $this->db->get($this->tableSidang);
	}

	public function get_datasidang_bykode($kode)
	{
		$this->db->where('kode_surat',$kode);
		return $this->db->get($this->tableSidang);
	}

	public function get_sidang_iduser($id)
	{
		$this->db->where("$this->tableSidang.id_user", $id);
		return $this->db->get($this->tableSidang);
	}

	public function simpan_sidang($data)
	{
		$this->db->insert($this->tableSidang,$data);
	}

	####################################################################################
	#                                  Tabel user dan detail user                      #
	####################################################################################
	/** Mendapatkan data lengkap user */
	public function get_data_user($data=null){
		$this->db->join($this->tableDetailUser, 'detail_user.id_user=user.id_user');
		$this->db->join($this->tableJurusan, 'jurusan.id_jurusan=detail_user.id_jurusan');
		if($data != null){
			$this->db->where('user.id_user', $data);
		}
		return $this->db->get($this->tableUser);
	}

	/** Menyimpan data user */
	public function simpan_user($data)
	{
		$this->db->insert($this->tableUser,$data);
		return $this->db->insert_id();
	}

	/** Menyimpan data detail user */
	public function simpan_detail_user($data)
	{
		$this->db->insert($this->tableDetailUser,$data);
	}

	/** Mengupdate data user */
	public function update_user($data,$id)
	{
		$this->db->where('id_user',$id);
		$this->db->update($this->tableUser,$data);
	}

	public function update_detail_user($data,$id)
	{
		$this->db->where('id_user',$id);
		$this->db->update($this->tableDetailUser,$data);
	}

	/** Mendapatkan data dari user */
	public function hapus_user($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tableUser);
	}


	####################################################################################
	#                                  Tabel jurusan                                   #
	####################################################################################
	/** Untuk mendapatkan data jurusan */
	public function get_data_jurusan($data=NULL)
	{
		if($data != NULL){
			$this->db->where('id_jurusan', $data);
		}
		return $this->db->get($this->tableJurusan);
	}

	/** Mengupdate data jurusan */
	public function update_jurusan($data,$id)
	{
		$this->db->where('id_jurusan',$id);
		$this->db->update($this->tableJurusan,$data);
	}

	/** Menyimpan data jurusan */
	public function simpan_jurusan($data)
	{
		$this->db->insert($this->tableJurusan, $data);
	}

	/** Mendapatkan data dari jurusan */
	public function hapus_jurusan($id)
	{
		$this->db->where('id_jurusan', $id);
		$this->db->delete($this->tableJurusan);
	}

	####################################################################################
	#                                  Tabel admin                                     #
	####################################################################################
	/** Dapat data untuk validasi login */
	public function validasi_login($username)
	{
		$this->db->where('username', $username);
		return $this->db->get($this->tableAdmin);
	}

	/** Mengupdate data admin */
	public function update_admin($data)
	{
		$this->db->where('id_admin',1);
		$this->db->update($this->tableAdmin,$data);
	}

	/** Dapat data untuk validasi login */
	public function validasi_login_user($username,$password)
	{
		$this->db->where('npm', $username);
		$this->db->where('password', $password);
		return $this->db->get($this->tableUser);
	}


}
