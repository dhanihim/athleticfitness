<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');

		parent::__construct();
		$this->load->model('schedule_model');
	}

	public function index()
	{
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
		$data['schedulerepeat'] = $this->schedule_model->get_data('schedule',0,1)->result();
		$data['scheduleregular'] = $this->schedule_model->get_data('schedule')->result();
		//$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('schedule/index', $data);
		$this->load->view('template/footer', $data);
	}

	public function new()
	{
		$data['title'] = "Athletic Page";
		$data['sport'] = $this->schedule_model->get_select('sport')->result();
		$data['coach'] = $this->schedule_model->get_select('coach')->result();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('schedule/new', $data);
		$this->load->view('template/footer', $data);
	}

	public function new_action()
	{
		$data = array(
			'sport_id' => $this->input->post('sport_id'),
			'coach_id' => $this->input->post('coach_id'),
			'type' => $this->input->post('type'),
			'scheduled_start' => $this->input->post('scheduled_start'),
			'scheduled_finish' => $this->input->post('scheduled_finish'),
			'created_at' => date('Y-m-d H:i:s'),
		);

		if($this->schedule_model->insert_data($data, 'schedule')>0)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  New data has been added!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');

			redirect('schedule');
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Failed to add data!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			redirect('schedule/new');
		}
	}

	public function edit()
	{
		$id = $this->input->get('id', TRUE);

		$data['title'] = "Athletic Page";
		$data['schedule'] = $this->schedule_model->get_data('schedule',$id)->result();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('schedule/edit', $data);
		$this->load->view('template/footer', $data);
	}

	public function edit_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Failed to edit data!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			$this->new();
		} else {
			$data = array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
			);

			$this->schedule_model->update_data($data, 'schedule');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Data has been edited!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			redirect('schedule');
		}
	}

	public function delete_action()
	{
		date_default_timezone_set('Asia','Jakarta');
		
		$data = array(
			'id' => $this->input->get('id', TRUE),
			'deleted_at' => date('Y-m-d H:i:s'),
		);

		$this->schedule_model->update_data($data, 'schedule');

		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  Data has been deleted!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');

		redirect('schedule');
	}

	public function _rules()
	{

	}
}
