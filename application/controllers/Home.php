<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if (!has_web_logged_in()) {
            //redirect(base_url() . 'user/login');
        }
	}

	public function index() {	
		$this->data ['user_data'] = get_web_logged_session();
		$this->data ['view'] = "home/index";
		$this->load->view('common/default_public', $this->data);
	}
	
}
