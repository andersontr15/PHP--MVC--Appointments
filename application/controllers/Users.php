<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('home');
	}
	public function login_page()
	{
		$this->load->view('home');
	}

	public function login_process()
	{
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email","Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password","Password", "trim|min_length[8]|required|md5");

		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata("login_errors", validation_errors());
			redirect('/');
		}
		else
		{
			$this->load->model("User");
			$get_user = $this->User->get_user($this->input->post());
			if($get_user)
				{
				$this->session->set_userdata("user_session", $get_user);
				redirect("/Users/profile");
				}
			else
			{
				
				$this->session->set_flashdata("login_errors", "Invalid email and/or password");
				redirect(base_url());
			}
		}
	}
		public function process_registration()
		{
			$this->load->library("form_validation");
			$this->form_validation->set_rules("name","Name", "trim|required");
			$this->form_validation->set_rules("email","Email", "required|valid_email|is_unique[users.email]");
			$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required|matches[confirm_password]|md5");
			$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|md5");
			if($this->form_validation->run()=== FALSE)
			{
				$this->session->set_flashdata("registration_errors", validation_errors());
				redirect(base_url());
			}
			else
			{
				$this->load->model("User");
				$user_input = $this->input->post();
				$insert_user = $this->User->insert_user($user_input);
				if($insert_user)
				{
					$this->session->set_flashdata('Success', 'You are now registered and may login.');
					redirect("/");
				}
				else
				{
					$this->session->set_flashdata("registration_errors", 
					"Sorry but your info was not going through our system. Try again, please.");
					redirect(base_url());
				}
			}
		}
		public function profile()
		{
			$this->load->model("User");
			$id = $this->session->userdata("user_session")['id'];
			$tasks = $this->User->show_tasks($id);
			$othertasks = $this->User->show_other_tasks($id);

			$show_user = $this->User->show_users_profile($this->session->
			userdata("user_session")['id']);
			$this->load->view("profile", array(
				'tasks'=> $tasks,
				'username'=> $show_user,
				'othertasks'=> $othertasks
				
			 ));
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect("/");
		}

		public function add()
		{
			$this->load->model("User");
			$our_id = $this->session->userdata("user_session")['id'];
			$tasks = $this->input->post("tasks");
			$date = $this->input->post("date");
			$time = $this->input->post("time");
			$today = date('Y-m-d', strtotime('today'));
			$status = "Pending";
			if(empty($time) OR empty($tasks) OR empty($date))
			{
				$this->session->set_flashdata('Wrong', 'Must enter a time, date and task field.');
				redirect("/Users/profile");


			}
			elseif($date < $today)
			{
				$this->session->set_flashdata('Wrong', 'Must enter tasks that are pending or in the future');
				redirect("/Users/profile");
			}
			
			else
			{
			$this->User->add($tasks, $date, $time, $our_id, $status);
			$this->session->set_flashdata('Wrong', 'Task added!');
			redirect("/Users/profile");
			}
		}
		public function delete($id)
		{
			$this->load->model("User");
			$this->User->delete($id);
			redirect("/Users/profile");
		}
		public function update()
		{
			$this->load->model('User');

			$update_product = $this->User->update($this->input->post());
			redirect('/Users/profile');
			
		}
		public function edit($id)
		{
			
			$this->load->model('User');
			$tasks = $this->User->show_appointments_profile($id);
			$this->load->view("edit", array("tasks"=>$tasks));
		}
					
	}