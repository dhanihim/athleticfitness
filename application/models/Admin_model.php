<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function get_data($table)
	{
		return $this->db->get($table);
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */