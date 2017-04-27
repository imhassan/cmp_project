<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	public $data = array();
	function load_default() {
		$this->disable_sql_mode();
		// site_settings
		$site_settings = $this->db_model->find('site_settings');
		$setting = array();
		foreach($site_settings as $key=>$value){
			$setting [$value ['setting_key']] = $value ['setting_value'];
		}
		$this->data ['setting'] = $setting;
		$this->data ['leaderboard'] = $this->leaderboard();
	}
	function __construct() {
		parent::__construct();
		$this->load->model('db_model');
		$this->load->model('user_model');
		
		$this->load_default();
	}
	public function check_auth() {
		if(!has_logged_in()){
			redirect(base_url() . 'user/login');
			return false;
		}
		
		$result = get_logged_session();
		
		if($result && isset($result ['login_user_id'])){
			$user_info = $this->user_model->get_user_by_id($result ['login_user_id']);
			$this->data ['user_info'] = $user_info;
			$this->data ['user_info'] ['user_pic'] = base_url("assets/web/images/profile.jpg");
			if($user_info ['img_name'] != ""){
				$this->data ['user_info'] ['user_pic'] = $this->config->item('user_images') ['public_path'] . $user_info ['img_name'] . '_s.' . $user_info ['img_ext'];
			}
		}
	}
	public function disable_sql_mode() {
		// use only if sql_mode error occur
		$sql = "SET @@SESSION.sql_mode = '';";
		$this->db->query($sql);
	}
	public function leaderboard() {
		$query = "SELECT * FROM users WHERE type = 'user'  order by score desc Limit 10";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
}
