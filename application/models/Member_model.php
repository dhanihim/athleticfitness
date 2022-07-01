<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function get_data($table, $id=0)
	{
		if($id==0)
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('deleted_at IS NULL');

			return $this->db->get();
		}
		else
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('id',$id);

			return $this->db->get();
		}
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);

		$id = $this->db->insert_id();

		$update_data = array(
			'uid' => 100152+$id, 
		);

		$this->db->where('id', $id);
		$this->db->update($table, $update_data);
	}

	public function update_data($data, $table)
	{
		$this->db->where('id', $data['id']);
		$this->db->update($table, $data);
	}

	public function delete_data($data, $table)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete($table);
	}
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */