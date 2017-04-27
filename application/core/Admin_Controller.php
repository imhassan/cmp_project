<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin_Controller extends CI_Controller {
	public $data = array ();
	public $settings = array();
	function load_default() {
		// site_settings
		$site_settings = $this->db_model->find ( 'site_settings' );
		$setting = array ();
		foreach ( $site_settings as $key => $value ) {
			$setting [$value ['setting_key']] = $value ['setting_value'];
		}
		$this->settings = $setting;
		$this->data['setting'] = $setting;
	}
	function __construct() {
		parent::__construct ();
		$this->load->model('db_model');
		$this->load->model('QuestionModel');
		$this->load_default();
	}
}
