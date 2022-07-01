<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Participant_model extends CI_Model {

		public function get_data($table, $schedule_id=0)
		{
			if($schedule_id==0)
			{
				$this->db->select('*');
				$this->db->from($table);
				$this->db->where('deleted_at IS NULL');

				return $this->db->get();
			}
			else
			{
				$this->db->select('*, member.id as memberid, member.name as membername, sport.name as sportname');
				$this->db->join('member', 'member.id = '.$table.'.member_id', 'inner');
				$this->db->join('schedule', 'schedule.id = '.$table.'.schedule_id', 'inner');
				$this->db->join('sport', 'sport.id = schedule.sport_id', 'inner');
				$this->db->from($table);
				$this->db->where('schedule_id',$schedule_id);

				return $this->db->get();
			}
		}

		public function get_available($table, $schedule_id)
		{
			$query = $this->db->query("SELECT * FROM member WHERE id NOT IN (SELECT member_id FROM participant WHERE schedule_id = ".$schedule_id.") ORDER BY session_left DESC, name ASC");

			return $query;
		}

		public function insert_data($data, $table)
		{
			$this->db->insert($table, $data);

			return $this->db->affected_rows();
		}

		public function update_data($data, $table)
		{
			$this->db->where('id', $data['id']);
			$this->db->update($table, $data);

			return $this->db->affected_rows();
		}

		public function delete_data($data, $table)
		{
			$this->db->where('member_id', $data['member_id']);
			$this->db->where('schedule_id', $data['schedule_id']);
			$this->db->delete($table);
		}

		public function get_today_schedule($table, $type, $day)
		{
			$this->db->select('*, schedule.id as scheduleid, sport.name as sportname, coach.name as coachname, count(participant.id) as total_participant');
			$this->db->from($table);
			$this->db->join('sport', 'sport.id = '.$table.'.sport_id', 'left');
			$this->db->join('coach', 'coach.id = '.$table.'.coach_id', 'left');
			$this->db->join('participant', 'participant.schedule_id = '.$table.'.id', 'left');

			//MySQL use Sunday as 1
			if($type==1)
			{
				$this->db->where('DAYOFWEEK(scheduled_start) = '.($day+1));
				$this->db->where($table.'.id NOT IN (SELECT reference FROM schedule WHERE scheduled_start >=  DATE_SUB(CURDATE(), INTERVAL 1 DAY))');
			}
			else
				$this->db->where('DATE(scheduled_start) = DATE("'.$day.'")');

			$this->db->where($table.'.type = '.$type);
			$this->db->where($table.'.deleted_at IS NULL');

			return $this->db->get();
		}

		public function get_schedule($table,$id)
		{
			$this->db->select('*, sport.name as sportname, coach.name as coachname');
			$this->db->from($table);
			$this->db->join('sport', 'sport.id = '.$table.'.sport_id', 'inner');
			$this->db->join('coach', 'coach.id = '.$table.'.coach_id', 'inner');
			$this->db->where('schedule.id',$id);

			return $this->db->get();
		}

		public function create_schedule($id)
		{
			$this->db->query("INSERT INTO schedule(sport_id, coach_id, type, scheduled_start, scheduled_finish, reference, description, started_at, created_at, deleted_at) SELECT sport_id, coach_id, 0, 
				(select concat(DATE(now()), ' ', TIME(scheduled_start)) as datetime from schedule where id = $id), 
				(select concat(DATE(now()), ' ', TIME(scheduled_finish)) as datetime from schedule where id = $id), $id,
				description, NULL, now(), NULL FROM schedule WHERE id = $id");

			return $this->db->insert_id();
		}

		public function modify_session($member_id, $session)
		{
			$this->db->query("UPDATE member SET session_left = session_left + ".$session." WHERE id = ".$member_id);
		}
	}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */

?>