<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

	public function __construct() {

        parent::__construct();
        if (!has_logged_in()) {
            redirect(base_url() . 'admin/user/login');
        }
        //$this->load->model('db_model');
        //$this->acl->buildACL();
    }

	public function index() {
		/*if(!$this->acl->has_permission('settings','view')){
            redirect(base_url() . 'admin/user');
        }*/
		$this->data['listings'] = $this->db_model->find('site_settings');
		$this->load->view('admin/common/admin_header',$this->data);
        $this->load->view('admin/settings/listing',$this->data);
        $this->load->view('admin/common/admin_footer');
	}	

	public function edit($id = false) {
		/*if(!$this->acl->has_permission('settings','edit')){
            redirect(base_url() . 'admin/user');
        }*/

		if(!$id) {
			show_404();
		}
		if($this->input->post()){
			$input = $this->input->post(null, true);
			$post = array();
			$post['setting_value'] = $input['setting_value'];
			$post['updated_by'] = get_user_id();
			$insert_id = $this->db_model->update('site_settings', $post, array('id' => $input['id']));
			if($insert_id) {				
				$this->session->set_flashdata('validate', array('message' => 'Setting has been updated.', 'type' => 'success'));				
			}
			else{
				$this->session->set_flashdata('validate', array('message' => 'Something went wrong in uploading!.', 'type' => 'error'));
			}
			redirect(base_url() . 'admin/settings');
		}
		$data = array();
		$site_setting = $this->db_model->find('site_settings', false, array('id'=>$id));
		if($site_setting) {
			$data['site_setting'] = $site_setting[0];
		}
		$this->load->view('admin/common/admin_header');
        $this->load->view('admin/settings/edit', $data);
        $this->load->view('admin/common/admin_footer');        
	}
	
}
