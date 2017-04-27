<?php
class QuestionModel extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->model('Db_model');
	}
	function getQuestionDetail($id) {
		$query = "SELECT * FROM questions  WHERE id = " . $this->db->escape($id);
		
		$user_question = $this->db->query($query)->result_array();
		if($user_question){
			$question = $user_question [0];
			$question_data ['question'] = $question;
		}
		$options = $this->getOptionsByQuestionID($id);
		$question_data ['options'] = $options;
		return $question_data;
	}
	function getOptionsByQuestionID($id) {
		return $this->db_model->find('options',false, "question_id = ".$this->db->escape($id));
	}
}

?>