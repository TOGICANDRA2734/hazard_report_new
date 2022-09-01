<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelapor_model extends CI_Model 
{
	public function checkLoginUser()
	{
		if (!$this->session->userdata('id_masyarakat')) 
		{
			redirect('landing/masuk');
		}
	}

	public function getDataUser()
	{
		$id_masyarakat = $this->session->userdata('id_masyarakat');
		return $this->db->get_where('user', ['id' => $id_masyarakat])->row_array();
	}

	public function changePassword()
	{
		$dataUser 	= $this->getDataUser();
		$id_masyarakat 	= $dataUser['id'];

		// check old password
		$old_password = $this->input->post('old_password', true);

		if (md5($old_password) === $dataUser['password']) 
		{
			$new_password = md5($this->input->post('new_password', true));

			$data = [
				'password' => $new_password
			];

			$this->db->update('user', $data, ['id' => $id_masyarakat]);

			$isi_log = "Password berhasil diubah";
			$this->session->set_flashdata('message-success', $isi_log);
			redirect('pelapor/profile');
		}
		else
		{
			$isi_log = "Password gagal diubah, password lama tidak sesuai";
			$this->session->set_flashdata('message-failed', $isi_log);
			redirect('pelapor/changePassword');
		}
	}

	public function editProfile()
	{
		$dataUser 	= $this->getDataUser();
		$id_masyarakat 	= $dataUser['id'];

		$data = [
			'nama' => ucwords(strtolower($this->input->post('nama', true))),
			'no_telepon' => $this->input->post('no_telepon'),
			'alamat' => $this->input->post('alamat')
		];

		$this->db->update('user', $data, ['id' => $id_masyarakat]);

		$isi_log = "Profil berhasil diubah";
		$this->session->set_flashdata('message-success', $isi_log);
		redirect('pelapor/profile');
	}
}