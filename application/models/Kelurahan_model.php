<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan_model extends CI_Model 
{
	
    protected $table = 'pit';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'admo');
		$this->load->model('Log_model', 'lomo');
	}

	public function getKelurahan()
	{
		$this->db->join('site', 'pma_dailyprod_pit.kodesite=site.kodesite');
		$this->db->order_by('pma_dailyprod_pit.id', 'asc');
		return $this->db->get('pma_dailyprod_pit')->result_array();
	}

	public function getKelurahanById($id_kelurahan)
	{
		$this->db->join('site', 'pit.kodesite=site.kodesite');
		return $this->db->get_where('pma_dailyprod_pit', ['id' => $id_kelurahan])->row_array();	
	}

	public function addKelurahan()
	{
		$dataUser = $this->admo->getDataUserAdmin();
		$isi_log_2 = 'User ' . $dataUser['username'] . ' mencoba menambahkan kelurahan';
		$this->admo->userPrivilege('pma_dailyprod_pit', $isi_log_2);

		$data = [
			'pit'		=> ucwords(strtolower($this->input->post('kelurahan', true))),
			'kodesite'	=> $this->input->post('id_kecamatan', true)
		];

		$this->db->insert('pit', $data);

		$isi_log = 'Kelurahan ' . $data['pit'] . ' berhasil ditambahkan';
		$this->lomo->addLog($isi_log, $dataUser['id']);
		$this->session->set_flashdata('message-success', $isi_log);
		redirect('kelurahan');
	}

	public function editKelurahan($id_kelurahan)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		$isi_log_2 = 'User ' . $dataUser['username'] . ' mencoba mengubah kelurahan ber id ' . $id_kelurahan;
		$this->admo->userPrivilege('kelurahan', $isi_log_2);

		$data_kelurahan = $this->getKelurahanById($id_kelurahan);
		$data = [
			'pit'		=> ucwords(strtolower($this->input->post('kelurahan', true))),
			'kodesite'	=> $this->input->post('id_kecamatan', true)
		];

		$this->db->update('pma_dailyprod_pit', $data, ['id_kelurahan' => $id_kelurahan]);

		$isi_log = 'Kelurahan ' . $data['pit'] . ' berhasil diubah';
		$this->lomo->addLog($isi_log, $dataUser['id']);
		$this->session->set_flashdata('message-success', $isi_log);
		redirect('kelurahan');
	}

	public function removeKelurahan($id_kelurahan)
	{
		$dataUser = $this->admo->getDataUserAdmin();
		$isi_log_2 = 'User ' . $dataUser['username'] . ' mencoba menghapus kelurahan ber id ' . $id_kelurahan;
		$this->admo->userPrivilege('pit', $isi_log_2);

		$data_kelurahan = $this->getKelurahanById($id_kelurahan);
		$kelurahan  = $data_kelurahan['pit'];
		
		$this->db->delete('hazard_pengaduan', ['id' => $id_kelurahan]);
		$this->db->delete('hazard_kelurahan', ['id' => $id_kelurahan]);
		$isi_log = 'Kelurahan ' . $kelurahan . ' berhasil dihapus';
		$this->lomo->addLog($isi_log, $dataUser['id_user']);
		$this->session->set_flashdata('message-success', $isi_log);
		redirect('kelurahan'); 
	}
}
