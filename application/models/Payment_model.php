<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

	public function get_data($table, $id=0, $deposited=0, $uid=0)
	{
		if($id==0)
		{
			$this->db->select($table.'.*,'.$table.'.created_at as '.$table.'createdat, '.$table.'.id as '.$table.'id, coach.name as coachname, pricelist.name as pricelistname, pricelist.price as price, pricelist.session_per_member as session, coach.*, pricelist.*' );
			$this->db->from($table);
			$this->db->join('coach', 'coach.id = '.$table.'.coach_id', 'inner');
			$this->db->join('pricelist', 'pricelist.id = '.$table.'.pricelist_id', 'inner');

			if($deposited==0)
				$this->db->where($table.'.deposited_at IS NULL');
			else if($deposited==1)
				$this->db->where($table.'.deposited_at IS NOT NULL');

			if($uid!=0)
			{
				$this->db->where('uid',$uid);
			}
			else
				$this->db->where($table.'.created_at IS NOT NULL');


			$this->db->where($table.'.deleted_at IS NULL');
			$this->db->order_by('payment.created_at', 'desc');

			return $this->db->get();
		}
		else
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('id',$id);
			$this->db->where($table.'.created_at IS NOT NULL');
			$this->db->order_by('created_at', 'desc');

			return $this->db->get();
		}
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function insert_draft($data, $table)
	{
		$this->db->insert($table, $data);

		return $this->db->insert_id();
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

	public function get_member_payment($table,$uid)
	{
		$this->db->select('*, member_payment.id as memberpaymentid');
		$this->db->join('payment', 'payment.id = '.$table.'.payment_id', 'inner');
		$this->db->join('member', 'member.id = '.$table.'.member_id', 'inner');
		$this->db->from($table);
		$this->db->where('payment.uid',$uid);

		return $this->db->get();
	}

	public function update_member_session($member, $session)
	{
		$this->db->set('session_left','session_left+'.$session,FALSE);
		$this->db->where('id', $member);
		$this->db->update('member');
	}
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */