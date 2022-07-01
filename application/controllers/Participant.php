<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class participant extends CI_Controller {
		
		public function __construct()
		{
			date_default_timezone_set('Asia/Jakarta');
			
			parent::__construct();
			$this->load->model('participant_model');
		}

		public function index()
		{
			$dayoftheweek = date('w',strtotime(date('Y-m-d H:i:s')));

			$data['dayoftheweek'] = array(
				'1' => 'Monday', 
				'2' => 'Tuesday', 
				'3' => 'Wednesday', 
				'4' => 'Thursday', 
				'5' => 'Friday', 
				'6' => 'Saturday', 
				'7' => 'Sunday', 
			);

			$data['title'] = "Athletic Page";
			$data['scheduleregular'] = $this->participant_model->get_today_schedule('schedule',0,date('Y-m-d'))->result();
			$data['schedulerepeat'] = $this->participant_model->get_today_schedule('schedule',1,$dayoftheweek)->result();

			$data['participant'] = $this->participant_model->get_data('participant')->result();
			//$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('participant/index', $data);
			$this->load->view('template/footer', $data);
		}

		public function new_action()
		{
			$data = array(
				'schedule_id' => $this->input->post('schedule_id'),
				'member_id' => $this->input->post('member_id'),
				'created_at' => date('Y-m-d H:i:s'),
			);

			if($this->participant_model->insert_data($data, 'participant')>0)
			{
				$this->participant_model->modify_session($data['member_id'],-1);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  New data has been added!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  Failed to add data!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
			}

			redirect('participant/register?id='.$data['schedule_id']);
		}

		

		public function delete_action()
		{ 
			$data = array(
				'member_id' => $this->input->get('member', TRUE),
				'schedule_id' => $this->input->get('schedule', TRUE),
			);

			$this->participant_model->delete_data($data, 'participant');

			$this->participant_model->modify_session($data['member_id'],1);

			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Data has been deleted!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			redirect('participant/register?id='.$this->input->get('schedule', TRUE));
		}

		public function register($value='')
		{
			$id = $this->input->get('id', TRUE);

			$data['title'] = "Athletic Page";
			$data['participant'] = $this->participant_model->get_data('participant',$id)->result();
			$data['schedule'] = $this->participant_model->get_schedule('schedule',$id)->result();

			$data['available'] = $this->participant_model->get_available('participant',$id)->result();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('participant/register', $data);
			$this->load->view('template/footer', $data);
		}

		public function generate_shedule()
		{
			$id = $this->input->get('id', TRUE);

			$insert_id = $this->participant_model->create_schedule($id, 'schedule');

			redirect('participant/register?id='.$insert_id);
		}

		public function start_schedule()
		{
			$id = $this->input->get('id', TRUE);

			$data = array(
				'id' => $id,
				'started_at' => date('Y-m-d H:i:s'),
			);

			if($this->participant_model->update_data($data, 'schedule') > 0)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  Scheduled class has been started!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  Failed to start scheduled class!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>');
			}

			redirect('participant');
		}

		public function _rules()
		{
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
		}

	}
	
	/* End of file participant.php */
	/* Location: ./application/controllers/participant.php */
?>