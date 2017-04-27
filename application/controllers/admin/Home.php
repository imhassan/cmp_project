<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Home extends Admin_Controller {
	public function __construct() {
		parent::__construct ();
		if (! has_logged_in ()) {
			redirect ( base_url () . 'admin/user/login' );
		}
		$this->load->model ( 'db_model' );
		//$this->acl->buildACL ();
	}
	public function index() {
		/*if (! $this->acl->has_permission ( 'slides', 'view' )) {
			redirect ( base_url () . 'admin/user' );
		}*/
		
		$this->slides ();
	}
	public function slides() {
		/*if (! $this->acl->has_permission ( 'slides', 'view' )) {
			redirect ( base_url () . 'admin/user' );
		}*/
		
		$this->data ['listings'] = $this->db_model->find ( 'slider' );

		$this->data['view'] = "admin/slider/listing";
		$this->load->view('admin/default',$this->data);
	}
	public function add_slide() {
		/*if (! $this->acl->has_permission ( 'slides', 'add' )) {
			redirect ( base_url () . 'admin/user' );
		}*/
		
		if ($this->input->post ()) {
			$input = $this->input->post ( null, true );
			$post = array ();
			$post ['slide_caption'] = $input ['slide_caption'];
			$post ['slide_desc'] = $input ['slide_desc'];
			$file = $this->upload_slide ( $_FILES );
			// var_dump($file);exit;
			if ($file) {
				$post ['slide_name'] = $file ['name'];
				$post ['slide_ext'] = $file ['ext'];
			}
			$post ['created_by'] = get_user_id ();
			$insert_id = $this->db_model->save ( 'slider', $post );
			if ($insert_id) {
				$this->session->set_flashdata ( 'validate', array (
						'message' => 'Slide has been uploaded.',
						'type' => 'success' 
				) );
			} else {
				$this->session->set_flashdata ( 'validate', array (
						'message' => 'Something went wrong in uploading!.',
						'type' => 'error' 
				) );
			}
			redirect ( base_url () . 'admin/home/slides' );
		}
		$this->data['view'] = "admin/slider/add";
		$this->load->view('admin/default',$this->data);
	}
	public function upload_slide($file) {
		if (file_exists ( $file ['photo_name'] ['tmp_name'] )) {
			// original
			$time = time () . rand ();
			$post_image = array (
					'file' => $file ["photo_name"],
					'new_name' => $time . '_o',
					'dst_path' => $this->config->item ( 'slider_path' ) 
			);
			$post_image_response = upload_original ( $post_image );
			$src_path = $this->config->item ( 'slider_path' ) . $post_image_response ['file_name'];
			
			// thumbnails
			// $thumbs = array();
			foreach ( $this->config->item ( 'slider_dimentions' ) as $key => $value ) {
				$thumb = array (
						'src_path' => $src_path,
						'dst_path' => $this->config->item ( 'slider_path' ),
						'image_x' => $value ['x'],
						'image_y' => $value ['y'],
						'image_ratio' => true,
						'quality' => '100%',
						'image_ratio_fill' => true,
						'new_name' => $time . '_' . $key 
				);
				upload_resized_images ( $thumb );
			}
			
			$response = array (
					'name' => $time,
					'ext' => $post_image_response ['file_ext'] 
			);
			return $response;
		}
		return false;
	}
	public function delete_slide($id = false) {
		/*if (! $this->acl->has_permission ( 'slides', 'delete' )) {
			redirect ( base_url () . 'admin/user' );
		}*/
		
		if (! $id) {
			show_404 ();
		}
		$photo = $this->db_model->find ( 'slider', false, array (
				'id' => $id 
		) );
		$photo_name = $photo [0] ['slide_name'];
		$photo_ext = $photo [0] ['slide_ext'];
		if ($this->db_model->delete ( 'slider', array (
				'id' => $id 
		) )) {
			// delete original
			unlink ( $this->config->item ( 'slider_path' ) . $photo_name . '_o.' . $photo_ext );
			// delete thumbs
			foreach ( $this->config->item ( 'slider_dimentions' ) as $key => $value ) {
				unlink ( $this->config->item ( 'slider_path' ) . $photo_name . '_' . $key . '.' . $photo_ext );
			}
			$this->session->set_flashdata ( 'validate', array (
					'message' => 'Slide has been deleted successfully.',
					'type' => 'success' 
			) );
		} else {
			$this->session->set_flashdata ( 'validate', array (
					'message' => 'Something went wrong in deletion.',
					'type' => 'error' 
			) );
		}
		redirect ( base_url () . 'admin/home/slides' );
	}
}
