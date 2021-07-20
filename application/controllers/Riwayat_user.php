<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_user extends CI_Controller
{
	public $form_validation;
	public $session;
	public $input;
	public $admin;
	public $idUser;

	/** Constructor dari Class Riwayat */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		$this->idUser = $this->session->userdata('idUser');
		if ($this->session->userdata('is_user_login') !== TRUE) {
			redirect('Login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('mahasiswa/views/' . $view, $data);
	}

	/** Menampilkan halaman index Riwayat */
	public function index()
	{
		$idUser = $this->session->userdata('idUser');
		$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
		$data['dataRiwayat'] = $this->admin->get_data_riwayat($idUser)->result_array();
		$view ='v_riwayat';
		$this->_template($data,$view);
	}

	public function detail($idx=NULL)
	{
		if(!empty($idx)){
			$cekKepemilikan = $this->admin->get_kepemilikan($this->idUser, $idx);
			if($cekKepemilikan->num_rows() != 0){
				$dataRiwayat = $this->admin->get_data_riwayatbyid($idx)->row();
				$tipeSurat = $dataRiwayat->type;
				$statusRiwayat = $dataRiwayat->status_riwayat;
				switch ($tipeSurat){
					case 1:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan1'] = $this->admin->get_datasidang_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_sidang';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 2:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan2'] = $this->admin->get_dataketerangan_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_keterangan';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 3:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan3'] = $this->admin->get_datacuti_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_cuti';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 4:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan4'] = $this->admin->get_dataaktif_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_aktif';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 5:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan5'] = $this->admin->get_datapenelitian_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_penelitian';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 6:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan6'] = $this->admin->get_datakp_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_kp';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 7:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan7'] = $this->admin->get_datapindahkelas_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_pindahkelas';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 8:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan8'] = $this->admin->get_datapindahprodi_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_pindahprodi';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					case 9:
						$data['title'] = "Dashboard | Ebaak - Layanan BAAK Darmajaya";
						$kodeSurat = $dataRiwayat->kode_surat;
						$data['pilihan9'] = $this->admin->get_datatandalulus_bykode($kodeSurat);
						$data['kontenRiwayat'] = 'k_riwayat_tandalulus';
						$data['statusRiwayat'] = $statusRiwayat;
						$view ='v_riwayat_surat';
						$this->_template($data,$view);
						break;
					default:
						redirect('mahasiswa/riwayat');
						break;
				}
			} else {
				redirect('mahasiswa/riwayat');
			}
		} else {
			redirect('mahasiswa/riwayat');
		}
	}
}
