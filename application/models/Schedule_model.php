<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

	public function get_data($table, $id=0, $type=0)
	{
		if($id==0)
		{
			$this->db->select('*,schedule.id as scheduleid, sport.name as sportname, coach.name as coachname');
			$this->db->from($table);
			$this->db->join('sport', 'sport.id = '.$table.'.sport_id', 'inner');
			$this->db->join('coach', 'coach.id = '.$table.'.coach_id', 'inner');
			$this->db->where($table.'.type = '.$type);
			$this->db->where($table.'.deleted_at IS NULL');
			$this->db->order_by($table.'.scheduled_start', 'desc');

			return $this->db->get();
		}
		else
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('id',$id);
			$this->db->where($table.'.deleted_at IS NULL');

			return $this->db->get();
		}
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);

		return $this->db->affected_rows() > 0;
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

	public function get_select($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('deleted_at IS NULL');
		$this->db->order_by('name');

		return $this->db->get();
	}
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */