<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');

		parent::__construct();
		$this->load->model('member_model');
	}

	public function index()
	{
		$data['title'] = "Athletic Page";
		$data['member'] = $this->member_model->get_data('member')->result();
		//$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('member/index', $data);
		$this->load->view('template/footer', $data);
	}

	public function new()
	{
		$data['title'] = "Athletic Page";

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('member/new', $data);
		$this->load->view('template/footer', $data);
	}

	public function new_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Failed to add data!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			$this->new();
		} else {
			$data = array(
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'session_left' => 0,
				'created_at' => date('Y-m-d H:i:s'),
			);

			$this->member_model->insert_data($data, 'member');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  New data has been added!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			redirect('member');
		}
	}

	public function edit()
	{
		$id = $this->input->get('id', TRUE);

		$data['title'] = "Athletic Page";
		$data['member'] = $this->member_model->get_data('member',$id)->result();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('member/edit', $data);
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

			$this->member_model->update_data($data, 'member');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Data has been edited!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			redirect('member');
		}
	}

	public function delete_action()
	{
		date_default_timezone_set('Asia','Jakarta');
		
		$data = array(
			'id' => $this->input->get('id', TRUE),
			'deleted_at' => date('Y-m-d H:i:s'),
		);

		$this->member_model->update_data($data, 'member');

		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  Data has been deleted!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');

		redirect('member');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
	}
}
