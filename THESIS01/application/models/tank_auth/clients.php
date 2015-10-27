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
class Clients extends CI_Model
{
	private $table_name			= 'client';			// user accounts
	private $request_name	= 'request';	// user profiles
	private $message_table		= 'messaging';		// messaging
	private $health_table	= 'health';
	private $growth_table	= 'growth_records';
	private $lab_table 		= 'laboratory_test';
	private $illness_table	= 'illness';
	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->request_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->request_name;
		$this->message_table		= $ci->config->item('db_
			table_prefix', 'tank_auth').$this->message_table;
		$this->health_table			= $ci->config->item('db_table_prefix', 'tank_auth').$this->health_table;
		$this->growth_table			= $ci->config->item('db_table_prefix', 'tank_auth').$this->growth_table;
		$this->lab_table			= $ci->config->item('db_table_prefix', 'tank_auth').$this->lab_table;
		$this->illness_table		= $ci->config->item('db_table_prefix', 'tank_auth').$this->illness_table;
	}



	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */


	//GENERAL
	function insert_msg($data)
	{
		$this->db->insert($this->message_table, $data);
		return NULL;
	}

	function get_all_user()
	{
		$this->db->select('*');
		$this->db->from('users');
		
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_indiv_clients($client_id)
	{
		
		$this->db->select('*');
		$this->db->from('client');
		$this->db->like('client_id', $match);
	
		
		$query = $this->db->get();

		return $query->result();
	}

	function get_client_by_id($client_id)
	{
		$this->db->select('*');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('users', 'client.sw_id = users.id');	
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_client_by_id_complete($client_id)
	{
		$this->db->select('*');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client_id = intake.intake_id');	
		
		$this->db->join('measurements', 'intake.intake_id = measurements.client_id');
		$this->db->join('impairments', 'intake.intake_id = impairments.client_id');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('intake_founder', 'intake_founder.intake_id = intake.intake_id');

		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_client_by_id_media($client_id)
	{
		$this->db->select('*');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client_id = intake.intake_id');	
		
		$this->db->join('measurements', 'intake.intake_id = measurements.client_id');
		$this->db->join('impairments', 'intake.intake_id = impairments.client_id');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('intake_founder', 'intake_founder.intake_id = intake.intake_id');


		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_client_by_id_for_media($client_id)
	{
		$this->db->select('*');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client_id = intake.intake_id');	
		
		$this->db->join('measurements', 'intake.intake_id = measurements.client_id');
		$this->db->join('impairments', 'intake.intake_id = impairments.client_id');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('intake_founder', 'intake_founder.intake_id = intake.intake_id');
		$this->db->join('media', 'media.client_id = client.client_id');

		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_user_by_id_no_intake_bg($client_id)
	{
		$this->db->select('*');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function client_has_no_intake($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('intake');
	
		return $query->num_rows() == 0;
	}

	function get_messages($user_id)
	{
		$this->db->select('*');
		$this->db->where('sender', $user_id);
		$this->db->from('messaging');
		
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_messages_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('messaging');

		$this->db->join('users', 'messaging.sender = users.id');
		
		$query = $this->db->get();
		return $query->result();
	}	

	function get_archive()
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('dormitory', 'dormitory.dormitory_id = client.dorm_id');
		$this->db->where('client_status', '2');
		$this->db->or_where('client_status', '5');


		$query = $this->db->get();
		return $query->result();
	}

	
	//ADMIN
	function get_pending_clients()
	{

		$this->db->select('*, client.created as admitdate');
		$this->db->from('client');
		$this->db->where('client_status', '0');
		$this->db->join('users', 'users.id = client.sw_id');
		$this->db->join('intake','intake.client_id = client.client_id');

		$query = $this->db->get();

		return $query->result();
	}

	function set_SW($client_id)
	{
		$this->db->select('client_id');
		$this->db->where('client.client_id', $client_id);

		$query = $this->db->get($this->table_name);

			if ($query->num_rows() == 1) 
			{

			$this->db->set('client_status', 1);
			
			$this->db->where('client_id', $client_id);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}

	function Reassign_SW($client_id, $sw_id, $Current_sw_id)
	{
		$this->db->select('client_id');
		$this->db->where('client.client_id', $client_id);

		$query = $this->db->get($this->table_name);

			if ($query->num_rows() == 1) 
			{

			$this->db->set('client_status', 1);
			$this->db->set('sw_id', $sw_id);
			
			$this->db->where('client_id', $client_id);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}

	function get_pending_Discharge()
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('users', 'users.id = client.sw_id');
		$this->db->join('discharge_sum', 'client.client_id = discharge_sum.client_id');

		$this->db->where('client_status', '1');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function Accept_Client($client_id)
	{
		$this->db->select('client_id');
		$this->db->where('client.client_id', $client_id);

		$query = $this->db->get($this->table_name);

			if ($query->num_rows() == 1) 
			{

			$this->db->set('client_status', 1);
			
			$this->db->where('client_id', $client_id);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}

	function Reject_Client($client_id)
	{
		$this->db->select('client_id');
		$this->db->where('client.client_id', $client_id);

		$query = $this->db->get($this->table_name);

			if ($query->num_rows() == 1) 
			{

			$this->db->set('client_status', 5);
			
			$this->db->where('client_id', $client_id);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}




	//SOCIAL WORKER
	function insert_profile_picture($client_id, $data)
	{
		$this->db->where('client_id', $client_id);
		$this->db->update('client', $data);
	}

	function get_all_clients_admin()
	{
		$this->db->select('*');
		$this->db->from('client');
	
		$this->db->order_by('created', 'asc');
		$this->db->join('intake', 'intake.client_id = client.client_id');	
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->where('client_status', '1');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_clients()
	{
		$this->db->select('*');
		$this->db->from('client');
	
		$this->db->order_by('created', 'asc');
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->where('client_status', '1');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_all_clients_age_report()
	{
		$this->db->select('*');
		$this->db->from('client');
	
		$this->db->order_by('created', 'asc');
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->where('client_status', '1');
		$this->db->or_where('client_status', '0');
		$this->db->or_where('client_status', '3');
		
		$query = $this->db->get();
		return $query->result();
	}
	


	function get_all_clients_SW($user_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('sw_id', $user_id);
		$this->db->where('client_status', "1");
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->order_by('created', 'asc');
		
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_sw_pending_clients($user_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('client_status', '0');
		$this->db->where('sw_id', $user_id);
		$this->db->join('users', 'users.id = client.sw_id');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$query = $this->db->get();

		return $query->result();
	}

	function get_SW_number_clients($SocialC)
	{
		$this->db->select('sw_id');
		$this->db->from('client');
		$this->db->where('sw_id', $SocialC);
		$this->db->where('client_status', '0');
		$query = $this->db->get();
		$this->db->count_all_results();


		return $query->result();
	}

	function Discharge($client_id2)
	{
		$this->db->select('client_id');
		$this->db->where('client.client_id', $client_id2);

		$query = $this->db->get($this->table_name);

			if ($query->num_rows() == 1) 
			{

			$this->db->set('client_status', 2);
			
			$this->db->where('client_id', $client_id2);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}

	function Change_Discharge_status($client_id2)
	{
		$this->db->select('client_id');
		$this->db->where('client.client_id', $client_id2);

		$query = $this->db->get($this->table_name);

			if ($query->num_rows() == 1) 
			{

			$this->db->set('client_status', 3);
			
			$this->db->where('client_id', $client_id2);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}

	function Final_Discharge($client_id2)
	{
		$this->db->select('client_id');
		$this->db->where('client.client_id', $client_id2);

		$query = $this->db->get($this->table_name);

			if ($query->num_rows() == 1) 
			{

			$this->db->set('client_status', 2);
			
			$this->db->where('client_id', $client_id2);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}

	function get_pending_Discharge_clients_SW($user_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('sw_id', $user_id);
		$this->db->join('dormitory', 'dormitory.dormitory_id = client.dorm_id');		
		$this->db->where('client_status', '3');

		$query = $this->db->get();
		return $query->result();
	}


	function create_request($data)
	{
		$this->db->insert('request', $data);		
		return NULL;
	}

	function get_requests($role)
	{
		$this->db->select('*');
		$this->db->from('request');
		$this->db->where('request_type', $role);
		$this->db->where('status', '0');
		$this->db->join('client', 'client.client_id = request.client_id');
		$this->db->join('dormitory', 'dormitory_id = dorm_id');
		$this->db->group_by('request.client_id');
		$query = $this->db->get();

		return $query->result();
	}
	function get_client_medical_requests($role, $client_id)
	{
		$this->db->select('*');
		$this->db->from('request');
		$this->db->where('request_type', $role);
		$this->db->where('status', '0');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('client', 'client.client_id = request.client_id');
		$this->db->join('dormitory', 'dormitory_id = dorm_id');
		$this->db->group_by('request.client_id');
		$query = $this->db->get();

		return $query->result();
	}

	function remove_request($client_id, $role)
	{
		$this->db->select('*');
		
		$this->db->where('request.request_type', $role);
		$this->db->where('request.client_id', $client_id);

		$query = $this->db->get($this->request_name);

			if($query->num_rows() >= 1)
			{
				$this->db->set('status', 1);
				$this->db->where('request.request_type', $role);
				$this->db->where('request.client_id', $client_id);
				$this->db->update($this->request_name);
				return true;

			}
		return true;
	}
	
	function search($Search)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->like('file.file_name', $Search);
		$this->db->or_like('file.file_id', $Search);


		$query = $this->db->get();

		return $query->result();
	}


	function get_CAY()
	{
		$this->db->select('client_sector');
		$this->db->from('client');
		$this->db->where('client_sector', '1');

		$query = $this->db->count_all_results();
		return $query;
	}
	function get_OP()
	{
		$this->db->select('client_sector');
		$this->db->from('client');
		$this->db->where('client_sector', '2');
		$query = $this->db->count_all_results();
		return $query;
	}
	function get_PWSN()
	{
		$this->db->select('client_sector');
		$this->db->from('client');
		$this->db->where('client_sector', '3');
		$query = $this->db->count_all_results();
		return $query;
	}
	function get_PICS()
	{
		$this->db->select('client_sector');
		$this->db->from('client');
		$this->db->where('client_sector', '4');

		$query = $this->db->count_all_results();
		return $query;
	}

	function get_pending_count()
	{
		$this->db->select('client_sector');
		$this->db->from('client');
		$this->db->where('client_status', '0');

		$query = $this->db->count_all_results();
		return $query;
	}

	function get_pending_discharge_count()
	{
		$this->db->select('client_sector');
		$this->db->from('client');
		$this->db->where('client_status', '3');

		$query = $this->db->count_all_results();
		return $query;
	}
	
	function get_num_clients($sw_id)
	{
		$this->db->select('client_sector');
		$this->db->from('client');
		$this->db->where('sw_id', $sw_id);
		$this->db->where('client_status', '1');

		$query = $this->db->count_all_results();
		return $query;
	}

	function get_Dorms($Sector)
	{
		$this->db->select('*');
		$this->db->from('dormitory');
		$this->db->where('d_sector', $Sector);

		$query = $this->db->get();

		return $query->result();
	}

	function get_conference_history($client_id)
	{
		$this->db->select('*');
		$this->db->from('conference_attendees');
		$this->db->where('conference_attendees.client_id', $client_id);
		$this->db->join('conference', 'conference.conference_id = conference_attendees.conference_id');
		$this->db->group_by('conference.conference_id');

		$query = $this->db->get();

		return $query->result();
	}

	function get_preadmission_page_details($client_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('conference_attendees', 'conference_attendees.client_id = client.client_id');
		$this->db->join('conference', 'conference.conference_id = conference_attendees.conference_id');
		$this->db->where('client.client_id', $client_id);
		$query = $this->db->get();

		return $query->result();
	}

	function get_pre_admission_attendees($pre_admission_id)
	{
		$this->db->select('*');
		$this->db->from('conference_attendees');
		$this->db->join('users', 'users.id = conference_attendees.user_id');
		$this->db->where('conference_id', $pre_admission_id);

		$query = $this->db->get();

		return $query->result();
	}

	function insert_conference_point($data)
	{	
		
		$this->db->insert('conference_main_topics', $data);
		$data['topic_id'] =$this->db->insert_id();
		return $data;
	}	
	function insert_sub_topic($data)
	{
		$this->db->insert('conference_sub_topics', $data);		
		$data['home_plan_id'] = $this->db->insert_id();
		return $data;
	}


	function client_has_media_certificate($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);

		$query = $this->db->get('media');
		return $query->num_rows() == 0;
	}

	function client_has_slip($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('discharge_sum');
		return $query->num_rows() == 0;
	}

	function client_has_slip_adop($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('discharge_adop');
		return $query->num_rows() == 0;
	}
	function client_has_sum($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('discharge_sum');
		return $query->num_rows() == 0;
	}

	function get_discharge_sum_info($client_id)
	{
		$this->db->select('*, client.created as date_admitted, discharge_sum.created as date_discharged');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		
		$this->db->join('discharge_sum', 'client.client_id = discharge_sum.client_id');
		$this->db->join('users', 'client.sw_id = id');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_discharge_slip_info($client_id)
	{
		$this->db->select('*, client.created as date_admitted, discharge_slip.created as date_discharged');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		
		$this->db->join('discharge_slip', 'intake.client_id = discharge_slip.client_id');
		$this->db->join('users', 'client.sw_id = id');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_discharge_adop_info($client_id)
	{
		$this->db->select('*, client.created as date_admitted, discharge_adop.created as date_discharged');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		
		$this->db->join('discharge_adop', 'client.client_id = discharge_adop.client_id');
		$this->db->join('users', 'client.sw_id = id');
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function create_initial_case($data)
	{
		$this->db->insert('initial_case_report', $data);		
		return $data;
	}

	function create_social_case($data)
	{
		$this->db->insert('social_case', $data);		
		return $data;
	}
	function client_has_initial_case($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('initial_case_report');
		return $query->num_rows() == 0;
	}

	function get_initial_case($client_id)
	{
		$this->db->select('*');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('users', 'client.sw_id = users.id');
		$this->db->join('initial_case_report', 'client.client_id = initial_case_report.client_id');	
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_updated_scs($client_id)
	{
		$this->db->select('*, social_case.created as social_created');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('users', 'client.sw_id = users.id');
		$this->db->join('initial_case_report', 'client.client_id = initial_case_report.client_id');	
		$this->db->join('social_case', 'client.client_id = social_case.client_id');
		$this->db->order_by('social_created', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_scs_by_id($client_id, $social_id)
	{
		$this->db->select('*, social_case.created as social_created');
		$this->db->where('client.client_id', $client_id);
		$this->db->where('social_case_id', $social_id);
		$this->db->join('intake', 'client_id = intake_id');	
		
		$this->db->join('dormitory', 'dorm_id = dormitory_id');
		$this->db->join('users', 'client.sw_id = users.id');
		$this->db->join('initial_case_report', 'client.client_id = initial_case_report.client_id');	
		$this->db->join('social_case', 'client.client_id = social_case.client_id');
		
	
		$query = $this->db->get('client');
		if ($query->num_rows() == 1) {return $query->result();}
		elseif($query->num_rows() >1) {return $query->result_array();}
		else{return NULL;}
	}

	function get_social_cases($client_id)
	{
		$this->db->select('*');
		$this->db->where('client_id', $client_id);

		$query = $this->db->get('social_case');
		return $query->result();

	}

	function get_home_plans($client_id)
	{
		$this->db->select('*');
		$this->db->from('home_plan');

		$query = $this->db->get();

		return $query->result();

	}

	function create_indie_home_plan($data)
	{
		$this->db->insert('home_plan', $data);		
		$data['home_plan_id'] = $this->db->insert_id();
		return $data;
	}



	function create_indie_home_plan_item($data)
	{
		$this->db->insert('home_plan_items', $data);		
		
		return TRUE;
	}

	function get_home_plan_items($home_plan_id)
	{
		$this->db->select('*');
		$this->db->join('home_plan_items', 'home_plan.home_plan_id = home_plan_items.home_plan_id');
		$this->db->join('users', 'person_responsible = id');
		$this->db->where('home_plan.home_plan_id', $home_plan_id);

		$query = $this->db->get('home_plan');
		return $query->result();
	}
	//NURSE

	function create_health($data, $data2, $data3, $data4)
	{	
		
		$this->db->insert('health', $data);
		$this->db->insert('growth_records', $data2);
		$this->db->insert('laboratory_test', $data3);
		$this->db->insert('illness', $data4);

		return NULL;
	}	

	function insert_measurements($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('measurements', $data);

		return true;
	}

	function insert_present($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('present_condition', $data);

		return true;
	}

	function insert_impairment($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('impairments', $data);

		return true;
	}

	function insert_growth($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('growth_records', $data);

		return true;
	}

	function insert_birth_history($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('birth_history', $data);

		return true;
	}

	function insert_immunizations($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('immunizations', $data);
		return true;
	}

	function insert_illnesses($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('illness', $data);
		return true;
	}

	function insert_illnesses_bg($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('illness_bg', $data);
		return true;
	}

	function insert_mishap($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('mishap', $data);
		return true;
	}

	function insert_lab_test($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('laboratory_test', $data);
		return true;
	}

	function insert_medical_problems($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('medical_problems', $data);
		return true;
	}

	function insert_notes_recommendation($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('notes_recommendation', $data);
		return true;
	}

	// Nurse initial medical examination 

	function client_has_laboratoy_test($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('laboratory_test');
		return $query->num_rows() == 0;
	}
	function client_has_medical_problems($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('medical_problems');
		return $query->num_rows() == 0;
	}
	
	function client_has_impairments($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('impairments');
		return $query->num_rows() == 0;
	}
	
	function client_has_immunizations($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('immunizations');
		return $query->num_rows() == 0;
	}
	
	function client_has_illness($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('illness');
		return $query->num_rows() == 0;
	}
	
	function client_has_notes_recommendation($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('notes_recommendation');
		return $query->num_rows() == 0;
	}
	
	function client_has_growth_records($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('growth_records');
		return $query->num_rows() == 0;
	}
	
	function client_has_birth_history($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('birth_history');
		return $query->num_rows() == 0;
	}
	function client_has_present_condition($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get('present_condition');
		return $query->num_rows() == 0;
	}

	function get_all_measure($client_id)
	{

		$this->db->select('*');
		$this->db->from('measurements');
		$this->db->where('measurements.client_id', $client_id);
		$this->db->join('users', 'measurements.examiner_id = users.id');
		$this->db->order_by('measurements.created', 'desc');
		

		$query = $this->db->get();
		return $query->result();
	}

	function get_measure_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('measurements');
		$this->db->where('measurements.client_id', $client_id);
		$this->db->join('users', 'measurements.examiner_id = users.id');
		$this->db->order_by('measurements.created', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_app($client_id)
	{

		$this->db->select('*');
		$this->db->from('measurements');
		$this->db->where('measurements.client_id', $client_id);
		$this->db->join('users', 'measurements.examiner_id = users.id');
		$this->db->order_by('measurements.created', 'desc');
		

		$query = $this->db->get();
		return $query->result();
	}

	function get_app_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('present_condition');
		$this->db->where('present_condition.client_id', $client_id);
		$this->db->order_by('present_condition.created', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_birth_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('birth_history');
		$this->db->where('birth_history.client_id', $client_id);
		$this->db->order_by('birth_history.created', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_immu($client_id)
	{

		$this->db->select('*');
		$this->db->from('immunizations');
		$this->db->where('immunizations.client_id', $client_id);
		$this->db->order_by('immunizations.immunization_date', 'desc');
		

		$query = $this->db->get();
		return $query->result();
	}

	function get_immu_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('immunizations');
		$this->db->where('immunizations.client_id', $client_id);
		$this->db->order_by('immunizations.created', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_growth($client_id)
	{

		$this->db->select('*');
		$this->db->from('growth_records');
		$this->db->where('growth_records.client_id', $client_id);
		$this->db->order_by('growth_records.growth_id', 'desc');
		

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_impair($client_id)
	{

		$this->db->select('*');
		$this->db->from('impairments');
		$this->db->where('impairments.client_id', $client_id);
		$this->db->order_by('impairments.created', 'desc');
		

		$query = $this->db->get();
		return $query->result();
	}

	function get_growth_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('growth_records');
		$this->db->where('growth_records.client_id', $client_id);
		$this->db->order_by('growth_records.growth_id', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_lab_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('laboratory_test');
		$this->db->where('laboratory_test.client_id', $client_id);
		$this->db->order_by('laboratory_test.created', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_lab($client_id)
	{

		$this->db->select('*');
		$this->db->from('laboratory_test');
		$this->db->where('laboratory_test.client_id', $client_id);
		$this->db->order_by('laboratory_test.created', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	function get_ill_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('illness');
		$this->db->where('illness.client_id', $client_id);
		$this->db->order_by('illness.created', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_ill($client_id)
	{

		$this->db->select('*');
		$this->db->from('illness');
		$this->db->where('illness.client_id', $client_id);
		$this->db->order_by('illness.created', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	function get_ill_bg_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('illness_bg');
		$this->db->where('illness_bg.client_id', $client_id);
		$this->db->order_by('illness_bg.created', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_note($client_id)
	{

		$this->db->select('*');
		$this->db->from('notes_recommendation');
		$this->db->where('notes_recommendation.client_id', $client_id);
		$this->db->join('users', 'notes_recommendation.staff_id = users.id');
		$this->db->order_by('notes_recommendation.note_id', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	function get_note_latest($client_id)
	{

		$this->db->select('*');
		$this->db->from('notes_recommendation');
		$this->db->where('notes_recommendation.client_id', $client_id);
		$this->db->join('users', 'notes_recommendation.staff_id = users.id');
		$this->db->order_by('notes_recommendation.note_id', 'desc');
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();
	}

	//HOUSE PARENT

	function get_hp_dorm($user_id)
	{
		$this->db->select('*');
		$this->db->from('dormitory');
		$this->db->where('d_in_charge', $user_id);

		$query = $this->db->get();
		return $query->result();
	}

	function get_report_log($user_id)
	{
		$this->db->select("*");
		$this->db->from("report_log");
		$this->db->where("hp_id", $user_id);

		$query = $this->db->get();
		return $query->result();
	}


	function get_all_client_HP($user_id, $dorm_id)
	{

		$current = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('dormitory');
		$this->db->join('client', 'dormitory_id = dorm_id');
		$this->db->where('d_in_charge', $user_id);
		$this->db->where("NOT EXISTS (select '*' from report_log where report_log.client_id = client.client_id and created = curdate())", null, false);
		$this->db->where('client_status <>', '3');

		$query = $this->db->get();
		return $query->result();
	}

	function get_client_daily_reports($user_id, $dorm_id)
	{

		$this->db->select('*');
		$this->db->from('dormitory');
		$this->db->join('client', 'dormitory_id = dorm_id');
		$this->db->where('d_in_charge', $user_id);
		$this->db->where('client_status <>', '3');

		$query = $this->db->get();
		return $query->result();
	}
	function get_house_reports($client_id)
	{

		$this->db->select("*, report_log.created as house_date");
		$this->db->from("report_log");
		$this->db->join("client", "report_log.client_id = client.client_id");
		$this->db->join('users', 'id = hp_id');
		$this->db->where("report_log.client_id", $client_id);

		$query = $this->db->get();

		return $query->result();
	}

	function has_pre_admission_schedule($client_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('client_id', $client_id);
		$this->db->where('conference_type', '1');

		$query = $this->db->get('conference');
		return $query->num_rows();
	}

	function get_client_pre_admission_schedule($client_id)
	{
		$this->db->select('*');
		$this->db->where('client_id', $client_id);
		$this->db->where('conference_type', '1');

		$query = $this->db->get('conference');
		return $query->result();
	}

	function get_kasunduan($client_id)
	{
		$this->db->select("*");
		$this->db->from("kasunduan");
		$this->db->where("client.client_id", $client_id);
		$this->db->join('users', 'kasunduan.sw_id = users.id');	
		$this->db->join('client', 'kasunduan.client_id = client.client_id');	
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_clients_admit()
	{
		$this->db->select('*');
		$this->db->from('client');
	
		$this->db->order_by('created', 'asc');
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		$this->db->where('client_status', '1');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_clients_pend()
	{
		$this->db->select('*');
		$this->db->from('client');
	
		$this->db->order_by('created', 'asc');
		$this->db->join('intake', 'client.client_id = intake.client_id');	
		$this->db->where('client_status', '0');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_clients_over()
	{
		$this->db->select('*');
		$this->db->from('client');
	
		$this->db->order_by('created', 'asc');
		$this->db->join('intake', 'client.client_id = intake.client_id');	
	
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_pending_count_sw($user_id)
	{
		$query = $this->db->query('SELECT * FROM client where client_status = 0 and sw_id = '.$user_id);

		return $query->num_rows();
	}

	function get_cutody_count($user_id)
	{
		$query = $this->db->query('SELECT * FROM client where client_status = 1 and sw_id = '.$user_id);

		return $query->num_rows();
	}

	function get_discharge_count($user_id)
	{
		$query = $this->db->query('SELECT * FROM client where client_status = 3 and sw_id = '.$user_id);

		return $query->num_rows();
	}

	function get_sur_det($client_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake_surrender', 'client.client_id = intake_surrender.client_id');
		$this->db->join('intake', 'client.client_id = intake.client_id');
		//$this->db->join('family', 'client.client_id = family.client_id');
		$this->db->join('dormitory', 'client.dorm_id = dormitory.dormitory_id');
		$this->db->join('users', 'client.sw_id = users.id');

		$query = $this->db->get();
		return $query->result();
	}

	function get_found_det($client_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake_founder', 'client.client_id = intake_founder.client_id');
		$this->db->join('intake', 'client.client_id = intake.client_id');
		//$this->db->join('family', 'client.client_id = family.client_id');
		$this->db->join('dormitory', 'client.dorm_id = dormitory.dormitory_id');
		$this->db->join('users', 'client.sw_id = users.id');

		$query = $this->db->get();
		return $query->result();
	}


	function get_agen_det($client_id)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('client.client_id', $client_id);
		$this->db->join('intake_agency', 'client.client_id = intake_agency.client_id');
		$this->db->join('intake', 'client.client_id = intake.client_id');
		//$this->db->join('family', 'client.client_id = family.client_id');
		$this->db->join('dormitory', 'client.dorm_id = dormitory.dormitory_id');
		$this->db->join('users', 'client.sw_id = users.id');
		
		$query = $this->db->get();
		return $query->result();
	}
	function get_family($client_id)
	{
		$this->db->select('*');
		$this->db->from('family');
		$this->db->where('client_id', $client_id);

		$query = $this->db->get();

		return $query->result();
	}

	function blank_dorm()
	{
		$query = $this->db->query('SELECT * FROM dormitory');

		return $query->result();
	}
	function blank_dorm_count($dorm_id)
	{
		$this->db->select('*, count(dorm_id) as d_counter');
		$this->db->from('client');
		$this->db->where('dorm_id', $dorm_id);
		$this->db->group_by('dorm_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_client_details($client_id)
	{
		$this->db->where('client_id', $client_id);

		$query = $this->db->get('client');
		return $query->row();
	}


}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */