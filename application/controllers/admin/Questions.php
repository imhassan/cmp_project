<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Questions extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		if(!has_logged_in()){
			redirect(base_url() . 'admin/user/login');
		}
	}
	public function index() {
		$this->data ['listings'] = $this->db_model->find('questions', false, false, false, false, false, false, "created_at desc");
		$this->data ['view'] = "admin/questions/listing";
		$this->load->view('admin/default', $this->data);
	}
	private function saveData() {
		if($this->input->post()){
			$post_data = $this->input->post(null, true);
			print_r($post_data);
			// return;
			$db_insert_data = array(
					'question_text' => $post_data ['question_text'] 
			);
			
			if(isset($post_data ['id'])){
				$this->db_model->update('questions', $db_insert_data, array(
						'id' => $post_data ['id'] 
				));
				$correct_option_id = "";
				// update options
				foreach($post_data ['options'] as $key=>$val){
					
					$this->db_model->update('options', array(
							'option_text' => $val 
					), array(
							'id' => $key 
					));
					
					if($post_data ['is_correct_radio'] == $key){
						$correct_option_id = $key;
					}
				}
				
				// delete options
				foreach($post_data ['delete_options'] as $key=>$val){
					
					$this->db_model->delete('options', array(
							'id' => $val 
					));
				}
				
				$insert_id = $post_data ['id'];
			}else{
				$insert_id = $this->db_model->save('questions', $db_insert_data);
			}
			
			// insert new options
			foreach($post_data ['new_options'] as $key=>$val){
				$insert_option_id = $this->db_model->save('options', array(
						'option_text' => $val,
						'question_id' => $insert_id 
				));
				
				if($post_data ['is_correct_radio'] == $key){
					$correct_option_id = $insert_option_id;
				}
			}
			
			// update question correct option id
			$this->db_model->update('questions', array(
					'correct_option_id' => $correct_option_id 
			), array(
					'id' => $post_data ['id'] 
			));
			
			$this->data ['post_data'] = $post_data;
			return ($insert_id)?true:false;
		}
	}
	public function add() {
		$this->data ['post_data'] = array();
		$this->data ['post_data'] ['question'] = array();
		$this->data ['post_data'] ['options'] = array();
		
		if($this->input->post()){
			if($this->saveData()){
				$this->session->set_flashdata('validate', array(
						'message' => 'Ads has been saved.',
						'type' => 'success' 
				));
				redirect(base_url() . 'admin/questions');
			}else{
				$this->session->set_flashdata('validate', array(
						'message' => 'Something went wrong. Please try again',
						'type' => 'error' 
				));
			}
		}
		
		$this->data ['view'] = "admin/questions/add";
		$this->load->view('admin/default', $this->data);
	}
	public function edit($id = false) {
		if(!$id){
			show_404();
		}
		$question_detail = $this->QuestionModel->getQuestionDetail($id);
		
		if($question_detail){
			$this->data ['post_data'] = $question_detail;
			$this->data ['post_data'] ['id'] = $id;
		}
		
		if($this->input->post()){
			if($this->saveData()){
				$this->session->set_flashdata('validate', array(
						'message' => 'Question has been updated.',
						'type' => 'success' 
				));
				redirect(base_url() . 'admin/questions');
			}else{
				$this->session->set_flashdata('validate', array(
						'message' => 'Something went wrong. Please try again!.',
						'type' => 'error' 
				));
			}
		}
		
		$this->data ['view'] = "admin/questions/edit";
		$this->load->view('admin/default', $this->data);
	}
}
