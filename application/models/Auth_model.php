<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	private $table = "user";
	private $_data = array('password');

	public function validate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->db->where("username", $username);
		$query = $this->db->get($this->table);

		if ($query->num_rows()) 
		{
				
			$row = $query->row_array();

		
			if ($row['password'] == $password)
			{
			
				unset($row['password']);
				$this->_data = $row;
				return ERR_NONE;
			}

			
			return ERR_INVALID_PASSWORD;
		}
		else {
			
			return ERR_INVALID_USERNAME;
		}
	}

	public function get_data()
	{
		return $this->_data;
	}

}