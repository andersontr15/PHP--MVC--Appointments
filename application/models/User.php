<?php 
	class User extends CI_Model
	{
		public $user;

		function __construct()
		{
			parent::__construct();
		}
		public function get_user($user_info)
		{
			return $this->db->query("SELECT * FROM users WHERE email = '{$user_info['email']}' AND 
				password = '{$user_info['password']}'")->row_array();
		}
		public function insert_user($user_info)
		{
				$insert_query = "INSERT INTO users (name, email, password, date_of_birth, created_at)
								VALUES (?, ?, ?, ?, NOW())";
				$values = (array($user_info['name'], $user_info['email'], $user_info['password'], $user_info['dob']));
				$this->db->query($insert_query, $values);
				return $this->db->insert_id();
		}
		public function show_users_profile($id)
		{
			$show_users_query = "SELECT * FROM users WHERE users.id = ?";
			return  $this->db->query($show_users_query, $id)->row_array();
		}

		public function show_appointments_profile($id)
		{
			$show_users_query = "SELECT * FROM appointments WHERE appointments.id = ?";
			return  $this->db->query($show_users_query, $id)->row_array();
		}
		public function add($tasks, $date, $time, $user_id, $status)
		{
			
		 	$query = "INSERT INTO appointments (tasks, dates, time, user_id, status, created_at) VALUES (?,?, ?, ?,?, NOW())";
			$values = array($tasks, $date, $time, $user_id, $status);
			$this->db->query($query, $values);	
		}
		public function show_tasks($id)
		{
			$today = date('Y-m-d', strtotime('today'));
			$get_tasks_query = "SELECT *
			FROM users 
			LEFT JOIN appointments on users.id = appointments.user_id
			WHERE users.id = ? AND appointments.dates = curdate() 
			LIMIT 4";
			return $this->db->query($get_tasks_query, $id)->result_array(); 
		}
		public function show_other_tasks($id)
		{
			
			
			$today = date('Y-m-d', strtotime('today'));
			$get_tasks_query = "SELECT *
			FROM users 
			LEFT JOIN appointments on users.id = appointments.user_id
			
			
			WHERE users.id = ? AND appointments.dates > curdate() 
			";
			return $this->db->query($get_tasks_query, $id)->result_array(); 
		}
		public function delete($id)
		{
			$delete_query = "DELETE FROM appointments WHERE appointments.id = ?";
			return $this->db->query($delete_query, $id);
		}
		public function update($product)
	{
		$query = "UPDATE appointments SET tasks = ?, time = ?, status = ?, dates= ?  WHERE id = ?";
		$values = array($product['tasks'],$product['time'],$product['status'], $product['dates'], $product['id']);
		return $this->db->query($query,$values);
		
	}
}