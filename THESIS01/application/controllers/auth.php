<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url', 'download'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
	
		$this->lang->load('tank_auth');
	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
			$this->load->view('auth/general_message', array('message' => $message));
		} else {
			redirect('/auth/login/');
		}
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');


			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {								// success
					redirect('');

				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {													// fail
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
				}
			}

			$this->load->view('header_footer/login_header');
			$this->load->view('auth/login_form', $data);
			$this->load->view('header_footer/login_footer');
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->tank_auth->logout();

		$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */



	function register()
	{	
		$role = $this->tank_auth->get_role();
		if ($role != '0') {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
			$this->_show_message($this->lang->line('auth_message_registration_disabled'));

		} else {
			$use_username = $this->config->item('use_username', 'tank_auth');
			if ($use_username) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
			}
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
			$this->form_validation->set_rules('first_name', 'first_name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('last_name', 'last_name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('role', 'role', 'trim|required|xss_clean');
		


		

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->create_user(
						$use_username ? $this->form_validation->set_value('username') : '',
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('first_name'),
						$this->form_validation->set_value('last_name'),
						$this->form_validation->set_value('role')
						))) {									// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');
					redirect('auth/login');
					
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			
		}
			
			$data['use_username'] = $use_username;
			$this->get_notifications();
			$this->load->view('auth/register_form', $data);
			$this->load->view('header_footer/admin_footer');
	}


	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/send_again_form', $data);
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
						$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					$this->_show_message($this->lang->line('auth_message_new_password_sent'));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/forgot_password_form', $data);
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		}
		$this->load->view('auth/reset_password_form', $data);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_password_form', $data);
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_email_form', $data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/unregister_form', $data);
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}
/* Start of THESIS Codes */





// SOCIAL WORKER	

	function socialW_dashboard()
	{
		$data['role']		= $this->tank_auth->get_role();
		$user_id = $data['user_id']	= $this->tank_auth->get_user_id();
		if (!$this->tank_auth->is_logged_in() ) 
		{									// logged in
			redirect('');
		} 
		else
		{

		$this->get_notifications();

		if ($data['role'] == 7){$Sector = 2;}
		elseif ($data['role'] == 8){$Sector = 3;}
		elseif ($data['role'] == 9){$Sector = 4;}
		elseif ($data['role'] == 10){$Sector = 1;}

		$data['Dorm_count'] = $this->users->dorm_counter($Sector);
		$data['Request_count'] = $this->users->request_counter($user_id);
		$data['Conference_count'] = $this->users->conference_counter($user_id);

		$data['Pending_client_count'] = $this->clients->get_sw_pending_clients($user_id);
		$data['Custody_client_count'] = $this->clients->get_all_clients_SW($user_id);
		$data['Discharge_client_count'] = $this->clients->get_pending_Discharge_clients_SW($user_id);

		$data['pending_count'] = $this->clients->get_pending_count_sw($user_id);
		$data['custody_count'] = $this->clients->get_cutody_count($user_id);
		$data['discharge_count'] = $this->clients->get_discharge_count($user_id);

		$data['i'] = 0;

		foreach($data['Pending_client_count'] as $entity)
		{
			$data['lol'][$data['i']]= $this->get_next_document($entity->client_id, $entity->admission_type);
			$data['i'] = $data['i'] + 1;
		}
		$data['i']--;

		$data['Messages'] = $this->messages->get_messages($user_id);
		$data['Tasks'] = $this->clients->get_requests($data['role']);
		$this->load->view('Social_Worker/socialW_dashboard', $data);
		$this->load->view('header_footer/socialW_footer');
		}
	}

	function get_next_document($client_id, $admission_type)
	{


		if($this->clients->client_has_no_intake($client_id))
		{
			$data['lol'] = $client_id;

		}
		//elseif($this->users->client_has_minutes($client_id))
		//{
		//	$data['lel'] = $client_id;
		//}
		//minutes = users -> client_has_minutes($client_id)
		//initial social case clients ->  client_has_initial_case($client_id)

		//return $data;
	}
	// Admission - new
	function step1_client_CJ()
	{
		$role = $this->tank_auth->get_role();	

		if($role == 7){$Sector = 1;}
		elseif($role == 8){$Sector = 3;}
		elseif($role == 9){$Sector = 4;}
		elseif($role == 10){$Sector = 2;}	
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/create_client', $data);
			$this->load->view('header_footer/socialW_footer');
		}
		else
		{

			
			$data['Dorms'] = $this->clients->get_dorms($Sector);
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/create_client', $data);
			$this->load->view('header_footer/socialw_footer');
		}
	}

	function admission_type()
	{
		$role = $this->tank_auth->get_role();	

		if($role == 7){$Sector = 1;}
		elseif($role == 8){$Sector = 3;}
		elseif($role == 9){$Sector = 4;}
		elseif($role == 10){$Sector = 2;}	
		if($this->form_validation->run())
		{	
			$rand_client_id = (rand(50,495)*2014) + (rand(0,1100)*11);
			$data['client_id'] = $rand_client_id;
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/admission_type', $data);
			$this->load->view('header_footer/socialW_footer');
		}
		else
		{

			
			$rand_client_id = (rand(50,495)*2014) + (rand(0,1100)*11);
			$data['client_id'] = $rand_client_id;
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/admission_type', $data);
			$this->load->view('header_footer/socialw_footer');
		}
	}

	function guardian_info()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{							
		
				$data['client_id'] = 	$this->form_validation->set_value('client_id');
				$data['admission_type'] = 	$this->form_validation->set_value('admission_type');
			
				$this->get_notifications();
				$this->load->view('Social_Worker/Admission/guardian_info', $data);
				$this->load->view('header_footer/socialW_footer');
			}
			else
			{

				$this->get_notifications();
				$this->load->view('Social_Worker/Admission/admission_type', $data);
				$this->load->view('header_footer/socialw_footer');
			}
		}
	}

	function client_info_ref()
	{	$data['client_id'] = $this->input->post('client_id');
		$data["admission_type"] = $this->input->post('admission_type');

		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else 
		{
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');

			$this->form_validation->set_rules('agenName', 'Agent Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenAdd', 'Agent Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenContact', 'Agency Contact', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenSW', 'Agency Social Worker', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenSWContact', 'Agency Social Wworker Contact', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenReason', 'Agency Reason', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenServices', 'Agency Services', 'trim|xss_clean');
		
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_agen(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('agenName'),
						$this->form_validation->set_value('agenAdd'),
						$this->form_validation->set_value('agenContact'),
						$this->form_validation->set_value('agenSW'),
						$this->form_validation->set_value('agenSWContact'),
						$this->form_validation->set_value('agenReason'),
						$this->form_validation->set_value('agenServices'))))
					{								
						$data['client_id'] = $this->form_validation->set_value('client_id');
						$data['admission_type'] = 	$this->form_validation->set_value('admission_type');
						$role = $this->tank_auth->get_role();	

						if ($role == 7){$Sector = 2;}
						elseif ($role == 8){$Sector = 3;}
						elseif ($role == 9){$Sector = 4;}
						elseif ($role == 10){$Sector = 1;}
						$this->get_notifications();

						$data['Dorms'] = $this->clients->get_dorms($Sector);
						$this->load->view('Social_Worker/Admission/client_info', $data);
						$this->load->view('header_footer/socialW_footer');

					} 
				else 
					{
						$errors = $this->tank_auth->get_error_message();
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);

					}
			} 
			else 
			{

				$this->get_notifications();
				$this->load->view('Social_Worker/Admission/guardian_info', $data);
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function client_info_sur()
	{
		$data['client_id'] = $this->input->post('client_id');
		$data["admission_type"] = $this->input->post('admission_type');
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else 
		{
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');

			$this->form_validation->set_rules('surrenderer_name', 'surrenderer_name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('surrenderer_rel', 'surrenderer_rel', 'trim|required|xss_clean');
			$this->form_validation->set_rules('surrenderer_age', 'surrenderer_age', 'trim|required|xss_clean');
			$this->form_validation->set_rules('surrenderer_add', 'surrenderer_add', 'trim|required|xss_clean');
			$this->form_validation->set_rules('surrenderer_gender', 'surrenderer_gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('surrenderer_contact', 'surrenderer_contact', 'trim|required|xss_clean');
			$this->form_validation->set_rules('surrenderer_reason', 'surrenderer_reason', 'trim|required|xss_clean');


			$data['errors'] = array();
			echo $this->form_validation->set_value('client_id');
			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_sur(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('surrenderer_name'),
						$this->form_validation->set_value('surrenderer_rel'),
						$this->form_validation->set_value('surrenderer_age'),
						$this->form_validation->set_value('surrenderer_add'),
						$this->form_validation->set_value('surrenderer_gender'),
						$this->form_validation->set_value('surrenderer_contact'),
						$this->form_validation->set_value('surrenderer_reason'))))
					{								
						$data['client_id'] = $this->form_validation->set_value('client_id');
						$data['admission_type'] = 	$this->form_validation->set_value('admission_type');

						$role = $this->tank_auth->get_role();	

						if ($role == 7){$Sector = 2;}
						elseif ($role == 8){$Sector = 3;}
						elseif ($role == 9){$Sector = 4;}
						elseif ($role == 10){$Sector = 1;}
						$this->get_notifications();
						$data['Dorms'] = $this->clients->get_dorms($Sector);
						$this->load->view('Social_Worker/Admission/client_info', $data);
						$this->load->view('header_footer/socialW_footer');


					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);

				}
			} 
			else 
			{
				$this->get_notifications();
				$this->load->view('Social_Worker/Admission/guardian_info', $data);
				$this->load->view('header_footer/socialW_footer');

			}
		}
	}

	function client_info_walk()
	{
		$data['client_id'] = $this->input->post('client_id');
		$data["admission_type"] = $this->input->post('admission_type');

		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');

			$this->form_validation->set_rules('founder_name', 'founder_name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('found_when', 'found_when', 'trim|required|xss_clean');
			$this->form_validation->set_rules('found_where', 'found where', 'trim|required|xss_clean');
			$this->form_validation->set_rules('found_address', 'found_address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('found_contact', 'found_contact', 'trim|required|xss_clean');
			$this->form_validation->set_rules('found_age', 'found_age', 'trim|required|xss_clean');
			$this->form_validation->set_rules('found_gender', 'found_gender', 'trim|required|xss_clean');

			$client_id = $this->input->post('client_id');
			$admission_type = $this->input->post('admission_type');
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				
					
					if (!is_null($data = $this->tank_auth->create_walk(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('founder_name'),
						$this->form_validation->set_value('found_when'),
						$this->form_validation->set_value('found_where'),
						$this->form_validation->set_value('found_address'),
						$this->form_validation->set_value('found_contact'),
						$this->form_validation->set_value('found_age'),
						$this->form_validation->set_value('found_gender'))))
					{								
						$data['client_id'] = $this->form_validation->set_value('client_id');
						$data['admission_type'] = 	$this->form_validation->set_value('admission_type');

						$role = $this->tank_auth->get_role();	

						if ($role == 7){$Sector = 2;}
						elseif ($role == 8){$Sector = 3;}
						elseif ($role == 9){$Sector = 4;}
						elseif ($role == 10){$Sector = 1;}
						$this->get_notifications();
						$data['Dorms'] = $this->clients->get_dorms($Sector);
						$this->load->view('Social_Worker/Admission/client_info', $data);
						$this->load->view('header_footer/socialW_footer');

					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} else {
				$this->get_notifications();
				$this->load->view('Social_Worker/Admission/guardian_info', $data);
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function client_info_special()
	{
		$data['client_id'] = $this->input->post('client_id');
		
		
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');
		
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{	
				$role = $data['role'] = $this->tank_auth->get_role();							// validation ok				
				$data['client_id'] = $this->form_validation->set_value('client_id');
				$data['admission_type'] = 	$this->form_validation->set_value('admission_type');
				

						if ($role == 7){$Sector = 2;}
						elseif ($role == 8){$Sector = 3;}
						elseif ($role == 9){$Sector = 4;}
						elseif ($role == 10){$Sector = 1;}
				$this->get_notifications();
				$data['Dorms'] = $this->clients->get_dorms($Sector);
				$this->load->view('Social_Worker/Admission/client_info', $data);
				$this->load->view('header_footer/socialW_footer');

			} else {
				$this->get_notifications();
				$this->load->view('Social_Worker/Admission/client_info', $data);
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}
	
	function background_info()
	{		$data['client_id'] = $this->input->post('client_id');
		$data["admission_type"] = $this->input->post('admission_type');

		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');

			$this->form_validation->set_rules('Fname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Lname', 'Last Name', 'trim|xss_clean');
			$this->form_validation->set_rules('Mname', 'Mname', 'trim|xss_clean');
			$this->form_validation->set_rules('Dorm', 'Dormitory', 'trim|required|xss_clean');
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			$this->form_validation->set_rules('Gender', 'Gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Birthday', 'Birthday', 'trim|xss_clean');
			$this->form_validation->set_rules('Birthplace', 'Birthplace', 'trim|xss_clean');
			$this->form_validation->set_rules('nickname', 'nickname', 'trim|xss_clean');
			$this->form_validation->set_rules('civilStat', 'Civil Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('religion', 'religion', 'trim|required|xss_clean');
			$this->form_validation->set_rules('baptized', 'baptized', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nationality', 'nationality', 'trim|xss_clean');
			$this->form_validation->set_rules('schoolAttended', 'School Attended', 'trim|xss_clean');
			$this->form_validation->set_rules('educAttain', 'Educational Attainment', 'trim|required|xss_clean');
			$this->form_validation->set_rules('emergencyAdd', 'emergencyAdd', 'trim|xss_clean');
			$this->form_validation->set_rules('emergencyPerson', 'emergencyPerson', 'trim|xss_clean');
			$this->form_validation->set_rules('emergencyContact', 'emergencyContact', 'trim|xss_clean');
			$this->form_validation->set_rules('presentedID', 'presentedID', 'trim|xss_clean');
			$this->form_validation->set_rules('healthStat', 'healthStat', 'trim|xss_clean');

			

			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				
				$data['role'] = $this->tank_auth->get_role();	

				if($data['role'] == 7){$Sector = 2;}
				elseif($data['role'] == 8){$Sector = 3;}
				elseif($data['role']== 9){$Sector = 4;}
				elseif($data['role'] == 10){$Sector = 1;}
						
				if (!is_null($data = $this->tank_auth->create_client_info(
					$this->form_validation->set_value('client_id'),
					$this->form_validation->set_value('admission_type'),
					$this->form_validation->set_value('Fname'),
					$this->form_validation->set_value('Lname'),
					$this->form_validation->set_value('Mname'),
					$this->form_validation->set_value('Dorm'),
					$SocialW,
					$this->form_validation->set_value('Gender'),
					$this->form_validation->set_value('Birthday'),
					$this->form_validation->set_value('Birthplace'),
					$this->form_validation->set_value('nickname'),
					$this->form_validation->set_value('civilStat'),
					$this->form_validation->set_value('religion'),
					$this->form_validation->set_value('baptized'),
					$this->form_validation->set_value('nationality'),
					$this->form_validation->set_value('schoolAttended'),
					$this->form_validation->set_value('educAttain'),
					$this->form_validation->set_value('emergencyAdd'),
					$this->form_validation->set_value('emergencyPerson'),
					$this->form_validation->set_value('emergencyContact'),
					$this->form_validation->set_value('presentedID'),
					$this->form_validation->set_value('healthStat'),
					$Sector)))
					{								
						$data['client_id'] = $this->form_validation->set_value('client_id');
						$data['admission_type'] = 	$this->form_validation->set_value('admission_type');
						
						$this->get_notifications();
						$this->load->view('Social_Worker/Admission/bg_info', $data);
						$this->load->view('header_footer/socialW_footer');

					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} 
			else 
			{
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/client_info', $data);
			$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function submit_intake()
	{

		$i = 0;
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('problem', 'problem', 'trim|xss_clean');
		$this->form_validation->set_rules('description', 'description', 'trim|xss_clean');
		$this->form_validation->set_rules('prob_when', 'prob_when', 'trim|xss_clean');
		$this->form_validation->set_rules('prob_circumstances', 'prob_circumstances', 'trim|xss_clean');
		$this->form_validation->set_rules('prob_duration', 'prob_duration', 'trim|xss_clean');
		$this->form_validation->set_rules('prob_self_diagnosis', 'prob_self_diagnosis', 'trim|xss_clean');
		$this->form_validation->set_rules('healthHis', 'healthHis', 'trim|xss_clean');
		$this->form_validation->set_rules('immediateProb', 'immediateProb', 'trim|xss_clean');
		$this->form_validation->set_rules('underlyingNeeds', 'underlyingNeeds', 'trim|xss_clean');
		$this->form_validation->set_rules('motivation', 'motivation', 'trim|ss_clean');
		$this->form_validation->set_rules('resource', 'resource', 'trim|xss_clean');

		
		$FamName = $this->input->post('FamName');
		$FamRel = $this->input->post('FamRel');
		$FamAge = $this->input->post('FamAge');
		$FamCS = $this->input->post('FamCS');
		$FamEduc = $this->input->post('FamEduc');
		$FamOccu = $this->input->post('FamOccu');
		$FamAdd = $this->input->post('FamAdd');
		
		$data['errors'] = array();

		if ($this->form_validation->run()) 
		{								// validation ok
			if (!is_null($data = $this->tank_auth->create_bg_info(
					$this->form_validation->set_value('client_id'),
					$this->form_validation->set_value('problem'),
					$this->form_validation->set_value('description'),
					$this->form_validation->set_value('prob_when'),
					$this->form_validation->set_value('prob_circumstances'),
					$this->form_validation->set_value('prob_duration'),
					$this->form_validation->set_value('prob_self_diagnosis'),
					$this->form_validation->set_value('healthHis'),
					$this->form_validation->set_value('immediateProb'),
					$this->form_validation->set_value('underlyingNeeds'),
					$this->form_validation->set_value('motivation'),
					$this->form_validation->set_value('resource')))) 
				{	

					$this->tank_auth->insert_file_db('General Intake', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '1');
					if($FamCS != null)
						{
						foreach($FamCS as $FamMember)
							{	
	
								$FamCS[$i];
								echo $FamName[$i];
								$this->tank_auth->insert_fam_mem($this->form_validation->set_value('client_id'), $FamName[$i], $FamRel[$i], $FamAge[$i], $FamCS[$i], $FamEduc[$i], $FamOccu[$i], $FamAdd[$i]);
								$i = $i + 1;
								
							}	
						}
					$client_id = $this->form_validation->set_value('client_id');
					$this->view_intake_admit($client_id);
				} 
			else 
			{
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}
		}
	}

	function view_intake_admit()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');

		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['family'] = $this->clients->get_family($client_id);
			foreach($data['client_info'] as $info)
				{
					$admission_type = $info->admission_type;
					$client_id = $info->client_id;
				}
				if($admission_type=="2")//surrender
				{
					$data['surrender_details'] = $this->clients->get_sur_det($client_id);
					$this->load->view('Forms/Output/intake_surrender', $data);
				}
				elseif($admission_type == "3")//walk-in
				{
					$data['founder_details'] = $this->clients->get_found_det($client_id);
					$this->load->view('Forms/Output/intake_walk', $data);
				}
				elseif($admission_type == "1") //referral
				{
					$data['agency_details'] = $this->clients->get_agen_det($client_id);
					//print_r($data['agency_details']);
					$this->load->view('Forms/Output/intake_refer', $data);
				}
				elseif($admission_type == "4")
				{
					$data['agency_details'] = $this->clients->get_client_by_id($client_id);
					$this->load->view('Forms/Output/intake_self', $data);
				}
				$this->load->view('header_footer/socialW_footer');
			
 		}
		else
		{
			echo 'lol';
		}
	}

	function view_gen_intake()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');

		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['family'] = $this->clients->get_family($client_id);
			$admission_type = $this->clients->get_client_details($client_id)->admission_type;
			$client_sector = $this->clients->get_client_details($client_id)->client_sector;
				if($admission_type=="2")//surrender
				{
				$data['surrender_details'] = $this->clients->get_sur_det($client_id);

				$this->load->view('Forms/Output/gen_surrender', $data);
				$this->load->view('header_footer/socialW_footer');
				}
				elseif($admission_type == "3")//walk-in
				{
				$data['founder_details'] = $this->clients->get_found_det($client_id);

				$this->load->view('Forms/Output/gen_walk', $data);
				$this->load->view('header_footer/socialW_footer');
				}
				elseif($admission_type == "1") //referral
				{
				$data['agency_details'] = $this->clients->get_agen_det($client_id);
				
				$this->load->view('Forms/Output/gen_agency', $data);
				$this->load->view('header_footer/socialW_footer');
				}
				elseif($admission_type == "4") //referral
				{
				$data['agency_details'] = $this->clients->get_client_by_id($client_id);
				
				$this->load->view('Forms/Output/gen_self', $data);
				$this->load->view('header_footer/socialW_footer');
				}
			
 		}
		else
		{
			echo 'lol';
		}
	}


// End Admission - new

function unknown_function()
{
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
	echo 'testetetetekaljlqwjqwjeqlwekq';
}

 //Admission - old

	function step1_client()
	{
		$role = $this->tank_auth->get_role();	

		if($role == 7){$Sector = 1;}
		elseif($role == 8){$Sector = 3;}
		elseif($role == 9){$Sector = 4;}
		elseif($role == 10){$Sector = 2;}	
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/create_client', $data);
			$this->load->view('header_footer/socialW_footer');
		}
		else
		{

			
			$data['Dorms'] = $this->clients->get_dorms($Sector);
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/create_client', $data);
			$this->load->view('header_footer/socialw_footer');
		}
	}

	function create_client()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else 
		{

			$data['role'] = $this->tank_auth->get_role();	

			if($data['role'] == 7){$Sector = 2;}
			elseif($data['role'] == 8){$Sector = 3;}
			elseif($data['role']== 9){$Sector = 4;}
			elseif($data['role'] == 10){$Sector = 1;}

			$this->get_notifications();
			$this->form_validation->set_rules('Fname', 'Fname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Lname', 'Lname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Mname', 'Mname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Dorm', 'Dorm', 'trim|required|xss_clean');
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			$this->form_validation->set_rules('Gender', 'Gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Birthday', 'Birthday', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Birthplace', 'Birthplace', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');
				
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				$data['Fname'] = $this->form_validation->set_value('Fname');
				$data['Lname'] = 	$this->form_validation->set_value('Lname');
				$data['Mname'] = 	$this->form_validation->set_value('Mname');
				$data['Sector'] = $Sector;
				$data['Dorm'] = 	$this->form_validation->set_value('Dorm');
				$data['sw_id'] = 	$SocialW;
				$data['Gender'] = 	$this->form_validation->set_value('Gender');
				$data['Birthday'] = 	$this->form_validation->set_value('Birthday');
				$data['Birthplace'] = 	$this->form_validation->set_value('Birthplace');
				$data['admission_type'] = 	$this->form_validation->set_value('admission_type');
											
					$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
					$data['locations'] = $this->files->get_locations($this->tank_auth->get_role());
					$data['document_type'] = $this->files->get_document_type();
					$this->load->view('Forms/intake', $data);
					$this->load->view('header_footer/socialW_footer');
			} 
			else 
			{
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}
		}
	}
	
	function General_intake()
	{

		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		}
		else {
			$this->get_notifications();
			$this->form_validation->set_rules('Fname', 'Fname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Lname', 'Lname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Mname', 'Mname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Sector', 'Sector', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Dorm', 'Dorm', 'trim|required|xss_clean');
			$sw_id = $data['user_id'] = $this->tank_auth->get_user_id();
			$this->form_validation->set_rules('Gender', 'Gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Birthday', 'Birthday', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Birthplace', 'Birthplace', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nickname', 'nickname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('civilStat', 'civilStat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('religion', 'religion', 'trim|required|xss_clean');
			$this->form_validation->set_rules('baptized', 'baptized', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nationality', 'nationality', 'trim|required|xss_clean');
			$this->form_validation->set_rules('presentAdd', 'presentAdd', 'trim|required|xss_clean');
			$this->form_validation->set_rules('contactNum', 'contactNum', 'trim|required|xss_clean');
			$this->form_validation->set_rules('permanentAdd', 'permanentAdd', 'trim|xss_clean');
			$this->form_validation->set_rules('educAttain', 'educAttain', 'trim|required|xss_clean');
			$this->form_validation->set_rules('emergencyAdd', 'emergencyAdd', 'trim|required|xss_clean');
			$this->form_validation->set_rules('emergencyPerson', 'emergencyPerson', 'trim|required|xss_clean');
			$this->form_validation->set_rules('emergencyContact', 'emergencyContact', 'trim|required|xss_clean');
			$this->form_validation->set_rules('referralSource', 'referralSource', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sourceAdd', 'sourceAdd', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sourceContact', 'sourceContact', 'trim|required|xss_clean');
			$this->form_validation->set_rules('presentedID', 'presentedID', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Sector', 'Sector', 'trim|required|xss_clean');
			$this->form_validation->set_rules('FamName1', 'FamName1', 'trim|xss_clean');
			$this->form_validation->set_rules('FamRel1', 'FamRel1', 'trim|xss_clean');
			$this->form_validation->set_rules('FamAge1', 'FamAge1', 'trim|xss_clean');
			$this->form_validation->set_rules('FamCS1', 'FamCS1', 'trim|xss_clean');
			$this->form_validation->set_rules('FamEduc1', 'FamEduc1', 'trim|xss_clean');
			$this->form_validation->set_rules('FamOccu1', 'FamOccu1', 'trim|xss_clean');
			$this->form_validation->set_rules('FamAdd1', 'FamAdd1', 'trim|xss_clean');

			
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok

				if(is_null($this->form_validation->set_value('permanentAdd')))
					{ 
						$perma_add = $this->form_validation->set_value('presentAdd');
					}
					else
					{
						$perma_add = $this->form_validation->set_value('permanentAdd');
					}

				if (!is_null($data = $this->tank_auth->create_intake(
						$this->form_validation->set_value('Fname'),
						$this->form_validation->set_value('Lname'),
						$this->form_validation->set_value('Mname'),
						$this->form_validation->set_value('Sector'),
						$this->form_validation->set_value('Dorm'),
						$sw_id,
						$this->form_validation->set_value('Gender'),
						$this->form_validation->set_value('Birthday'),
						$this->form_validation->set_value('Birthplace'),
						$this->form_validation->set_value('admission_type'),
						$this->form_validation->set_value('nickname'),
						$this->form_validation->set_value('civilStat'),
						$this->form_validation->set_value('religion'),
						$this->form_validation->set_value('baptized'),
						$this->form_validation->set_value('nationality'),
						$this->form_validation->set_value('presentAdd'),
						$this->form_validation->set_value('contactNum'),
						$perma_add,
						$this->form_validation->set_value('educAttain'),
						$this->form_validation->set_value('emergencyPerson'),
						$this->form_validation->set_value('emergencyAdd'),
						$this->form_validation->set_value('emergencyContact'),
						$this->form_validation->set_value('referralSource'),
						$this->form_validation->set_value('sourceAdd'),
						$this->form_validation->set_value('sourceContact'),
						$this->form_validation->set_value('presentedID'),
						$this->form_validation->set_value('FamName1'),
						$this->form_validation->set_value('FamRel1'),
						$this->form_validation->set_value('FamAge1'),
						$this->form_validation->set_value('FamCS1'),
						$this->form_validation->set_value('FamEduc1'),
						$this->form_validation->set_value('FamOccu1'),
						$this->form_validation->set_value('FamAdd1')))) 
					{								
						
						$data['admission_type'] = $this->form_validation->set_value('admission_type');
						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						$data['locations'] = $this->files->get_locations($this->tank_auth->get_role());
						
						$this->load->view("Forms/intake_bg",$data);
						$this->load->view('header_footer/socialW_footer');
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} else {
				$this->load->view('Forms/intake', $data);
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function Gen_Intake2()
	{

		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->form_validation->set_rules('intake_id', 'intake_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('problem', 'problem', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenName', 'agenName', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenReason', 'agenReason', 'trim|required|xss_clean');
			$this->form_validation->set_rules('agenServices', 'agenServices', 'trim|required|xss_clean');
			$this->form_validation->set_rules('prob_when', 'prob_when', 'trim|required|xss_clean');
			$this->form_validation->set_rules('prob_duration', 'prob_duration', 'trim|required|xss_clean');
			$this->form_validation->set_rules('prob_circumstances', 'prob_circumstances', 'trim|required|xss_clean');
			$this->form_validation->set_rules('prob_self_diagnosis', 'prob_self_diagnosis', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
			$this->form_validation->set_rules('healthHis', 'healthHis', 'trim|xss_clean');
			$this->form_validation->set_rules('famBG', 'famBG', 'trim|required|xss_clean');
			$this->form_validation->set_rules('immediateProb', 'immediateProb', 'trim|required|xss_clean');
			$this->form_validation->set_rules('underlyingNeeds', 'underlyingNeeds', 'trim|required|xss_clean');
			$this->form_validation->set_rules('motivation', 'motivation', 'trim|required|xss_clean');
			$this->form_validation->set_rules('resource', 'resource', 'trim|required|xss_clean');
			$this->form_validation->set_rules('admission_type', 'admission_type', 'trim|xss_clean');

			$this->form_validation->set_rules('surrenderer_name', 'surrenderer_name', 'trim|xss_clean');
			$this->form_validation->set_rules('surrenderer_rel', 'surrenderer_rel', 'trim|xss_clean');
			$this->form_validation->set_rules('surrenderer_age', 'surrenderer_age', 'trim|xss_clean');
			$this->form_validation->set_rules('surrenderer_add', 'surrenderer_add', 'trim|xss_clean');
			$this->form_validation->set_rules('surrenderer_gender', 'surrenderer_gender', 'trim|xss_clean');
			$this->form_validation->set_rules('surrenderer_contact', 'surrenderer_contact', 'trim|xss_clean');
			$this->form_validation->set_rules('surrenderer_reason', 'surrenderer_reason', 'trim|xss_clean');

			$this->form_validation->set_rules('founder_name', 'founder_name', 'trim|xss_clean');
			$this->form_validation->set_rules('found_when', 'found_when', 'trim|xss_clean');
			$this->form_validation->set_rules('found_where', 'found_where', 'trim|xss_clean');
			$this->form_validation->set_rules('found_address', 'found_address', 'trim|xss_clean');
			$this->form_validation->set_rules('found_contact', 'found_contact', 'trim|xss_clean');
			$this->form_validation->set_rules('found_age', 'found_age', 'trim|xss_clean');
			$this->form_validation->set_rules('found_gender', 'found_gender', 'trim|xss_clean');
			

			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				
				if (!is_null($data = $this->tank_auth->create_intake2(
						$this->form_validation->set_value('intake_id'),
						$this->form_validation->set_value('problem'),
						$this->form_validation->set_value('agenName'),
						$this->form_validation->set_value('agenReason'),
						$this->form_validation->set_value('agenServices'),
						$this->form_validation->set_value('prob_when'),
						$this->form_validation->set_value('prob_duration'),
						$this->form_validation->set_value('prob_circumstances'),
						$this->form_validation->set_value('prob_self_diagnosis'),
						$this->form_validation->set_value('description'),
						$this->form_validation->set_value('healthHis'),
						$this->form_validation->set_value('famBG'),
						$this->form_validation->set_value('immediateProb'),
						$this->form_validation->set_value('underlyingNeeds'),
						$this->form_validation->set_value('motivation'),
						$this->form_validation->set_value('resource'),						

						$this->form_validation->set_value('surrenderer_name'),
						$this->form_validation->set_value('surrenderer_rel'),
						$this->form_validation->set_value('surrenderer_age'),
						$this->form_validation->set_value('surrenderer_gender'),
						$this->form_validation->set_value('surrenderer_add'),
						$this->form_validation->set_value('surrenderer_contact'),
						$this->form_validation->set_value('surrenderer_reason'),

						$this->form_validation->set_value('founder_name'),
						$this->form_validation->set_value('found_when'),
						$this->form_validation->set_value('found_where'),
						$this->form_validation->set_value('found_address'),
						$this->form_validation->set_value('found_contact'),
						$this->form_validation->set_value('found_age'),
						$this->form_validation->set_value('found_gender'))))
					{						
						$data['client_info'] = $this->clients->get_client_by_id($this->form_validation->set_value('intake_id'));

						$data['locations'] = $this->files->get_locations($this->tank_auth->get_role());
						$data['document_type'] = $this->files->get_document_type();
						$this->intake_file($data['intake_id']);
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} else {
				$this->get_notifications();
				$this->load->view('Forms/intake_bg', $data);
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function continue_intake($client_id)
	{

			$client = $this->clients->get_user_by_id_no_intake_bg($client_id);
			foreach($client as $client_info)
			{
				$data['client_id'] = $client_info->client_id;
				$data['admission_type'] = $client_info->admission_type;

			}
			$data['intake_id'] = $client_id;

			$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
			$data['locations'] = $this->files->get_locations($this->tank_auth->get_role());
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/bg_info', $data);
			$this->load->view('header_footer/socialW_footer');
	}	

	function view_intake()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('Forms/General_Intake_Form', $data);
			$this->load->view('header_footer/socialW_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function intake_file($intake_id)
	{
		$this->form_validation->set_rules('intake_id', 'intake_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('intake_id');
			//$data['client_family'] = $this->clients->get_family($client_id);
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('Forms/General_Intake_Form', $data);
			$this->load->view('header_footer/socialW_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function intial_case()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$client_id = $this->form_validation->set_value('client_id');
			if(!$this->clients->client_has_initial_case($client_id))
			{
				$this->mpdf_initial_social($client_id);
				echo "<script>javascript:alert('Initial Case Study Report has been made');</script>";
			}
			else
			{
				$this->get_notifications();
				
				$data['client_info'] = $this->clients->get_client_by_id($client_id);

				foreach($data['client_info'] as $info)
				{
					$admission_type = $info->admission_type;
				}
				$data['client_medical'] = "";
				if($admission_type=="2")
				{
				$data['surrender_details'] ="" ;
				}
				elseif($admission_type == "3")
				{
				$data['founder_details']  ="";
				}
				$this->load->view('Forms/initial_case_study', $data);
				$this->load->view('header_footer/socialW_footer');
			}
 		}
		else
		{
			echo 'lol';
		}
	}

	function intial_case_submit()
	{
		$client_id = $this->input->post('client_id');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		$this->form_validation->set_rules('exceptionality', 'exceptionality', 'trim|required|xss_clean');
		$this->form_validation->set_rules('presentEnvi', 'presentEnvi', 'trim|xss_clean');
		$this->form_validation->set_rules('currentFam', 'currentFam', 'trim|xss_clean');
		$this->form_validation->set_rules('referalAdmission', 'referalAdmission', 'trim|xss_clean');
		$this->form_validation->set_rules('abandonFact', 'abandonFact', 'trim|xss_clean');
		$this->form_validation->set_rules('evalReco', 'evalReco', 'trim|xss_clean');

		if($this->form_validation->run())
		{	
			
			if (!is_null($data = $this->tank_auth->create_intial_case($client_id = $this->form_validation->set_value('client_id'),
				$this->form_validation->set_value('exceptionality'),
				$this->form_validation->set_value('presentEnvi'),
				$this->form_validation->set_value('currentFam'),
				$this->form_validation->set_value('referalAdmission'),
				$this->form_validation->set_value('abandonFact'),
				$this->form_validation->set_value('evalReco'))))
				{
					$this->tank_auth->insert_file_db('Initial Case Study', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '20');
					
					echo "<script>alert('initial case report accomplished'); </script>";
					$this->mpdf_initial_social($client_id);
				}
 		}
		else
		{
			$this->get_notifications();
				
				$data['client_info'] = $this->clients->get_client_by_id($client_id);

			$this->load->view('Forms/initial_case_study', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}


	function upload_initial_documents()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');

		if($this->form_validation->run())
		{
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($data['client_id']);
			$data['locations'] = $this->files->get_locations($this->tank_auth->get_role());
			$data['document_type'] = $this->files->get_document_type();
			$this->get_notifications();
			$this->load->view('Social_Worker/socialW_upload', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function conference_history()
	{
		$client_id = $this->input->post('client_id');
		$data['client_info'] = $this->clients->get_client_by_id($client_id);
		$data['conference_history'] = $this->clients->get_conference_history($client_id);

		$this->get_notifications();
		$this->load->view('conference_history', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	/* not in use
	function conference_details()
	{
		$this->form_validation->set_rules('client_id');
		$this->form_validation->set_rules('conference_id');

		if($this->form_validation->run())
		{
			echo $client_id = $this->form_validation->set_value('client_id');
			echo $conference_id = $this->form_validation->set_value('conference_id');

			if(!$this->)
		}
	} */

	function pre_admission_CC()
	{
		$this->form_validation->set_rules('client_id', 'xss_clean');
		$this->form_validation->set_rules('conference_type', 'xss_clean');
		//$client_id = $this->input->post('client_id');
		//$conference_type = $this->input->post('conference_type');
		$role= $this->tank_auth->get_role();
		$user_id = $this->tank_auth->get_user_id();
		if($this->form_validation->run())
		{
			$client_id = $this->form_validation->set_value('client_id');
			$conference_type = $this->form_validation->set_value('conference_type');	

			if($conference_type == 1)
			{
				$data['conference_details'] = $this->users->get_my_conference_details_clients($client_id, $conference_type);
				if($data['conference_details'] != null)
				{
					$conference_id = $data['conference_details'][0]->conference_id;
					$data['conference_attendees'] = $this->users->conference_final_attendees($conference_id);
					$data['clients'] = $this->users->conference_custody_clients($conference_id);
				}
				

			}
			elseif($conference_type == 2)
			{
				$data['conference_details'] = $this->users->get_my_conference_details_clients($client_id, $conference_type);
				if($data['conference_details'] != null)
				{
					$conference_id = $data['conference_details'][0]->conference_id;
					$data['conference_attendees'] = $this->users->conference_final_attendees($conference_id);
					$data['clients'] = $this->users->conference_pending_clients($conference_id, $user_id);
				}
			}
			if($data['conference_details'] == null)
			{
				$this->get_conferences();
				echo "<script>javascript:alert('Client is not assigned to a conference');</script>";
			}
			else
			{

				$data['role'] = $this->tank_auth->get_role();
				$this->get_notifications();
				$this->load->view('General/Conference_details', $data);
				$this->load->view('header_footer/socialW_footer');	
			}


			/* $this->get_notifications();
			$data['client_id'] = $this->form_validation->set_value('client_id');
			if(!$this->users->client_has_minutes($data['client_id']))
			{
				$this->conference_minutes_page($this->form_validation->set_value('client_id'));
			}
			elseif(!$this->users->client_has_pre_admission_schedule($data['client_id']))
			{$client_id = $this->form_validation->set_value('client_id');

			
			if(!$this->users->I_made_this($user_id, $client_id))
			{
				$data['i_am_not_creator'] = '1';
			}
			else
			{
				$data['i_am_not_creator'] = '2';
			}	
				echo "<script>javascript:alert('Client already has a schedule');</script>";
				$this->pre_admission_page($data['client_id']);

			}
			else
			{
				if($role == "7" || $role == "8" || $role == "9" || $role == "10")
				{	$data['client_info'] = $this->clients->get_client_by_id($this->form_validation->set_value('client_id'));
					$data['employees'] = $this->users->get_all_employees($this->tank_auth->get_user_id());
					$this->load->view('Social_Worker/Admission/socialW_Preadmission', $data);
					$this->load->view('header_footer/socialW_footer');
				}
				else
				{
					echo "<script>javascript:alert('Client does not have a schedule yet');</script>";	
					$data['pre_admission_page_details'] = $this->clients->get_client_by_id($data['client_id']);
					$this->load->view('Social_Worker/Admission/socialW_pending_client_page', $data);
					$this->load->view('header_footer/socialW_footer');
				} 
			}*/
		}
		else
		{
			echo 'lol';
		}	
	}

	function submit_pre_admission_request()
	{
		$this->form_validation->set_rules('counter', 'counter', 'trim|xss_clean');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		$this->form_validation->set_rules('Schedule', 'Schedule', 'trim|xss_clean');
		$this->form_validation->set_rules('start_time', 'start_time', 'trim|xss_clean');
		$this->form_validation->set_rules('end_time', 'end_time', 'trim|xss_clean');

		$attendee = $this->input->post('check');
		$counter = $this->input->post('counter');


		if($this->form_validation->run())
		{	
			$client_id = $this->form_validation->set_value('client_id');
			$Schedule = $this->form_validation->set_value('Schedule');
			$start_time = $this->form_validation->set_value('start_time');
			$end_time = $this->form_validation->set_value('end_time');
			$conference_type = "1";
			$user_id = $this->tank_auth->get_user_id();
			if (!is_null($data = $this->tank_auth->create_pre_admission_CC($client_id, $Schedule, $user_id, $start_time, $end_time,$conference_type )))
			{
				
				foreach($attendee as $check)
				{	
					$attendant = $check;
					$this->tank_auth->insert_pre_ad_attendee($data['id'], $attendant);
					
				}
				echo "<script>javascript:alert('Pre-Admission case conference request has been sent');</script>";
				$this->get_notifications();
				$this->pre_admission_page($client_id);
			}
		}
		else
		{
			echo 'lol';
		}	
	}

	function before_inter()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		$role= $this->tank_auth->get_role();
		
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$data['client_id'] = $this->form_validation->set_value('client_id');
			
				if($role == "7" || $role == "8" || $role == "9" || $role == "10")
				{	$data['client_info'] = $this->clients->get_client_by_id($this->form_validation->set_value('client_id'));
					$data['employees'] = $this->users->get_all_employees($this->tank_auth->get_user_id());
					$this->load->view('Conference', $data);
					$this->load->view('header_footer/socialW_footer');
				}
				else
				{
					echo "<script>javascript:alert('Client does not have a schedule yet');</script>";	
					$data['pre_admission_page_details'] = $this->clients->get_client_by_id($data['client_id']);
					$this->load->view('Social_Worker/Admission/socialW_pending_client_page', $data);
					$this->load->view('header_footer/socialW_footer');
				}
			
			}
		else
		{
			echo 'lol';
		}	
	}

	function get_conference_details_client()
	{
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
		$data['role'] = $this->tank_auth->get_role();
		$this->form_validation->set_rules('conference_id', 'conference_id', 'xss_clean|trim');
		$this->form_validation->set_rules('conference_type', 'conference_type', 'xss_clean|trim');

		if($this->form_validation->run())
		{

			$conference_id = $this->form_validation->set_value('conference_id');
			$conference_type = $this->form_validation->set_value('conference_type');

			
			$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
			$data['conference_attendees'] = $this->users->conference_final_attendees($conference_id);

			if($conference_type == 1)
			{
				$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
				$data['clients'] = $this->users->conference_custody_clients($conference_id);

			}
			elseif($conference_type == 2)
			{
				$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
				$data['clients'] = $this->users->conference_pending_clients($conference_id, $user_id);
			}

			$data['role'] = $this->tank_auth->get_role();
			$this->get_notifications();
			$this->load->view('General/Conference_details', $data);
			$this->load->view('header_footer/socialW_footer');
			
		
		}
	}

//End Admission - old

// Start lists
	function client_list()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');
		} 
		else
		{

			$user_id = $this->tank_auth->get_user_id();
			$data['client_list'] = $this->clients->get_all_clients_SW($user_id);
			$this->get_notifications();
			$this->load->view('Social_Worker/case/socialW_case', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function SW_pending_client_list()
	{
		$user_id= $this->tank_auth->get_user_id();
		
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok

				$data['client_info'] = $this->clients->get_client_by_id($this->form_validation->set_value('client_id'));
				
					
						$this->get_notifications();
						$data['locations'] = $this->files->get_locations($this->tank_auth->get_role());
						$data['document_type'] = $this->files->get_document_type();
						$this->load->view("Social_Worker/Admission/socialW_add_upload",$data);
						$this->load->view('header_footer/socialW_footer');
			}
			else{

		$this->get_notifications();
		$data['pending_clients'] = $this->clients->get_sw_pending_clients($user_id);
		$this->load->view('Social_Worker/socialW_pending_clients', $data);
		$this->load->view('header_footer/socialw_footer');
		}
	}

	function POA_list()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');

		if($this->form_validation->run())
		{

			$data['POA_list'] = $this->users->get_POA_list($this->form_validation->set_value('client_id'));
			$data['client_info'] = $this->clients->get_client_by_id($this->form_validation->set_value('client_id'));
			$this->get_notifications();
			$this->load->view('POA_list', $data);
			$this->load->view('header_footer/socialW_footer');

		}
	}

	function pending_client_page()
	{

		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$client_id = $this->form_validation->set_value('client_id');
				if($this->clients->client_has_no_intake($client_id))
				{
					
					$this->continue_intake($client_id);
					echo "<script>javascript:alert('Please finish the General Intake Form');</script>";
				}
				else
				{
					$data['role'] = $this->tank_auth->get_role();
					$data['pre_admission_page_details'] = $this->clients->get_client_by_id($client_id);
					$this->get_notifications();
					$this->load->view('Social_Worker/Admission/socialW_pending_client_page', $data);
					$this->load->view('header_footer/socialW_footer');
				}
		}
		else
		{
			echo 'lol';
		}	
	}

// Custody
	function socialW_case()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');
		} 
		else
		{

			$user_id = $this->tank_auth->get_user_id();
			$data['client_list'] = $this->clients->get_all_clients_SW($user_id);
			$this->get_notifications();
			$this->load->view('Social_Worker/Case/socialW_case', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}
	
	function socialW_client_profile()
	{
		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		else
		{

			$data['username']	= $this->tank_auth->get_username();

			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');


			if ($this->form_validation->run()) 
			{								// validation ok
			
				$client_id = $this->form_validation->set_value('client_id');


				$file['client_info'] = $this->clients->get_client_by_id($client_id);
				$this->load->helper('file');
				$file['path_MR'] = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports';
				$file['file_MR'] = get_filenames($file['path_MR']);

				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Social_Worker/Case/socialW_client_profile', $file);
				$this->load->view('header_footer/socialW_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Social_Worker/socialW_activity', $data_info);
				$this->load->view('header_footer/socialW_footer');
			}	
		}
	}

	function socialW_case_profile()
	{
		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		else
		{

			$data['username']	= $this->tank_auth->get_username();

			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');

			if ($this->form_validation->run()) 
			{								// validation ok
			
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');

				$file['client_info'] = $this->clients->get_client_by_id($client_id);
				$file['social_case'] = $this->clients->get_social_cases($client_id);
				$this->load->helper('file');
				$file['path_MR'] = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports';
				$file['file_MR'] = get_filenames($file['path_MR']);

				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$file['files'] 	= $this->files->get_files_client_SW($client_id, $sw_id);
				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Social_Worker/Case/socialW_case_profile', $file);
				$this->load->view('header_footer/socialW_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Social_Worker/socialW_activity', $data_info);
				$this->load->view('header_footer/socialW_footer');
			}	
		}
	}

	function View_Social_Reports()
	{
		$data_clients['client_list'] = $this->clients->get_all_clients();
		$this->get_notifications();
		$this->load->view('Social_Worker/socialW_case', $data_clients);
		$this->load->view('header_footer/socialW_footer');
	}

	function Request_test()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('report_type', 'request_type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('Reason', 'Reason', 'trim|required|xss_clean');
		if($this->form_validation->run())
		{
			$this->tank_auth->create_request(
					$this->form_validation->set_value('client_id'),
					$this->form_validation->set_value('sw_id'),
					$this->form_validation->set_value('report_type'),
					$this->form_validation->set_value('Reason'));		
			echo "<script>javascript:alert('Your request has been posted'); window.location = 'socialW_medical'</script>";
		}
	}

	function socialW_client_documents()
	{
		$this->form_validation->set_rules('client_id', 'xss_clean');

		if($this->form_validation->run())
		{
			$client_id = $this->form_validation->set_value('client_id');
			$data['document_list'] =  $this->files->get_uploaded_documents($client_id);
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->get_notifications();
			$this->load->view('Social_Worker/Case/uploaded_documents', $data);
			$this->load->view('header_footer/SocialW_footer');
		}
	}

// Discharge

	function SW_Discharge()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		else
		{
			$this->get_notifications();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			/* $this->form_validation->set_rules('fname', 'fname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lname', 'lname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('dorm_id', 'dorm_id', 'trim|required|xss_clean'); 
			*/
			if($this->form_validation->run())
			{

				$file['client_id'] = $this->form_validation->set_value('client_id');
				/* $file['fname'] = $this->form_validation->set_value('fname');
				$file['lname'] = $this->form_validation->set_value('lname');
				$file['dorm_id'] = $this->form_validation->set_value('dorm_id');
				$file['sw_id'] = $this->tank_auth->get_user_id();
				$this->load->helper('file');
				$file['path'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'General Documents' . DIRECTORY_SEPARATOR . 'Discharge' ;
				$file['file1'] = get_filenames($file['path']);
				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role()); */
				$file['client_info'] = $this->clients->get_client_by_id($file['client_id']);
				$counter = 0;

				/* foreach($file['file1'] as $row)
				{
					$counter++;
				}
				if($counter >= 2)
				{
					echo "<script> alert('The client is pending for Discharge'); </script>";
					$this->clients->Change_Discharge_status($file['client_id']);
					redirect('auth/Pending_Discharge', $file);
					$this->load->view('headr_footer/socialw_footer');
				}
				else{ */
				$this->load->helper('directory');
				$this->load->view('Social_Worker/Discharge/Discharge', $file);
				$this->load->view('header_footer/socialw_footer');
				
			}
		}
	}

	function Pending_Discharge()
	{

		$user_id = $this->tank_auth->get_user_id();
		$data['client_list'] = $this->clients->get_pending_Discharge_clients_SW($user_id);
		$this->get_notifications();
		$this->load->view('Social_Worker/social_Pending_Client_Directory', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	function Discharge_Client()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');
		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				
				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'General Documents' . DIRECTORY_SEPARATOR . 'Discharge',
	        	'allowed_types' => '*',
	     		
	            );

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
					else
					{
						
						$data['upload_data'] = $this->upload->data();

						$this->tank_auth->insert_file_db($data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							 $sw_id, 
							 $sw_id,
							 $client_id, 
							 $file_ploc);
						$action = "A Discharge Document was Uploaded for ".$client_id;
						$this->remove_request($client_id, $data['role']);
						$this->add_audit_entry($data['upload_data']['file_name'], $action, $sw_id);
						$this->notification($sw_id);	
						echo "<script>javascript:alert('File has been uploaded'); window.history.back() </script>";
						
					}
				}

			}	
	}

	function before_dis_adop()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$client_id = $this->form_validation->set_value('client_id');

			if(!$this->clients->client_has_slip_adop($client_id))
				{
					echo "<script>javascript:alert('Client already has a Discharge Slip');</script>";
					$this->discharge_adop_page($client_id);
				}
			else
				{
					$this->get_notifications();
					
					$data['client_info'] = $this->clients->get_client_by_id($client_id);
					$this->load->view('Forms/dischargeForm_adoption', $data);
					$this->load->view('header_footer/socialW_footer');
				}
 		}
		else
		{
			echo 'lol';
		}
	}


	function before_dis_slip()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	$client_id = $this->form_validation->set_value('client_id');
			if(!is_null($this->clients->client_has_slip($client_id)))
				{
					echo "<script>javascript:alert('Client already has a Discharge Slip');</script>";
					$this->discharge_slip_page($client_id);
				}
				else
				{
					$this->get_notifications();
					
					$data['client_info'] = $this->clients->get_client_by_id($client_id);
					$this->load->view('Forms/dischargeSlip_CIP', $data);
					$this->load->view('header_footer/socialW_footer');
				}
 		}
		else
		{
			echo 'lol';
		}
	}

	function discharge_slip_page($client_id)
	{
		$data['discharge_sli_details'] = $this->clients->get_discharge_slip_info($client_id);

		$this->get_notifications();
		$this->load->view('Forms/Output/discharge_slip_cip', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	function before_dis_sum()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	$client_id = $this->form_validation->set_value('client_id');
			if(!$this->clients->client_has_sum($client_id))
				{
					echo "<script>javascript:alert('Client already has a Discharge Summary');</script>";
					$this->discharge_sum_page($client_id);
				}
				else
				{
					$this->get_notifications();


					$data['client_info'] = $this->clients->get_client_by_id($client_id);
					$this->load->view('Forms/dischargeSum_PSN', $data);
					$this->load->view('header_footer/socialW_footer');
				}
 		}
		else
		{
			echo 'lol';
		}
	}

	function discharge_sum_page($client_id)
	{
		$data['discharge_sum_details'] = $this->clients->get_discharge_sum_info($client_id);
		$this->get_notifications();
		$this->load->view('Forms/Input/Discharge_summary', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	function discharge_adop_page($client_id)
	{
		$data['discharge_adop_details'] = $this->clients->get_discharge_adop_info($client_id);
		$this->get_notifications();
		$this->load->view('Forms/Output/discharge_slip_adop', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	function create_dis_adop()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('numMonths', 'numMonths', 'trim|required|xss_clean');
			$this->form_validation->set_rules('adopFather', 'adopFather', 'trim|required|xss_clean');
			$this->form_validation->set_rules('adopMother', 'adopMother', 'trim|xss_clean');
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				$this->form_validation->set_value('client_id');
				$this->form_validation->set_value('numMonths');
				$this->form_validation->set_value('adopFather');
				$this->form_validation->set_value('adopMother');
				if (!is_null($data = $this->tank_auth->create_dis_adop(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('numMonths'),
						$this->form_validation->set_value('adopFather'),
						$this->form_validation->set_value('adopMother'),
						$SocialW))) 
					{	
						$this->tank_auth->insert_file_db('Discharge Slip', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '27');
												
						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						$this->discharge_adop_page($this->form_validation->set_value('client_id'));
						echo "<script>javascript:alert('Discharge Slip created');</script>";

					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			else 
			{
				$this->get_notifications();
				$this->load->view('Forms/intervention_caseconfe');
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function create_dis_slip()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->get_notifications();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('dischargeReason', 'numMonths', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'adopFather', 'trim|required|xss_clean');
			$this->form_validation->set_rules('contactNum', 'adopMother', 'trim|xss_clean');
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				if (!is_null($data = $this->tank_auth->create_dis_slip(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('dischargeReason'),
						$this->form_validation->set_value('address'),
						$this->form_validation->set_value('contactNum'),
						$SocialW))) 
					{								
						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						echo "<script>javascript:alert('Discharge Slip created');</script>";
						
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			else 
			{
				$this->load->view('Forms/intervention_caseconfe');
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function create_discharge_sum()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('dischargeTo', 'numMonths', 'trim|required|xss_clean');
			$this->form_validation->set_rules('dischargeReason', 'adopFather', 'trim|required|xss_clean');
			$this->form_validation->set_rules('caseSum', 'adopMother', 'trim|xss_clean');
			$this->form_validation->set_rules('postPlaceStat', 'numMonths', 'trim|required|xss_clean');
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_dis_sum(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('dischargeTo'),
						$this->form_validation->set_value('dischargeReason'),
						$this->form_validation->set_value('caseSum'),
						$this->form_validation->set_value('postPlaceStat'),
						$SocialW))) 
					{
						$this->tank_auth->insert_file_db('Discharge Summary', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '45');
						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());
						$this->discharge_sum_page($this->form_validation->set_value('client_id'));	// success
						echo "<script>javascript:alert('Discharge Summary created')</script>";

					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			else 
			{
				$this->load->view('Forms/intervention_caseconfe');
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

// Medical - SW

	function socialW_medical()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$user_id = $this->tank_auth->get_user_id();
			$this->get_notifications();
			$data['client_list'] = $this->clients->get_all_clients_SW($user_id);
			$this->load->view('Social_Worker/Medical/socialW_medical', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function Social_audit_trail()
	{

		$data['role']		= $this->tank_auth->get_role();
		$data['user_id']	= $this->tank_auth->get_user_id();
		if (!$this->tank_auth->is_logged_in() || $data['role'] != 7) 
		{									// logged in
			redirect('');
		} 
		else
		{
		$data['files'] = $this->files->get_all_audit_files($data['user_id']);
		$this->get_notifications();
		$this->load->view('Social_Worker/Social_Audit_Trail', $data);
		$this->load->view('header_footer/socialW_footer');
		}
	}

	function socialW_medical_profile()
	{
		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		else
		{

			$data['username']	= $this->tank_auth->get_username();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$file['client_info'] = $this->clients->get_client_by_id($client_id);

				$file['medical_files'] = $this->files->get_medical_files($client_id);
				$file['psychologist_files'] = $this->files->get_psychologist_files($client_id);
				$file['psychiatric_files'] = $this->files->get_psychiatric_files($client_id);
				$file['physical_files'] = $this->files->get_physical_files($client_id);

				$this->load->helper('file');

				$file['path_MR']      = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Medical Reports';
				$file['path_GD']      = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'General Documents';
				$file['path_PsychiR'] = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychiatric Reports';
				$file['path_PsychoR'] = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychological Reports';
				$file['path_PTR']     = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'PT Reports';
				
				$file['file_MR'] = get_filenames($file['path_MR']);
				$file['file_GD'] = get_filenames($file['path_GD']);
				$file['file_PsychiR'] = get_filenames($file['path_PsychiR']);
				$file['file_PsychoR'] = get_filenames($file['path_PsychoR']);
				$file['file_PTR'] = get_filenames($file['path_PTR']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Social_Worker/Medical/socialW_medical_profile', $file);
				$this->load->view('header_footer/socialW_footer');
			}
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Social_Worker/socialW_activity', $data_info);
				$this->load->view('header_footer/socialW_footer');
			}		


		}
	}

	
// Forms and Reports

	function get_client_checklist_items()
	{

		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
		{	
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$admission_type = $this->clients->get_client_details($client_id)->admission_type;
			$client_sector = $this->clients->get_client_details($client_id)->client_sector;

			$data['checklist_items'] = $this->files->get_client_checklist_items($client_id);
				$this->get_notifications();

				$this->load->view('Social_Worker/checklists/checklist', $data);
				$this->load->view('header_footer/socialw_footer');
		}
		else
		{

		}
	}

	function update_checklist()
	{
		$user_id= $this->tank_auth->get_user_id();
	
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

		
		$data['errors'] = array();

		if ($this->form_validation->run()) 
		{								// validation ok

			$client_id = 	$this->form_validation->set_value('client_id');
			
				$data['client_info'] = $this->clients->get_client_by_id($client_id);	
					$this->get_notifications();
					$data['locations'] = $this->files->get_locations($this->tank_auth->get_role());
					$data['document_type'] = $this->files->get_document_type();
					$this->load->view("Social_Worker/Admission/socialW_add_upload",$data);
					$this->load->view('header_footer/socialW_footer');
		}
		else{

		$this->get_notifications();
		$data['pending_clients'] = $this->clients->get_sw_pending_clients($user_id);
		$this->load->view('Social_Worker/socialW_pending_clients', $data);
		$this->load->view('header_footer/socialw_footer');
		}
	}

	function get_POA()
	{
		$this->form_validation->set_rules('plan_of_action_id', 'plan_of_action_id', 'xss_clean|trim');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{

			$data['POA_details'] = $this->users->get_POA($this->form_validation->set_value('plan_of_action_id'));
			$data['client_info'] = $this->clients->get_client_by_id($this->form_validation->set_value('client_id'));

			$this->get_notifications();
			$this->load->view('POA_details', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function get_POA_page($client_id, $id)
	{


		$data['POA_details'] = $this->users->get_POA($id);
		$data['client_info'] = $this->clients->get_client_by_id($client_id);

		$this->get_notifications();
		$this->load->view('POA_details', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	function Plan_of_action()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{
			
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['employees'] = $this->users->get_employees();
			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/POA', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function create_POA()
	{
		$i = 0;
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
		$tasks = $this->input->post('task');
		$Person_Responsible = $this->input->post('Person_Responsible');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$remarks = $this->input->post('Remarks');

		
		$data['errors'] = array();

		if ($this->form_validation->run()) 
		{							
			if($Person_Responsible != null)
			{
				if (!is_null($data = $this->tank_auth->create_POA(
						$this->form_validation->set_value('client_id'),
						$user_id))) 
					{	
							$this->tank_auth->insert_file_db('Plan of Action', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '61');
					
					foreach($Person_Responsible as $task)
						{	
							$POAtask = $task;
							$Person_Responsible[$i];

							$this->tank_auth->insert_POA_task($data['id'], $POAtask, $Person_Responsible[$i], $start_date[$i], $end_date[$i], $remarks[$i]);
							$i = $i + 1;
							
						}	
						
						$client_id = $this->form_validation->set_value('client_id');
						$this->get_POA_page($client_id, $data['id']);
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			else
			{
				echo '<script>alert("No items");</script>';
				$client_id = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($client_id);
				$data['employees'] = $this->users->get_employees();
				$this->get_notifications();
				$this->load->view('Social_Worker/Admission/POA', $data);
				$this->load->view('header_footer/socialW_footer');
			}


		}
	}

	function edit_POA()
	{
		$this->form_validation->set_rules('POA_id', 'POA_id', 'xss_clean|trim');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{
			$data['POA_details'] = $this->users->get_POA($this->form_validation->set_value('POA_id'));
			$data['client_info'] = $this->clients->get_client_by_id($this->form_validation->set_value('client_id'));
			$data['employees'] = $this->users->get_employees();
			$this->get_notifications();
			$this->load->view('POA_edit',$data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function before_scs_report()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);

			foreach($data['client_info'] as $info)
			{
				$admission_type = $info->admission_type;
			}
			$data['client_medical'] = "";
			if($admission_type=="2")
			{
			$data['surrender_details'] ="" ;
			}
			elseif($admission_type == "3")
			{
			$data['founder_details']  ="";
			}
			$this->load->view('Forms/social_case_study_report', $data);
			$this->load->view('header_footer/socialW_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function social_case_report()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->get_notifications();

			$this->form_validation->set_rules('medicalDev', 'medicalDev', 'trim|required|xss_clean');
			$this->form_validation->set_rules('present_description', 'present_description', 'trim|required|xss_clean');
		
			$this->form_validation->set_rules('Eval_reco', 'Eval_reco', 'trim|required|xss_clean');
		
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_socialCase(
						$this->form_validation->set_value('medicalDev'),
						$this->form_validation->set_value('present_description'),
						$this->form_validation->set_value('Eval_reco'),
						$this->form_validation->set_value('client_id')
						))) 
					{						
						$this->tank_auth->insert_file_db('Social Case Study Report', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '20');		
						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						$client_id = $this->form_validation->set_value('client_id');
						$this->mpdf_social($client_id);
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} else {
				$this->load->view('Forms/social_case_study_report');
				$this->load->view('header_footer/socialW_footer');
			}
		}
	}

	function create_media()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
			$this->form_validation->set_rules('bodyBuilt', 'bodyBuilt', 'trim|xss_clean');

			
			
			$this->form_validation->set_rules('bioMom', 'bioMom', 'trim|xss_clean');

			$this->form_validation->set_rules('bioDad', 'bioDad', 'trim|xss_clean');

			$this->form_validation->set_rules('tvRadioProg', 'tvRadioProg', 'trim|xss_clean');
			$this->form_validation->set_rules('airedTime', 'airedTime', 'trim|xss_clean');
			
			$this->form_validation->set_rules('airedDate', 'airedDate', 'trim|xss_clean');
			$this->form_validation->set_rules('announcer', 'announcer', 'trim|required|xss_clean');
			$this->form_validation->set_rules('person1', 'person1', 'trim|xss_clean');
			$this->form_validation->set_rules('person2', 'person2', 'trim|xss_clean');
			$this->form_validation->set_rules('person3', 'person3', 'trim|xss_clean');
			
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_mediaCer(
						

						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('bodyBuilt'),
						
						$this->form_validation->set_value('bioMom'),
						
						$this->form_validation->set_value('bioDad'),
						$this->form_validation->set_value('tvRadioProg'),
						$this->form_validation->set_value('airedTime'),
						
						$this->form_validation->set_value('airedDate'),
						$this->form_validation->set_value('announcer'),
						$this->form_validation->set_value('person1'),
						$this->form_validation->set_value('person2'),
						$this->form_validation->set_value('person3'),
						$SocialW))) 
					{								
						$this->mpdf_media($this->form_validation->set_value('client_id'));

					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} else {
				$this->get_notifications();
				$this->load->view('Forms/media_certificate');
				$this->load->view('header_footer/socialW_footer');
			}
		}		
	}

	function media_certificate()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');

		if($this->form_validation->run())
		{	
			
			$data['client_id'] = $this->form_validation->set_value('client_id');
			if(!$this->clients->client_has_media_certificate($data['client_id']))
			{
				echo "<script>javascript:alert('Client has a media certificate');</script>";
				$this->mpdf_media($data['client_id']);
			}
			else
			{
				$client_id = $this->form_validation->set_value('client_id');
			
				
				if($this->clients->client_has_immunizations($client_id) 
				|| $this->clients->client_has_illness($client_id)
				|| $this->clients->client_has_notes_recommendation($client_id)
				|| $this->clients->client_has_birth_history($client_id)
				|| $this->clients->client_has_impairments($client_id)
				|| $this->clients->client_has_present_condition($client_id)
				|| $this->clients->client_has_medical_problems($client_id)
				|| $this->clients->client_has_laboratoy_test($client_id))
				{
					echo "<script>javascript:alert('Initial Medical Exam has not yet been accomplished'); window.history.back(2);</script>";
				}
				else{
					$this->get_notifications();
					$data['complete_info'] = $this->clients->get_client_by_id_media($client_id);
					$data['employees'] = $this->users->get_all_employees($this->tank_auth->get_user_id());
					$this->load->view('Forms/media_certificate_form', $data);
					$this->load->view('header_footer/socialW_footer');
					}
			}
		}
		else
		{
			echo 'lol';
		}	
	}

	function media_certificate_page($client_id)
	{
		$data['media_certificate'] = $this->clients->get_client_by_id_for_media($client_id);

			$this->get_notifications();
			$this->load->view('Social_Worker/Admission/socialW_pending_client_page', $data);
			$this->load->view('header_footer/socialW_footer');
	}

	function home_visit_page()
	{
		$client_id = $this->input->post('client_id');

		$home_report['home_report'] = $this->users->get_home_visit_reports($client_id);
		$home_report['client_info'] = $this->clients->get_client_by_id($client_id);
		$this->get_notifications();
		$this->load->view('Forms/home_visit_page', $home_report);
		$this->load->view('header_footer/socialW_footer');
	}

	function view_home_visit_report()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		$this->form_validation->set_rules('home_visit_id','home_visit_id', 'xss_clean|trim');

		if($this->form_validation->run())
		{
			$home_visit_id = $this->form_validation->set_value('home_visit_id');
			$client_id = $this->form_validation->set_value('client_id');
			

			$data['home_visit'] = $this->users->get_home_visit_items($home_visit_id);
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->get_notifications();
			$this->load->view('Forms/Output/home_visit_results', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function view_home_visit_page($client_id, $home_visit_id)
	{	
		$data['home_visit'] = $this->users->get_home_visit_items($home_visit_id);
		$data['client_info'] = $this->clients->get_client_by_id($client_id);
		$this->get_notifications();
		$this->load->view('Forms/Output/home_visit_results', $data);
		$this->load->view('header_footer/socialW_footer');
		
	}

	function before_home_report()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($data['client_id']);
			$this->load->view('Forms/home_visit', $data);
			$this->load->view('header_footer/socialW_footer');
 		}
	}
	function home_visit_report()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');
		} 
		else {
			$this->form_validation->set_rules('response', 'response', 'trim|required|xss_clean');
			$this->form_validation->set_rules('visitDate', 'visitDate', 'trim|required|xss_clean');
			$this->form_validation->set_rules('visitPlace', 'visitPlace', 'trim|required|xss_clean');
			$this->form_validation->set_rules('obj', 'obj', 'trim|required|xss_clean');
			$this->form_validation->set_rules('narra', 'narra', 'trim|required|xss_clean');
			$this->form_validation->set_rules('assess', 'assess', 'trim|required|xss_clean');
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$user_id = $this->tank_auth->get_user_id();
			
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_homeVisit(
						$this->form_validation->set_value('response'),
						$this->form_validation->set_value('visitDate'),
						$this->form_validation->set_value('visitPlace'),
						$this->form_validation->set_value('obj'),
						$this->form_validation->set_value('narra'),
						$this->form_validation->set_value('assess'),
						$this->form_validation->set_value('client_id'),
						$user_id))) 
					{	

						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						$client_id = $this->form_validation->set_value('client_id');
						$home_visit_id = $data['home_visit_id'];
						$this->view_home_visit_page($client_id, $home_visit_id);
						$this->tank_auth->insert_file_db('Home Visit Report', 'Electronic Form', 'view_home_visit_page('.$client_id.','. $home_visit_id.')', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '20');		
						

					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} else {
				$this->load->view('Forms/home_visit');
				$this->load->view('header_footer/houseP_footer');
			}
		}		
	}



// ETC
	function socialW_messaging()
	{
		if (!$this->tank_auth->is_logged_in()) {									
			redirect('auth/login');

		} 
		else {
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			$this->form_validation->set_rules('msg', 'msg', 'xss_clean|required|trim');
			$this->form_validation->set_rules('user_chat_id', 'user_chat_id', 'xss_clean|required|trim');
			
			$data['errors'] = array();

		

			if ($this->form_validation->run()) {								
				if (!is_null($data = $this->tank_auth->insert_msg(
					$SocialW,
					$this->form_validation->set_value('msg'),
					$this->form_validation->set_value('user_chat_id')))) {									

					redirect('auth/login');
					
				} 

				else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}

				
			}


			
		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data_msg['msge'] = $this->clients->get_messages($data['user_id']);
		$data['users'] = $this->clients->get_all_user();
		$this->load->view('header_footer/socialW_header', $data);
		$this->load->view('Social_Worker/socialW_messaging', $data_msg);
		$this->load->view('header_footer/socialW_footer');
	}

	function socialW_upload()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');
		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			$this->form_validation->set_rules('document_type', 'document_type', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				$document_type = $this->form_validation->set_value('document_type');

				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'Social Case Reports',
	        	'allowed_types' => '*',
	     		
	            );

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
				else
					{
						$data['upload_data'] = $this->upload->data();
						$action = 'A new Social Case Report was uploaded to '. $client_id;
						
						$this->tank_auth->insert_file_db(
							$data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							$sw_id,
							$client_id,
							$sw_id,
							$file_ploc,
							$document_type);

						$this->add_audit_entry($data['upload_data']['file_name'], $sw_id, $action );
						$this->remove_request($client_id, $data['role']);

						$this->notification($sw_id);	
						echo "<script>javascript:alert('".$data['upload_data']['file_name']." new File has been added'); window.location = 'socialW_case'</script>";
					}
			}
		}	
	}

	function get_client()
	{
		$data['role']= $this->tank_auth->get_role();
		$this->form_validation->set_rules('client_id', 'client_id');
		if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->get_client_by_id($this->form_validation->set_value('client_id'))))
						{
						$data['client_info'] = $this->clients->get_client_by_id();
						$this->load->view('search_client_result', $data);
						}
					}
				else
				{
						$this->load->view('search_client');
				}
	}

	function get_house_reports()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['house_reports'] = $this->clients->get_house_reports($client_id);
			$this->load->view('Social_Worker/Case/socialW_house_reports', $data);
			$this->load->view('header_footer/socialW_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function submit_intervention_case_conference()
	{
		$this->form_validation->set_rules('counter', 'counter', 'trim|xss_clean');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		$this->form_validation->set_rules('Schedule', 'Schedule', 'trim|xss_clean');
		$this->form_validation->set_rules('start_time', 'start_time', 'trim|xss_clean');
		$this->form_validation->set_rules('end_time', 'end_time', 'trim|xss_clean');

		$attendee = $this->input->post('check');
		$counter = $this->input->post('counter');


		if($this->form_validation->run())
		{	
			$client_id = $this->form_validation->set_value('client_id');
			$Schedule = $this->form_validation->set_value('Schedule');
			$start_time = $this->form_validation->set_value('start_time');
			$end_time = $this->form_validation->set_value('end_time');
			$conference_type = "2";
			$user_id = $this->tank_auth->get_user_id();
			if (!is_null($data = $this->tank_auth->create_pre_admission_CC($client_id, $Schedule, $user_id, $start_time, $end_time,$conference_type )))
			{
				
				foreach($attendee as $check)
				{	
					$attendant = $check;
					$this->tank_auth->insert_pre_ad_attendee($data['id'], $attendant);
					
				}
				echo "<script>javascript:alert('Pre-Admission case conference request has been sent');</script>";
				$this->get_notifications();
				$this->pre_admission_page($client_id);
			}
		}
		else
		{
			echo 'lol';
		}	
	}

	function pre_admission_page($client_id)
	{
		$data['pre_admission_details'] = $this->clients->get_preadmission_page_details($client_id);
		$user_id = $this->tank_auth->get_user_id();
		if(!$this->users->I_made_this($user_id, $client_id))
			{
				$data['i_am_not_creator'] = '1';
			}
			else
			{
				$data['i_am_not_creator'] = '2';
			}	

		foreach ($data['pre_admission_details'] as $row_details)
		{
			$pre_admission_id = $row_details->conference_id;
		}

		$data['pre_admission_attendees']	= $this->clients->get_pre_admission_attendees($pre_admission_id);
		$this->load->view('Social_Worker/Admission/pre_admission_page',$data);
		$this->load->view('header_footer/socialW_footer');
	}

	function create_minutes()
	{
		$role = $this->tank_auth->get_role();
		$this->form_validation->set_rules('conference_id', 'conference_id', 'xss_clean|trim');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{
			$conference_id = $data['conference_id'] = $this->form_validation->set_value('conference_id');
			$client_id = $this->form_validation->set_value('client_id');
			if(!($this->users->client_has_minutes($conference_id, $client_id)))
			{
				echo '<script>alert("Client has conference minutes"); </script>';
				$this->conference_minutes_page($client_id, $conference_id);
			}
			else
			{
				if($role == 7 || $role == 8 || $role == 9 || $role == 10)
				{
					$data['pre_admission_details'] = $this->clients->get_preadmission_page_details($this->form_validation->set_value('client_id'));
					
					$this->get_notifications();
					$this->load->view('conference_minutes', $data);
					$this->load->view('header_footer/socialW_footer');
				}
				else
				{
					echo '<script>alert("Client minutes is not yet available"); </script>';
					$this->conference_history($client_id);
				}
			}
		}
	}

	function conference_minutes_submission()
	{
		$this->form_validation->set_rules('conference_id', 'conference_id', 'xss_clean|trim');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_cleat|trim');
		$points = $this->input->post('point');
		$point_counter = 1; 
		if($this->form_validation->run())
		{
			if($points != null)
			{
				foreach ($points as $point)
				{
					$data = $this->tank_auth->insert_conference_point($conference_id = $this->form_validation->set_value('conference_id'),$client_id = $this->form_validation->set_value('client_id'), $point);
					$sub_point = $this->input->post('sub_point_'.$point_counter);
					$sub_point_counter = 0;
					$point;
					if($sub_point != null)
					{
						foreach($sub_point as $sub)
						{
							$this->tank_auth->insert_sub_topic($data['topic_id'], $sub);
							$sub_point_counter++;
						}
					}
					$point_counter++;

				}
				$this->conference_minutes_page($client_id, $conference_id);
				$this->tank_auth->insert_file_db('Conference Minutes', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '20');		
						
				echo "<script>javascript:alert('Minutes have been added');</script>";
			}
			else
			{
									$this->get_notifications();
					$this->load->view('conference_minutes', $data);
					$this->load->view('header_footer/socialW_footer');
				echo "<script>alert('Please Input Minutes'); </script>";
			}
		}
	}

	function conference_minutes_page($client_id, $conference_id)
	{

		$data['role'] = $this->tank_auth->get_role();
		$data['client_info'] = $this->clients->get_client_by_id($client_id);
		$data['conference_point'] = $this->users->get_conference_points($client_id, $conference_id);
		$data['conference_sub_point'] = $this->users->get_conference_sub_points($client_id, $conference_id);
		$data['conference_attendees'] = $this->users->conference_final_attendees($client_id);
		$this->get_notifications();
		$this->load->view('conference_minutes_results', $data);
		$this->load->view('header_footer/socialW_footer');
	}








// PSYCHOLOGIST
	function psycho_dashboard()
	{
		$this->get_notifications();
		$role = $data['role']		= $this->tank_auth->get_role();
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();


		$data['Request_count'] = $this->users->medical_request_counter($role);
		$data['Conference_count'] = $this->users->conference_counter($user_id);
		$data['Messages'] = $this->messages->get_messages($data['user_id']);
		$data['tasks'] = $this->clients->get_requests($data['role'] = $this->tank_auth->get_role());
		$this->load->view('Psychologist/psycho_dashboard', $data);
		$this->load->view('header_footer/psycho_footer');
	}

	function psycho_medical()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$data['username']	= $this->tank_auth->get_username();
		
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

			if ($this->form_validation->run()) 
			{								// validation ok
					
				$file['client_id'] = $this->form_validation->set_value('client_id');

				$file['client_info'] = $this->clients->get_client_by_id($file['client_id']);
				$file['sw_id'] = $this->form_validation->set_value('sw_id');
				$user_id = $this->tank_auth->get_user_id();
				$file['file_cham']	= $this->files->get_files_client($file['client_id'], $user_id);
				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$this->load->helper('file');
				$file['path'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Psychological Reports';
				$file['file'] = get_filenames($file['path']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Psychologist/psycho_upload', $file);
				$this->load->view('header_footer/psycho_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Psychologist/psycho_medical', $data_info);
				$this->load->view('header_footer/psycho_footer');
			}	
		}
	}

	function psycho_upload()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');

		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			$this->form_validation->set_rules('document_type', 'document_type', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				$document_type = $this->form_validation->set_value('document_type');
				$user_id = $this->tank_auth->get_user_id();
				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'Psychological Reports',
	        	'allowed_types' => '*',
	        );

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
				else
					{
						$data['upload_data'] = $this->upload->data();
			
						$this->tank_auth->insert_file_db(
							$data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							$sw_id, 
							$client_id,
							$user_id, 
							$file_ploc,
							$document_type);

						$action = $data['upload_data']['file_name'].' has been uploaded';
						$this->remove_request($client_id, $data['role']);
						$this->add_audit_entry($data['upload_data']['file_name'],$action, $sw_id);
						$this->notification($sw_id);
						echo "<script>javascript:alert('File has been uploaded'); window.location = 'psycho_medical'</script>";
					}
				
			}
		}	
	}

	// just added

	function before_psych_rep()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('Forms/psycho_report', $data);
			$this->load->view('header_footer/socialW_footer');
 		}
		else
		{
			echo 'lol';
		}
	}


	function create_psycho()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->get_notifications();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('educAttain', 'educAttain', 'trim|required|xss_clean');
			$this->form_validation->set_rules('referBy', 'referBy', 'trim|required|xss_clean');
			$this->form_validation->set_rules('referDate', 'referDate', 'trim|required|xss_clean');
			$this->form_validation->set_rules('referReason', 'referReason', 'trim|required|xss_clean');
			$this->form_validation->set_rules('caseBG', 'caseBG', 'trim|required|xss_clean');
			$this->form_validation->set_rules('observedBeh', 'observedBeh', 'trim|required|xss_clean');
			$this->form_validation->set_rules('intAbility', 'intAbility', 'trim|required|xss_clean');
			$this->form_validation->set_rules('emoStat', 'emoStat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('impre', 'impre', 'trim|xss_clean');
			$this->form_validation->set_rules('recom', 'recom', 'trim|xss_clean');
			$this->form_validation->set_rules('test1', 'test1', 'trim|xss_clean');
			$this->form_validation->set_rules('test2', 'test2', 'trim|xss_clean');
			$this->form_validation->set_rules('test3', 'test3', 'trim|xss_clean');
			$this->form_validation->set_rules('test4', 'test4', 'trim|xss_clean');
			$this->form_validation->set_rules('test5', 'test5', 'trim|xss_clean');
			$this->form_validation->set_rules('test6', 'test6', 'trim|xss_clean');
			$this->form_validation->set_rules('test7', 'test7', 'trim|xss_clean');
			$this->form_validation->set_rules('test8', 'test8', 'trim|xss_clean');
			$this->form_validation->set_rules('test9', 'test9', 'trim|xss_clean');
			$this->form_validation->set_rules('test10', 'test10', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest1', 'dateTest1', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest2', 'dateTest2', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest3', 'dateTest3', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest4', 'dateTest4', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest5', 'dateTest5', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest6', 'dateTest6', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest7', 'dateTest5', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest8', 'dateTest8', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest9', 'dateTest9', 'trim|xss_clean');
			$this->form_validation->set_rules('dateTest10', 'dateTest10', 'trim|xss_clean');
			$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_psycho_rep(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('educAttain'),
						$this->form_validation->set_value('referBy'),
						$this->form_validation->set_value('referDate'),
						$this->form_validation->set_value('referReason'),
						$this->form_validation->set_value('caseBG'),
						$this->form_validation->set_value('observedBeh'),
						$this->form_validation->set_value('intAbility'),
						$this->form_validation->set_value('emoStat'),
						$this->form_validation->set_value('impre'),
						$this->form_validation->set_value('recom'),
						$this->form_validation->set_value('test1'),
						$this->form_validation->set_value('test2'),
						$this->form_validation->set_value('test3'),
						$this->form_validation->set_value('test4'),
						$this->form_validation->set_value('test5'),
						$this->form_validation->set_value('test6'),
						$this->form_validation->set_value('test7'),
						$this->form_validation->set_value('test8'),
						$this->form_validation->set_value('test9'),
						$this->form_validation->set_value('test10'),
						$this->form_validation->set_value('dateTest1'),
						$this->form_validation->set_value('dateTest2'),
						$this->form_validation->set_value('dateTest3'),
						$this->form_validation->set_value('dateTest4'),
						$this->form_validation->set_value('dateTest5'),
						$this->form_validation->set_value('dateTest6'),
						$this->form_validation->set_value('dateTest7'),
						$this->form_validation->set_value('dateTest8'),
						$this->form_validation->set_value('dateTest9'),
						$this->form_validation->set_value('dateTest10'),
						$user_id))) 
					{								
						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						echo "<script>javascript:alert('Pyschological Report created');</script>";
						$this->load->view('Psychiatrist/psycho_medical');
						$this->load->view('header_footer/psycho_footer');
						//the table is not working and the alert is also not working
						// although the input are inserted into the db
						echo $test1;
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			else 
			{
				$this->load->view('Forms/psycho_report');
				$this->load->view('header_footer/psycho_footer');
			}
		}
	}





// PSYCHIATRIST
	function psychia_dashboard()
	{
		$this->get_notifications();
		$role = $data['role']		= $this->tank_auth->get_role();
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();


		$data['Request_count'] = $this->users->medical_request_counter($role);
		$data['Conference_count'] = $this->users->conference_counter($user_id);
		$data['Messages'] = $this->messages->get_messages($data['user_id']);
		$data['tasks'] = $this->clients->get_requests($data['role'] = $this->tank_auth->get_role());
		$this->load->view('Psychiatrist/psychia_dashboard', $data);
		$this->load->view('header_footer/psychia_footer');
	}

	function psychia_medical()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$data['username']	= $this->tank_auth->get_username();
		
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

			if ($this->form_validation->run()) 
			{								// validation ok
					
				$file['client_id'] = $this->form_validation->set_value('client_id');
				$file['client_info'] = $this->clients->get_client_by_id($file['client_id']);
				$user_id = $this->tank_auth->get_user_id();
				
				$file['file_cham']	= $this->files->get_files_client($file['client_id'], $user_id);
				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$this->load->helper('file');
				$file['path'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Psychiatric Reports';
				$file['file'] = get_filenames($file['path']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Psychiatrist/psychia_upload', $file);
				$this->load->view('header_footer/psychia_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Psychiatrist/psychia_medical', $data_info);
				$this->load->view('header_footer/psychia_footer');
			}	
		}
	}

	function psychia_upload()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');

		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			$this->form_validation->set_rules('document_type', 'document_type', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$document_type = $this->form_validation->set_value('document_type');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				$user_id = $this->tank_auth->get_user_id();

				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'Psychiatric Reports',
	        	'allowed_types' => '*',
	        );

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
				else
					{
						$data['upload_data'] = $this->upload->data();
			
						$this->tank_auth->insert_file_db(
							$data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							$sw_id, 
							$client_id,
							$user_id, 
							$file_ploc,
							$document_type);

						$action = $data['upload_data']['file_name'].' has been uploaded';
						$this->remove_request($client_id, $data['role']);
						$this->add_audit_entry($data['upload_data']['file_name'],$action, $sw_id);
						$this->notification($sw_id);
						echo "<script>javascript:alert('File has been uploaded'); window.location = 'psychia_medical'</script>";
					}
				
			}
		}	
	}






// HOUSE PARENT
	function houseP_dashboard()
	{
		$this->get_notifications();
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
		$data['Messages'] = $this->messages->get_messages($data['user_id']);

		$dorm_user = $this->clients->get_hp_dorm($user_id);
		$dorm_id= $dorm_user[0]->dormitory_id;

		$data['client_list'] = $this->clients->get_all_client_HP($user_id, $dorm_id);	
		$data['report_logs'] = $this->clients->get_report_log($user_id);	
		$data['tasks'] = $this->clients->get_requests($data['role'] = $this->tank_auth->get_role());
		$this->load->view('House_Parent/houseP_dashboard', $data);
		$this->load->view('header_footer/houseP_footer');
	}

	function houseP_medical()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$data['username']	= $this->tank_auth->get_username();
		
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fname', 'fname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lname', 'lname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('age', 'age', 'trim|require|xss_clean'); 
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
					
				$file['client_id'] = $this->form_validation->set_value('client_id');
				$file['fname'] = $this->form_validation->set_value('fname');
				$file['lname'] = $this->form_validation->set_value('lname');
				$file['gender'] = $this->form_validation->set_value('gender');
				$file['age'] = $this->form_validation->set_value('age');
		
				$file['sw_id'] = $this->form_validation->set_value('sw_id');
				$user_id = $this->tank_auth->get_user_id();
				$file['file_cham']	= $this->files->get_files_client($file['client_id'], $user_id);
				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$this->load->helper('file');
				$file['path'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'House Reports';
				$file['file'] = get_filenames($file['path']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('House_Parent/houseP_upload', $file);
				$this->load->view('header_footer/socialW_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('House_Parent/houseP_medical', $data_info);
				$this->load->view('header_footer/admin_footer');
			}	
		}
	}

	function houseP_upload()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');

		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				$user_id = $this->tank_auth->get_user_id();
				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'House Reports',
	        	'allowed_types' => '*',
	        );

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
				else
					{
						$data['upload_data'] = $this->upload->data();
			
						$this->tank_auth->insert_file_db(
							$data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							$sw_id, 
							$client_id,
							$user_id, 
							$file_ploc);

						$action = $data['upload_data']['file_name'].' has been uploaded';
						$this->remove_request($client_id, $data['role']);
						$this->add_audit_entry($data['upload_data']['file_name'], $action, $sw_id);
						$this->notification($sw_id);
						echo "<script>javascript:alert('File has been uploaded'); window.location = 'houseP_medical'</script>";
					}
				
			}
		}	
	}

	function house_reports()
	{
		$user_id = $this->tank_auth->get_user_id();
		$dorm_id = $this->clients->get_hp_dorm($user_id);
		$data['client_list'] = $this->clients->get_client_daily_reports($user_id, $dorm_id[0]->dormitory_id);
		$this->get_notifications();
		$this->load->view('House_Parent/daily_reports', $data);
		$this->load->view('header_footer/houseP_footer');
	}
	function house_house_plans()
	{
		$user_id = $this->tank_auth->get_user_id();
		$dorm_id = $this->clients->get_hp_dorm($user_id);
		$data['client_list'] = $this->clients->get_client_daily_reports($user_id, $dorm_id[0]->dormitory_id);
		$this->get_notifications();
		$this->load->view('House_Parent/house_house_plan', $data);
		$this->load->view('header_footer/houseP_footer');
	}
	function hp_report_log()
	{
		$this->get_notifications();

		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
		
		$client_id = $this->input->post('client_id');
		$remark = $this->input->post('remark');
		$data['errors'] = array();

		$i = 0;
		foreach($remark as $remarks)
		{
			if($remarks != "")
			{
				
				$this->tank_auth->create_report_log($client_id[$i], $remarks, $user_id);
				$i = $i + 1;


			}
			else
			{
				echo $i = $i + 1;
			}
		}
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
		$data['Messages'] = $this->messages->get_messages($data['user_id']);

		$dorm_user = $this->clients->get_hp_dorm($user_id);
		foreach ($dorm_user as $dorm_user)
		{
			$dorm_id = $dorm_user->dormitory_id;
		}
		redirect('', 'refresh');
/*		$data['client_list'] = $this->clients->get_all_client_HP($user_id, $dorm_id);	
		$data['report_logs'] = $this->clients->get_report_log($user_id);	
		$data['tasks'] = $this->clients->get_requests($data['role'] = $this->tank_auth->get_role());
		$this->load->view('House_Parent/houseP_dashboard', $data);
		$this->load->view('header_footer/houseP_footer');
*/
		if ($this->form_validation->run()) 
		{								// validation ok
			/*if (!is_null($data = $this->tank_auth->create_report_log(
					$this->form_validation->set_value('client_id'),
					$this->form_validation->set_value('remark'),
					$user_id))) 
				{								
					$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
					echo "<script>javascript:alert('Log Report sent');</script>";
					$this->load->view('House_Parent/houseP_dashboard');
					$this->load->view('header_footer/psycho_footer');

					
				} 
			else 
			{
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			} */

		}
	}

	function client_daily_report()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['house_reports'] = $this->clients->get_house_reports($client_id);
			$this->load->view('House_Parent/client_daily_report', $data);
			$this->load->view('header_footer/socialW_footer');
 		}
		else
		{
			echo 'lol';
		}
	}


// PHYSICAL THERAPIST
	function physicalT_dashboard()
	{
		$this->get_notifications();
		$role = $data['role']		= $this->tank_auth->get_role();
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();


		$data['Request_count'] = $this->users->medical_request_counter($role);
		$data['Conference_count'] = $this->users->conference_counter($user_id);
		$data['Messages'] = $this->messages->get_messages($data['user_id']);
		$data['tasks'] = $this->clients->get_requests($data['role'] = $this->tank_auth->get_role());
		$this->load->view('Physical_Therapist/physicalT_dashboard', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	function physicalT_medical()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$data['username']	= $this->tank_auth->get_username();
		
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
					
				$file['client_id'] = $this->form_validation->set_value('client_id');
				
				$file['client_info'] = $this->clients->get_client_by_id($file['client_id']);
				$user_id = $this->tank_auth->get_user_id();
				$file['file_cham']	= $this->files->get_files_client($file['client_id'], $user_id);
				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$this->load->helper('file');
				$file['path'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Physical Therapy Reports';
				$file['file'] = get_filenames($file['path']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Physical_Therapist/physicalT_upload', $file);
				$this->load->view('header_footer/admin_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Physical_Therapist/physicalT_medical', $data_info);
				$this->load->view('header_footer/physicalT_footer');
			}	
		}
	}

	function physicalT_upload()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');

		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			$this->form_validation->set_rules('document_type', 'document_type', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				$document_type = $this->form_validation->set_value('document_type');
				$user_id = $this->tank_auth->get_user_id();
				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'Physical Therapy Reports',
	        	'allowed_types' => '*',
	        );

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
				else
					{
						$data['upload_data'] = $this->upload->data();
			
						$this->tank_auth->insert_file_db(
							$data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							$sw_id, 
							$client_id,
							$user_id, 
							$file_ploc,
							$document_type);

						$action = $data['upload_data']['file_name'].' has been uploaded';
						$this->remove_request($client_id, $data['role']);
						$this->add_audit_entry($data['upload_data']['file_name'], $action, $sw_id);
						$this->notification($sw_id);
						echo "<script>javascript:alert('File has been uploaded'); window.location = 'physicalT_medical'</script>";
					}
				
			}
		}	
	}

	function create_PT()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('Forms/PT_Progress_report_and_plan', $data);
			$this->load->view('header_footer/physicalT_footer');
 		}
		else
		{
			echo 'lol';
		}
	}


	function submit_PT()
	{
		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->get_notifications();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('coveredPeriod', 'coveredPeriod', 'trim|xss_clean');
			$this->form_validation->set_rules('diag', 'diag', 'trim|xss_clean');
			$this->form_validation->set_rules('prob1', 'prob1', 'trim|xss_clean');
			$this->form_validation->set_rules('prob2', 'prob2', 'trim|xss_clean');
			$this->form_validation->set_rules('prob3', 'prob3', 'trim|xss_clean');
			$this->form_validation->set_rules('prog1', 'prog1', 'trim|xss_clean');
			$this->form_validation->set_rules('prog2', 'prog2', 'trim|xss_clean');
			$this->form_validation->set_rules('prog3', 'prog3', 'trim|xss_clean');
			$this->form_validation->set_rules('presentPlan1', 'presentPlan1', 'trim|xss_clean');
			$this->form_validation->set_rules('presentPlan2', 'presentPlan2', 'trim|xss_clean');
			$this->form_validation->set_rules('presentPlan3', 'presentPlan3', 'trim|xss_clean');
			$this->form_validation->set_rules('reco', 'reco', 'trim|xss_clean');
			
			$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_pt_report(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('coveredPeriod'),
						$this->form_validation->set_value('diag'),
						$this->form_validation->set_value('prob1'),
						$this->form_validation->set_value('prob2'),
						$this->form_validation->set_value('prob3'),
						$this->form_validation->set_value('prog1'),
						$this->form_validation->set_value('prog2'),
						$this->form_validation->set_value('prog3'),
						$this->form_validation->set_value('presentPlan1'),
						$this->form_validation->set_value('presentPlan2'),
						$this->form_validation->set_value('presentPlan3'),
						$this->form_validation->set_value('reco'),
						$user_id))) 
					{								
						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						echo "<script>javascript:alert('PT Report and Plan created');</script>";
						$this->load->view('Physical_Therapist/physicalT_medical');
						$this->load->view('header_footer/physicalT_footer');
						//the table is not working and the alert is also not working
						// although the input are inserted into the db
						
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			else 
			{
				$this->load->view('Forms/psycho_report');
				$this->load->view('header_footer/psycho_footer');
			}
		}
	}


// NURSE


	function nurse_dashboard()
	{
		$this->get_notifications();
		$role = $data['role']		= $this->tank_auth->get_role();
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();


		$data['Request_count'] = $this->users->medical_request_counter($role);
		$data['Conference_count'] = $this->users->conference_counter($user_id);


		$data['Messages'] = $this->messages->get_messages($data['user_id']);
		$data['tasks'] = $this->clients->get_requests($data['role'] = $this->tank_auth->get_role());
		$this->load->view('Nurse/nurse_dashboard', $data);
		$this->load->view('header_footer/nurse_footer');
	}

	function nurse_messaging()
	{
		if (!$this->tank_auth->is_logged_in()) {									
			redirect('auth/login');

		} 
		else {
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			$this->form_validation->set_rules('msg', 'msg', 'xss_clean|required|trim');
			$this->form_validation->set_rules('user_chat_id', 'user_chat_id', 'xss_clean|required|trim');
			
			$data['errors'] = array();

		

			if ($this->form_validation->run()) {								
				if (!is_null($data = $this->tank_auth->insert_msg(
					$SocialW,
					$this->form_validation->set_value('msg'),
					$this->form_validation->set_value('user_chat_id')))) {									

					redirect('auth/login');
					
				} 

				else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}

				
			}


			
		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data_msg['msge'] = $this->clients->get_messages($data['user_id']);
		$data['users'] = $this->clients->get_all_user();
		$this->load->view('header_footer/nurse_header', $data);
		$this->load->view('Nurse/nurse_messaging', $data_msg);
		$this->load->view('header_footer/nurse_footer');
	}

	function nurse_trial()
	{
		if (!$this->tank_auth->is_logged_in()) {									
			redirect('auth/login');

		} 
		else {
			$SocialW = $data['user_id'] = $this->tank_auth->get_user_id();
			$this->form_validation->set_rules('msg', 'msg', 'xss_clean|required|trim');
			$this->form_validation->set_rules('user_chat_id', 'user_chat_id', 'xss_clean|required|trim');
			
			$data['errors'] = array();

		

			if ($this->form_validation->run()) {								
				if (!is_null($data = $this->tank_auth->insert_msg(
					$SocialW,
					$this->form_validation->set_value('msg'),
					$this->form_validation->set_value('user_chat_id')))) {									

					redirect('auth/login');
					
				} 

				else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}

				
			}


			
		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data_msg['msge'] = $this->clients->get_messages($data['user_id']);
		$data['users'] = $this->clients->get_all_user();
		$this->load->view('header_footer/nurse_header', $data);
		$this->load->view('Nurse/nurse_trial', $data_msg);
		$this->load->view('header_footer/nurse_footer');
	}

	function nurse_reports()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$data['username']	= $this->tank_auth->get_username();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fname', 'fname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lname', 'lname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('age', 'age', 'trim|require|xss_clean'); 
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
			
				$file['client_id'] = $this->form_validation->set_value('client_id');
				$file['fname'] = $this->form_validation->set_value('fname');
				$file['lname'] = $this->form_validation->set_value('lname');
				$file['gender'] = $this->form_validation->set_value('gender');
				$file['age'] = $this->form_validation->set_value('age');
		
				$file['sw_id'] = $this->form_validation->set_value('sw_id');


				$this->load->helper('file');
				$file['path'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Medical Reports';
				$file['file'] = get_filenames($file['path']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Nurse/nurse_upload', $file);
				$this->load->view('header_footer/nurse_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Nurse/nurse_reports', $data_info);
				$this->load->view('header_footer/nurse_footer');
			}	
		}
	}

	function nurse_upload()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');

		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			$this->form_validation->set_rules('document_type', 'document_type', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				$document_type = $this->form_validation->set_value('document_type');
				$user_id = $this->tank_auth->get_user_id();
				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'Medical Reports',
	        	'allowed_types' => '*',
	        );

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
				else
					{
						$data['upload_data'] = $this->upload->data();
			
						$this->tank_auth->insert_file_db(
							$data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							$sw_id, 
							$client_id,
							$user_id, 
							$file_ploc,
							$document_type);

						$action = $data['upload_data']['file_name'].' has been uploaded';
						$this->remove_request($client_id, $data['role']);
						$this->add_audit_entry($data['upload_data']['file_name'],$action, $sw_id);
						$this->notification($sw_id);
						echo "<script>javascript:alert('file has been uploaded'); window.location = 'nurse_medical'</script>";
					}
				
			}
		}	
	}

	function success()
	{
		$this->get_notifications();
		$data['user_id'] = $this->tank_auth->get_user_id();
		$data['Messages'] = $this->messages->get_messages($data['user_id']);
		$this->load->view('Nurse/success', $data);
		$this->load->view('header_footer/nurse_footer');
	}

	function before_health_medical()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('Forms/health_and_medical', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}


	function nurse_medical()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$data['username']	= $this->tank_auth->get_username();
		
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

			if ($this->form_validation->run()) 
			{								// validation ok
					
				$client_id = $this->form_validation->set_value('client_id');
				
				$file['client_info'] = $this->clients->get_client_by_id($client_id);
				$user_id = $this->tank_auth->get_user_id();
				$file['file_cham']	= $this->files->get_files_client($client_id, $user_id);
				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$this->load->helper('file');
				$file['path'] = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Medical Reports';
				$file['file'] = get_filenames($file['path']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Nurse/nurse_upload', $file);
				$this->load->view('header_footer/nurse_footer');
			}
						
			
			else
			{
				$data['username']	= $this->tank_auth->get_username();
				$data_info['client_list'] = $this->clients->get_all_clients();
				$this->get_notifications();
				$this->load->view('Nurse/nurse_medical', $data_info);
				$this->load->view('header_footer/nurse_footer');
			}	
		}
	}

	function health_medical()
	{

		if (!$this->tank_auth->is_logged_in()) {									// logged in
			redirect('auth/login');

		} 
		else {
			$this->get_notifications();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('height', 'height', 'trim|xss_clean');
			$this->form_validation->set_rules('weight', 'weight', 'trim|xss_clean');
			$this->form_validation->set_rules('headCir', 'headCir', 'trim|xss_clean');
			$this->form_validation->set_rules('chestCir', 'chestCir', 'trim|xss_clean');
			$this->form_validation->set_rules('abdoCir', 'abdoCir', 'trim|xss_clean');
			$this->form_validation->set_rules('hairColor', 'hairColor', 'trim|xss_clean');
			$this->form_validation->set_rules('eyeColor', 'eyeColor', 'trim|xss_clean');
			$this->form_validation->set_rules('skinColor', 'skinColor', 'trim|xss_clean');
			$this->form_validation->set_rules('presentLoc', 'presentLoc', 'trim|xss_clean');
			$this->form_validation->set_rules('presentApp', 'presentApp', 'trim|xss_clean');
			$this->form_validation->set_rules('admissionApp', 'admissionApp', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth1', 'yearMonth1', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth2', 'yearMonth2', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth3', 'yearMonth3', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth4', 'yearMonth4', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth5', 'yearMonth5', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth6', 'yearMonth6', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth7', 'yearMonth7', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth8', 'yearMonth8', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth9', 'yearMonth9', 'trim|xss_clean');
			$this->form_validation->set_rules('yearMonth10', 'yearMonth10', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth1', 'ageMonth1', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth2', 'ageMonth2', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth3', 'ageMonth3', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth4', 'ageMonth4', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth5', 'ageMonth5', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth6', 'ageMonth6', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth7', 'ageMonth7', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth8', 'ageMonth8', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth9', 'ageMonth9', 'trim|xss_clean');
			$this->form_validation->set_rules('ageMonth10', 'ageMonth10', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos1', 'weightKilos1', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos2', 'weightKilos2', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos3', 'weightKilos3', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos4', 'weightKilos4', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos5', 'weightKilos5', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos6', 'weightKilos6', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos7', 'weightKilos7', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos8', 'weightKilos8', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos9', 'weightKilos9', 'trim|xss_clean');
			$this->form_validation->set_rules('weightKilos10', 'weightKilos10', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight1', 'lengthHeight1', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight2', 'lengthHeight2', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight3', 'lengthHeight3', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight4', 'lengthHeight4', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight5', 'lengthHeight5', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight6', 'lengthHeight6', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight7', 'lengthHeight7', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight8', 'lengthHeight8', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight9', 'lengthHeight9', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthHeight10', 'lengthHeight10', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm1', 'HCcm1', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm2', 'HCcm2', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm3', 'HCcm3', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm4', 'HCcm4', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm5', 'HCcm5', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm6', 'HCcm6', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm7', 'HCcm7', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm8', 'HCcm8', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm9', 'HCcm9', 'trim|xss_clean');
			$this->form_validation->set_rules('HCcm10', 'HCcm10', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm1', 'CCcm1', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm2', 'CCcm2', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm3', 'CCcm3', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm4', 'CCcm4', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm5', 'CCcm5', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm6', 'CCcm6', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm7', 'CCcm7', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm8', 'CCcm8', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm9', 'CCcm9', 'trim|xss_clean');
			$this->form_validation->set_rules('CCcm10', 'CCcm10', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth1', 'teeth1', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth2', 'teeth2', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth3', 'teeth3', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth4', 'teeth4', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth5', 'teeth5', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth6', 'teeth6', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth7', 'teeth7', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth8', 'teeth8', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth9', 'teeth9', 'trim|xss_clean');
			$this->form_validation->set_rules('teeth10', 'teeth10', 'trim|xss_clean');
			$this->form_validation->set_rules('marksPhy', 'marksPhy', 'trim|xss_clean');
			$this->form_validation->set_rules('obserHead', 'obserHead', 'trim|xss_clean');
			$this->form_validation->set_rules('obserEyes', 'obserEyes', 'trim|xss_clean');
			$this->form_validation->set_rules('obserNose', 'obserNose', 'trim|xss_clean');
			$this->form_validation->set_rules('obserEars', 'obserEars', 'trim|xss_clean');
			$this->form_validation->set_rules('obserMouth', 'obserMouth', 'trim|xss_clean');
			$this->form_validation->set_rules('obserNeck', 'obserNeck', 'trim|xss_clean');
			$this->form_validation->set_rules('obserChest', 'obserChest', 'trim|xss_clean');
			$this->form_validation->set_rules('obserAbdo', 'obserAbdo', 'trim|xss_clean');
			$this->form_validation->set_rules('obserGen', 'obserGen', 'trim|xss_clean');
			$this->form_validation->set_rules('obserSpinal', 'obserSpinal', 'trim|xss_clean');
			$this->form_validation->set_rules('obserExtre', 'obserExtre', 'trim|xss_clean');
			$this->form_validation->set_rules('obserPulse', 'obserPulse', 'trim|xss_clean');
			$this->form_validation->set_rules('obserBlood', 'obserBlood', 'trim|xss_clean');
			$this->form_validation->set_rules('obserNer', 'obserNer', 'trim|xss_clean');
			$this->form_validation->set_rules('obserRes', 'obserRes', 'trim|xss_clean');
			$this->form_validation->set_rules('obserSkin', 'obserSkin', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoHead', 'abnoHead', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoEyes', 'abnoEyes', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoNose', 'abnoNose', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoEars', 'abnoEars', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoMouth', 'abnoMouth', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoNeck', 'abnoNeck', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoChest', 'abnoChest', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoAdbo', 'abnoAdbo', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoGen', 'abnoGen', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoSpinal', 'abnoSpinal', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoExtre', 'abnoExtre', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoPulse', 'abnoPulse', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoBlood', 'abnoBlood', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoNer', 'abnoNer', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoRes', 'abnoRes', 'trim|xss_clean');
			$this->form_validation->set_rules('abnoSkin', 'abnoSkin', 'trim|xss_clean');
			$this->form_validation->set_rules('gestationAge', 'gestationAge', 'trim|xss_clean');
			$this->form_validation->set_rules('fullTerm', 'fullTerm', 'trim|xss_clean');
			$this->form_validation->set_rules('preMature', 'preMature', 'trim|xss_clean');
			$this->form_validation->set_rules('normalDel', 'normalDel', 'trim|xss_clean');
			$this->form_validation->set_rules('caesarianDel', 'caesarianDel', 'trim|xss_clean');
			$this->form_validation->set_rules('forcep', 'forcep', 'trim|xss_clean');
			$this->form_validation->set_rules('bornAt', 'bornAt', 'trim|xss_clean');
			$this->form_validation->set_rules('deliverBy', 'deliverBy', 'trim|xss_clean');
			$this->form_validation->set_rules('deliverName', 'deliverName', 'trim|xss_clean');
			$this->form_validation->set_rules('compli', 'compli', 'trim|xss_clean');
			$this->form_validation->set_rules('weightBirth', 'weightBirth', 'trim|xss_clean');
			$this->form_validation->set_rules('lengthBirth', 'lengthBirth', 'trim|xss_clean');
			$this->form_validation->set_rules('headCirBirth', 'headCirBirth', 'trim|xss_clean');
			$this->form_validation->set_rules('chestCirBirth', 'chestCirBirth', 'trim|xss_clean');
			$this->form_validation->set_rules('apgarScore', 'apgarScore', 'trim|xss_clean');
			$this->form_validation->set_rules('abnormalBirth', 'abnormalBirth', 'trim|xss_clean');
			$this->form_validation->set_rules('dateBCG', 'dateBCG', 'trim|xss_clean');
			$this->form_validation->set_rules('physiBCG', 'physiBCG', 'trim|xss_clean');
			$this->form_validation->set_rules('dateDPT1', 'dateDPT1', 'trim|xss_clean');
			$this->form_validation->set_rules('physiDPT1', 'physiDPT1', 'trim|xss_clean');
			$this->form_validation->set_rules('dateDPT2', 'dateDPT2', 'trim|xss_clean');
			$this->form_validation->set_rules('physiDPT2', 'physiDPT2', 'trim|xss_clean');
			$this->form_validation->set_rules('dateDPT3', 'dateDPT3', 'trim|xss_clean');
			$this->form_validation->set_rules('physiDPT3', 'physiDPT3', 'trim|xss_clean');
			$this->form_validation->set_rules('dateDPTBoos', 'dateDPTBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('physiDPTBoos', 'physiDPTBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('dateOPV1', 'dateOPV1', 'trim|xss_clean');
			$this->form_validation->set_rules('physiOPV1', 'physiOPV1', 'trim|xss_clean');
			$this->form_validation->set_rules('dateOPV2', 'dateOPV2', 'trim|xss_clean');
			$this->form_validation->set_rules('physiOPV2', 'physiOPV2', 'trim|xss_clean');
			$this->form_validation->set_rules('dateOPV3', 'dateOPV3', 'trim|xss_clean');
			$this->form_validation->set_rules('physiOPV3', 'physiOPV3', 'trim|xss_clean');
			$this->form_validation->set_rules('dateOPVBoos', 'dateOPVBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('physiOPVBoos', 'physiOPVBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('dateMeas', 'dateMeas', 'trim|xss_clean');
			$this->form_validation->set_rules('physiMeas', 'physiMeas', 'trim|xss_clean');
			$this->form_validation->set_rules('dateMMR', 'dateMMR', 'trim|xss_clean');
			$this->form_validation->set_rules('physiMMR', 'physiMMR', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHIB1', 'dateHIB1', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHIB1', 'physiHIB1', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHIB2', 'dateHIB2', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHIB2', 'physiHIB2', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHIB3', 'dateHIB3', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHIB3', 'physiHIB3', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHIBBoos', 'dateHIBBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHIBBoos', 'physiHIBBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHepa1', 'dateHepa1', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHepa1', 'physiHepa1', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHepa2', 'dateHepa2', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHepa2', 'physiHepa2', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHepa3', 'dateHepa3', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHepa3', 'physiHepa3', 'trim|xss_clean');
			$this->form_validation->set_rules('dateHepaBoos', 'dateHepaBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('physiHepaBoos', 'physiHepaBoos', 'trim|xss_clean');
			$this->form_validation->set_rules('dateOth', 'dateOth', 'trim|xss_clean');
			$this->form_validation->set_rules('physiOth', 'physiOth', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate1', 'labDate1', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate2', 'labDate2', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate3', 'labDate3', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate4', 'labDate4', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate5', 'labDate5', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate6', 'labDate6', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate7', 'labDate7', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate8', 'labDate8', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate9', 'labDate9', 'trim|xss_clean');
			$this->form_validation->set_rules('labDate10', 'labDate10', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest1', 'labTest1', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest2', 'labTest2', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest3', 'labTest3', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest4', 'labTest4', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest5', 'labTest5', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest6', 'labTest6', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest7', 'labTest7', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest8', 'labTest8', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest9', 'labTest9', 'trim|xss_clean');
			$this->form_validation->set_rules('labTest10', 'labTest10', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult1', 'labResult1', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult2', 'labResult2', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult3', 'labResult3', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult4', 'labResult4', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult5', 'labResult5', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult6', 'labResult6', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult7', 'labResult7', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult8', 'labResult8', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult9', 'labResult9', 'trim|xss_clean');
			$this->form_validation->set_rules('labResult10', 'labResult10', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction1', 'labAction1', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction2', 'labAction2', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction3', 'labAction3', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction4', 'labAction4', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction5', 'labAction5', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction6', 'labAction6', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction7', 'labAction7', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction8', 'labAction8', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction9', 'labAction9', 'trim|xss_clean');
			$this->form_validation->set_rules('labAction10', 'labAction10', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate1', 'illDate1', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate2', 'illDate2', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate3', 'illDate3', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate4', 'illDate4', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate5', 'illDate5', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate6', 'illDate6', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate7', 'illDate7', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate8', 'illDate8', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate9', 'illDate9', 'trim|xss_clean');
			$this->form_validation->set_rules('illDate10', 'illDate10', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge1', 'illAge1', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge2', 'illAge2', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge3', 'illAge3', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge4', 'illAge4', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge5', 'illAge5', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge6', 'illAge6', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge7', 'illAge7', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge8', 'illAge8', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge9', 'illAge9', 'trim|xss_clean');
			$this->form_validation->set_rules('illAge10', 'illAge10', 'trim|xss_clean');
			$this->form_validation->set_rules('illName1', 'illName1', 'trim|xss_clean');
			$this->form_validation->set_rules('illName2', 'illName2', 'trim|xss_clean');
			$this->form_validation->set_rules('illName3', 'illName3', 'trim|xss_clean');
			$this->form_validation->set_rules('illName4', 'illName4', 'trim|xss_clean');
			$this->form_validation->set_rules('illName5', 'illName5', 'trim|xss_clean');
			$this->form_validation->set_rules('illName6', 'illName6', 'trim|xss_clean');
			$this->form_validation->set_rules('illName7', 'illName7', 'trim|xss_clean');
			$this->form_validation->set_rules('illName8', 'illName8', 'trim|xss_clean');
			$this->form_validation->set_rules('illName9', 'illName9', 'trim|xss_clean');
			$this->form_validation->set_rules('illName10', 'illName10', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed1', 'illMed1', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed2', 'illMed2', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed3', 'illMed3', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed4', 'illMed4', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed5', 'illMed5', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed6', 'illMed6', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed7', 'illMed7', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed8', 'illMed8', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed9', 'illMed9', 'trim|xss_clean');
			$this->form_validation->set_rules('illMed10', 'illMed10', 'trim|xss_clean');
			$this->form_validation->set_rules('illActive', 'illActive', 'trim|xss_clean');
			$this->form_validation->set_rules('illCompli', 'illCompli', 'trim|xss_clean');
			$this->form_validation->set_rules('illAccident', 'illAccident', 'trim|xss_clean');
			$this->form_validation->set_rules('medChild', 'medChild', 'trim|xss_clean');
			$this->form_validation->set_rules('medTake', 'medTake', 'trim|xss_clean');
			$this->form_validation->set_rules('medPhysician', 'medPhysician', 'trim|xss_clean');
			$this->form_validation->set_rules('medReason', 'medReason', 'trim|xss_clean');
			$this->form_validation->set_rules('medSeizure', 'medSeizure', 'trim|xss_clean');
			$this->form_validation->set_rules('medChronic', 'medChronic', 'trim|xss_clean');
			$this->form_validation->set_rules('medAllergic', 'medAllergic', 'trim|xss_clean');
			$this->form_validation->set_rules('medAllergicMed', 'medAllergicMed', 'trim|xss_clean');
			$this->form_validation->set_rules('dentalHealth', 'dentalHealth', 'trim|xss_clean');
			$this->form_validation->set_rules('dentalProgress', 'dentalProgress', 'trim|rxss_clean');
			$this->form_validation->set_rules('notesReco', 'notesReco', 'trim|xss_clean');
			$this->form_validation->set_rules('doctor', 'doctor', 'trim|xss_clean');
			$this->form_validation->set_rules('licenseNo', 'licenseNo', 'trim|xss_clean');
			$this->form_validation->set_rules('ptrNo', 'ptrNo', 'trim|xss_clean');
			$this->form_validation->set_rules('hospitalClinic', 'hospitalClinic', 'trim|xss_clean');
			
			
			$data['errors'] = array();

			if ($this->form_validation->run()) 
			{								// validation ok
				if (!is_null($data = $this->tank_auth->create_health_medical(
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('height'),
						$this->form_validation->set_value('weight'),
						$this->form_validation->set_value('headCir'),
						$this->form_validation->set_value('chestCir'),
						$this->form_validation->set_value('abdoCir'),
						$this->form_validation->set_value('hairColor'),
						$this->form_validation->set_value('eyeColor'),
						$this->form_validation->set_value('skinColor'),
						$this->form_validation->set_value('presentLoc'),
						$this->form_validation->set_value('presentApp'),
						$this->form_validation->set_value('admissionApp'),
						$this->form_validation->set_value('yearMonth1'),
						$this->form_validation->set_value('yearMonth2'),
						$this->form_validation->set_value('yearMonth3'),
						$this->form_validation->set_value('yearMonth4'),
						$this->form_validation->set_value('yearMonth5'),
						$this->form_validation->set_value('yearMonth6'),
						$this->form_validation->set_value('yearMonth7'),
						$this->form_validation->set_value('yearMonth8'),
						$this->form_validation->set_value('yearMonth9'),
						$this->form_validation->set_value('yearMonth10'),
						$this->form_validation->set_value('ageMonth1'),
						$this->form_validation->set_value('ageMonth2'),
						$this->form_validation->set_value('ageMonth3'),
						$this->form_validation->set_value('ageMonth4'),
						$this->form_validation->set_value('ageMonth5'),
						$this->form_validation->set_value('ageMonth6'),
						$this->form_validation->set_value('ageMonth7'),
						$this->form_validation->set_value('ageMonth8'),
						$this->form_validation->set_value('ageMonth9'),
						$this->form_validation->set_value('ageMonth10'),
						$this->form_validation->set_value('weightKilos1'),
						$this->form_validation->set_value('weightKilos2'),
						$this->form_validation->set_value('weightKilos3'),
						$this->form_validation->set_value('weightKilos4'),
						$this->form_validation->set_value('weightKilos5'),
						$this->form_validation->set_value('weightKilos6'),
						$this->form_validation->set_value('weightKilos7'),
						$this->form_validation->set_value('weightKilos8'),
						$this->form_validation->set_value('weightKilos9'),
						$this->form_validation->set_value('weightKilos10'),
						$this->form_validation->set_value('lengthHeight1'),
						$this->form_validation->set_value('lengthHeight2'),
						$this->form_validation->set_value('lengthHeight3'),
						$this->form_validation->set_value('lengthHeight4'),
						$this->form_validation->set_value('lengthHeight5'),
						$this->form_validation->set_value('lengthHeight6'),
						$this->form_validation->set_value('lengthHeight7'),
						$this->form_validation->set_value('lengthHeight8'),
						$this->form_validation->set_value('lengthHeight9'),
						$this->form_validation->set_value('lengthHeight10'),
						$this->form_validation->set_value('HCcm1'),
						$this->form_validation->set_value('HCcm2'),
						$this->form_validation->set_value('HCcm3'),
						$this->form_validation->set_value('HCcm4'),
						$this->form_validation->set_value('HCcm5'),
						$this->form_validation->set_value('HCcm6'),
						$this->form_validation->set_value('HCcm7'),
						$this->form_validation->set_value('HCcm8'),
						$this->form_validation->set_value('HCcm9'),
						$this->form_validation->set_value('HCcm10'),
						$this->form_validation->set_value('CCcm1'),
						$this->form_validation->set_value('CCcm2'),
						$this->form_validation->set_value('CCcm3'),
						$this->form_validation->set_value('CCcm4'),
						$this->form_validation->set_value('CCcm5'),
						$this->form_validation->set_value('CCcm6'),
						$this->form_validation->set_value('CCcm7'),
						$this->form_validation->set_value('CCcm8'),
						$this->form_validation->set_value('CCcm9'),
						$this->form_validation->set_value('CCcm10'),
						$this->form_validation->set_value('teeth1'),
						$this->form_validation->set_value('teeth2'),
						$this->form_validation->set_value('teeth3'),
						$this->form_validation->set_value('teeth4'),
						$this->form_validation->set_value('teeth5'),
						$this->form_validation->set_value('teeth6'),
						$this->form_validation->set_value('teeth7'),
						$this->form_validation->set_value('teeth8'),
						$this->form_validation->set_value('teeth9'),
						$this->form_validation->set_value('teeth10'),
						$this->form_validation->set_value('marksPhy'),
						$this->form_validation->set_value('obserHead'),
						$this->form_validation->set_value('obserEyes'),
						$this->form_validation->set_value('obserNose'),
						$this->form_validation->set_value('obserEars'),
						$this->form_validation->set_value('obserMouth'),
						$this->form_validation->set_value('obserNeck'),
						$this->form_validation->set_value('obserChest'),
						$this->form_validation->set_value('obserAbdo'),
						$this->form_validation->set_value('obserGen'),
						$this->form_validation->set_value('obserSpinal'),
						$this->form_validation->set_value('obserExtre'),
						$this->form_validation->set_value('obserPulse'),
						$this->form_validation->set_value('obserBlood'),
						$this->form_validation->set_value('obserNer'),
						$this->form_validation->set_value('obserRes'),
						$this->form_validation->set_value('obserSkin'),
						$this->form_validation->set_value('abnoHead'),
						$this->form_validation->set_value('abnoEyes'),
						$this->form_validation->set_value('abnoNose'),
						$this->form_validation->set_value('abnoEars'),
						$this->form_validation->set_value('abnoMouth'),
						$this->form_validation->set_value('abnoNeck'),
						$this->form_validation->set_value('abnoChest'),
						$this->form_validation->set_value('abnoAdbo'),
						$this->form_validation->set_value('abnoGen'),
						$this->form_validation->set_value('abnoSpinal'),
						$this->form_validation->set_value('abnoExtre'),
						$this->form_validation->set_value('abnoPulse'),
						$this->form_validation->set_value('abnoBlood'),
						$this->form_validation->set_value('abnoNer'),
						$this->form_validation->set_value('abnoRes'),
						$this->form_validation->set_value('abnoSkin'),
						$this->form_validation->set_value('gestationAge'),
						$this->form_validation->set_value('fullTerm'),
						$this->form_validation->set_value('preMature'),
						$this->form_validation->set_value('normalDel'),
						$this->form_validation->set_value('caesarianDel'),
						$this->form_validation->set_value('forcep'),
						$this->form_validation->set_value('bornAt'),
						$this->form_validation->set_value('deliverBy'),
						$this->form_validation->set_value('deliverName'),
						$this->form_validation->set_value('compli'),
						$this->form_validation->set_value('weightBirth'),
						$this->form_validation->set_value('lengthBirth'),
						$this->form_validation->set_value('headCirBirth'),
						$this->form_validation->set_value('chestCirBirth'),
						$this->form_validation->set_value('apgarScore'),
						$this->form_validation->set_value('abnormalBirth'),
						$this->form_validation->set_value('dateBCG'),
						$this->form_validation->set_value('physiBCG'),
						$this->form_validation->set_value('dateDPT1'),
						$this->form_validation->set_value('physiDPT1'),
						$this->form_validation->set_value('dateDPT2'),
						$this->form_validation->set_value('physiDPT2'),
						$this->form_validation->set_value('dateDPT3'),
						$this->form_validation->set_value('physiDPT3'),
						$this->form_validation->set_value('dateDPTBoos'),
						$this->form_validation->set_value('physiDPTBoos'),
						$this->form_validation->set_value('dateOPV1'),
						$this->form_validation->set_value('physiOPV1'),
						$this->form_validation->set_value('dateOPV2'),
						$this->form_validation->set_value('physiOPV2'),
						$this->form_validation->set_value('dateOPV3'),
						$this->form_validation->set_value('physiOPV3'),
						$this->form_validation->set_value('dateOPVBoos'),
						$this->form_validation->set_value('physiOPVBoos'),
						$this->form_validation->set_value('dateMeas'),
						$this->form_validation->set_value('physiMeas'),
						$this->form_validation->set_value('dateMMR'),
						$this->form_validation->set_value('physiMMR'),
						$this->form_validation->set_value('dateHIB1'),
						$this->form_validation->set_value('physiHIB1'),
						$this->form_validation->set_value('dateHIB2'),
						$this->form_validation->set_value('physiHIB2'),
						$this->form_validation->set_value('dateHIB3'),
						$this->form_validation->set_value('physiHIB3'),
						$this->form_validation->set_value('dateHIBBoos'),
						$this->form_validation->set_value('physiHIBBoos'),
						$this->form_validation->set_value('dateHepa1'),
						$this->form_validation->set_value('physiHepa1'),
						$this->form_validation->set_value('dateHepa2'),
						$this->form_validation->set_value('physiHepa2'),
						$this->form_validation->set_value('dateHepa3'),
						$this->form_validation->set_value('physiHepa3'),
						$this->form_validation->set_value('dateHepaBoos'),
						$this->form_validation->set_value('physiHepaBoos'),
						$this->form_validation->set_value('dateOth'),
						$this->form_validation->set_value('physiOth'),
						$this->form_validation->set_value('labDate1'),
						$this->form_validation->set_value('labDate2'),
						$this->form_validation->set_value('labDate3'),
						$this->form_validation->set_value('labDate4'),
						$this->form_validation->set_value('labDate5'),
						$this->form_validation->set_value('labDate6'),
						$this->form_validation->set_value('labDate7'),
						$this->form_validation->set_value('labDate8'),
						$this->form_validation->set_value('labDate9'),
						$this->form_validation->set_value('labDate10'),
						$this->form_validation->set_value('labTest1'),
						$this->form_validation->set_value('labTest2'),
						$this->form_validation->set_value('labTest3'),
						$this->form_validation->set_value('labTest4'),
						$this->form_validation->set_value('labTest5'),
						$this->form_validation->set_value('labTest6'),
						$this->form_validation->set_value('labTest7'),
						$this->form_validation->set_value('labTest8'),
						$this->form_validation->set_value('labTest9'),
						$this->form_validation->set_value('labTest10'),
						$this->form_validation->set_value('labResult1'),
						$this->form_validation->set_value('labResult2'),
						$this->form_validation->set_value('labResult3'),
						$this->form_validation->set_value('labResult4'),
						$this->form_validation->set_value('labResult5'),
						$this->form_validation->set_value('labResult6'),
						$this->form_validation->set_value('labResult7'),
						$this->form_validation->set_value('labResult8'),
						$this->form_validation->set_value('labResult9'),
						$this->form_validation->set_value('labResult10'),
						$this->form_validation->set_value('labAction1'),
						$this->form_validation->set_value('labAction2'),
						$this->form_validation->set_value('labAction3'),
						$this->form_validation->set_value('labAction4'),
						$this->form_validation->set_value('labAction5'),
						$this->form_validation->set_value('labAction6'),
						$this->form_validation->set_value('labAction7'),
						$this->form_validation->set_value('labAction8'),
						$this->form_validation->set_value('labAction9'),
						$this->form_validation->set_value('labAction10'),
						$this->form_validation->set_value('illDate1'),
						$this->form_validation->set_value('illDate2'),
						$this->form_validation->set_value('illDate3'),
						$this->form_validation->set_value('illDate4'),
						$this->form_validation->set_value('illDate5'),
						$this->form_validation->set_value('illDate6'),
						$this->form_validation->set_value('illDate7'),
						$this->form_validation->set_value('illDate8'),
						$this->form_validation->set_value('illDate9'),
						$this->form_validation->set_value('illDate10'),
						$this->form_validation->set_value('illAge1'),
						$this->form_validation->set_value('illAge2'),
						$this->form_validation->set_value('illAge3'),
						$this->form_validation->set_value('illAge4'),
						$this->form_validation->set_value('illAge5'),
						$this->form_validation->set_value('illAge6'),
						$this->form_validation->set_value('illAge7'),
						$this->form_validation->set_value('illAge8'),
						$this->form_validation->set_value('illAge9'),
						$this->form_validation->set_value('illAge10'),
						$this->form_validation->set_value('illName1'),
						$this->form_validation->set_value('illName2'),
						$this->form_validation->set_value('illName3'),
						$this->form_validation->set_value('illName4'),
						$this->form_validation->set_value('illName5'),
						$this->form_validation->set_value('illName6'),
						$this->form_validation->set_value('illName7'),
						$this->form_validation->set_value('illName8'),
						$this->form_validation->set_value('illName9'),
						$this->form_validation->set_value('illName10'),
						$this->form_validation->set_value('illMed1'),
						$this->form_validation->set_value('illMed2'),
						$this->form_validation->set_value('illMed3'),
						$this->form_validation->set_value('illMed4'),
						$this->form_validation->set_value('illMed5'),
						$this->form_validation->set_value('illMed6'),
						$this->form_validation->set_value('illMed7'),
						$this->form_validation->set_value('illMed8'),
						$this->form_validation->set_value('illMed9'),
						$this->form_validation->set_value('illMed10'),
						$this->form_validation->set_value('illActive'),
						$this->form_validation->set_value('illCompli'),
						$this->form_validation->set_value('illAccident'),
						$this->form_validation->set_value('medChild'),
						$this->form_validation->set_value('medTake'),
						$this->form_validation->set_value('medPhysician'),
						$this->form_validation->set_value('medReason'),
						$this->form_validation->set_value('medSeizure'),
						$this->form_validation->set_value('medChronic'),
						$this->form_validation->set_value('medAllergic'),
						$this->form_validation->set_value('medAllergicMed'),
						$this->form_validation->set_value('dentalHealth'),
						$this->form_validation->set_value('dentalProgress'),
						$this->form_validation->set_value('notesReco'),
						$this->form_validation->set_value('doctor'),
						$this->form_validation->set_value('licenseNo'),
						$this->form_validation->set_value('ptrNo'),
						$this->form_validation->set_value('hospitalClinic')))) 
					{		

						$this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						$data['$client_id'] = $this->form_validation->set_value('client_id');
						$this->load->view("Nurse/nurse_medical", $data);
						$this->load->view('header_footer/nurse_footer');
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			} else {
				$data['$client_id'] = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($client_id);	
				$this->load->view('Forms/nurse_medical', $data);
				$this->load->view('header_footer/nurse_footer');
			}
		}
	}
	
	function before_measurements()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		if($this->form_validation->run())
		{	

			$this->get_notifications();
			$data['client_id'] = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($data['client_id'] );
			$this->load->view('nurse/update_Measurements', $data);
			$this->load->view('header_footer/nurse_footer');
		}
	}

	function update_measurements()
	{

		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('height', 'height', 'trim|xss_clean');
		$this->form_validation->set_rules('weight', 'weight', 'trim|xss_clean');
		$this->form_validation->set_rules('headCir', 'headCir', 'trim|xss_clean');
		$this->form_validation->set_rules('chestCir', 'chestCir', 'trim|xss_clean');
		$this->form_validation->set_rules('abdoCir', 'abdoCir', 'trim|xss_clean');
		$this->form_validation->set_rules('hairColor', 'hairColor', 'trim|xss_clean');
		$this->form_validation->set_rules('eyeColor', 'eyeColor', 'trim|xss_clean');
		$this->form_validation->set_rules('skinColor', 'skinColor', 'trim|xss_clean');
		$this->form_validation->set_rules('presentLoc', 'presentLoc', 'trim|xss_clean');

		if($this->form_validation->run())
		{	

			$this->get_notifications();
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$this->tank_auth->update_measurements($this->form_validation->set_value('client_id'),
			$this->form_validation->set_value('height'),
			$this->form_validation->set_value('weight'),
			$this->form_validation->set_value('headCir'),
			$this->form_validation->set_value('chestCir'),
			$this->form_validation->set_value('abdoCir'),
			$this->form_validation->set_value('hairColor'),
			$this->form_validation->set_value('eyeColor'),
			$this->form_validation->set_value('skinColor'),
			$this->form_validation->set_value('presentLoc'));

				echo "<script>javascript:alert('Measurements have been updated');</script>";
		}
	}

	function before_lab()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{	
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$this->get_notifications();
			$this->load->view('nurse/update_laboratory_test', $data);
			$this->load->view('header_footer/nurse_footer');
		}
	}

	function update_lab()
	{
		$i = 0;
		$labTest = $this->input->post('labTest');
		$labDate = $this->input->post('labDate');
		$labResult = $this->input->post('labResult');
		$labAction = $this->input->post('labAction');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{
			$data['client_id'] = $this->form_validation->set_value('client_id');
			foreach($labTest as $enrty)
			{

				$this->tank_auth->insert_lab_test($data['client_id'], 
					$labDate[$i], 
					$labTest[$i], 
					$labResult[$i], 
					$labAction[$i]);
				$i = $i + 1;
			}

				echo "<script>javascript:alert('Lab results have been posted');</script>";
		}
	}

	function before_illness()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{	
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$this->get_notifications();
			$this->load->view('nurse/update_illnesses', $data);
			$this->load->view('header_footer/nurse_footer');
		}
	}

	function update_illness()
	{
		$i = 0;
		$illAge = $this->input->post('illAge');
		$illDate = $this->input->post('illDate');
		$illName = $this->input->post('illName');
		$illMed = $this->input->post('illMed');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{
			$data['client_id'] = $this->form_validation->set_value('client_id');
			foreach($illDate as $enrty)
			{

				$this->tank_auth->insert_illnesses($data['client_id'], 
					$illDate[$i], 
					$illAge[$i], 
					$illName[$i], 
					$illMed[$i]);
				$i = $i + 1;
			}

				echo "<script>javascript:alert('Illnesses have been posted'); window.location='nurse_medical';</script>";
		}
	}
//Cham
	function health_profile()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/client_med_profile', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}
//initial view
	function measurement()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/Measurements', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}
//initial submit
	function initial_medical_submit()
	{$client_id = $this->input->post('client_id');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bloodP', 'bloodP', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pulseRate', 'pulseRate', 'trim|required|xss_clean');
		$this->form_validation->set_rules('height', 'height', 'trim|required|xss_clean');
		$this->form_validation->set_rules('weight', 'weight', 'trim|required|xss_clean');
		$this->form_validation->set_rules('temperature', 'temperature', 'trim|required|xss_clean');
		$this->form_validation->set_rules('respiRate', 'respiRate', 'trim|required|xss_clean');
		$this->form_validation->set_rules('headCir', 'headCir', 'trim|xss_clean');
		$this->form_validation->set_rules('chestCir', 'chestCir', 'trim|xss_clean');
		$this->form_validation->set_rules('abdoCir', 'abdoCir', 'trim|xss_clean');
		
		$user_id = $this->tank_auth->get_user_id();

		if($this->form_validation->run())
		{	

			$this->get_notifications();
			$client_id = $data['client_id'] = $this->form_validation->set_value('client_id');
			$this->tank_auth->insert_measurements($this->form_validation->set_value('client_id'),
			$this->form_validation->set_value('bloodP'),
			$this->form_validation->set_value('pulseRate'),
			$this->form_validation->set_value('height'),
			$this->form_validation->set_value('weight'),
			$this->form_validation->set_value('temperature'),
			$this->form_validation->set_value('respiRate'),
			$this->form_validation->set_value('headCir'),
			$this->form_validation->set_value('chestCir'),
			$this->form_validation->set_value('abdoCir'),
			$user_id);

			$data['client_info'] = $this->clients->get_client_by_id($client_id);	
			
			$this->load->view('nurse/Present_condition', $data);
			$this->load->view('header_footer/nurse_footer');
		}
		else {
				$data['client_info'] = $this->clients->get_client_by_id($client_id);	
				$this->get_notifications();
				$this->load->view('nurse/Measurements', $data);
				$this->load->view('header_footer/nurse_footer');
		}
	}

	function present_submit()
	{$client_id = $this->input->post('client_id');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('presentApp', 'presentApp', 'trim|xss_clean');
		$this->form_validation->set_rules('admissionApp', 'admissionApp', 'trim|required|xss_clean');
		$this->form_validation->set_rules('marksPhy', 'marksPhy', 'trim|xss_clean');
		$this->form_validation->set_rules('hairColor', 'hairColor', 'trim|required|xss_clean');
		$this->form_validation->set_rules('eyeColor', 'eyeColor', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skinColor', 'skinColor', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $data['client_id'] = $this->form_validation->set_value('client_id');
			$this->tank_auth->insert_present($this->form_validation->set_value('client_id'),
				$this->form_validation->set_value('presentApp'),
				$this->form_validation->set_value('admissionApp'),
				$this->form_validation->set_value('marksPhy'),
				$this->form_validation->set_value('hairColor'),
				$this->form_validation->set_value('eyeColor'),
				$this->form_validation->set_value('skinColor'));
			
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/Birth_info', $data);
			$this->load->view('header_footer/nurse_footer');
		}
		else {
				$data['client_info'] = $this->clients->get_client_by_id($client_id);
				$this->get_notifications();	
			$this->load->view('nurse/Present_condition', $data);
			$this->load->view('header_footer/nurse_footer');
		}
	}

	function insert_birth_history()
	{$client_id = $this->input->post('client_id');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');


		$this->form_validation->set_rules('forcep', 'forcep', 'trim|xss_clean');
		$this->form_validation->set_rules('bornAt', 'bornAt', 'trim|xss_clean');
		$this->form_validation->set_rules('deliverBy', 'deliverBy', 'trim|xss_clean');
		$this->form_validation->set_rules('deliverName', 'deliverName', 'trim|xss_clean');
		$this->form_validation->set_rules('compli', 'compli', 'trim|xss_clean');
		$this->form_validation->set_rules('weightBirth', 'weightBirth', 'trim|xss_clean');
		$this->form_validation->set_rules('lengthBirth', 'lengthBirth', 'trim|xss_clean');
		$this->form_validation->set_rules('headCirBirth', 'headCirBirth', 'trim|xss_clean');
		$this->form_validation->set_rules('chestCirBirth', 'chestCirBirth', 'trim|xss_clean');
		$this->form_validation->set_rules('apgarScore', 'apgarScore', 'trim|xss_clean');
		$this->form_validation->set_rules('abnormalBirth', 'abnormalBirth', 'trim|xss_clean');

		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$this->tank_auth->insert_birth_history(
			$this->form_validation->set_value('client_id'),

			$this->form_validation->set_value('forcep'),
			$this->form_validation->set_value('bornAt'),
			$this->form_validation->set_value('deliverBy'),
			$this->form_validation->set_value('deliverName'),
			$this->form_validation->set_value('compli'),
			$this->form_validation->set_value('weightBirth'),
			$this->form_validation->set_value('lengthBirth'),
			$this->form_validation->set_value('headCirBirth'),
			$this->form_validation->set_value('chestCirBirth'),
			$this->form_validation->set_value('apgarScore'),
			$this->form_validation->set_value('abnormalBirth')
			);
			
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('Nurse/immunizations', $data);
			$this->load->view('header_footer/socialw_footer');
		}
		else {
				$data['client_info'] = $this->clients->get_client_by_id($client_id);
				$this->get_notifications();
				$this->load->view('nurse/Birth_info', $data);
				$this->load->view('header_footer/nurse_footer');
		}
	}

	function insert_immunizations()
	{
		$i = 0;
		$immunizations = $this->input->post('Immunization');
		$immunization_date = $this->input->post('immunization_date');
		$immunization_physician = $this->input->post('immunization_physician');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{
			$client_id = $data['client_id'] = $this->form_validation->set_value('client_id');
			if($immunizations != null)
			{
				foreach($immunizations as $enrty)
				{

					$this->tank_auth->insert_immunizations($data['client_id'], 
						$immunizations[$i], 
						$immunization_date[$i], 
						$immunization_physician[$i]);
					$i = $i + 1;
				}
				
			}

			echo "<script>alert('initial medical check up accomplished');</script>";
			$user_id = $this->tank_auth->get_user_id();
				$data['client_info'] = $this->clients->get_client_by_id($client_id);
				$data['client_id'] = $this->form_validation->set_value('client_id');
				$this->get_notifications();
				$this->load->view('nurse/client_med_profile', $data);
				$this->load->view('header_footer/nurse_footer');
		}

	}
//health_med view
	function measure_update()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['measure_info'] = $this->clients->get_measure_latest($client_id);

			$this->load->view('nurse/measure_up', $data);
			$this->load->view('header_footer/nurse_footer');

 		}
		else
		{
			echo 'lol';
		}
	}

	function appearance_update()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['app_info'] = $this->clients->get_app_latest($client_id);
			$this->load->view('nurse/appearance_up', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function birth_update()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['birth_info'] = $this->clients->get_birth_latest($client_id);
			$this->load->view('nurse/birth_up', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function immunization_update()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['immu_info'] = $this->clients->get_immu_latest($client_id);
			$this->load->view('nurse/immunization_up', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}
	function growth_record()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['growth_info'] = $this->clients->get_growth_latest($client_id);
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/Growth_records', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function laboratory_exam()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['lab_info'] = $this->clients->get_lab_latest($client_id);
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/laboratory_test', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function list_illness()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['ill_info'] = $this->clients->get_ill_latest($client_id);
			$data['ill_bg_info'] = $this->clients->get_ill_bg_latest($client_id);
			
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/illnesses', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function medical_condition()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/medical_problems', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function notes_recommendation()
	{
		$user_id = $this->tank_auth->get_user_id();
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['note_info'] = $this->clients->get_note_latest($client_id);
			$data['doc_info'] = $this->users->get_user_info_by_id($user_id);
			$this->load->view('nurse/Notes_Recommendations', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}
//health_med submit
	function measurement_submit()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bloodP', 'bloodP', 'trim|xss_clean');
		$this->form_validation->set_rules('pulseRate', 'pulseRate', 'trim|xss_clean');
		$this->form_validation->set_rules('height', 'height', 'trim|xss_clean');
		$this->form_validation->set_rules('weight', 'weight', 'trim|xss_clean');
		$this->form_validation->set_rules('temperature', 'temperature', 'trim|xss_clean');
		$this->form_validation->set_rules('respiRate', 'respiRate', 'trim|xss_clean');
		$this->form_validation->set_rules('headCir', 'headCir', 'trim|xss_clean');
		$this->form_validation->set_rules('chestCir', 'chestCir', 'trim|xss_clean');
		$this->form_validation->set_rules('abdoCir', 'abdoCir', 'trim|xss_clean');
		$user_id = $this->tank_auth->get_user_id();

		if($this->form_validation->run())
		{	

			$this->get_notifications();
			$client_id = $data['client_id'] = $this->form_validation->set_value('client_id');
			$this->tank_auth->insert_measurements($this->form_validation->set_value('client_id'),
			$this->form_validation->set_value('bloodP'),
			$this->form_validation->set_value('pulseRate'),
			$this->form_validation->set_value('height'),
			$this->form_validation->set_value('weight'),
			$this->form_validation->set_value('temperature'),
			$this->form_validation->set_value('respiRate'),
			$this->form_validation->set_value('headCir'),
			$this->form_validation->set_value('chestCir'),
			$this->form_validation->set_value('abdoCir'),
			$user_id);

			$data['client_info'] = $this->clients->get_client_by_id($client_id);	
			
			$this->load->view('nurse/client_med_profile', $data);
			$this->load->view('header_footer/nurse_footer');
			echo "<script>alert('measurements updated'); </script>";
		}
		else {
				$data['client_info'] = $this->clients->get_client_by_id($client_id);	
				$this->load->view('nurse/client_med_profile', $data);
				$this->load->view('header_footer/nurse_footer');
		}
	}

	function p_condition_submit()
	{$client_id = $this->input->post('client_id');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('presentApp', 'presentApp', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admissionApp', 'admissionApp', 'trim|xss_clean');
		$this->form_validation->set_rules('marksPhy', 'marksPhy', 'trim|xss_clean');
		$this->form_validation->set_rules('hairColor', 'hairColor', 'trim|xss_clean');
		$this->form_validation->set_rules('eyeColor', 'eyeColor', 'trim|xss_clean');
		$this->form_validation->set_rules('skinColor', 'skinColor', 'trim|xss_clean');

		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $data['client_id'] = $this->form_validation->set_value('client_id');
			$this->tank_auth->insert_present($this->form_validation->set_value('client_id'),
				$this->form_validation->set_value('presentApp'),
				$this->form_validation->set_value('admissionApp'),
				$this->form_validation->set_value('marksPhy'),
				$this->form_validation->set_value('hairColor'),
				$this->form_validation->set_value('eyeColor'),
				$this->form_validation->set_value('skinColor'));
			
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/client_med_profile', $data);
			$this->load->view('header_footer/nurse_footer');
		}
		else {
				$data['client_info'] = $this->clients->get_client_by_id($client_id);	
				$data['app_info'] = $this->clients->get_app_latest($client_id);
				$this->get_notifications();
				$this->load->view('nurse/appearance_up', $data);
				$this->load->view('header_footer/nurse_footer');
		}
	}

	function impairment_submit()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		
		$i = 0;
		$yearMonth = $this->input->post('yearMonth');
		$ageMonth = $this->input->post('ageMonth');
		$weightKilos = $this->input->post('weightKilos');
		$lengthHeight = $this->input->post('lengthHeight');
		$HCcm = $this->input->post('HCcm');
		$CCcm = $this->input->post('CCcm');
		$teeth = $this->input->post('teeth');

		$x = 0;
		$body_part = $this->input->post('body_part');
		$observation = $this->input->post('observation');
		if($this->form_validation->run())
		{	
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$this->get_notifications();
			

			foreach($yearMonth as $enrty)
			{

				$this->tank_auth->insert_growth_record($data['client_id'], 
					$yearMonth[$i], 
					$ageMonth[$i], 
					$weightKilos[$i],
					$lengthHeight[$i], 
					$HCcm[$i],
					$CCcm[$i], 
					$teeth[$i]);
				$i = $i + 1;
			}

			foreach($body_part as $entry)
			{

				$this->tank_auth->insert_impairment($data['client_id'], 
					$body_part[$x], 
					$observation[$x]);
				$x = $x + 1;
			}
			
			$this->load->view('nurse/client_med_profile', $data);
			$this->load->view('header_footer/nurse_footer');
		}
		else {
				$data['client_id'] = $this->form_validation->set_value('client_id');
				$this->load->view('nurse/client_med_profile', $data);
				$this->load->view('header_footer/nurse_footer');
		}
	}

	function insert_lab_test()
	{
		$i = 0;
		$labTest = $this->input->post('labTest');
		$labDate = $this->input->post('labDate');
		$labResult = $this->input->post('labResult');
		$labAction = $this->input->post('labAction');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');
		if($this->form_validation->run())
		{
			$data['client_id'] = $this->form_validation->set_value('client_id');
			foreach($labTest as $enrty)
			{

				$this->tank_auth->insert_lab_test($data['client_id'], 
					$labDate[$i], 
					$labTest[$i], 
					$labResult[$i], 
					$labAction[$i]);
				$i = $i + 1;
			}
			$this->get_notifications();
			$data['client_info'] = $this->clients->get_client_by_id($data['client_id']);
			$this->load->view('nurse/client_med_profile', $data);
			$this->load->view('header_footer/nurse_footer');
		}
	}

	function insert_illnesses()
	{
		$this->form_validation->set_rules('illActive', 'illActive', 'xss_clean|trim');
		$this->form_validation->set_rules('illCompli', 'illCompli', 'xss_clean|trim');


		$i = 0;
		$illAge = $this->input->post('illAge');
		$illDate = $this->input->post('illDate');
		$illName = $this->input->post('illName');
		$illMed = $this->input->post('illMed');
		$this->form_validation->set_rules('client_id', 'client_id', 'xss_clean|trim');

		$x = 0;
		$misDate = $this->input->post('misDate');
		$misDesc = $this->input->post('misDesc');
		$misEff = $this->input->post('misEff');
		$misClass = $this->input->post('misClass');


		if($this->form_validation->run())
		{
			$data['client_id'] = $this->form_validation->set_value('client_id');


			$this->tank_auth->insert_illnesses_bg($data['client_id'], 
				$this->form_validation->set_value('illActive'),
				$this->form_validation->set_value('illCompli'));

			foreach($illName as $enrty)
			{

				$this->tank_auth->insert_illnesses($data['client_id'], 
					$illDate[$i], 
					$illAge[$i], 
					$illName[$i], 
					$illMed[$i]);
				$i = $i + 1;
			}
			foreach($misDate as $entry)
			{

				$this->tank_auth->insert_mishap($data['client_id'], 
					$misDate[$i], 
					$misDesc[$i], 
					$misEff[$i], 
					$misClass[$i]);
				$x = $x + 1;
			}

			$this->get_notifications();
			$this->load->view('nurse/client_med_profile', $data);
			$this->load->view('header_footer/nurse_footer');
		}
	}

	function insert_medical_problems()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('medClient', 'medClient', 'trim|xss_clean');
		$this->form_validation->set_rules('medTake', 'medTake', 'trim|xss_clean');
		$this->form_validation->set_rules('medPhysician', 'medPhysician', 'trim|xss_clean');
		$this->form_validation->set_rules('medReason', 'medReason', 'trim|xss_clean');
		$this->form_validation->set_rules('medSeizure', 'medSeizure', 'trim|xss_clean');
		$this->form_validation->set_rules('medChronic', 'medChronic', 'trim|xss_clean');
		$this->form_validation->set_rules('medAllergic', 'medAllergic', 'trim|xss_clean');
		$this->form_validation->set_rules('medAllergicMed', 'medAllergicMed', 'trim|xss_clean');
		$this->form_validation->set_rules('dentalHealth', 'dentalHealth', 'trim|xss_clean');
		$this->form_validation->set_rules('dentalProgress', 'dentalProgress', 'trim|xss_clean');
			if($this->form_validation->run())
		{	
			$this->get_notifications();
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$this->tank_auth->insert_medical_problems(
			 	$this->form_validation->set_value('client_id'),
				$this->form_validation->set_value('medClient'),
				$this->form_validation->set_value('medTake'),
				$this->form_validation->set_value('medPhysician'),
				$this->form_validation->set_value('medReason'),
				$this->form_validation->set_value('medSeizure'),
				$this->form_validation->set_value('medChronic'),
				$this->form_validation->set_value('medAllergic'),
				$this->form_validation->set_value('medAllergicMed'),
				$this->form_validation->set_value('dentalHealth'),
				$this->form_validation->set_value('dentalProgress'));
		$data['client_info'] = $this->clients->get_client_by_id($data['client_id']);	
			$this->load->view('nurse/client_med_profile', $data);
			$this->load->view('header_footer/nurse_footer');
		}
		else {
				$data['client_info'] = $this->clients->get_client_by_id($client_id);	
				$this->load->view('nurse/client_med_profile', $data);
				$this->load->view('header_footer/nurse_footer');
		}
	}

	function insert_notes_recommendation()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('notesReco', 'notesReco', 'trim|xss_clean');
		$data['doc_id']	= $this->tank_auth->get_user_id();
		
			if($this->form_validation->run())
		{	
			$this->get_notifications();
			$data['client_id'] = $this->form_validation->set_value('client_id');
			$data = $this->tank_auth->insert_notes_recommendation($this->form_validation->set_value('client_id'),
				$this->form_validation->set_value('notesReco'),
				$this->form_validation->set_value('doc_id')
				);
		
			echo "<script>javascript:alert('Health medical record submitted'); window.location = 'get_conferences'</script>";
			$this->load->view('header_footer/nurse_footer');
		}
		else {
				$data['client_info'] = $this->clients->get_client_by_id($client_id);	
				$this->load->view('Forms/medical_part1', $data);
				$this->load->view('header_footer/nurse_footer');
		}
	}
//history
	function health_history()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$this->load->view('nurse/client_med_history', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function measure_history()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['measure_info'] = $this->clients->get_all_measure($client_id);

			$this->load->view('nurse/measurement_history', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function growth_record_history()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['growth_info'] = $this->clients->get_all_growth($client_id);
			$data['impair_info'] = $this->clients->get_all_impair($client_id);
			$this->load->view('nurse/growth_record_history', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function immunization_history()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['immu_info'] = $this->clients->get_all_immu($client_id);
			
			$this->load->view('nurse/immunization_history', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function laboratory_exam_history()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['lab_info'] = $this->clients->get_all_lab($client_id);
			
			$this->load->view('nurse/laboratory_exam_history', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function list_illness_history()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['ill_info'] = $this->clients->get_all_ill($client_id);
			
			$this->load->view('nurse/list_illness_history', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function notes_recommendation_history()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$client_id = $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($client_id);
			$data['note_info'] = $this->clients->get_all_growth($client_id);
			
			$this->load->view('nurse/notes_recommendation_history', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}
	
// ADMIN

	function admin_dashboard()
	{
		$data['role']		= $this->tank_auth->get_role();
		$data['user_id']	= $this->tank_auth->get_user_id();

		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		elseif($data['role'] != 0)
		{
			redirect('');
		}
		else
		{

			$data['Dorm_count'] = $this->users->dorm_counter_admin();
			$data['Conference_count'] = $this->users->conference_counter_admin();

			$data['Pending_client_count'] = $this->clients->get_pending_clients();
			$data['Custody_client_count'] = $this->clients->get_all_clients_admin();
			$data['Discharge_client_count'] = $this->clients->get_pending_discharge();

			$data['pending_count'] = $this->users->get_pending_count_admin();
			$data['custody_count'] = $this->users->get_cutody_count_admin();
			$data['discharge_count'] = $this->users->get_discharge_count_admin();
			
			$data['Messages'] = $this->messages->get_messages($data['user_id']);
			$this->get_notifications();
			$this->load->view('Admin/admin_dashboard', $data);
			$this->load->view('header_footer/admin_footer');
		}
	}

	function Admin_Pending_Clients()
	{
		$data['role']		= $this->tank_auth->get_role();
		$data['user_id']	= $this->tank_auth->get_user_id();

		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		elseif($data['role'] != 0)
		{
			redirect('');
		}
		else
		{
		$data['Pending_Clients'] = $this->clients->get_pending_clients();
		$data['Social_Workers']		= $this->users->get_Social_Workers();

		$this->get_notifications();
		$this->load->view('Admin/Admin_Pending_Clients', $data);
		$this->load->view('header_footer/Admin_footer');
		}
	}

	function Admin_Client_approval()
	{
		$conference_id = null;
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{
			$client_id = $this->form_validation->set_value('client_id');
		
			if($this->users->client_has_minutes($conference_id, $client_id))
			{
				echo "<script>javascript:alert('Client has not yet been discussed in a pre-admission case conference');</script>";
					$data['role'] = $this->tank_auth->get_role();
					$data['pre_admission_page_details'] = $this->clients->get_client_by_id($client_id);
					$this->pending_client_page($client_id);

			}
			elseif($this->clients->client_has_initial_case($client_id))
			{
					echo "<script>javascript:alert('Social worker has not accomplished the initial social case study report');</script>";
					$data['role'] = $this->tank_auth->get_role();
					$data['pre_admission_page_details'] = $this->clients->get_client_by_id($client_id);
					$this->pending_client_page($client_id);
			}
			else
			{
				$this->clients->Accept_Client($client_id);
				echo "<script>javascript:alert('Client has been Accepted'); window.location = 'Admin_social_case'</script>";
			}
			
				
	
			
		}
	}
	function Admin_Client_reject()
	{$conference_id = null;
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{
			$client_id = $this->form_validation->set_value('client_id');

			if(!$this->users->client_has_minutes($conference_id, $client_id))
			{
				echo "<script>javascript:alert('Client has not yet been discussed in a pre-admission case conference'); window.location = 'Admin_Pending_Clients'</script>";
					$data['role'] = $this->tank_auth->get_role();
					$data['pre_admission_page_details'] = $this->clients->get_client_by_id($client_id);
					$this->get_notifications();
					$this->load->view('Social_Worker/Admission/socialW_pending_client_page', $data);
					$this->load->view('header_footer/socialW_footer');
			}else
			{
				$this->clients->Reject_Client($client_id);
				echo "<script>javascript:alert('Client has been Rejected');</script>";
				redirect("");
			}
			
				
	
			
		}
	}

	function Admin_Pending_Discharge()
	{
		$data['role']		= $this->tank_auth->get_role();
		$data['user_id']	= $this->tank_auth->get_user_id();

		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		elseif($data['role'] != 0)
		{
			redirect('');
		}
		else
		{

		$data['Pending_Clients'] = $this->clients->get_pending_discharge();
		
		$this->get_notifications();
		$this->load->view('Admin/Admin_Pending_Discharge', $data);
		$this->load->view('header_footer/Admin_footer');
		}
	}

	function Admin_Client_Discharge()
	{
		$data['role']		= $this->tank_auth->get_role();
		$data['user_id']	= $this->tank_auth->get_user_id();

		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		elseif($data['role'] != 0)
		{
			redirect('');
		}
		else
		{
			$data['username']	= $this->tank_auth->get_username();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
			
				$file['client_id'] = $this->form_validation->set_value('client_id');
		
				$file['sw_id'] = $this->form_validation->set_value('sw_id');
				$file['client_info'] = $this->clients->get_client_by_id($file['client_id']);

				$this->load->helper('file');

				$file['path_Discharge'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'General Documents'. DIRECTORY_SEPARATOR. 'Discharge';
				
				$file['file_Discharge'] = get_filenames($file['path_Discharge']);

				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Admin/Admin_Discharge_Profile', $file);
				$this->load->view('header_footer/admin_footer');
			}
		}
	}

	function Admin_Conference()
	{
		$data['Conference_count'] = $this->users->conference_counter_admin_list();
		$this->get_notifications();
		$this->load->view('Admin/Conference_list', $data);
		$this->load->view('header_footer/admin_footer');		
	}

	function Admin_Conference_Create()
	{
		$user_id = $data['user_id']= $this->tank_auth->get_user_id();
		
		$this->form_validation->set_rules('Conference_Type', 'Conference_Type', 'trim|xss_clean|required');
		$this->form_validation->set_rules('Location', 'Location', 'trim|xss_clean|required');		
		$this->form_validation->set_rules('Schedule', 'Schedule', 'trim|xss_clean|required');
		$this->form_validation->set_rules('start_time', 'start_time', 'trim|xss_clean|required');
		$this->form_validation->set_rules('end_time', 'end_time', 'trim|xss_clean|required');
				$this->form_validation->set_rules('Capacity', 'Capacity', 'trim|xss_clean|required');


		if($this->form_validation->run())
		{

			if (!is_null($data = $this->tank_auth->create_conference($this->form_validation->set_value('Conference_Type'),
			$this->form_validation->set_value('Location'),
			$this->form_validation->set_value('Schedule'),
			$this->form_validation->set_value('start_time'),
			$this->form_validation->set_value('end_time'),
			$this->form_validation->set_value('Capacity'))))
			{
				echo "<script>alert('Your Conference has been created');</script>";
				$this->Admin_Conference();
				$employee = $this->users->get_all_employees($this->tank_auth->get_user_id());
				foreach($employee as $employees)
				{
				$this->notification($employees->id, '8');
				}
			}
	
		}
		else
		{
			$this->get_notifications();
			$this->load->view('Admin/Conference_Create');
			$this->load->view('header_footer/admin_footer');
		}
	}


	function Admin_Reports()
	{
		$data['CAY'] = $this->clients->get_CAY();
		$data['OP'] = $this->clients->get_OP();
		$data['PWSN'] = $this->clients->get_PWSN();
		$data['PICS'] = $this->clients->get_PICS();
		$data['admitted'] = $this->clients->get_all_clients_admit();
		$data['pending'] = $this->clients->get_all_clients_pend();
		$data['overall'] = $this->clients->get_all_clients_over();

		$this->get_notifications();
		$this->load->view('Admin/Admin_Statistics', $data);
		$this->load->view('header_footer/admin_footer');

	}

	function Admin_Statistics()
	{
		$data['CAY'] = $this->clients->get_CAY();
		$data['OP'] = $this->clients->get_OP();
		$data['PWSN'] = $this->clients->get_PWSN();
		$data['PICS'] = $this->clients->get_PICS();
		$data['admitted'] = $this->clients->get_all_clients_admit();
		$data['pending'] = $this->clients->get_all_clients_pend();
		$data['overall'] = $this->clients->get_all_clients_over();

		$this->get_notifications();
		$this->load->view('Admin/Admin_Statistics', $data);
		$this->load->view('header_footer/admin_footer');

	}
	function Admin_Dormitories()
	{
		$data['Dorm_count'] = $this->users->dorm_counter_admin();

		$this->get_notifications();
		$this->load->view('Admin/Admin_Dormitories', $data);
		$this->load->view('header_footer/admin_footer');

	}

	function Admin_Age_Group()
	{
		$data['client'] = $this->clients->get_all_clients_age_report();
		$this->get_notifications();
		$this->load->view('Admin/Admin_age', $data);
		$this->load->view('header_footer/admin_footer');
	}



	function Admin_Discharge()
	{
		$this->form_validation->set_rules('client_id2', 'client_id2', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{
			
			$file['client_id'] = $this->form_validation->set_value('client_id2');
			$this->clients->Final_Discharge($file['client_id']);
			echo "<script>javascript:alert('Client has been Discharged'); window.location = 'Admin_Pending_Discharge'</script>";

			
		}
	}

	function admin_social_case()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('');
		} 
		else
		{

			$user_id = $this->tank_auth->get_user_id();
			$this->get_notifications();
			$data['client_list'] = $this->clients->get_all_clients_admin();
			$this->load->view('Social_Worker/Case/socialW_case', $data);
			$this->load->view('header_footer/admin_footer');
		}
	}
	
	function admin_client_profile()
	{
		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		else
		{

			$data['username']	= $this->tank_auth->get_username();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

			if ($this->form_validation->run()) 
			{								// validation ok
			
				$client_id = $this->form_validation->set_value('client_id');
				
				$file['client_info'] = $this->clients->get_client_by_id($client_id);

				$sw_id = $file['client_info'][0]->sw_id;

				$file['locations']	= $this->files->get_locations($data['role']=$this->tank_auth->get_role());
				$this->load->helper('file');
				$file['path_MR'] = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports';
				$file['file_MR'] = get_filenames($file['path_MR']);

				$file['files'] 	= $this->files->get_files_client_SW($client_id, $sw_id);
				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('Admin/Admin_case_profile', $file);
				$this->load->view('header_footer/socialW_footer');
			}
						
			
			else
			{
			redirect('');
			}	


		}
	}

	function Create_Dorm()
	{
		$this->form_validation->set_rules('dorm_sector','Sector', 'required');
		$this->form_validation->set_rules('dorm_name','Dormitory Name', 'required');
		$this->form_validation->set_rules('incharge','House Parent', 'required');
		$this->form_validation->set_rules('capacity','Capacity',  'required');

		if($this->form_validation->run())
		{
			if(!is_null($this->tank_auth->create_dorm($this->form_validation->set_value('dorm_sector'),
			$this->form_validation->set_value('dorm_name'),
			$this->form_validation->set_value('incharge'),
			$this->form_validation->set_value('capacity'))))
			{
				$data['parents'] = $this->users->get_house_parents();
				$this->get_notifications();
				$this->load->view('Admin/Create_Dorm', $data);
			}
			else
			{
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				
			}

		}
		else
		{
			$data['parents'] = $this->users->get_house_parents();
			$this->get_notifications();
			$this->load->view('Admin/Create_Dorm', $data);
			$this->load->view('header_footer/admin_footer');
		}
	}


// UNIVERSAL

	function Employee_Directory()
	{
		$data['employee_list'] = $this->users->get_employees();

		$this->get_notifications();
		$this->load->view('Employee_Directory', $data);
		$this->load->view('header_footer/socialw_footer');
	}
	function get_file()
	{
		$this->load->helper('file');
		$this->form_validation->set_rules('file_path', 'file_path', 'trim|required|xss_clean');
		$this->form_validation->set_rules('file_name', 'file_name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
		$data['user_id'] = $this->tank_auth->get_user_id();
			if ($this->form_validation->run()) 
			{
				$file_path = $this->form_validation->set_value('file_path');
				$file_name = $this->form_validation->set_value('file_name');
				$sw_id = $this->form_validation->set_value('sw_id');
			
				$this->load->helper('download');

				$action = $file_name. ' Was downloaded by '. $data['user_id'];
				$this->add_audit_entry($file_name, $action, $sw_id);
				$string = read_file($file_path);
			    force_download($file_name, $string);
			}
	}

	function get_client_list()
	{

		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data_info['client_list'] = $this->clients->get_all_clients_SW($user_id);

		$this->load->view('Nurse/trial_indiv_directory', $data_info);
	}

	function notification($sw_id, $notification_number)
	{
		$this->tank_auth->set_notification($sw_id, $notification_number);

	}



	/*{

		$data['role'] = $this->tank_auth->get_role();
		
		if ($data['role'] == 1)
		{
			//$this->form_validation->set_rules('sw_id', 'sw_id', 'xss_clean|required|trim');
			$notif_number = '0';
			$receiver_id = '922165';
			if($this->form_validation->run())
			{
				$this->tank_auth->set_notification($receiver_id, $notif_number);
	
			}
			else
			{
				redirect('');
			}
		}	
		elseif ($data['role'] == 2) 
		{
			$this->form_validation->set_rules('sw_id', 'sw_id', 'xss_clean|required|trim');
			$notif_number = '1';
			if($this->form_validation->run())
			{
				$this->tank_auth->set_notification($this->form_validation->set_value('sw_id'), $notif_number);	
			}
			else
			{
				redirect('');
			}
		}
		elseif($data['role'] == 3)
		{
			$this->form_validation->set_rules('sw_id', 'sw_id', 'xss_clean|required|trim');
			$notif_number = '1';
			if($this->form_validation->run())
			{
				$this->tank_auth->set_notification($this->form_validation->set_value('sw_id'), $notif_number);	
			}
			else
			{
				redirect('');
			}
		}
		elseif($data['role'] == 4)
		{
			$this->form_validation->set_rules('sw_id', 'sw_id', 'xss_clean|required|trim');
			$notif_number = '1';
			if($this->form_validation->run())
			{
				$this->tank_auth->set_notification($this->form_validation->set_value('sw_id'), $notif_number);	
			}
			else
			{
				redirect('');
			}
		}
		elseif($data['role'] == 5)
		{
			$this->form_validation->set_rules('sw_id', 'sw_id', 'xss_clean|required|trim');
			$notif_number = '1';
			if($this->form_validation->run())
			{
				$this->tank_auth->set_notification($this->form_validation->set_value('sw_id'), $notif_number);	
			}
			else
			{
				redirect('');
			}
		}
		elseif($data['role'] == 6)
		{
			$this->form_validation->set_rules('sw_id', 'sw_id', 'xss_clean|required|trim');
			$notif_number = '1';
			if($this->form_validation->run())
			{
				$this->tank_auth->set_notification($this->form_validation->set_value('sw_id'), $notif_number);	
			}
			else
			{
				redirect('');
			}
		}
		elseif($data['role'] == 0)
		{
			$this->form_validation->set_rules('sw_id', 'sw_id', 'xss_clean|required|trim');
			$notif_number = '1';
			if($this->form_validation->run())
			{
				$this->tank_auth->set_notification($this->form_validation->set_value('sw_id'), $notif_number);	
			}
			else
			{
				redirect('');
			}
		}

	}*/

	function get_notifications()
	{
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role']		= $this->tank_auth->get_role();
		$data['notification'] = $this->files->get_notifications($data['user_id']);
		
		//determine notification unread count without querying the database
		$data['notification_count'] = 0;
		foreach ($data['notification'] as $v)
			if(!$v->seen)
				$data['notification_count']++;

		if($data['notification_count'] == 0){
			$data['notification_count'] = "";
		}	
		if ($data['role'] == 1 || $data['role'] == 7 || $data['role'] == 8 || $data['role'] == 9 || $data['role'] == 10)
		{
				$this->load->view('header_footer/socialW_header', $data);			
		}	
		elseif ($data['role'] == 2) 
		{
				$this->load->view('header_footer/nurse_header', $data);
		}
		elseif($data['role'] == 3)
		{
				$this->load->view('header_footer/psychia_header', $data);
		}
		elseif($data['role'] == 4)
		{
				$this->load->view('header_footer/psycho_header', $data);
		}
		elseif($data['role'] == 5)
		{
				$this->load->view('header_footer/houseP_header', $data);
		}
		elseif($data['role'] == 6)
		{
				$this->load->view('header_footer/physicalT_header', $data);
		}
		elseif($data['role'] == 0)
		{
				$this->load->view('header_footer/admin_header', $data);
		}
	}

	function get_request()
	{

		$data['role'] = $this->tank_auth->get_role();

		$data['request'] = $this->clients->get_requests($data['role']);
		$this->get_notifications();
		$this->load->view('General/Requests', $data);
		$this->load->view('header_footer/nurse_footer');
	}


	function get_client_medical_request()
	{	
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{	
		$data['role'] = $this->tank_auth->get_role();

		$data['request'] = $this->clients->get_client_medical_requests($data['role'], $this->form_validation->set_value('client_id'));
		
		$this->get_notifications();
		$this->load->view('General/Requests', $data);
		$this->load->view('header_footer/nurse_footer');
		}
	}


	function remove_request($client_id, $role)
	{
		$this->clients->remove_request($client_id, $role);
	}

	function read_test()
	{
		$this->load->helper('file');
		$this->form_validation->set_rules('path', 'path', 'trim|required|xss_clean');
		$this->form_validation->set_rules('file', 'file', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');

		if($this->form_validation->run())
		{
			$path = $this->form_validation->set_value('path');
		    $file = $this->form_validation->set_value('file');
		    $sw_id = $this->form_validation->set_value('sw_id');
			$action = $file. ' Was downloaded';
			$this->add_audit_entry($file, $action, $sw_id);
			
			$string = read_file($path);
		force_download($file, $string);

		}
	}

	function get_client_files($client_id)
	{
		$data['username']	= $this->tank_auth->get_username();
		$data_info['client_list'] = $this->clients->get_all_clients();
		$this->load->view('header_footer/nurse_header', $data);
		$this->load->view('Nurse/nurse_medical', $data_info);
		$this->load->view('header_footer/nurse_footer');
	}
	
	function search()
	{

		$this->form_validation->set_rules('Search', 'Search', 'trim|required|xss_clean');
		if($this->form_validation->run())
		{
			$data['search'] = $this->clients->search($this->form_validation->set_value('Search'));

			$this->get_notifications();
			$this->load->view('auth/Search', $data);
			$this->load->view('header_footer/admin_footer');
		}
	}

	function archive()
	{

		$data_info['client_list'] = $this->clients->get_archive();
		$this->get_notifications();
		$this->load->view('General/Archive', $data_info);
		$this->load->view('header_footer/admin_footer');
	}

	function archive_profile()
	{
		if (!$this->tank_auth->is_logged_in())
		{
			redirect('');
		}
		else
		{

			$data['username']	= $this->tank_auth->get_username();
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

			if ($this->form_validation->run()) 
			{								// validation ok
			
				$client_id = $file['client_id'] = $this->form_validation->set_value('client_id');
				$file['client_info'] = $this->clients->get_client_by_id($file['client_id']);
				$this->load->helper('file');

				
				$file['path_MR'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Medical Reports';
				$file['path_GD'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'General Documents';
				$file['path_PsychiR'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Psychiatric Reports';
				$file['path_PsychoR'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Psychological Reports';
				$file['path_PTR'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Physical Therapy Reports';
				$file['path_house'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'House Reports' . DIRECTORY_SEPARATOR;
				$file['path_Social'] = "./uploads". DIRECTORY_SEPARATOR . $file['client_id'] . DIRECTORY_SEPARATOR . 'Social Case Reports' . DIRECTORY_SEPARATOR;
			
				$file['file_MR'] = get_filenames($file['path_MR']);
				$file['file_GD'] = get_filenames($file['path_GD']);
				$file['file_PsychiR'] = get_filenames($file['path_PsychiR']);
				$file['file_PsychoR'] = get_filenames($file['path_PsychoR']);
				$file['file_Physical'] = get_filenames($file['path_PTR']);
				$file['file_House'] = get_filenames($file['path_house']);
				$file['file_Social'] = get_filenames($file['path_Social']);


				$file['social_case'] = $this->clients->get_social_cases($client_id);
				$file['document_list'] =  $this->files->get_uploaded_documents($client_id);
				$file['home_plans'] = $this->clients->get_home_plans($client_id);
				
				$this->load->helper('directory');
				$this->get_notifications();
				$this->load->view('General/Archive_Profile', $file);
				$this->load->view('header_footer/admin_footer');
			}
						
			
			else
			{
				$data_info['client_list'] = $this->clients->get_archive();
				$this->get_notifications();
				$this->load->view('General/Archive', $data_info);
				$this->load->view('header_footer/admin_footer');
			}	


		}
	}

	function add_audit_entry($action, $sw_id, $file_name)
	{
		$data['user_id'] = $this->tank_auth->get_user_id();
		{
			$this->tank_auth->insert_audit($data['user_id'], $action, $sw_id, $file_name);
		}
	}

	function audit_trail()
	{
		$data['audit_files'] = $this->files->get_all_audit();
		$this->get_notifications();
		$this->load->view('Admin/audit', $data);
		$this->load->view('header_footer/Admin_footer');
	}

	function single_upload()
	{
		$output_dir = "uploads/";
		if(isset($_FILES["myfile"]))
		{
			$ret = array();

			$error =$_FILES["myfile"]["error"];
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData() 
			if(!is_array($_FILES["myfile"]["name"])) //single file
			{
		 	 	$fileName = $_FILES["myfile"]["name"];
		 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
		    	$ret[]= $fileName;
			}
			else  //Multiple files, file[]
			{
			  $fileCount = count($_FILES["myfile"]["name"]);
			  for($i=0; $i < $fileCount; $i++)
			  {
			  	$fileName = $_FILES["myfile"]["name"][$i];
				move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
			  	$ret[]= $fileName;
			  }
			
			}
		    echo json_encode($ret);
		 }
	}
	
	function plupload_client()
	{
		$this->load->helper("url");
		// 5 minutes execution time
		@set_time_limit(5 * 60);

		// Uncomment this one to fake upload time
		// usleep(5000);

		// Settings
		$targetDir = FCPATH . "uploads/";
		//$targetDir = 'uploads';
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds


		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}
		$client_id =  $_REQUEST['client_id'];
		//$fileName = $client_id . "_" . $fileName;
		$fileName = $fileName;
		$sw_id 	  = $_REQUEST['sw_id'];
		$user_id = $_REQUEST['user_id'];
		$file_ploc = $_REQUEST['file_ploc'];
		$document_type = $_REQUEST['document_type'];
		$filePath = $targetDir .DIRECTORY_SEPARATOR . $_REQUEST['client_id'] . DIRECTORY_SEPARATOR . "General Documents" . DIRECTORY_SEPARATOR . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


		// Remove old temp files	
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}	


		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {	
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);
		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off 
			rename("{$filePath}.part", $filePath);
		}
		//all done.. insert to database
		$this->tank_auth->insert_file_db(
							$fileName, 
							$_FILES['file']['type'], 
							$filePath, 
							pathinfo($filePath, PATHINFO_EXTENSION),
							$sw_id, 
							$client_id,
							$user_id, 
							$file_ploc,
							$document_type);

		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}

	function get_files_json()
	{
		$this->load->helper('file');
		$array_inputs = $this->uri->uri_to_assoc();

		$client_id = $array_inputs['client_id'];
		$user_id   = $array_inputs['user_id'];
		$role 	   = $this->tank_auth->get_role();
		$file_list = $this->files->get_files_client($client_id,$user_id);
		$locations = $this->files->get_locations($role);
		$path 	   = FCPATH . "uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'General Documents';
		$files 	   = get_filenames($path);

		$json_array = array(
				"json_data" => json_encode(array(
								"role"		=> $role,
								"file_list"	=> $file_list,
								"locations" => $locations,
								"path"		=> $path,
								"files"		=> $files
							),JSON_PRETTY_PRINT)
			);
		$this->load->view("get_files_json",$json_array);
	}

	function alert($notif_id,$view_redirect)
	{
		//$receiver_id = $this->input->get('receiver_id');
		if($notif_id){
			$this->db->set('seen', 1);
			$this->db->where('notification_id', $notif_id);
			$this->db->update("notification");
			redirect("auth/" . $view_redirect);
		} else {
			echo "false";
		}
	}

	function get_conferences()
	{
		$user_id = $this->tank_auth->get_user_id();
				$data['Conference_count'] = $this->users->conference_counter($user_id);
		$data['conferences'] = $this->users->get_conferences($user_id);
		$this->get_notifications();

		$this->load->view('General/conference', $data);
		$this->load->view('header_footer/nurse_footer');
	}

	function get_conference_details()
	{
		$user_id = $data['user_id'] = $this->tank_auth->get_user_id();
		$data['role'] = $this->tank_auth->get_role();
		$this->form_validation->set_rules('conference_id', 'conference_id', 'xss_clean|trim');
		$this->form_validation->set_rules('conference_type', 'conference_type', 'xss_clean|trim');

		if($this->form_validation->run())
		{

			$conference_id = $this->form_validation->set_value('conference_id');
			$conference_type = $this->form_validation->set_value('conference_type');

			
			$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
			$data['conference_attendees'] = $this->users->conference_final_attendees($conference_id);

			if($conference_type == 1)
			{
				$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
				$data['clients'] = $this->users->conference_custody_clients($conference_id);

			}
			elseif($conference_type == 2)
			{
				$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
				$data['clients'] = $this->users->conference_pending_clients($conference_id, $user_id);
			}

			$data['role'] = $this->tank_auth->get_role();
			$this->get_notifications();
			$this->load->view('General/Conference_details', $data);
			$this->load->view('header_footer/socialW_footer');
			
		
		}
	}

	function end_conference()
	{
		$this->form_validation->set_rules('conference_id', 'xss_clean');

		if($this->form_validation->run())
		{
			$conference_id = $this->form_validation->set_value('conference_id');

			$this->users->end_conference($conference_id);

			redirect('', 'refresh');
		}
	}
	function Conference_add_client()
	{
		$client_count = 0;
		$this->form_validation->set_rules('conference_id', 'conference_id', 'xss_clean|trim');
		$this->form_validation->set_rules('conference_type', 'conference_type', 'xss_clean|trim');
		$this->form_validation->set_rules('counter', 'xss_clean');
		$this->form_validation->set_rules('capacity', 'xss_clean');

		$check = $this->input->post('check');
		$user_id = $this->tank_auth->get_user_id();

		if($this->form_validation->run())
		{
			$capacity =  $this->form_validation->set_value('capacity');
			$counter =  $this->form_validation->set_value('counter');
			$conference_id = $this->form_validation->set_value('conference_id');
			$conference_type = $this->form_validation->set_value('conference_type');
			foreach($check as $count)
			{
				$client_count++;
			}
			if(($capacity - $counter) >= $client_count )
			{
				foreach($check as $client)
				{
					$this->tank_auth->conference_add_client($client, $conference_id, $user_id);
				}
			}
			elseif(($capacity - $counter) < $client_count)
			{
				echo "<script>javascript:alert('Too many clients'); </script>";
			}
			if($conference_type == 1)
			{
				$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
				$data['clients'] = $this->users->conference_custody_clients($conference_id);

			}
			elseif($conference_type == 2)
			{
				$data['conference_details'] = $this->users->get_my_conference_details($conference_id);
				$data['clients'] = $this->users->conference_pending_clients($conference_id, $user_id);
			}

			$data['role'] = $this->tank_auth->get_role();
			$this->get_notifications();
			$data['conference_attendees'] = $this->users->conference_final_attendees($conference_id);
			$this->load->view('General/Conference_details', $data);
			$this->load->view('header_footer/socialW_footer');
		}
	}

	function confirm_attendance()
	{

		$this->form_validation->set_rules('decision', 'decision', 'xss_clean|trim');
		$this->form_validation->set_rules('conference_id', 'conference_id', 'xss_clean|trim');
		$user_id = $this->tank_auth->get_user_id();

		if($this->form_validation->run())
		{
			if(!is_null($this->users->give_decision($this->form_validation->set_value('decision'), $this->form_validation->set_value('conference_id'), $user_id)));

			echo "<script>javascript:alert('Your answer has been posted'); window.location = 'get_conferences'</script>";

		}
	}

	function test()
	{
		$this->form_validation->set_rules('test', 'test', 'xss_clean|required|trim');

		if($this->form_validation->run())
		{
			if(!is_null($this->users->test($this->form_validation->set_value('test'))))
			{

				$data['data'] = array($this->users->test($this->form_validation->set_value('test')));
				$this->get_notifications();
				$this->load->view('result', $data);
				$this->load->view('header_footer/socialW_footer');
			}
			else
			{
				echo "none";
			}
		}
		else
		{
		$this->get_notifications();
		$this->load->view('test');
		$this->load->view('header_footer/socialW_footer');
		}
	}

	function Profile()
	{
		$user_id = $this->tank_auth->get_user_id();

		$data['Profile_details'] = $this->users->get_user_by_id($user_id);

				$data['username']	= $this->tank_auth->get_username();
				
				$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
				$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
				$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
				if ($this->form_validation->run()) 
				{								// validation ok
					$client_id = $this->form_validation->set_value('client_id');
					$sw_id = $this->form_validation->set_value('sw_id');
					$file_ploc = $this->form_validation->set_value('file_ploc');
					$user_id = $this->tank_auth->get_user_id();
					$config = array(
		        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'Psychiatric Reports',
		        	'allowed_types' => '*',
		        );

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload())
						{
							$error = array('error' => $this->upload->display_errors());			
						}
					else
						{
							$data['upload_data'] = $this->upload->data();
				
							$this->tank_auth->insert_file_db(
								$data['upload_data']['file_name'], 
								$data['upload_data']['file_type'], 
								$data['upload_data']['file_path'], 
								$data['upload_data']['file_ext'],
								$sw_id, 
								$client_id,
								$user_id, 
								$file_ploc);

							$action = $data['upload_data']['file_name'].' has been uploaded';
							$this->remove_request($client_id, $data['role']);
							$this->add_audit_entry($data['upload_data']['file_name'],$action, $sw_id);
							$this->notification($sw_id);
							echo "<script>javascript:alert('File has been uploaded'); window.location = 'psychia_medical'</script>";
						}
					
				}

		$this->get_notifications();
		$this->load->view('General/Profile', $data);
		$this->load->view('header_footer/socialW_footer');
	}

	function form_test()
	{
		$this->get_notifications();
		$this->load->view('Forms/intake_bg');
		$this->load->view('header_footer/socialw_footer');
	}

	function before_kasunduan()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$data['user'] = $this->clients->get_all_user();
			$data['client_id']= $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($data['client_id']);
			$this->load->view('Forms/kasunduan', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	
	function input_kasunduan()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('Pname', 'Pname', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('duration', 'duration', 'trim|required|xss_clean');
		$this->form_validation->set_rules('signature', 'signature', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness1', 'witness1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness2', 'witness2', 'trim|required|xss_clean');
		$user_id = $this->tank_auth->get_user_id();
		if ($this->form_validation->run()) 
			{
				$data['client_id'] = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($data['client_id']);
				$data['Pname'] = $this->form_validation->set_value('Pname');
				$data['address'] = $this->form_validation->set_value('address');
				$data['duration'] = $this->form_validation->set_value('duration');
				$data['signature'] = $this->form_validation->set_value('signature');
				$data['witness1'] = $this->form_validation->set_value('witness1');
				$data['witness2'] = $this->form_validation->set_value('witness2');
				$data['user_id'] = $user_id;

				$this->get_notifications();
				$client_id = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($client_id);
				$this->load->view('Forms/kasunduan_form', $data);

			}
		else{
			$this->get_notifications();
			$data['user'] = $this->clients->get_all_user();
			$this->load->view('Forms/kasunduan', $data);
			$this->load->view('header_footer/socialw_footer');
		}
	}

	function create_kasunduan()
	{
		$this->form_validation->set_rules('Pname', 'Pname', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('duration', 'duration', 'trim|required|xss_clean');
		$this->form_validation->set_rules('signature', 'signature', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness1', 'witness1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness2', 'witness2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required|xss_clean');
		if ($this->form_validation->run()) 
			{
				
				if (!is_null($data = $this->tank_auth->create_kasundu(
						$this->form_validation->set_value('Pname'),
						$this->form_validation->set_value('address'),
						$this->form_validation->set_value('client_id'),
						$this->form_validation->set_value('duration'),
						$this->form_validation->set_value('signature'),
						$this->form_validation->set_value('witness1'),
						$this->form_validation->set_value('witness2'),
						$this->form_validation->set_value('user_id')))) 
					{								
						/* $this->notification($data['user_id'] = $this->tank_auth->get_user_id());	// success
						$data['client_id'] = $this->form_validation->set_value('client_id');
						$this->load->view("Forms/socialW_client_profile", $data);
						$this->load->view('header_footer/houseP_footer'); */
						echo "<script>javascript:alert('Kasunduan has been uploaded'); window.location = 'socialW_case'</script>";
					} 
				else 
				{
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
				

			}

		$this->get_notifications();
		$this->load->view('Forms/kasunduan_form');
		$this->load->view('header_footer/socialw_footer');
	}

	function before_aff_undertaking()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|xss_clean');
		if($this->form_validation->run())
		{	
			$this->get_notifications();
			$data['client_id']= $this->form_validation->set_value('client_id');
			$data['client_info'] = $this->clients->get_client_by_id($data['client_id']);
			$this->load->view('Forms/input/aff_undertaking', $data);
			$this->load->view('header_footer/nurse_footer');
 		}
		else
		{
			echo 'lol';
		}
	}

	function input_aff_undertaking()
	{
		$this->form_validation->set_rules('name1', 'name1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name2', 'name2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address1', 'address1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address2', 'address2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('relationship1', 'relationship1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('relationship2', 'relationship2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('var4', 'var4', 'trim|xss_clean');
		$this->form_validation->set_rules('var5', 'var5', 'trim|xss_clean');
		$this->form_validation->set_rules('var6', 'var6', 'trim|xss_clean');
		$this->form_validation->set_rules('var7', 'var7', 'trim|xss_clean');
		$this->form_validation->set_rules('var8', 'var8', 'trim|xss_clean');
		$this->form_validation->set_rules('var9', 'var9', 'trim|xss_clean');
		$this->form_validation->set_rules('var10', 'var10', 'trim|xss_clean');
		$this->form_validation->set_rules('affiant1', 'affiant1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('affiant2', 'affiant2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness1', 'witness1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness2', 'witness2', 'trim|xss_clean');
		$this->form_validation->set_rules('day', 'day', 'trim|required|xss_clean');
		$this->form_validation->set_rules('month', 'month', 'trim|required|xss_clean');
		$this->form_validation->set_rules('taxnum', 'taxnum', 'trim|required|xss_clean');
		$this->form_validation->set_rules('taxplace', 'taxplace', 'trim|xss_clean');
		$this->form_validation->set_rules('taxdate', 'taxdate', 'trim|required|xss_clean');
		$this->form_validation->set_rules('docNum', 'docNum', 'trim|xss_clean');
		$this->form_validation->set_rules('pageNum', 'pageNum', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bookNum', 'bookNum', 'trim|xss_clean');

		if ($this->form_validation->run()) 
			{
				$data['name1'] = $this->form_validation->set_value('name1');
				$data['name2'] = $this->form_validation->set_value('name2');
				$data['address1'] = $this->form_validation->set_value('address1');
				$data['address2'] = $this->form_validation->set_value('address2');
				$data['relationship1'] = $this->form_validation->set_value('relationship1');
				$data['relationship2'] = $this->form_validation->set_value('relationship2');
				$data['client_id'] = $this->form_validation->set_value('client_id');
				$data['var4'] = $this->form_validation->set_value('var4');
				$data['var5'] = $this->form_validation->set_value('var5');
				$data['var6'] = $this->form_validation->set_value('var6');
				$data['var7'] = $this->form_validation->set_value('var7');
				$data['var8'] = $this->form_validation->set_value('var8');
				$data['var9'] = $this->form_validation->set_value('var9');
				$data['var10'] = $this->form_validation->set_value('var10');
				$data['affiant1'] = $this->form_validation->set_value('affiant1');
				$data['affiant2'] = $this->form_validation->set_value('affiant2');
				$data['witness1'] = $this->form_validation->set_value('witness1');
				$data['witness2'] = $this->form_validation->set_value('witness2');
				$data['day'] = $this->form_validation->set_value('day');
				$data['month'] = $this->form_validation->set_value('month');
				$data['taxnum'] = $this->form_validation->set_value('taxnum');
				$data['taxplace'] = $this->form_validation->set_value('taxplace');
				$data['taxdate'] = $this->form_validation->set_value('taxdate');
				$data['docNum'] = $this->form_validation->set_value('docNum');
				$data['pageNum'] = $this->form_validation->set_value('pageNum');
				$data['bookNum'] = $this->form_validation->set_value('bookNum');
				
				$this->get_notifications();
				$client_id = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($client_id);
				$this->load->view('Forms/aff_undertaking_form', $data);


			}
		else{
			$this->get_notifications();
			$this->load->view('Forms/aff_undertaking');
			$this->load->view('header_footer/socialw_footer');
		}
	}

	function create_aff_undertaking()
	{
		$this->form_validation->set_rules('name1', 'name1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name2', 'name2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address1', 'address1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address2', 'address2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('relationship1', 'relationship1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('relationship1', 'relationship2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('var4', 'var4', 'trim|xss_clean');
		$this->form_validation->set_rules('var5', 'var5', 'trim|xss_clean');
		$this->form_validation->set_rules('var6', 'var6', 'trim|xss_clean');
		$this->form_validation->set_rules('var7', 'var7', 'trim|xss_clean');
		$this->form_validation->set_rules('var8', 'var8', 'trim|xss_clean');
		$this->form_validation->set_rules('var9', 'var9', 'trim|xss_clean');
		$this->form_validation->set_rules('var10', 'var10', 'trim|xss_clean');
		$this->form_validation->set_rules('affiant1', 'affiant1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('affiant2', 'affiant2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness1', 'witness1', 'trim|required|xss_clean');
		$this->form_validation->set_rules('witness2', 'witness2', 'trim|xss_clean');
		$this->form_validation->set_rules('day', 'day', 'trim|required|xss_clean');
		$this->form_validation->set_rules('month', 'month', 'trim|required|xss_clean');
		$this->form_validation->set_rules('taxnum', 'taxnum', 'trim|required|xss_clean');
		$this->form_validation->set_rules('taxplace', 'taxplace', 'trim|xss_clean');
		$this->form_validation->set_rules('taxdate', 'taxdate', 'trim|required|xss_clean');
		$this->form_validation->set_rules('docNum', 'docNum', 'trim|xss_clean');
		$this->form_validation->set_rules('pageNum', 'pageNum', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bookNum', 'bookNum', 'trim|xss_clean');

		if ($this->form_validation->run()) 
			{
				
				if (!is_null($data = $this->tank_auth->create_aff_under(
					$this->form_validation->set_value('name1'),
					$this->form_validation->set_value('name2'),
					$this->form_validation->set_value('address1'),
					$this->form_validation->set_value('address2'),
					$this->form_validation->set_value('relationship1'),
					$this->form_validation->set_value('relationship2'),
					$this->form_validation->set_value('client_id'),
					$this->form_validation->set_value('var4'),
					$this->form_validation->set_value('var5'),
					$this->form_validation->set_value('var6'),
					$this->form_validation->set_value('var7'),
					$this->form_validation->set_value('var8'),
					$this->form_validation->set_value('var9'),
					$this->form_validation->set_value('var10'),
					$this->form_validation->set_value('affiant1'),
					$this->form_validation->set_value('affiant2'),
					$this->form_validation->set_value('witness1'),
					$this->form_validation->set_value('witness2'),
					$this->form_validation->set_value('day'),
					$this->form_validation->set_value('month'),
					$this->form_validation->set_value('taxnum'),
					$this->form_validation->set_value('taxplace'),
					$this->form_validation->set_value('taxdate'),
					$this->form_validation->set_value('docNum'),
					$this->form_validation->set_value('pageNum'),
					$this->form_validation->set_value('bookNum')))) 
					{	
						echo "<script>javascript:alert('Affidavit of Undertaking has been uploaded'); window.location = 'socialW_case'</script>";
					}							
				else 
					{
						$errors = $this->tank_auth->get_error_message();
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
				

			}

		$this->get_notifications();
		$this->load->view('Forms/aff_undertaking_form');
		$this->load->view('header_footer/socialw_footer');
	}

	function indi_home_plan_page()
	{
		$client_id = $this->input->post('client_id');
		$data['client_info'] = $this->clients->get_client_by_id($client_id);
		$data['home_plans'] = $this->clients->get_home_plans($client_id);
		$this->get_notifications();
		$this->load->view('Forms/home_indie_page', $data);
		$this->load->view('header_footer/socialw_footer');
	}

	function create_indi_home_plan()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');

		$this->get_notifications();
		$client_id = $this->input->post('client_id');
		$data['client_info'] = $this->clients->get_client_by_id($client_id);
		$data['user'] = $this->clients->get_all_user();
		$this->load->view('Forms/Input/indi_home_plan', $data);
		$this->load->view('header_footer/socialw_footer');
	}

	function submit_indi_home_plan()
	{
		$user_id = $this->tank_auth->get_user_id();
		$client_id = $this->input->post('client_id');
		
		$timeStart = $this->input->post('timeStart');
		$timeEnd = $this->input->post('timeEnd');
		$activity = $this->input->post('activity');
		$personRes = $this->input->post('personRes');
		$counter = 0;

		if($timeStart == null)
			{ echo "no data"; }
		else{
			if(!is_null($data = $this->tank_auth->create_indie_home_plan($user_id, $client_id)))
			{

				foreach($timeStart as $entry)
				{
					$this->tank_auth->create_indie_home_plan_item($data['home_plan_id'],
					$timeStart[$counter],
					$timeEnd[$counter],
					$activity[$counter],
					$personRes[$counter]);
					$counter = $counter + 1;
				}
				$home_plan['client_info'] = $this->clients->get_client_by_id($client_id);
				$home_plan['home_plan_items'] = $this->clients->get_home_plan_items($data['home_plan_id']);
				$this->get_notifications();
				$this->load->view('Forms/Output/home_plan_result', $home_plan);
				$this->load->view('header_footer/socialW_footer');
				$this->tank_auth->insert_file_db('Individual Home Plan', 'Electronic Form', 'System', 'Electronic', $this->tank_auth->get_user_id(), $this->form_validation->set_value('client_id'), $this->tank_auth->get_user_id(), 'System', '50');		
					
			}
		}
	}

	function view_indi_home_plan()
	{
		$this->form_validation->set_rules('client_id', 'xss_clean');
		$this->form_validation->set_rules('home_plan_id', 'xss_clean');
		if($this->form_validation->run())
		{
			$client_id = $this->form_validation->set_value('client_id');
			$home_plan_id = $this->form_validation->set_value('home_plan_id');

			$home_plan['client_info'] = $this->clients->get_client_by_id($client_id);
			$home_plan['home_plan_items'] = $this->clients->get_home_plan_items($home_plan_id);
			$this->get_notifications();
			$this->load->view('Forms/Output/home_plan_result', $home_plan);
			$this->load->view('header_footer/socialW_footer');
		}
	}



// PDF files

	function m_pdf_sample_code()
	{
			   
		$client_id ='335585' ;
		$data['client_info'] = $this->clients->get_client_by_id($client_id);

		$html = $this->load->view('mpdf_output', $data, true); // render the view into HTML
     
	    $this->load->library('m_pdf');
	    $m_pdf = $this->m_pdf->load();
	    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
	    $m_pdf->WriteHTML($html); // write the HTML into the PDF
	    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

	}

	function mpdf_general()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($client_id);

				$html = $this->load->view('mpdf_general_intake', $data, true); // render the view into HTML
		     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

			}
	}

	function mpdf_kasunduan()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['kasunduan'] = $this->clients->get_kasunduan($client_id);

				$html = $this->load->view('mpdf_kasunduan', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

			}
	}

	function mpdf_health()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['health'] = $this->clients->get_health($client_id);

				$html = $this->load->view('mpdf_health', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

			}
	}

	function mpdf_psycho() 
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['psycho'] = $this->clients->get_psycho($client_id);

				$html = $this->load->view('mpdf_psycho', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

			}
	}

	function mpdf_media($client_id)  
	{

		$data['media'] = $this->clients->get_client_by_id_for_media($client_id);

		$html = $this->load->view('mpdf_media', $data, true); // render the view into HTML

	    $this->load->library('m_pdf');
	    $m_pdf = $this->m_pdf->load();
	    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
	    $m_pdf->WriteHTML($html); // write the HTML into the PDF
	    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

	}

	function mpdf_aff_undertaking()  
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['aff_under'] = $this->clients->get_aff_under($client_id);

				$html = $this->load->view('mpdf_aff_undertaking', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

			}
	}

	function mpdf_dis_adop() 
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['dis_adop'] = $this->clients->get_discharge_adop_info($client_id);

				$html = $this->load->view('mpdf_dis_adop', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

			}
	}

	function mpdf_dis_slip() 
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['dis_slip'] = $this->clients->get_discharge_slip_info($client_id);

				$html = $this->load->view('mpdf_dis_slip', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can

			}
	}

	function mpdf_dis_sum() 
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['dis_sum'] = $this->clients->get_discharge_sum_info($client_id);

				$html = $this->load->view('mpdf_dis_sum', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can
			}
	}

	function mpdf_home_visit() 
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['home_visit'] = $this->clients->get_home_visit($client_id);

				$html = $this->load->view('mpdf_home_visit', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can
			}
	}

	function mpdf_inter_cc() 
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['inter_cc'] = $this->clients->get_inter_cc($client_id);

				$html = $this->load->view('mpdf_inter_cc', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can
			}
	}

	function mpdf_initial_social($client_id)  // no db at thesisdb
	{
		//$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		//if ($this->form_validation->run()) 
		//	{
				//$client_id = $this->form_validation->set_value('client_id');
				$data['social'] = $this->clients->get_initial_case($client_id);

				$html = $this->load->view('mpdf_initial_social', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can
			//}
	}

	function mpdf_social($client_id)  // no db at thesisdb
	{
		//$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		//if ($this->form_validation->run()) 
		//	{
				//$client_id = $this->form_validation->set_value('client_id');
				$data['social'] = $this->clients->get_initial_case($client_id);
				$data['update'] = $this->clients->get_updated_scs($client_id);
				$html = $this->load->view('mpdf_social', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can
			//}
	}

	function mpdf_social_case()  // no db at thesisdb
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('social_id', 'social_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$social_id = $this->form_validation->set_value('social_id');
				$data['social'] = $this->clients->get_initial_case($client_id);
				$data['update'] = $this->clients->get_scs_by_id($client_id, $social_id);
				$html = $this->load->view('mpdf_social', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can
			}
	}

	function mpdf_pt_prog() 
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['pt_prog'] = $this->clients->get_pt_prog($client_id);

				$html = $this->load->view('mpdf_pt_prog', $data, true); // render the view into HTML
     
			    $this->load->library('m_pdf');
			    $m_pdf = $this->m_pdf->load();
			    $m_pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
			    $m_pdf->WriteHTML($html); // write the HTML into the PDF
			    $m_pdf->Output($pdfFilePath, 'F'); // save to file because we can
			}
	}

	function mpdf_files()
	{
		$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
		
		if ($this->form_validation->run()) 
			{
				$client_id = $this->form_validation->set_value('client_id');
				$data['client_info'] = $this->clients->get_client_by_id($client_id);
				$this->get_notifications();
				$this->load->view('mpdf_files', $data);
				$this->load->view('header_footer/socialw_footer');


			}
	}

	function blank()
	{

		$this->form_validation->set_rules('client_id');

		if($this->form_validation->run())
		{
			$client_id = $this->form_validation->set_value('client_id');

			echo $this->clients->get_client_details($client_id)->admission_type;
		}
	}

	function client_picture()
	{
		$data['role'] = $this->tank_auth->get_role();
		if (!$this->tank_auth->is_logged_in()) 
		{									// logged in
			redirect('auth/login');
		} 
		else 
		{
			
			$data['username']	= $this->tank_auth->get_username();
			
			$this->form_validation->set_rules('client_id', 'client_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sw_id', 'sw_id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('file_ploc', 'file_ploc', 'trim|required|xss_clean');
			$this->form_validation->set_rules('document_type', 'document_type', 'trim|required|xss_clean');
			if ($this->form_validation->run()) 
			{								// validation ok
				$client_id = $this->form_validation->set_value('client_id');
				$sw_id = $this->form_validation->set_value('sw_id');
				$file_ploc = $this->form_validation->set_value('file_ploc');
				$document_type = $this->form_validation->set_value('document_type');

				$config = array(
	        	'upload_path' => './uploads' . DIRECTORY_SEPARATOR . $client_id  . DIRECTORY_SEPARATOR . 'Social Case Reports',
	        	'allowed_types' => 'png|jpeg|jpg',
	     		'post_max_size' => '200'
	            );
				$upload_path = 'uploads' . '/' . $client_id  . '/' . 'Social Case Reports /';
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());			
					}
				else
					{
						$data['upload_data'] = $this->upload->data();
						$action = 'A new Social Case Report was uploaded to '. $client_id;
						
						/* $this->tank_auth->insert_file_db(
							$data['upload_data']['file_name'], 
							$data['upload_data']['file_type'], 
							$data['upload_data']['file_path'], 
							$data['upload_data']['file_ext'],
							$sw_id,
							$client_id,
							$sw_id,
							$file_ploc,
							$document_type);
						*/

						$this->tank_auth->insert_profile_picture($client_id, $upload_path.$data['upload_data']['file_name']);

						$this->add_audit_entry($data['upload_data']['file_name'], $sw_id, $action );
						$this->remove_request($client_id, $data['role']);

						$this->notification($sw_id);	
						echo "<script>javascript:alert('".$data['upload_data']['file_name']." new File has been added'); window.location = 'socialW_case'</script>";
					}
			}
		}	
	}
}



/* End of file auth.php */
/* Location: ./application/controllers/auth.php */


