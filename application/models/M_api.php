<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_api extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tableJurusan = 'jurusan';
		$this->tableUser = 'user';
		$this->tableDetailuser = 'detail_user';
		$this->tableKeterangan = 'surat_keterangan';
		$this->tableSidang = 'surat_sidang';
		$this->tableRiwayat = 'riwayat_surat';
		$this->tableCuti = 'surat_cuti';
		$this->tableAktif = 'surat_aktif';
		$this->tablePenelitian = 'surat_penelitian';
		$this->tableKP = 'surat_kp';
		$this->tablePindahKelas = 'surat_pindah_kelas';
		$this->tablePindahProdi = 'surat_pindah_prodi';
		$this->tableLulus = 'surat_tanda_lulus';
	}
	####################################################################################
	#                             Tabel surat tanda lulus                              #
	####################################################################################
	public function simpan_surat_lulus($data)
	{
		$this->db->insert($this->tableLulus, $data);
	}

	####################################################################################
	#                             Tabel surat pindah  prodi                            #
	####################################################################################
	public function simpan_surat_pindah_prodi($data)
	{
		$this->db->insert($this->tablePindahProdi, $data);
	}

	####################################################################################
	#                             Tabel surat pindah  kelas                            #
	####################################################################################
	public function simpan_surat_pindah_kelas($data)
	{
		$this->db->insert($this->tablePindahKelas, $data);
	}
	####################################################################################
	#                                Tabel surat kp                                    #
	####################################################################################
	public function simpan_surat_kp($data)
	{
		$this->db->insert($this->tableKP, $data);
	}

	####################################################################################
	#                                Tabel surat penelitian                            #
	####################################################################################
	public function simpan_surat_penelitian($data)
	{
		$this->db->insert($this->tablePenelitian,$data);
		return $this->db->insert_id();
	}

	####################################################################################
	#                                Tabel surat cuti                                  #
	####################################################################################
	public function simpan_surat_aktif($dataAktif)
	{
		$this->db->insert($this->tableAktif,$dataAktif);
		return $this->db->insert_id();
	}

	public function data_surat_aktif($id)
	{
		$this->db->where('id_surataktif',$id);
		return $this->db->get($this->tableAktif);
	}
	####################################################################################
	#                                Tabel surat cuti                                  #
	####################################################################################
	public function simpan_surat_cuti($data)
	{
		$this->db->insert($this->tableCuti,$data);
		return $this->db->insert_id();
	}
	public function data_surat_cuti($id)
	{
		$this->db->where('id_suratcuti',$id);
		return $this->db->get($this->tableCuti);
	}

	####################################################################################
	#                                Tabel surat riwayat                               #
	####################################################################################
	public function simpan_riwayat($data)
	{
		$this->db->insert($this->tableRiwayat,$data);
	}

	public function data_riwayat($data)
	{
		$this->db->where('id_user', $data);
		$this->db->order_by("id_riwayat", "DESC");
		return $this->db->get($this->tableRiwayat);
	}

	####################################################################################
	#                                Tabel surat sidang                                #
	####################################################################################
	public function simpan_surat_sidang($data)
	{
		$this->db->insert($this->tableSidang,$data);
		return $this->db->insert_id();
	}

	public function data_surat_sidang($id)
	{
		$this->db->where('id_suratsidang',$id);
		return $this->db->get($this->tableSidang);
	}

	####################################################################################
	#                                Tabel surat keterangan                            #
	####################################################################################
	public function simpan_surat_keterangan($data)
	{
		$this->db->insert($this->tableKeterangan,$data);
		return $this->db->insert_id();
	}

	####################################################################################
	#                                Tabel jurusan                                     #
	####################################################################################
	/** Untuk mendapatkan data jurusan */
	public function get_data_jurusan($data=NULL)
	{
		if($data != NULL){
			$this->db->where('id_jurusan', $data);
		}
		return $this->db->get($this->tableJurusan);
	}
	public function get_data_jurusanbyname($data){
		$this->db->where('nama_jurusan', $data);
		return $this->db->get($this->tableJurusan);
	}
	####################################################################################
	#                                Tabel user                                        #
	####################################################################################
	/** Mengecek npm apakah sudah ada */
	public function cek_npm($data)
	{
		$this->db->where('npm', $data);
		return $this->db->get($this->tableUser);
	}
	/** Mengecek email apakah sudah ada */
	public function cek_email($data)
	{
		$this->db->where('email', $data);
		return $this->db->get($this->tableDetailuser);
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
		$this->db->insert($this->tableDetailuser,$data);
	}

	/** Mengecek login */
	public function cek_login($npm, $password)
	{
		$this->db->where('npm', $npm);
		$this->db->where('password', $password);
		return $this->db->get($this->tableUser);
	}

	/** Data login */
	public function data_user($npm)
	{
		$this->db->where('npm', $npm);
		return $this->db->get($this->tableUser);
	}

	/** Simpan data token */
	public function simpan_token($data,$npm)
	{
		$this->db->where('npm',$npm);
		$this->db->update($this->tableUser,$data);
	}

	public function data_akun($data){
		$this->db->join($this->tableDetailuser, "$this->tableDetailuser.id_user = $this->tableUser.id_user");
		$this->db->join($this->tableJurusan, "$this->tableJurusan.id_jurusan = $this->tableDetailuser.id_jurusan");
		$this->db->where("$this->tableUser.id_user",$data);
		return $this->db->get($this->tableUser);
	}

	public function update_password($dataUser,$id)
	{
		$this->db->where("id_user",$id);
		$this->db->update($this->tableUser,$dataUser);
	}

	public function update_detail_user($dataDetail,$id)
	{
		$this->db->where("id_user",$id);
		return $this->db->update($this->tableDetailuser,$dataDetail);
	}

}
