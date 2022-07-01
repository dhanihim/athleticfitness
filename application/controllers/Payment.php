<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class payment extends CI_Controller {

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		
		parent::__construct();
		$this->load->model('payment_model');
	}

	public function index()
	{
		$data['title'] = "Athletic Page";
		$data['paymentpending'] = $this->payment_model->get_data('payment')->result();
		$data['paymentdone'] = $this->payment_model->get_data('payment','0','1')->result();
		//$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('payment/index', $data);
		$this->load->view('template/footer', $data);
	}

	public function new()
	{
		$data['title'] = "Athletic Page";
		$data['pricelist'] = $this->payment_model->get_select('pricelist')->result();
		$data['coach'] = $this->payment_model->get_select('coach')->result();
		$data['member'] = $this->payment_model->get_select('member')->result();

		if(null !== ($this->input->get('referal', TRUE)))
		{
			$referal = $this->input->get('referal', TRUE);

			$data['referal'] = $this->payment_model->get_data('payment',0,0,$referal)->result();

			$data['memberlist'] = $this->payment_model->get_member_payment('member_payment',$referal)->result();
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('payment/new', $data);
		$this->load->view('template/footer', $data);
	}

	public function draft()
	{
		$uid = strtotime(date('Y-m-d H:i:s'));

		$data = array(
			'pricelist_id' => $this->input->post('pricelist_id'),
			'coach_id' => $this->input->post('coach_id'),
			'uid' => $uid,
		);

		$draft_id = $this->payment_model->insert_draft($data, 'payment');

		if($draft_id > 0)
			redirect('payment/new?referal='.$uid);
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Failed to add data!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			$this->new();
		}
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
				'price' => $this->input->post('price'),
				'total_member' => $this->input->post('total_member'),
				'session_per_member' => $this->input->post('session_per_member'),
				'validity' => $this->input->post('validity'),
				'created_at' => date('Y-m-d H:i:s'),
			);

			$this->payment_model->insert_data($data, 'payment');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  New data has been added!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

			redirect('payment');
		}
	}

	public function view()
	{
		$data['title'] = "Athletic Page";

		if(null !== ($this->input->get('referal', TRUE)))
		{
			$uid = $this->input->get('referal', TRUE);

			$data['referal'] = $this->payment_model->get_data('payment',0,-1,$uid)->result();

			$data['memberlist'] = $this->payment_model->get_member_payment('member_payment',$uid)->result();

			$data['payment'] = $this->payment_model->get_data('payment',0,-1,$uid)->result();
		}


		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('payment/view', $data);
		$this->load->view('template/footer', $data);
	}

	public function delete_action()
	{
		$data = array(
			'id' => $this->input->get('id', TRUE),
			'deleted_at' => date('Y-m-d H:i:s'),
		);

		$this->payment_model->update_data($data, 'payment');

		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  Data has been deleted!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');

		redirect('payment');
	}

	public function accept_action()
	{
		$payment_id = $this->input->get('id', TRUE);

		$data = array(
			'id' => $this->input->get('id', TRUE),
			'deposited_at' => date('Y-m-d H:i:s'),
		);

		$session = $this->input->get('n', TRUE);
		
		$query = $this->db->query("SELECT * FROM member_payment WHERE payment_id = ".$payment_id);

		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
			    $member_id = $row->member_id;

				$this->payment_model->update_member_session($member_id, $session);
			}
		}

		$this->payment_model->update_data($data, 'payment');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  Data has been updated!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');

		redirect('payment');
	}

	public function delete_member_payment()
	{
		$data = array(
			'id' => $this->input->get('id', TRUE),
		);
		$this->payment_model->delete_data($data,'member_payment');

		redirect('payment/new?referal='.$this->input->get('r', TRUE));
	}

	public function add_memberpayment()
	{
		$data = array(
			'member_id' => $this->input->post('member_id'),
			'payment_id' => $this->input->post('payment_id'),
		);

		$referal = $this->input->post('referal');

		$this->payment_model->insert_data($data, 'member_payment');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  Data has been added!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');

		redirect('payment/new?referal='.$referal);
	}

	public function final_submit()
	{
		$data = array(
			'id' => $this->input->post('payment_id'),
			'total' => $this->input->post('total'),
			'created_at' => date('Y-m-d H:i:s'),
		);

		$this->payment_model->update_data($data, 'payment');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			 New payment has been created!
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>');

		redirect('payment');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('price', 'Address', 'required');
		$this->form_validation->set_rules('total_member', 'Total Member', 'required');
		$this->form_validation->set_rules('session_per_member', 'Session per Member', 'required');
		$this->form_validation->set_rules('validity', 'Validity', 'required');
	}
}
