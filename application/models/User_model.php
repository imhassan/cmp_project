<?php
class User_model extends CI_Model {
	function userAdsStats($userId, $where = "") {
		$query = "SELECT count(user_ads.id) as total_jobs
				FROM users LEFT JOIN user_ads ON users.id = user_ads.user_id";
		if($where != ""){
			$query .= " AND " . $where;
		}
		$query .= " WHERE users.id = " . $this->db->escape($userId);
		
		$query .= " GROUP BY users.id";
		$result = $this->db->query($query)->result_array();
		//print_r($result);
		return $result [0] ['total_jobs'];
	}
	function login($username, $password) {
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->where('u.user_password', MD5($password));
		$this->db->where('u.user_name', $username);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows() == 1){
			return $query->row();
		}else{
			return false;
		}
	}
	function user_login($email, $password) {
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->where('u.user_password', MD5($password));
		$this->db->where('u.email', $email);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows() == 1){
			return $query->row_array();
		}else{
			return false;
		}
	}
	function get_users() {
		$this->db->select('u.*');
		$this->db->from('users u');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_user_by_id($user_id) {
		$this->db->select('u.*');
		$this->db->from('users u');
		
		$this->db->where('u.id', $user_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	function get_user_by_name($user_name) {
		$this->db->select('u.*');
		$this->db->from('users u');
		
		$this->db->where('u.user_name', $user_name);
		$query = $this->db->get();
		return $query->row_array();
	}
	function get_user_by_fb_id($fb_id) {
		$this->db->select('u.*');
		$this->db->from('users u');
		
		$this->db->where('u.fb_id', $fb_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	function get_user_by_email($email) {
		$this->db->select('u.*');
		$this->db->from('users u');
		$this->db->where('u.email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		return false;
	}
	function get_user_by_region($region_id) {
		$this->db->select('u.*,g.*,b.*');
		$this->db->from('user u');
		$this->db->join('group g', 'u.group_id_fk = g.group_id', 'left');
		$this->db->join('branches b', 'b.branch_id = u.branch_id_fk', 'left');
		
		$this->db->where('u.region_id_fk', $region_id);
		$this->db->where('u.branch_id_fk!=', '');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_user_by_group_id($group_id) {
		$this->db->select('u.*,g.*,b.*');
		$this->db->from('user u');
		$this->db->join('group g', 'u.group_id_fk = g.group_id', 'left');
		$this->db->join('branches b', 'b.branch_id = u.branch_id_fk', 'left');
		
		$this->db->where('u.group_id_fk', $group_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_user_role($user_id) {
		$this->db->select('*,concat(user_role_module,"_",user_role_name) as role_module_name');
		$this->db->from('user_role');
		$this->db->where('user_id_fk', $user_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_roles() {
		$this->db->select('*');
		$this->db->from('role');
		$query = $this->db->get();
		return $query->result_array();
	}
	function save_user($data) {
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}
	function save_user_role($role_list) {
		$this->db->insert('user_role', $role_list);
		return $this->db->insert_id();
	}
	function remove_role_by_user_id($user_id) {
		$this->db->delete('user_role', array(
				'user_id_fk' => $user_id 
		));
	}
	function get_authentication_key() {
		$this->db->select('auth_pin');
		$this->db->from('user');
		$this->db->where('user_id', get_user_id());
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->auth_pin;
		}else{
			return false;
		}
	}
	public function verify_code($code = false) {
		if(!$code){
			return false;
		}
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('u_activation_code', $code);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->id;
		}
		return false;
	}
	private function _generate_activation_code() {
		$characters = 'abcdefghijklmnopqrstuvwxyz-ABCDEFGHIJKLMNOPQRSTUVWXYZ_0123456789';
		do{
			$string = '';
			$max = strlen($characters) - 1;
			for($i = 0; $i < 50; $i++){
				$string .= $characters [mt_rand(0, $max)];
			}
		}while($this->_activation_code_exists($string));
		return $string;
	}
	private function _activation_code_exists($code = false) {
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('u_activation_code', $code);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return true;
		}
		return false;
	}
	public function process_user_forgot_password($postData = false) {
		
		// if (!$this->validator->validate_forgot_password_form()) {
		// return $this->response->send_response(validation_errors(), true);
		// }
		$userData = $this->get_user_by_email($postData ['email']);
		if(!$userData){
			return array(
					'status' => false,
					'message' => 'Email Address does not exists.' 
			);
		}
		
		if(!$userData ['is_active']){
			return array(
					'status' => false,
					'message' => 'Your account is Disabled/In-Active.' 
			);
		}
		
		$updateData = array();
		$userData ['u_activation_code'] = $updateData ['u_activation_code'] = $this->_generate_activation_code();
		
		$this->db->update('users', $updateData, array(
				'id' => $userData ['id'] 
		));
		if($this->_send_forgot_password_email($userData)){
			return array(
					'status' => true,
					'message' => 'Change Password link is sent on your Email Address.' 
			);
		}
		return array(
				'status' => false,
				'message' => 'Email Not sent. Please Try Again Later' 
		);
	}
	public function process_change_password($userId = false) {
		$postData = $this->input->post(null, true);
		
		$updateArray = array();
		$updateArray ['u_activation_code'] = '';
		$updateArray ['user_password'] = md5($postData ['user_password']);
		
		$changed = $this->db->update('users', $updateArray, array(
				'id' => $userId 
		));
		if($changed){
			return array(
					'status' => true,
					'message' => 'Password changed Successfuly.' 
			);
		}
		return array(
				'status' => false,
				'message' => 'Password not changed. Please try again later.' 
		);
	}
	private function _send_forgot_password_email(array $userData) {
		if(!is_array($userData) || empty($userData)){
			return false;
		}
		
		$this->load->model('db_model');
		$settings = $this->db_model->find('site_settings');
		$settings_arr = array();
		foreach($settings as $key=>$setting){
			$settings_arr [$setting ['setting_key']] = $setting ['setting_value'];
		}
		$siteName = $settings_arr ['site_name'];
		$data = array(
				'userdata' => $userData,
				'sitedata' => $settings_arr 
		);
		$message = $this->load->view('email/forgot_password', $data, true);
		$subject = 'Notification: Reset your ' . $siteName . ' password';
		$to = $userData ['email'];
		
		$from = $settings_arr ['info_email'];
		$from_name = $siteName . ' Support';
		
		return send_email($to, $from, $subject, $message);
	}
}

?>