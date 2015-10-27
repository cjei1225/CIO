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
class Messages extends CI_Model
{
	private $table_name			= 'messages';			// user accounts


	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		
	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */

	function get_messages($user_id)
	{
		$this->db->select('*');
		$this->db->from('messaging');
		$this->db->where('receiver', $user_id);
		$this->db->order_by('date_time', 'asc');
		
		
		$query = $this->db->get();
		return $query->result();
	}



}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */