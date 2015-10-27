<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/'); //if user is authenticated
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role']		= $this->tank_auth->get_role();
				
			
			if($data['role'] == 7 || $data['role'] == 8 ||$data['role'] == 9 ||$data['role'] == 10) /* Social worker */
			{

				redirect('/auth/socialW_dashboard');


			}
			elseif($data['role'] == 2) /* Nurse */
			{

				redirect('/auth/nurse_dashboard');

			}
			elseif($data['role'] == '3') /* psychiatrist */
			{

				redirect('/auth/psychia_dashboard');

			}
			elseif($data['role'] == '4') /* psychologist */
			{

				redirect('/auth/psycho_dashboard');

			}
			elseif($data['role'] == '5') /* house parent */
			{

				redirect('/auth/houseP_dashboard');

			}
			elseif($data['role'] == '6') /* Physical Therapist */
			{

				redirect('/auth/physicalT_dashboard');

			}
			else /* Admin */
			{
				redirect('/auth/admin_dashboard');


			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */