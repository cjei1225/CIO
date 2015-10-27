<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('phpass-0.1/PasswordHash.php');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');

/**
 * Tank_auth
 *
 * Authentication library for Code Igniter.
 *
 * @package		Tank_auth
 * @author		Ilya Konyukhov (http://konyukhov.com/soft/)
 * @version		1.0.9
 * @based on	DX Auth by Dexcell (http://dexcell.shinsengumiteam.com/dx_auth)
 * @license		MIT License Copyright (c) 2008 Erick Hartanto
 */
class Tank_auth
{
	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();

		$this->ci->load->config('tank_auth', TRUE);

		$this->ci->load->library('session');
		$this->ci->load->database();
		$this->ci->load->model('tank_auth/users');
		$this->ci->load->model('tank_auth/clients');
		$this->ci->load->model('tank_auth/files');
		$this->ci->load->model('tank_auth/messages');
		// Try to autologin
		$this->autologin();
	}

	/**
	 * Login user on the site. Return TRUE if login is successful
	 * (user exists and activated, password is correct), otherwise FALSE.
	 *
	 * @param	string	(username or email or both depending on settings in config file)
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function login($login, $password, $remember, $login_by_username, $login_by_email)
	{
		if ((strlen($login) > 0) AND (strlen($password) > 0)) {

			// Which function to use to login (based on config)
			if ($login_by_username AND $login_by_email) {
				$get_user_func = 'get_user_by_login';
			} else if ($login_by_username) {
				$get_user_func = 'get_user_by_username';
			} else {
				$get_user_func = 'get_user_by_email';
			}

			if (!is_null($user = $this->ci->users->$get_user_func($login))) {	// login ok

				// Does password match hash in database?
				$hasher = new PasswordHash(
						$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
						$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
				if ($hasher->CheckPassword($password, $user->password)) {		// password ok

					if ($user->banned == 1) {									// fail - banned
						$this->error = array('banned' => $user->ban_reason);

					} else {
						$this->ci->session->set_userdata(array(
								'user_id'	=> $user->id,
								'username'	=> $user->username,
								'role' 		=> $user->role,
								'status'	=> ($user->activated == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
						));

						if ($user->activated == 0) {							// fail - not activated
							$this->error = array('not_activated' => '');

						} else {												// success
							if ($remember) {
								$this->create_autologin($user->id);
							}

							$this->clear_login_attempts($login);

							$this->ci->users->update_login_info(
									$user->id,
									$this->ci->config->item('login_record_ip', 'tank_auth'),
									$this->ci->config->item('login_record_time', 'tank_auth'));
							return TRUE;
						}
					}
				} else {														// fail - wrong password
					$this->increase_login_attempt($login);
					$this->error = array('password' => 'auth_incorrect_password');
				}
			} else {															// fail - wrong login
				$this->increase_login_attempt($login);
				$this->error = array('login' => 'auth_incorrect_login');
			}
		}
		return FALSE;
	}

	/**
	 * Logout user from the site
	 *
	 * @return	void
	 */
	function logout()
	{
		$this->delete_autologin();

		// See http://codeigniter.com/forums/viewreply/662369/ as the reason for the next line
		$this->ci->session->set_userdata(array('user_id' => '', 'username' => '', 'status' => ''));

		$this->ci->session->sess_destroy();
	}

	/**
	 * Check if user logged in. Also test if user is activated or not.
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_logged_in($activated = TRUE)
	{
		return $this->ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
	}

	/**
	 * Get user_id
	 *
	 * @return	string
	 */
	function get_user_id()
	{
		return $this->ci->session->userdata('user_id');
	}

	/**
	 * Get username
	 *
	 * @return	string
	 */
	function get_username()
	{
		return $this->ci->session->userdata('username');
	}

	/**
	 * Create new user on the site and return some data about it:
	 * user_id, username, password, email, new_email_key (if any).
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	array
	 */
	function create_user($username, $email, $password, $first_name, $last_name, $role)
	{
		if ((strlen($username) > 0) AND !$this->ci->users->is_username_available($username)) {
			$this->error = array('username' => 'auth_username_in_use');

		} elseif (!$this->ci->users->is_email_available($email)) {
			$this->error = array('email' => 'auth_email_in_use');

		} else {
			// Hash password using phpass
			$hasher = new PasswordHash(
					$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
					$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			$hashed_password = $hasher->HashPassword($password);

			$data = array(
				'username'	=> $username,
				'password'	=> $hashed_password,
				'email'		=> $email,
				'first_name'=> $first_name,
				'last_name'	=> $last_name,
				'role'		=> $role,
				'last_ip'	=> $this->ci->input->ip_address(),
			);

			
				$data['new_email_key'] = md5(rand().microtime());
			if (!is_null($res = $this->ci->users->create_user($data))) {
				$data['user_id'] = $res['user_id'];
				$data['password'] = $password;
				unset($data['last_ip']);
				return $data;
			}
		}
		return NULL;
	}

	/**
	 * Check if username available for registering.
	 * Can be called for instant form validation.
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_username_available($username)
	{
		return ((strlen($username) > 0) AND $this->ci->users->is_username_available($username));
	}

	/**
	 * Check if email available for registering.
	 * Can be called for instant form validation.
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		return ((strlen($email) > 0) AND $this->ci->users->is_email_available($email));
	}

	/**
	 * Change email for activation and return some data about user:
	 * user_id, username, email, new_email_key.
	 * Can be called for not activated users only.
	 *
	 * @param	string
	 * @return	array
	 */
	function change_email($email)
	{
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, FALSE))) {

			$data = array(
				'user_id'	=> $user_id,
				'username'	=> $user->username,
				'email'		=> $email,
			);
			if (strtolower($user->email) == strtolower($email)) {		// leave activation key as is
				$data['new_email_key'] = $user->new_email_key;
				return $data;

			} elseif ($this->ci->users->is_email_available($email)) {
				$data['new_email_key'] = md5(rand().microtime());
				$this->ci->users->set_new_email($user_id, $email, $data['new_email_key'], FALSE);
				return $data;

			} else {
				$this->error = array('email' => 'auth_email_in_use');
			}
		}
		return NULL;
	}

	/**
	 * Activate user using given key
	 *
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function activate_user($user_id, $activation_key, $activate_by_email = TRUE)
	{
		$this->ci->users->purge_na($this->ci->config->item('email_activation_expire', 'tank_auth'));

		if ((strlen($user_id) > 0) AND (strlen($activation_key) > 0)) {
			return $this->ci->users->activate_user($user_id, $activation_key, $activate_by_email);
		}
		return FALSE;
	}

	/**
	 * Set new password key for user and return some data about user:
	 * user_id, username, email, new_pass_key.
	 * The password key can be used to verify user when resetting his/her password.
	 *
	 * @param	string
	 * @return	array
	 */
	function forgot_password($login)
	{
		if (strlen($login) > 0) {
			if (!is_null($user = $this->ci->users->get_user_by_login($login))) {

				$data = array(
					'user_id'		=> $user->id,
					'username'		=> $user->username,
					'email'			=> $user->email,
					'new_pass_key'	=> md5(rand().microtime()),
				);

				$this->ci->users->set_password_key($user->id, $data['new_pass_key']);
				return $data;

			} else {
				$this->error = array('login' => 'auth_incorrect_email_or_username');
			}
		}
		return NULL;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function can_reset_password($user_id, $new_pass_key)
	{
		if ((strlen($user_id) > 0) AND (strlen($new_pass_key) > 0)) {
			return $this->ci->users->can_reset_password(
				$user_id,
				$new_pass_key,
				$this->ci->config->item('forgot_password_expire', 'tank_auth'));
		}
		return FALSE;
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user)
	 * and return some data about it: user_id, username, new_password, email.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function reset_password($user_id, $new_pass_key, $new_password)
	{
		if ((strlen($user_id) > 0) AND (strlen($new_pass_key) > 0) AND (strlen($new_password) > 0)) {

			if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

				// Hash password using phpass
				$hasher = new PasswordHash(
						$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
						$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
				$hashed_password = $hasher->HashPassword($new_password);

				if ($this->ci->users->reset_password(
						$user_id,
						$hashed_password,
						$new_pass_key,
						$this->ci->config->item('forgot_password_expire', 'tank_auth'))) {	// success

					// Clear all user's autologins
					$this->ci->load->model('tank_auth/user_autologin');
					$this->ci->user_autologin->clear($user->id);

					return array(
						'user_id'		=> $user_id,
						'username'		=> $user->username,
						'email'			=> $user->email,
						'new_password'	=> $new_password,
					);
				}
			}
		}
		return NULL;
	}

	/**
	 * Change user password (only when user is logged in)
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function change_password($old_pass, $new_pass)
	{
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

			// Check if old password correct
			$hasher = new PasswordHash(
					$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
					$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			if ($hasher->CheckPassword($old_pass, $user->password)) {			// success

				// Hash new password using phpass
				$hashed_password = $hasher->HashPassword($new_pass);

				// Replace old password with new one
				$this->ci->users->change_password($user_id, $hashed_password);
				return TRUE;

			} else {															// fail
				$this->error = array('old_password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	/**
	 * Change user email (only when user is logged in) and return some data about user:
	 * user_id, username, new_email, new_email_key.
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	string
	 * @param	string
	 * @return	array
	 */
	function set_new_email($new_email, $password)
	{
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

			// Check if password correct
			$hasher = new PasswordHash(
					$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
					$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			if ($hasher->CheckPassword($password, $user->password)) {			// success

				$data = array(
					'user_id'	=> $user_id,
					'username'	=> $user->username,
					'new_email'	=> $new_email,
				);

				if ($user->email == $new_email) {
					$this->error = array('email' => 'auth_current_email');

				} elseif ($user->new_email == $new_email) {		// leave email key as is
					$data['new_email_key'] = $user->new_email_key;
					return $data;

				} elseif ($this->ci->users->is_email_available($new_email)) {
					$data['new_email_key'] = md5(rand().microtime());
					$this->ci->users->set_new_email($user_id, $new_email, $data['new_email_key'], TRUE);
					return $data;

				} else {
					$this->error = array('email' => 'auth_email_in_use');
				}
			} else {															// fail
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return NULL;
	}

	/**
	 * Activate new email, if email activation key is valid.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($user_id, $new_email_key)
	{
		if ((strlen($user_id) > 0) AND (strlen($new_email_key) > 0)) {
			return $this->ci->users->activate_new_email(
					$user_id,
					$new_email_key);
		}
		return FALSE;
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @param	string
	 * @return	bool
	 */
	function delete_user($password)
	{
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->users->get_user_by_id($user_id, TRUE))) {

			// Check if password correct
			$hasher = new PasswordHash(
					$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
					$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			if ($hasher->CheckPassword($password, $user->password)) {			// success

				$this->ci->users->delete_user($user_id);
				$this->logout();
				return TRUE;

			} else {															// fail
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	/**
	 * Get error message.
	 * Can be invoked after any failed operation such as login or register.
	 *
	 * @return	string
	 */
	function get_error_message()
	{
		return $this->error;
	}

	/**
	 * Save data for user's autologin
	 *
	 * @param	int
	 * @return	bool
	 */
	private function create_autologin($user_id)
	{
		$this->ci->load->helper('cookie');
		$key = substr(md5(uniqid(rand().get_cookie($this->ci->config->item('sess_cookie_name')))), 0, 16);

		$this->ci->load->model('tank_auth/user_autologin');
		$this->ci->user_autologin->purge($user_id);

		if ($this->ci->user_autologin->set($user_id, md5($key))) {
			set_cookie(array(
					'name' 		=> $this->ci->config->item('autologin_cookie_name', 'tank_auth'),
					'value'		=> serialize(array('user_id' => $user_id, 'key' => $key)),
					'expire'	=> $this->ci->config->item('autologin_cookie_life', 'tank_auth'),
			));
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Clear user's autologin data
	 *
	 * @return	void
	 */
	private function delete_autologin()
	{
		$this->ci->load->helper('cookie');
		if ($cookie = get_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'), TRUE)) {

			$data = unserialize($cookie);

			$this->ci->load->model('tank_auth/user_autologin');
			$this->ci->user_autologin->delete($data['user_id'], md5($data['key']));

			delete_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'));
		}
	}

	/**
	 * Login user automatically if he/she provides correct autologin verification
	 *
	 * @return	void
	 */
	private function autologin()
	{
		if (!$this->is_logged_in() AND !$this->is_logged_in(FALSE)) {			// not logged in (as any user)

			$this->ci->load->helper('cookie');
			if ($cookie = get_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'), TRUE)) {

				$data = unserialize($cookie);

				if (isset($data['key']) AND isset($data['user_id'])) {

					$this->ci->load->model('tank_auth/user_autologin');
					if (!is_null($user = $this->ci->user_autologin->get($data['user_id'], md5($data['key'])))) {

						// Login user
						$this->ci->session->set_userdata(array(
								'user_id'	=> $user->id,
								'username'	=> $user->username,
								'role' 		=> $role->role,
								'status'	=> STATUS_ACTIVATED,
						));

						// Renew users cookie to prevent it from expiring
						set_cookie(array(
								'name' 		=> $this->ci->config->item('autologin_cookie_name', 'tank_auth'),
								'value'		=> $cookie,
								'expire'	=> $this->ci->config->item('autologin_cookie_life', 'tank_auth'),
						));

						$this->ci->users->update_login_info(
								$user->id,
								$this->ci->config->item('login_record_ip', 'tank_auth'),
								$this->ci->config->item('login_record_time', 'tank_auth'));
						return TRUE;
					}
				}
			}
		}
		return FALSE;
	}

	/**
	 * Check if login attempts exceeded max login attempts (specified in config)
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_max_login_attempts_exceeded($login)
	{
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			$this->ci->load->model('tank_auth/login_attempts');
			return $this->ci->login_attempts->get_attempts_num($this->ci->input->ip_address(), $login)
					>= $this->ci->config->item('login_max_attempts', 'tank_auth');
		}
		return FALSE;
	}

	/**
	 * Increase number of attempts for given IP-address and login
	 * (if attempts to login is being counted)
	 *
	 * @param	string
	 * @return	void
	 */
	private function increase_login_attempt($login)
	{
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			if (!$this->is_max_login_attempts_exceeded($login)) {
				$this->ci->load->model('tank_auth/login_attempts');
				$this->ci->login_attempts->increase_attempt($this->ci->input->ip_address(), $login);
			}
		}
	}

	/**
	 * Clear all attempt records for given IP-address and login
	 * (if attempts to login is being counted)
	 *
	 * @param	string
	 * @return	void
	 */
	private function clear_login_attempts($login)
	{
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			$this->ci->load->model('tank_auth/login_attempts');
			$this->ci->login_attempts->clear_attempts(
					$this->ci->input->ip_address(),
					$login,
					$this->ci->config->item('login_attempt_expire', 'tank_auth'));
		}
	}

		/* Thesis Codes */



//THESIS CODES

		//General

	function create_dorm($dorm_sector, $dorm_name, $incharge, $capacity)
	{
		$data = array(
			'd_sector' =>$dorm_sector,
			'd_name' =>$dorm_name,
			'd_in_charge' =>$incharge,
			'd_capacity' =>$capacity);

		if (!is_null($res = $this->ci->users->create_dorm($data))) 
		{
			return $data;
		}
		return NULL;
	}

	function get_role()
	{
		return $this->ci->session->userdata('role');
	}

	function insert_file_db($file_name, $file_type, $file_path, $file_ext, $sw_id, $client_id, $user_id, $file_ploc, $document_type)
	{

		$data = array(
			'file_name' => $file_name,
			'file_type' => $file_type,
			'file_location' => $file_path,
			'file_extention' => $file_ext,
			'file_owner'	=> $sw_id,
			'file_client'	=> $client_id,
			'file_uploader' => $user_id,
			'file_ploc'		=> $file_ploc,
			'document_type' => $document_type
			);
		$data['created'] = date('Y-m-d H:i:s');
		if (!is_null($res = $this->ci->files->insert_file_db($data))) 
		{
			return $data;
		}
		return NULL;

	}

	function set_notification($sw_id, $notif_number)
	{
		$data = array(
			'message' => $notif_number,
			'receiver_id' => $sw_id
			);
		if(!is_null($res = $this->ci->files->set_message($data)))
		{
			return $data;
		}
		return NULL;
	}

	function insert_msg($user_id, $msg, $user_chat_id)
	{

		$data = array(
			'sender' 		=> $user_id,
			'message' 		=> $msg,
			'receiver' 		=> $user_chat_id,
			);
		$data['date_time'] = date('Y-m-d H:i:s');

		if (!is_null($res = $this->ci->clients->insert_msg($data))) 
		{
			return $data;
		}
		return NULL;
	}

	function get_indiv_client($client_id)
	{

		$data = array('client_id'	=> $client_id);
		if (!is_null($res = $this->ci->client->get_indiv_client($data))) 
		{
        return $data;
       	}
    
   		return NULL;
	}

	function get_client_by_id($client_id)
	{
		$data = array('client_id' => $client_id);
		if (!is_null($res = $this->ci->clients->get_client_by_id($data))) 
		{
		return $data;
		}
		return NULL;
	}


	function create_request($client_id, $sw_id, $request_type, $Reason)
	{

		$data = array(
			'client_id' => $client_id,
			'sender' => $sw_id,
			'request_type' => $request_type,
			'Reason' => $Reason
		
			
			);
		if (!is_null($res = $this->ci->clients->create_request($data))) 
		{
			return $data;
		}
		return NULL;
	}

	function insert_audit($user_id, $file_name, $action, $sw_id)
	{
		$data = array(
			'file_name' => $file_name,
			'user_id' => $user_id,
			'a_action' => $action,
			'file_owner' =>$sw_id
			);
		if(!is_null($res = $this->ci->files->insert_audit($data)))
		{
			return $data;
		}
		return NULL;
	}



	// SOCIAL WORKER
	function insert_profile_picture($client_id, $file_path)
	{
		$data = array(
			'profile_pic' => $file_path);
		$this->ci->clients->insert_profile_picture($client_id, $data);
		return null;
	}

	function create_client($Fname, $Lname, $Mname, $Sector, $Dorm, $SocialW, $Gender, $Birthday, $Birthplace, $admission_type)
	{

			$data = array(
				'client_fname'	=> $Fname,
				'client_lname'	=> $Lname,
				'client_mname'	=> $Mname,
				'client_sector'	=> $Sector,
				'dorm_id'		=> $Dorm,
				'sw_id' 		=> $SocialW,
				'gender' 		=> $Gender,
				'birthday'		=> $Birthday,
				'birthplace' 	=> $Birthplace,
				'admission_type' => $admission_type,
			);

			
			$res = $this->ci->clients->create_client($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
			}
		
		return null;
	}
	function create_agen($client_id, $agenName, $agenAdd, $agenContact, $agenSW, $agenSWContact, $agenReason, $agenServices)
	{

			$data = array(
				'client_id'			=> $client_id,
				'agency_name'		=> $agenName,
				'agency_add'		=> $agenAdd,
				'agency_contact'	=> $agenContact,
				'agency_sw_name'	=> $agenSW,
				'agency_sw_contact' => $agenSWContact,
				'agency_reason' 	=> $agenReason,
				'agency_service'	=> $agenServices,

			);
			
			$res = $this->ci->files->create_in_agen($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
			}
		
		return null;
	}

	function create_sur($client_id, $surrenderer_name, $surrenderer_rel, $surrenderer_age, $surrenderer_add, $surrenderer_gender, $surrenderer_contact, $surrenderer_reason)
	{

			$data = array(
				'client_id'		=> $client_id,
				'surrender_name'=> $surrenderer_name,
				'surrender_rel'	=> $surrenderer_rel,
				'surrender_age'	=> $surrenderer_age,
				'surrender_address'	=> $surrenderer_add,
				'surrender_gender' 	=> $surrenderer_gender,
				'surrender_contact' => $surrenderer_contact,
				'surrender_reason'	=> $surrenderer_reason,
			);

			
			$res = $this->ci->files->create_in_sur($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
			}
		
		return null;
	}

	function create_walk($client_id, $founder_name, $found_when, $found_where, $found_address, $found_contact, $found_age, $found_gender)
	{

			$data = array(
				'client_id'		=> $client_id,
				'founder_name'	=> $founder_name,
				'founder_when'	=> $found_when,
				'founder_where'	=> $found_where,
				'founder_address'=> $found_address,
				'founder_contact' => $found_contact,
				'founder_age' 	=> $found_age,
				'founder_gender'=> $found_gender,
			);

			
			$res = $this->ci->files->create_in_walk($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
			}
		
		return null;
	}

	function create_client_info($client_id, $admission_type, $Fname, $Lname, $Mname, 
		$Dorm, $SociaW, $Gender, $Birthday, $Birthplace, 
		$nickname, $civilStat, $religion, $baptized, $nationality, 
		$educAttain,$schoolAttended, $emergencyAdd, $emergencyPerson, 
		$emergencyContact, $presentedID, $healthStat, $Sector)
	{

			$data = array(
				'client_id'		=> $client_id,
				'client_fname'	=> $Fname,
				'client_lname'	=> $Lname,
				'client_mname'	=> $Mname,
				'client_sector'	=> $Sector,
				'dorm_id'		=> $Dorm,
				'sw_id' 		=> $SociaW,
				'gender' 		=> $Gender,
				'birthday'		=> $Birthday,
				'birthplace' 	=> $Birthplace, 
				'admission_type'=> $admission_type,
				'client_status' => '0',
				'nickname'		=> $nickname,
				'civil_status' 	=> $civilStat,
				'religion' 		=> $religion,
				'baptized' 		=> $baptized,
				'nationality' 	=> $nationality,
				'school_attended' 	=> $schoolAttended,
				'educ_attained' => $educAttain,
				'emergency_name'=> $emergencyPerson,
				'emergency_add'	=> $emergencyAdd,
				'emergency_contact'=> $emergencyContact,
				'id_presented' 	=> $presentedID,
			);

			
			$res = $this->ci->files->create_client($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
			}
		
		return null;
	}

	function create_bg_info($client_id, $problem, $desscription, $prob_when, $prob_circumstances,
		 $prob_duration, $prob_self_diagnosis, $healthHis, $immediateProb, $underlyingNeeds, 
		$motivation, $resource)
	{

		$data = array(
			'client_id'			=> $client_id,
			'problem'			=> $problem,
			'problem_when'		=> $prob_when,
			'problem_duration'	=> $prob_duration,
			'problem_circums'	=> $prob_circumstances,
			'problem_self_diag'	=> $prob_self_diagnosis,
			'intake_desc' 		=> $desscription,
			'health_history' 	=> $healthHis,
			'assess_problem'	=> $immediateProb,
			'assess_needs' 		=> $underlyingNeeds, 
			'assess_motiv'		=> $motivation,
			'assess_resource' 	=> $resource,
		
		);



		
		$res = $this->ci->files->create_client_bg($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			return $data;
		}
	
		return null;
	}

	function insert_fam_mem($client_id, $FamName, $FamRel, $FamAge, $FamCS, $FamEduc, $FamOccu, $FamAdd)
	{

		$data_fam = array(
			'client_id'		=> $client_id,
			'name'			=> $FamName,
			'relationship'	=> $FamRel,
			'age'			=> $FamAge,
			'civil_status'	=> $FamCS,
			'educ_attained'	=> $FamEduc,
			'occupation' 	=> $FamOccu,
			'address' 		=> $FamAdd,
			
		
		);

		
		$res = $this->ci->files->insert_fam_mem($data_fam);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			return $data;
		}
		
		return null;
	}
	
	function create_intake(
		$Fname, $Lname, $Mname,$Sector, $Dorm, 
		$sw_id, $Gender, $Birthday, $Birthplace, $admission_type,  
		$nickname, $civilStat, $religion, $baptized,
		$nationality, $presentAdd, $contactNum, $permanentAdd,
		$educAttain, $emergencyPerson, $emergencyAdd, $emergencyContact, $referralSource, 
		$sourceAdd, $sourceContact, $presentID,$FamName1,$FamRel1,$FamAge1, $FamCS1,$FamEduc1,$FamOccu1,$FamAdd1)
	{
		
		$data['created'] = date('Y-m-d H:i:s');
		$data_profile['created'] = date('Y-m-d H:i:s');
			$data_profile = array(
				'client_fname'	=> $Fname,
				'client_lname'	=> $Lname,
				'client_mname'	=> $Mname,
				'client_sector'	=> $Sector,
				'dorm_id'		=> $Dorm,
				'sw_id' 		=> $sw_id,
				'gender' 		=> $Gender,
				'birthday'		=> $Birthday,
				'birthplace' 	=> $Birthplace, 
				'admission_type'=> $admission_type,
				'client_status' => '0'
				);
			
			$data = array(

				'nickname'		=> $nickname,
				'civil_status' 	=> $civilStat,
				'religion' 		=> $religion,
				'baptized' 		=> $baptized,
				'nationality' 	=> $nationality,
				'present_add' 	=> $presentAdd,
				'contact_num' 	=> $contactNum,
				'permanent_add' => $permanentAdd,
				'educ_attained' => $educAttain,
				'emergency_name'=> $emergencyPerson,
				'emergency_add'	=> $emergencyAdd,
				'emergency_contact'=> $emergencyContact,
				'referral_source'=> $referralSource,
				'source_add'	=> $sourceAdd,
				'source_contact'=> $sourceContact,
				'id_presented' 	=> $presentID
			);

			$data_family =  array(
				'name'			=> $FamName1,
				'relationship'	=> $FamRel1,
				'age' 			=> $FamAge1,
				'civil_status'	=> $FamCS1,
				'educ_attained'	=> $FamEduc1,
				'occupation'	=> $FamOccu1,
				'address'		=> $FamAdd1,
				
			);

			
			$res = $this->ci->files->create_intake( $data_profile,$data);
			if (!is_null($res)) {
				$data['intake_id'] = $res;
				return $data;
			}
		
		return null;
	}

	function create_intake2($intake_id, $problem, $agenName, $agenReason, $agenServices,
		$prob_when,$prob_duration,$prob_circumstances,$prob_self_diagnosis, $description,$healthHis, $famBG, $immediateProb, $underlyingNeeds, 
		$motivation,$resource, 
		$surrenderer_name, $surrenderer_rel,$surrenderer_age, $surrenderer_gender,  $surrenderer_add, $surrenderer_contact, $surrenderer_reason,
		$founder_name, $found_when, $found_where, $found_address, $found_contact, $found_age, $found_gender)
	{
		$data = array(
			'intake_id'			=> $intake_id,
			'problem'			=> $problem,
			'agent_name'		=> $agenName,
			'agent_reason'		=> $agenReason,
			'agent_service'	=> $agenServices,
			'problem_when'	=> $prob_when,
			'problem_history'	=> $prob_duration,
			'problem_circumstances'	=> $prob_circumstances,
			'problem_self_diagnosis'	=> $prob_self_diagnosis,
			'intake_desc' 		=> $description,
			'health_history'	=> $healthHis,
			'family_bg' 		=> $famBG,
			'assess_problem' 	=> $immediateProb,
			'assess_needs' 		=> $underlyingNeeds,
			'assess_motiv' 		=> $motivation,
			'assess_resource' 	=> $resource
			);

		if(!is_null($surrenderer_name))
		{
		$data_surrenderer = array(
			'intake_id'			=> $intake_id,
			'surrender_name' =>$surrenderer_name, 
			'surrender_rel' =>$surrenderer_rel, 
			'surrender_age'	=>$surrenderer_age,
			'surrender_gender' =>$surrenderer_gender, 
			'surrender_address' =>$surrenderer_add, 
			'surrender_contact' =>$surrenderer_contact, 
			'surrender_reason' =>$surrenderer_reason
			);
		$this->ci->files->insert_surrenderer($data_surrenderer);
		}
		elseif(!is_null($founder_name)){
		$data_founder =array(
			'intake_id'			=> $intake_id,
			'founder_name' =>$founder_name, 
			'founder_when' =>$found_when, 
			'founder_where' =>$found_where, 
			'founder_address' =>$found_address, 
			'founder_contact' =>$found_contact, 
			'founder_age' =>$found_age, 
			'founder_gender' =>$found_gender
			);
			$this->ci->files->insert_founder($data_founder);
		}

		$res = $this->ci->files->create_intake2($data);
		if (!is_null($res)) {
			$data['intake_id'] = $res;
			return $data;
			}
		return NULL;
	}

	function create_pre_admission_CC($client_id, $Schedule, $user_id, $start_time, $end_time, $conference_type)
	{



		$data = array(
				'schedule'			=> $Schedule,
				'client_id'			=> $client_id,
				'user_id'			=> $user_id,
				'start_time'			=> $start_time,
				'end_time'			=> $end_time,
				'conference_type'	=> $conference_type
			);

		$res = $this->ci->users->create_pre_admission_CC($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				$data['id'] = $res;
				return $data;
			}
		
		return null;
		
	}

	function insert_pre_ad_attendee($id, $attendant)
	{
		$data = array(
			'conference_id' => $id,
			'user_id' => $attendant
			);
		$res = $this->ci->users->insert_pre_ad_attendee($data);
		return null;
	}

	function create_POA($client_id, $user_id)
	{
		$data = array(
			'client_id' => $client_id,
			'user_id' => $user_id
			);
		$res = $this->ci->files->create_POA($data);
				if (!is_null($res)) {
					$data['id'] = $res;
					return $data;
					}
				return NULL;
	}

	function insert_POA_task($plan_of_action_id, $POAtask, $Person_Responsible, $start_date, $end_date, $remarks)
	{
		$data = array(
			'plan_of_action_id' => $plan_of_action_id,
			'task' => $POAtask,
			'per_res_id' => $Person_Responsible,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'remarks' => $remarks,
			);
		$res = $this->ci->files->insert_POA_task($data);
				if (!is_null($res)) {
					$data['id'] = $res;
					return $data;
					}
				return NULL;
	}
	function create_dis_slip($client_id, $dischargeReason, $address, $contactNum, $SocialW)
	{
		$data = array(
			'client_id'		=> $client_id,
			'dis_reason'	=> $dischargeReason,
			'address' 		=> $address,
			'contact_num' 	=> $contactNum,
			'sw_id'			=> $SocialW,
		);

		
		$res = $this->ci->files->create_dis_sl($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			
			return $data;
		}
	
		return null;
	}

	function create_mediaCer($client_id, $bodyBuilt, 
			 $bioMom, $bioDad, $tvRadioProg, $airedTime, 
			 $airedDate, $announcer, $person1, $person2, $person3, 
			 $SocialW)
	{
			
		$data['created'] = date('Y-m-d H:i:s');
			$data = array(
				'client_id'		=>$client_id,
				'body_built'	=> $bodyBuilt,
				'biological_mom'=> $bioMom,
				'biological_dad'=> $bioDad,
				'tv_radio' 		=> $tvRadioProg,
				'aired_time' 	=> $airedTime,
				'aired_date'	=> $airedDate,
				'announcer' 	=> $announcer,
				'witness_1' 	=> $person1,
				'witness_2' 	=> $person2,
				'witness_3' 	=> $person3,
				'sw_id'			=> $SocialW,
			);

			
			$res = $this->ci->files->create_media($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				
				return $data;
			}
		
		return null;

	}
	function create_dis_adop($client_id, $numMonths, $adopFather, $adopMother, $SocialW)
	{
		$data = array(
			'client_id'		=> $client_id,
			'num_months'	=> $numMonths,
			'adop_father' 		=> $adopFather,
			'adop_mother' 	=> $adopMother,
			'sw_id'			=> $SocialW,
		);

		
		$res = $this->ci->files->create_dis_a($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			
			return $data;
		}
	
		return null;
	}


	function create_dis_sum($client_id, $dischargeTo, $dischargeReason, $caseSum, $postPlaceStat,
							$SocialW)
	{
		$data = array(
			'client_id'			=> $client_id,
			'discharge_to'		=> $dischargeTo,
			'discharge_reason' 	=> $dischargeReason,
			'case_summary' 		=> $caseSum,
			'post_place_stat' 	=> $postPlaceStat,
			'sw_id'				=> $SocialW,
		);

		
		$res = $this->ci->files->create_dis_su($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			
			return $data;
		}
	
		return null;
	}

	function create_intial_case($client_id, $exceptionality, $presentEnvi, $currentFam, $referalAdmission, 
		$abandonFact, $evalReco)
	{

		$data = array(
			'client_id' 		=> $client_id,
			'exceptionality' 	=> $exceptionality,
			'present_envi' 		=> $presentEnvi,
			'fam_details' 		=> $currentFam,
			'circumstances' 	=> $referalAdmission,
			'facts_abandonment' => $abandonFact,
			'eval_reco' 		=> $evalReco,
			);
		$data['created'] = date('Y-m-d H:i:s');

		if (!is_null($res = $this->ci->clients->create_initial_case($data))) 
		{
			return $data;
		}
		return NULL;
	}

	function create_socialCase( $medicalDev, $presentEnvi, $evalReco,$client_id)
	{

		$data = array(
			
			'medical_development'	=> $medicalDev,
			'present_description' 		=> $presentEnvi,
			
			'Eval_reco' 		=> $evalReco,
			'client_id' 		=> $client_id,
			);
		$data['created'] = date('Y-m-d H:i:s');

		if (!is_null($res = $this->ci->clients->create_social_case($data))) 
		{
			return $data;
		}
		return NULL;
	}

	//NURSE

	function insert_measurements($client_id, $bloodP, $pulseRate, $height, $weight, 
		$temperature, $respiRate, $headCir, $chestCir, $abdoCir, 
		$user_id)
	{
		$data = array(
			'client_id'		=> $client_id,
			'blood_pressure'=> $bloodP,
			'pulse_rate'	=> $pulseRate,
			'height'		=> $height,
			'weight'		=> $weight,
			'temperature'	=> $temperature,
			'respiratory_rate'=> $respiRate,
			'head_circum'	=> $headCir,
			'chest_circum'	=> $chestCir,
			'abdomen_circum'=> $abdoCir,
			'examiner_id' 	=> $user_id,
			);

		$res = $this->ci->clients->insert_measurements($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				
				return $data;
			}
		
		return null;

	}


	function insert_present($client_id, $presentApp, $admissionApp, $marksPhy, $hairColor, $eyeColor, $skinColor)
	{
		$data = array(
			'client_id'		=> $client_id,
			'present_app' 	=> $presentApp,
			'admission_app' => $admissionApp,
			'marks_physical' => $marksPhy,
			'hair_color' 	=> $hairColor,
			'eye_color' 	=> $eyeColor,
			'skin_color' 	=> $skinColor);


		$res = $this->ci->clients->insert_present($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			return $data;
			}
		
		return null;
	}

	function insert_growth_record($client_id, $yearMonth,$ageMonth,$weightKilos,$lengthHeight,
		$HCcm,$CCcm,$teeth)
	{
		$data = array(
			'client_id' => $client_id,
			'year_month'	=>$yearMonth,
			'age_month'=> $ageMonth,
			'weight_kilos' => $weightKilos,
			'length_height' => $lengthHeight,
			'HC_cm' => $HCcm,
			'CC_cm'	=>$CCcm,
			'teeth'=> $teeth,
			);
			$res = $this->ci->clients->insert_growth($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			return null;
	}

	function insert_impairment($client_id, $body_part, $observation)
	{
		$data = array(
			'client_id'		=> $client_id,
			'body_part'		=> $body_part,
			'observation'	=> $observation,
			);

		$res = $this->ci->clients->insert_impairment($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			return $data;
			}
		
		return null;
	}


	function insert_birth_history($client_id, $forcep, $bornAt, $deliverBy, $deliverName, $compli, 
		 $weightBirth, $lengthBirth, $headCirBirth, $chestCirBirth, $apgarScore, 
		 $abnormalBirth)
	{
		$data = array(
				'client_id'		=> $client_id,
				'forcep'		=> $forcep,
				'born_at'		=> $bornAt,
				'deliver_by'	=> $deliverBy,
				'deliver_name'	=> $deliverName,
				'complication' 	=> $compli,
				'weight_birth'	=> $weightBirth,
				'length_birth' 	=> $lengthBirth,
				'head_cir_birth'=> $headCirBirth,
				'chest_cir_birth'=> $chestCirBirth,
				'apgar_score' 	=> $apgarScore,
				'abnormal_birth' => $abnormalBirth);
		
		$res = $this->ci->clients->insert_birth_history($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			return $data;
			}
		
		return null;
	}

	function insert_immunizations($client_id, $immunizations, $immunization_date, $immunization_physician)
	{
		$data = array(
			'client_id' => $client_id,
			'immunization'	=>$immunizations,
			'immunization_date'=> $immunization_date,
			'immunization_physician' => $immunization_physician
			);
			$res = $this->ci->clients->insert_immunizations($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			
			return null;
	}

	function insert_lab_test($client_id, $labDate, $labTest, $labResult,$labAction)
	{
		$data = array(
			'client_id' => $client_id,
			'lab_date'	=>$labDate,
			'lab_test'=> $labTest,
			'lab_result' => $labResult,
			'lab_action' => $labAction
			);
			$res = $this->ci->clients->insert_lab_test($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			
			return null;
	}
	function insert_illnesses($client_id, $illDate, $illAge, $illName, $illMed)
	{
		$data = array(
			'client_id' => $client_id,
			'ill_date'	=>$illDate,
			'ill_age'=> $illAge,
			'ill_name' => $illName,
			'ill_med' => $illMed
			);
			$res = $this->ci->clients->insert_illnesses($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			return null;
	}

	function insert_illnesses_bg($client_id, $illActive, $illCompli)
	{
		$data = array(
			'client_id' => $client_id,
			'ill_active'	=>$illActive,
			'ill_complication'=> $illCompli,
			
			);
			$res = $this->ci->clients->insert_illnesses_bg($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			return null;
	}

	function insert_mishap($client_id, $misDate, $misDesc, $misEff, $misClass)
	{
		$data = array(
			'client_id' 	=> $client_id,
			'mishap_date'	=> $misDate,
			'mishap_desc'	=> $misDesc,
			'mishap_effect' => $misEff,
			'mishap_class' 	=> $misClass
			);
			$res = $this->ci->clients->insert_mishap($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			return null;
	}

	function insert_medical_problems($client_id, $medClient,$medTake,$medPhysician,$medReason,
		$medSeizure,$medChronic,$medAllergic,$medAllergicMed,$dentalHealth,$dentalProgress)
	{
		$data = array(
			'client_id' => $client_id,
			'medication'	=>$medClient,
			'times_per_day'=> $medTake,
			'perscriber' => $medPhysician,
			'reason' => $medReason,
			'seizures' => $medSeizure,
			'chronic'	=>$medChronic,
			'allergy'=> $medAllergic,
			'allergy_medication' => $medAllergicMed,
			'dental_health' => $dentalHealth,
			'dental_progress' => $dentalProgress
			);
			$res = $this->ci->clients->insert_medical_problems($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			return null;
	}

	function insert_notes_recommendation($client_id, $notesReco,$licenseNo,$ptrNo,$hospitalClinic)
	{
		$data = array(
			'client_id' => $client_id,
			'notes'	=>$notesReco,
			'license'=> $licenseNo,
			'PTR' => $ptrNo,
			'facility' => $hospitalClinic
			);
			$res = $this->ci->clients->insert_notes_recommendation($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				return $data;
				}
			return null;
	}

	function create_homeVisit($response, $visitDate, $visitPlace, $obj, $narra,
			 $assess, $client_id, $user_id)
	{
			
		$data['created'] = date('Y-m-d H:i:s');
			$data = array(
				'response'		=> $response,
				'visit_date'	=> $visitDate,
				'visit_place'	=> $visitPlace,
				'objective'		=> $obj,
				'narration'		=> $narra,
				'assessment'	=> $assess,
				'client_id' 	=> $client_id,
				'sw_id' 		=> $user_id,
			);

			
			$res = $this->ci->files->create_home($data);
			if (!is_null($res)) {
				$data['home_visit_id'] = $res;
				
				return $data;
			}
		
		return null;
	}



	//HOUSE PARENTS
	function create_report_log($client_id, $remark, $user_id)
	{
			$data = array(
				'client_id'			=> $client_id,
				'remark'			=> $remark,
				'hp_id' 			=> $user_id,
			);

			
			$res = $this->ci->files->create_report_hp($data);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				
				return $data;
			}
		
		return null;
	
	}


	//General

	function give_decision($decision, $conference_id, $user_id)
	{
		$data = array(
			'status' => $decision);

			$res = $this->ci->users->give_decision($data, $conference_id, $user_id);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				
				return $data;
			}
		
		return null;

	}

	function insert_conference_point($conference_id, $client_id, $point)
	{
		$data = array(
			'conference_id' => $conference_id,
			'client_id' =>$client_id,
			'main_topic' => $point);

			$res = $this->ci->clients->insert_conference_point($data);
			if (!is_null($res)) {
				
				return $res;
			}
		
		return null;

	}
	function insert_sub_topic($topic_id, $sub)
	{
		$data = array(
			'main_topic_id' => $topic_id,
			'sub_topic' => $sub);
			$res = $this->ci->clients->insert_sub_topic($data);
			if (!is_null($res)) {
				
				return $res;
			}
		
		return null;

	}

	function create_psycho_rep($client_id, $educAttain, $referBy, $referDate, $referReason,
		 $caseBG, $observedBeh, $intAbility, $emoStat, $impre,
		 $recom, $test1, $test2, $test3, $test4, 
		 $test5, $test6, $test7, $test8, $test9, 
		 $test10, $dateTest1, $dateTest2, $dateTest3, $dateTest4, 
		 $dateTest5, $dateTest6, $dateTest7, $dateTest8, $dateTest9,
		 $dateTest10, $user_id)
	{
			
		$data['created'] = date('Y-m-d H:i:s');
			$data = array(
				'client_id'			=> $client_id,
				'educ_attain'		=> $educAttain,
				'refer_by'			=> $referBy,
				'refer_date'		=> $referDate,
				'refer_reason'		=> $referReason,
				'case_bg'			=> $caseBG,
				'observed_beh'		=> $observedBeh,
				'intellectual_ability'=> $intAbility,
				'emotional_stat'	=> $emoStat,
				'impression'		=> $impre,
				'recommendation'	=> $recom,
				'psycho_id'				=> $user_id,
			);

			$data2 = array(
				'client_id'			=> $client_id,
				'test'				=> $test1,
				'date_test'			=> $dateTest1,
				'test'				=> $test2,
				'date_test'			=> $dateTest2,
				'test'				=> $test3,
				'date_test'			=> $dateTest3,
				'test'				=> $test4,
				'date_test'			=> $dateTest4,
				'test'				=> $test5,
				'date_test'			=> $dateTest5,
				'test'				=> $test6,
				'date_test'			=> $dateTest6,
				'test'				=> $test7,
				'date_test'			=> $dateTest7,
				'test'				=> $test8,
				'date_test'			=> $dateTest8,
				'test'				=> $test9,
				'date_test'			=> $dateTest9,
				'test'				=> $test10,
				'date_test'			=> $dateTest10,

			);

			
			$res = $this->ci->files->create_psych($data, $data2);
			if (!is_null($res)) {
				$data['client_id'] = $res;
				
				return $data;
			}
		
		return null;
	}

	function create_kasundu($Pname, $address, $client_id, $duration, $signature,
						$witness1, $witness2, $user_id)
	{
		$data = array(
			'parent_name'		=> $Pname,
			'address'			=> $address,
			'client_id' 		=> $client_id,
			'duration' 			=> $duration,
			'signature' 		=> $signature,
			'witness_1'			=> $witness1,
			'witness_2'			=> $witness2,
			'sw_id'				=> $user_id,

		);

		
		$res = $this->ci->files->create_kasun($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			
			return $data;
		}
	
		return null;
	}

	function create_conference($Conference_Type, $Location, $Schedule, $start_time, $end_time, $capacity)
	{
		$data = array(
			'Conference_Type' => $Conference_Type,
			'Location'			=>$Location,
			'Schedule'			=>$Schedule,
			'start_time'		=>$start_time,
			'end_time'			=>$end_time,
			'capacity'			=>$capacity
			);
		$res = $this->ci->users->create_conference($data);
		if (!is_null($res)) {
			return $data;
		}
	
		return null;
	}

	function conference_add_client($client, $conference_id, $user_id)
	{
		$data = array(
			'conference_id' => $conference_id,
			'client_id'			=>$client,
			'user_id'			=>$user_id,
			);
		$res = $this->ci->users->conference_add_clients($data);
		if (!is_null($res)) {
			return $data;
		}
	
		return null;
	}

	function end_conference($conference_id)
	{
		$data = array(
			'conference_id' => $conference_id,
			'client_id'			=>$client,
			'user_id'			=>$user_id,
			);
		$res = $this->ci->users->end_conference($data);
		if (!is_null($res)) {
			return $data;
		}
	
		return null;
	}

	function create_pt_report($client_id, $coveredPeriod, $diag, $prob1, $prob2, $prob3, $prog1, $prog2, $prog3, $presentPlan1, $presentPlan2, $presentPlan3, $reco, $user_id)
	{
		$data = array(
			'client_id'		=> $client_id,
			'reco'			=> $reco,
			'covered_period'=> $coveredPeriod,
			'diagnosis'		=> $diag,
			'problem_1' 	=> $prob1,
			'problem_2'		=> $prob2,
			'problem_3'		=> $prob3,
			'progress_1' 	=> $prog1,
			'progress_2'	=> $prog2,
			'progress_3'	=> $prog3,
			'plan_1' 		=> $presentPlan1,
			'plan_2'		=> $presentPlan2,
			'plan_3'		=> $presentPlan3,
			'physical_id' 	=> $user_id,

		);

		
		$res = $this->ci->files->create_pt_report($data);
		if (!is_null($res)) {
			$data['client_id'] = $res;
			
			return $data;
		}
	
		return null;
	}

	function create_indie_home_plan($user_id, $client_id)
	{
		$data = array(
			'sw_id' => $user_id,
			'client_id' => $client_id
			);

			$res = $this->ci->clients->create_indie_home_plan($data);
			if (!is_null($res)) {
				
				return $res;
			}
		
		return null;

	}
	function create_indie_home_plan_item($home_plan_id, $time_start, $time_end, $activity, $person)
	{
		$data = array(
		'home_plan_id' => $home_plan_id,
		'time_start' => $time_start,
		'time_end' => $time_end,
		'activity' => $activity,
		'person_responsible' => $person	);

			$res = $this->ci->clients->create_indie_home_plan_item($data);
			if (!is_null($res)) {
				
				return $res;
			}
		
		return null;
	}

}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */