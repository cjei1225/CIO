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
class Files extends CI_Model
{
	private $table_name			= 'notification';			// user accounts
	private $profile_table_name	= 'user_profiles';
	private $file_table			= 'file';
	private $audit_table 		= 'audit';
	private $intake_table 		= 'intake';
	private $family_table		= 'family';
	private $social_table		= 'social';
	private $home_table			= 'home_visit';
	private $media_table		= 'media';
	private $inter_table		= 'intervention';
	private $inter_reco_table	= 'inter_reco';
	private $psycho_table		= 'psychological';
	private $pyscho_test_table	= 'psycho_test';
	private $dis_slip_table		= 'discharge_slip';
	private $dis_adop_table		= 'discharge_adop';
	private $dis_sum_table		= 'discharge_sum';
	private $dis_pt_prog_table	= 'pt_progress';
	private $dis_hp_log_table	= 'report_log';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
				$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
		$this->file_table 			= $ci->config->item('db_table_prefix', 'tank_auth').$this->file_table;
		$this->audit_table 			= $ci->config->item('db_table_prefix', 'tank_auth').$this->audit_table;
		$this->intake_table 		= $ci->config->item('db_table_prefix', 'tank_auth').$this->intake_table;
		$this->family_table 		= $ci->config->item('db_table_prefix', 'tank_auth').$this->family_table;
		$this->social_table 		= $ci->config->item('db_table_prefix', 'tank_auth').$this->social_table;
		$this->home_table 			= $ci->config->item('db_table_prefix', 'tank_auth').$this->home_table;
		$this->media_table 			= $ci->config->item('db_table_prefix', 'tank_auth').$this->media_table;
		$this->inter_table 			= $ci->config->item('db_table_prefix', 'tank_auth').$this->inter_table;
		$this->inter_reco_table 	= $ci->config->item('db_table_prefix', 'tank_auth').$this->inter_reco_table;
		$this->psycho_table 		= $ci->config->item('db_table_prefix', 'tank_auth').$this->psycho_table;
		$this->pyscho_test_table 	= $ci->config->item('db_table_prefix', 'tank_auth').$this->pyscho_test_table;
		$this->dis_pt_prog_table 	= $ci->config->item('db_table_prefix', 'tank_auth').$this->dis_pt_prog_table;
		$this->dis_hp_log_table 	= $ci->config->item('db_table_prefix', 'tank_auth').$this->dis_hp_log_table;
	}


	function set_message($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->table_name, $data);
		return NULL;
	}

	function get_notifications($user_id)
	{
		$this->db->select('*');
		$this->db->from('notification');
		$this->db->where('receiver_id', $user_id);
		$this->db->order_by('created', 'desc');
		$this->db->join('notification_messages', 'notif_message_id = message');
		
		$query = $this->db->get();
		foreach($query->result() as $key=>$vleu){
			$query->result()[$key]->created = $this->get_timelapsed($query->result()[$key]->created);
		}
		$query->result()['count'] = count($query->result());
		return $query->result();
	}

	function get_timelapsed($timestamp)
	{
		//$row_notification->created
        $from_time = time();
        $to_time = strtotime($timestamp);
        $result = round(abs($to_time - $from_time) / 60,2);
        $time = "";
        $rtime = 0;
        //less an hour
        if($result >=1 && $result <= 60){
            if(round($result,0) == 1){
                $time = "about a minute ago";
            } else if($result == 60) {
            	$time = "about an hour ago";
            } else {
                $time = $result . " minutes ago";                                   
            }
        //hour
        } else if($result >=61 && $result <= 1440 && round($result/60,2) < 24){
            //greater than an hour but not less than an hour and not greater than a day
             $rtime = round($result/60,2);
            if($rtime == 1){
             $time = "about an hour ago";
            } else {
	            $htime = $rtime - floor($rtime); //returns the decimal part
	            $htime = round($htime * 60,0); //convert to minutes again
	            $con = (floor($rtime) > 1) ? " hrs" : " hr";

	            $time = floor($rtime) . $con . " and " . $htime . " minutes ago";
            }
        //days
        } else if(round($result/60,2) >=24){
            //greater than a day
            $rtime = round($result/1440,2);
            if($rtime >= 1 && $rtime < 2){
                //yesterday
                $time = "Yesterday at " . date('h:i a',$to_time);
            } else {
                //ago days
                $time = date('F d \a\t h:i a',$to_time);
            }
        }
        return $time;
	}

	function insert_file_db($data)
	{
		$this->db->insert($this->file_table, $data);
		return TRUE;
	}

	function insert_audit($data)
	{
		$data['a_datetime'] = date('Y-m-d H:i:s');
		$this->db->insert($this->audit_table, $data);
		return TRUE;
	}

	function get_medical_files($client_id)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->join('users', 'id = file_uploader');
		$this->db->where('file_client', $client_id);
		$this->db->where('document_type', '33');
		$query = $this->db->get();
		return $query->result();
	}

	function get_psychologist_files($client_id)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->join('users', 'id = file_uploader');
		$this->db->where('file_client', $client_id);
		$this->db->where('document_type', '34');
		$query = $this->db->get();
		return $query->result();
	}
	function get_physical_files($client_id)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->join('users', 'id = file_uploader');
		$this->db->where('file_client', $client_id);
		$this->db->where('document_type', '36');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_psychiatric_files($client_id)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->join('users', 'id = file_uploader');
		$this->db->where('file_client', $client_id);
		$this->db->where('document_type', '35');
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_files()
	{
		$this->db->select('*');
		$this->db->from('file');

		$query = $this->db->get();
		return $query->result();
	}
	
	function get_all_audit_files($user_id)
	{
		$this->db->select('*');
		$this->db->from('audit');
		$this->db->where('file_owner', $user_id);
		$this->db->order_by('a_datetime');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_files_client($client_id, $user_id)
	{

		$this->db->select('*');
		$this->db->from('file');
		$this->db->where('file_client', $client_id);
		$this->db->where('file_uploader', $user_id);
		
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_files_client_SW($client_id, $user_id)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->where('file_client', $client_id);
		$this->db->where('file_owner', $user_id);
		$this->db->where('document_type', '20');
		
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_locations($role)
	{
		$this->db->select('*');
		$this->db->from('locations');
		$this->db->where('role', $role);

		$query = $this->db->get();

		return $query->result();
	}

	function get_document_type()
	{
		$this->db->select('*');
		$this->db->from('document_type');
		

		$query = $this->db->get();

		return $query->result();
	}
	
	function get_all_audit()
	{
		$this->db->select('*');
		$this->db->from('audit');
			$this->db->order_by('a_datetime');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_client_checklist_items($client_id)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->where('file_client', $client_id);

		$query = $this->db->get();

		return $query->result();
	}

	function get_uploaded_documents($client_id)
	{
		$this->db->select('*');
		$this->db->from('file');
		$this->db->join('document_type', 'document_type.document_id = file.document_type');
		$this->db->where('file_client', $client_id);
		$this->db->where('file_type <>', 'Electronic Form' );
		$query = $this->db->get();

		return $query->result();
	}

	function create_intake($data_profile, $data)
	{
		$rand_intake_id = (rand(50,495)*2014) + (rand(0,1100)*11);
		do 
		{
			$data['intake_id'] = $rand_intake_id;
			$data_family['intake_id'] = $rand_intake_id;
			$data_profile['client_id'] = $rand_intake_id;
			$this->db->select('intake_id');
			$this->db->where('intake_id', $data['intake_id']);
			$query = $this->db->get('intake');
		} 
		while($query->num_rows() > 0);
			$this->db->insert('intake', $data);
			$this->db->insert('family', $data_family);
			$this->create_client($data_profile);
		
		return $rand_intake_id;
	}
	
	function create_intake2($data)
	{
		
		$this->db->insert('intake_bg', $data);
		return TRUE;
	}

	function insert_surrenderer($data_surrenderer)
	{
		
		$this->db->insert('intake_surrender', $data_surrenderer);
		return TRUE;
	}

	function insert_founder($data_founder)
	{
		
		$this->db->insert('intake_founder', $data_founder);
		return TRUE;
	}
	function insert_family($data2)
	{	
		return TRUE;
	}

	function create_in_agen($data)
	{	
	
		$this->db->insert('intake_agency', $data);
		return TRUE;
	}

	function create_in_walk($data)
	{	
		
		$this->db->insert('intake_founder', $data);
	

		return TRUE;
	}	

	function create_client($data_profile)
	{
		
		
		$SocialC = '/Social Case Reports';
		$Medical = '/Medical Reports';
		$Psychological = '/Psychological Reports';
		$Psychiatric = '/Psychiatric Reports';
		$Physical = '/Physical Therapy Reports';
		$General = '/General Documents';
		$House_Reports = '/House Reports';
		$Discharge = '/General Documents/Discharge';

		$data_profile['created'] = date('Y-m-d H:i:s');
		mkdir(('./uploads/'.$data_profile['client_id']), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$SocialC), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$General), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$Discharge), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$Medical), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$Psychological), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$Psychiatric), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$Physical), 0777, true);
		mkdir(('./uploads/'.$data_profile['client_id'] .$House_Reports), 0777, true);
		$this->db->insert('client', $data_profile);
	
		return true;
	}

	function create_report_hp($data)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->dis_hp_log_table, $data);

		return TRUE;
	}

	function create_POA($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('plan_of_action', $data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	function insert_POA_task($data)
	{
		$this->db->insert('plan_of_action_items', $data);
		$id = $this->db->insert_id();
		
		return $id;
	}

	function create_dis_sl($data)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->dis_slip_table, $data);

		return TRUE;
	}

	function create_dis_a($data)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->dis_adop_table, $data);

		return TRUE;
	}

	function create_dis_su($data)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->dis_sum_table, $data);

		return TRUE;
	}
	function create_psych($data, $data2)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->psycho_table, $data);
		$this->db->insert($this->pyscho_test_table, $data2);

		return TRUE;
	}

	function create_kasun($data)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('kasunduan', $data);

		return TRUE;
	}
	function create_media($data)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('media', $data);

		return TRUE;
	}

	function create_client_bg($data)
	{
		
		$this->db->insert('intake', $data);
		return TRUE;
	}

	function create_in_sur($data)
	{	
		
		$this->db->insert('intake_surrender', $data);
		return TRUE;
	}

	function insert_fam_mem($data_fam)
	{

		$this->db->insert('family', $data_fam);
		return TRUE;
	}

	function create_pt_report($data)
	{
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert('pt_progress', $data);
		return TRUE;
	}
	
	function create_home($data)
	{	
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->home_table, $data);
		$home_visit_id = $this->db->insert_id();

		return $home_visit_id;
	}

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */