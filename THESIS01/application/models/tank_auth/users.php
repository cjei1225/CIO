<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Users extends CI_Model
{
	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_id($user_id)
	{
		$this->db->where('id', $user_id);
		

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->result();
		return NULL;
	}

	/**
	 * Get user record by login (username or email)
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_login($login)
	{
		$this->db->where('LOWER(username)=', strtolower($login));
		$this->db->or_where('LOWER(email)=', strtolower($login));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by username
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_username($username)
	{
		$this->db->where('LOWER(username)=', strtolower($username));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_email($email)
	{
		$this->db->where('LOWER(email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Check if username available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_username_available($username)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(username)=', strtolower($username));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	/**
	 * Check if email available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email)=', strtolower($email));
		$this->db->or_where('LOWER(new_email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	/**
	 * Create new user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_user($data, $activated = TRUE)
	{

		do {
			$data['id'] = (rand(50,495)*2014) + (rand(0,1100)*11);
			$this->db->select('id');
			$this->db->where('id', $data['id']);
			$query = $this->db->get($this->table_name);
		} while($query->num_rows() > 0);
		
		$data['created'] = date('Y-m-d H:i:s');
		$data['activated'] = $activated ? 1 : 0;

		if ($this->db->insert($this->table_name, $data)) {
			$user_id = $this->db->insert_id();
			if ($activated)	$this->create_profile($user_id);
			return array('user_id' => $user_id);
		}
		return NULL;
	}

	/**
	 * Activate user if activation key is valid.
	 * Can be called for not activated users only.
	 *
	 * @param	int
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function activate_user($user_id, $activation_key, $activate_by_email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		if ($activate_by_email) {
			$this->db->where('new_email_key', $activation_key);
		} else {
			$this->db->where('new_password_key', $activation_key);
		}
		$this->db->where('activated', 0);
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() == 1) {

			$this->db->set('activated', 1);
			$this->db->set('new_email_key', NULL);
			$this->db->where('id', $user_id);
			$this->db->update($this->table_name);

			$this->create_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Purge table of non-activated users
	 *
	 * @param	int
	 * @return	void
	 */
	function purge_na($expire_period = 172800)
	{
		$this->db->where('activated', 0);
		$this->db->where('UNIX_TIMESTAMP(created) <', time() - $expire_period);
		$this->db->delete($this->table_name);
	}

	/**
	 * Delete user record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_user($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Set new password key for user.
	 * This key can be used for authentication when resetting user's password.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function set_password_key($user_id, $new_pass_key)
	{
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	function can_reset_password($user_id, $new_pass_key, $expire_period = 900)
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	/**
	 * Change user password if password key is valid and user is authenticated.conference_pending_clients
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900)
	{
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Change user password
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function change_password($user_id, $new_pass)
	{
		$this->db->set('password', $new_pass);
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Set new email for user (may be activated or not).
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function set_new_email($user_id, $new_email, $new_email_key, $activated)
	{
		$this->db->set($activated ? 'new_email' : 'email', $new_email);
		$this->db->set('new_email_key', $new_email_key);
		$this->db->where('id', $user_id);
		$this->db->where('activated', $activated ? 1 : 0);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Activate new email (replace old email with new one) if activation key is valid.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($user_id, $new_email_key)
	{
		$this->db->set('email', 'new_email', FALSE);
		$this->db->set('new_email', NULL);
		$this->db->set('new_email_key', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_email_key', $new_email_key);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function update_login_info($user_id, $record_ip, $record_time)
	{
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);

		if ($record_ip)		$this->db->set('last_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('last_login', date('Y-m-d H:i:s'));

		$this->db->where('id', $user_id);
		$this->db->update($this->table_name);
	}

	/**
	 * Ban user
	 *
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function ban_user($user_id, $reason = NULL)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 1,
			'ban_reason'	=> $reason,
		));
	}

	/**
	 * Unban user
	 *
	 * @param	int
	 * @return	void
	 */
	function unban_user($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 0,
			'ban_reason'	=> NULL,
		));
	}

	/**
	 * Create an empty profile for a new user
	 *
	 * @param	int
	 * @return	bool
	 */
	private function create_profile($user_id)
	{
		$this->db->set('user_id', $user_id);
		return $this->db->insert($this->profile_table_name);
	}

	/**
	 * Delete user profile
	 *
	 * @param	int
	 * @return	void
	 */
	private function delete_profile($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->profile_table_name);
	}

	function get_house_parents()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role', '5');
		$this->db->where_not_in('users.id', 'dormitory.d_in_charge');
		//$this->db->where("NOT EXISTS (select '*' from dormitory where dormitory.d_in_charge = users.id", null, false);
		$query = $this->db->get('');

		return $query->result();
	}

	function create_dorm($data)
	{
		$this->db->insert('dormitory', $data);
	
		
		return TRUE;	
	}

	function get_Social_Workers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role', '1');

		$query = $this->db->get();

		return $query->result();
	}

	function test($username)
	{	

		$this->db->select('*');
		$this->db->where('client_id', $username);

		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->row();}
		elseif($query->num_rows() >1) {return $query->row_array();}
		else{return NULL;}
		

		/* $this->db->select('*');
		$this->db->like('client_id', $username);

		$query = $this->db->get('client');

		return $query->result_array(); */
	}

	function get_all_employees($user_id)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id <>", $user_id);
		$query = $this->db->get();

		return $query->result();
	}

	function get_employees()
	{
		$this->db->select('*');
		$this->db->from('users');

		$query = $this->db->get();

		return $query->result();
	}

	function I_made_this($user_id, $client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('conference_attendees');
		return $query->num_rows() == 0;
	}

	function client_has_pre_admission_schedule($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('conference_attendees');
		return $query->num_rows() == 0;
	}

	function change_conference_status($conference_id)
	{
		$this->db->set('status', '1');
		$this->db->where('conference_id', $conference_id);
		$query = $this->db->update('conference');
		return NULL;
	}

	function client_has_minutes($conference_id, $client_id)
	{
		if($conference_id != null)
		{
			$this->db->select('1', FALSE);
			$this->db->where('conference_id', $conference_id);
			$this->db->where('client_id', $client_id);
		}
		else
		{
			$this->db->select('*', FALSE);
			$this->db->where('client_id', $client_id);
		
		}
		$query = $this->db->get('conference_main_topics');
		return $query->num_rows() == 0;
	
	}

	function user_has_decision($user_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->where('status', "<> 0");
		$query = $this->db->get('conference_attendees');
		return $query->num_rows() == 0;
	}

	function create_pre_admission_CC($data)
	{
		$this->db->insert('conference', $data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	
	function insert_pre_ad_attendee($data)
	{
		$this->db->insert('conference_attendees', $data);
		$id = $this->db->insert_id();
		
		return $id;
	}



	function get_POA_list($client_id)
	{
		$this->db->select('*');
		$this->db->from('plan_of_action');
		$this->db->where('client_id', $client_id);

		$query = $this->db->get();

		return $query->result();
	}

	function get_POA($plan_of_action_id)
	{
		$this->db->select('*');
		$this->db->from('plan_of_action_items');
		$this->db->join('plan_of_action', 'plan_of_action_items.plan_of_action_id = plan_of_action.plan_of_action_id');
		$this->db->join('users', 'plan_of_action_items.per_res_id = users.id');
		$this->db->where('plan_of_action.plan_of_action_id', $plan_of_action_id);

		$query = $this->db->get();

		return $query->result();

	}

//Conference codes
//Old conferences
	function get_conferences($user_id)
	{
		$this->db->select('*');
		$this->db->from('conference');
		$this->db->order_by('schedule', 'desc');
		$query = $this->db->get();

		return $query->result();
	}

	function get_my_conference_details($conference_id)
	{
		$this->db->select('*');
		$this->db->from('conference');
		
		$this->db->where('conference_id', $conference_id);
		$query = $this->db->get();

		return $query->result();
	}

	function conference_final_attendees($conference_id)
	{
		$this->db->select('*');
		$this->db->from('conference_attendees');
		$this->db->join('users', 'users.id = conference_attendees.user_id');
		$this->db->join('conference', 'conference.conference_id = conference_attendees.conference_id');
		$this->db->join('client', 'conference_attendees.client_id = client.client_id');
		$this->db->where('conference_attendees.conference_id', $conference_id);



		$query = $this->db->get();

		return $query->result();
	}
	function get_my_conference_details_clients($client_id, $conference_type)
	{
		$this->db->select('*');
		$this->db->from('conference_attendees');
		$this->db->join('conference', 'conference.conference_id = conference_attendees.conference_id');
		$this->db->where('status <>', '2');
		$this->db->where('status <>', '1');
		$this->db->where('conference_type', $conference_type);
		$this->db->where('conference_attendees.client_id', $client_id);
		$query = $this->db->get();

		return $query->result();
	}

	function conference_final_attendees_clients($client_id)
	{
		$this->db->select('*');
		$this->db->from('conference_attendees');
		$this->db->join('users', 'users.id = conference_attendees.user_id');
		$this->db->join('conference', 'conference.conference_id = conference_attendees.conference_id');
		$this->db->join('client', 'conference_attendees.client_id = client.client_id');
		$this->db->where('conference_attendees.conference_id', $client_id);



		$query = $this->db->get();

		return $query->result();
	}
	
//New conference
	function get_conference_points($client_id, $conference_id)
	{
		/* $this->db->select('*');
		$this->db->join('conference', 'conference.conference_id = conference_main_topics.conference_id');
		$this->db->where('client_id', $client_id);
		$this->db->where('status', '1');
		$query = $this->db->get('conference_main_topics'); **/

		$this->db->select('*');
		$this->db->from('conference_main_topics');
		$this->db->where('conference_id', $conference_id);
		$this->db->where('client_id', $client_id);
		
		$query = $this->db->get();
		return $query->result();
	}
	function get_conference_sub_points($client_id, $conference_id)
	{
		$this->db->select('*');
		$this->db->from('conference_main_topics');
		$this->db->where('conference_id', $conference_id);
		$this->db->join('conference_sub_topics', 'main_topic_id = topic_id');


		$query = $this->db->get();
		return $query->result();
	}
	function create_conference($data)
	{
		$this->db->insert('conference', $data);
		return $data;
	}

	function conference_pending_clients($conference_id, $user_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('intake', 'client.client_id = intake.client_id');
		$this->db->where('client.client_id NOT IN(SELECT conference_attendees.client_id From conference_attendees join conference on conference.conference_id = conference_attendees.conference_id where (conference_attendees.conference_id ='.$conference_id.' or conference.status = 0) )');
		$this->db->where('client_status', '0');
		$this->db->where('sw_id', $user_id );
	
		$query = $this->db->get();

		return $query->result();
	}

	function conference_custody_clients($conference_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('intake', 'client.client_id = intake.client_id');
		$this->db->where('client.client_id NOT IN(SELECT conference_attendees.client_id From conference_attendees join conference on conference.conference_id = conference_attendees.conference_id where (conference_attendees.conference_id ='.$conference_id.' or conference.status = 0) )');
		$this->db->where('client_status', '1');
	
		$query = $this->db->get();

		return $query->result();
	}

	function conference_add_clients($data)
	{
		$this->db->insert('conference_attendees', $data);
		return $data;
	}

	function end_conference($conference_id)
	{
		$this->db->select('*');
		$this->db->from('conference');
		$this->db->set('status', '2');
		$this->db->where('conference_id', $conference_id);
		$this->db->update('conference');
		return TRUE;
	}
	
	function conference_counter_admin_list()
	{
		$this->db->select('*');
		$this->db->from('conference');
		
		$query = $this->db->get();

		return $query->result();
	}
/* dashboard */

	function dorm_counter($Sector)
	{
		$this->db->select('*, Count(dormitory_id) as d_count');
		$this->db->from('dormitory');
		$this->db->join('client', 'client.dorm_id = dormitory.dormitory_id');
		$this->db->where('d_sector', $Sector);
		$this->db->group_by('dormitory_id');

		$query = $this->db->get();

		return $query->result();
	}

	function request_counter($user_id)
	{
		$this->db->select('*');
		$this->db->from('request');
		$this->db->where('sender',$user_id);
		$this->db->join('client', 'request.client_id = client.client_id');

				$query = $this->db->get();

		return $query->result();
	}

	function conference_counter($user_id)
	{
		$this->db->select('*');
		$this->db->from('conference');
		$this->db->where('conference.status', '0');
		$query = $this->db->get();

		return $query->result();
	}

	function medical_request_counter($role)
	{
		$this->db->select('*');
		$this->db->from('request');
		$this->db->where('request_type',$role);
		$this->db->join('client', 'request.client_id = client.client_id');

				$query = $this->db->get();

		return $query->result();
	}

	function dorm_counter_admin()
	{
		$this->db->select('*, Count(dormitory_id) as d_count');
		$this->db->from('dormitory');
		$this->db->join('client', 'client.dorm_id = dormitory.dormitory_id');
		$this->db->where('client_status !=', '2' );
		$this->db->group_by('dormitory_id');


		$query = $this->db->get();

		return $query->result();
	}


	function conference_counter_admin()
	{
		$this->db->select('*');
		$this->db->from('conference');
		$this->db->where('conference.status', '0');
		
		$query = $this->db->get();

		return $query->result();
	}

	function get_pending_count_admin()
	{
		$query = $this->db->query('SELECT * FROM client where client_status = 0');

		return $query->num_rows();
	}

	function get_cutody_count_admin()
	{
		$query = $this->db->query('SELECT * FROM client where client_status = 1');

		return $query->num_rows();
	}

	function get_discharge_count_admin()
	{
		$query = $this->db->query('SELECT * FROM client where client_status = 3');

		return $query->num_rows();
	}

	function get_pending_clients_admin()
	{

		$this->db->select('*, client.created as admitdate');
		$this->db->from('client');
		$this->db->where('client_status', '0');
		$this->db->join('users', 'users.id = client.sw_id');
		$this->db->join('intake','intake.client_id = client.lient_id');
		$this->db->limit('5');

		$query = $this->db->get();

		return $query->result();
	}
	
	function get_user_info_by_id($user_id)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("id", $user_id);
		$query = $this->db->get();

		return $query->result();
	}

	function get_home_visit_reports($client_id)
	{
		$this->db->select('*');
		$this->db->where('client_id', $client_id);

		$query = $this->db->get('home_visit');

		return $query->result();
	}

	function get_home_visit_items($home_visit_id)
	{
		$this->db->select('*');
		$this->db->where('home_visit_id', $home_visit_id);

		$query = $this->db->get('home_visit');

		return $query->result();
	}
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */