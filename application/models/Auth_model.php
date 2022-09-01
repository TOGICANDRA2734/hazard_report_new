<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'admo');
	}

	public function loginAdmin()
	{
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		$dataUser = $this->admo->getDataUserAdminByUsername($username);
		// check username
		if ($dataUser) 
		{
			// check password
			if (md5($password) === $dataUser['password']) 
			{
				if($dataUser['role_id'] == 1 || $dataUser['role_id'] == 2 ){
					$dataSession = [
						'id_user' => $dataUser['id_user']
					];
					
					var_dump('MASUK');

					$this->session->set_userdata($dataSession);
					redirect('admin');
				} else {
					$this->session->set_flashdata('message-failed', 'Gagal masuk, anda bukan admin');
					redirect('landing/masuk');
				}
		
			}
			else
			{
				$this->session->set_flashdata('message-failed', 'Gagal masuk, password yang anda masukkan salah');
				redirect('auth');
			}
		}
		else
		{
			$this->session->set_flashdata('message-failed', 'Gagal masuk, username yang anda masukkan salah');
			redirect('auth');
		}
	}
}