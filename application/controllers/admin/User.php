<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller
{

    public function __construct() {

        parent::__construct();
        $this->load->model('user_model');
    }

    public function index() {

        if (!has_logged_in()) {
            redirect(base_url() . 'admin/user/login');
        } 
        $this->listing();   
    }

    public function listing() {

        if (!has_logged_in()) {
            redirect(base_url() . 'admin/user/login');
        } 

        $sess = get_logged_session();
        $user_list =  $this->db_model->find('users',false, " type = 'user' ");
        //$user_list = $this->user_model->get_users();
        $this->data['user_list'] = $user_list;
        //print_r($this->data);exit;
        $this->data['view'] = "admin/user/user_listing";
        $this->load->view('admin/default',$this->data);
    }

    public function add() {

        if (!has_logged_in()) {
            redirect(base_url() . 'admin/user/login');
        }

        if($this->input->post()){
            
            $sess = get_logged_session();
            // if($sess['login_group_id']=='11'){
            //     $region_id = $sess['login_region_id'];
            // }else{
            //     $region_id = '0';
            // }
            
            //$auth_pin = rand(0,9999);
            $user_add_array = array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'user_name'=>$this->input->post('user_name'),
            'user_password'=>md5($this->input->post('user_password')),
            'type'=>$this->input->post('type'),
            'email'=>$this->input->post('email')
            //'group_id_fk'=>$this->input->post('group_id_fk')
            // 'branch_id_fk'=>$this->input->post('branch_id_fk'),
            // 'region_id_fk'=>$region_id,
            // 'auth_pin'=>$this->input->post('auth_pin')
            );
           
            $this->db->insert('users',$user_add_array);
            //$user_id = $this->db->insert_id();
            
            //add_user_role($user_id, $this->input->post('group_id_fk'));
            // if($this->input->post('user_type')=='api')
            // {
                
            //     $api_key = generate_api_key();
            //     $api_key_add = array(
            //         'key'=>$api_key,
            //         'user_id_fk' => $user_id,
            //         'branch_id_fk' => $this->input->post('branch_id_fk')
            //         );
            //     $this->db->insert('api_keys',$api_key_add);
            // }
            redirect(base_url() . 'admin/user/listing');
        }
        
        // $group_list = $this->group_model->get_groups();
        // $this->data['group_list'] = $group_list;

        // $sess = get_logged_session();
        // if($sess['login_group_id']=='11'){
        //     $branch_list = $this->branch_model->get_branches_by_region($sess['login_region_id']);
        // }else{
        //     $branch_list = $this->branch_model->get_branches();
        // }
        
        
        // $this->data['branch_list'] = $branch_list;
        
        
        
        
        $this->data['view'] = "admin/user/add_user";
        $this->load->view('admin/default',$this->data);
        
    }


    public function login() {

        if(has_logged_in()) {
            
            redirect(base_url() . 'admin/user');
            
        }
        $this->load->helper(array('form'));
        $this->load->view('admin/user/login',$this->data);
    }

    function login_confirm() {
        $refferer_url = $_SERVER['HTTP_REFERER'];
        //print_r($this->input->post());exit;
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Password', "trim|required|callback_check_database");
        
        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            //$this->load->view('users/login');
            //echo validation_errors();
            //exit;
            $this->session->set_flashdata('validate', array('message' => 'Invalid User Name or Password. Please try again!', 'type' => 'error'));
            $this->load->helper(array('form'));
            $this->load->view('admin/user/login', $this->data);
            //redirect(base_url() . 'guest');
        } else {

            //Go to private area
            $username = $this->input->post('user_name');
            $password = $this->input->post('user_password');
            $remember_me = $this->input->post('remember_me', NULL);
            if ($remember_me) {

                $expire = time() + 60 * 60 * 24 * 60;
                setcookie("remember_me", "on", $expire, "/", "");
                setcookie("remember_me_username", $username, $expire, "/", "");
                setcookie("remember_me_password", $password, $expire, "/", "");
            } else {

                $past = time() - 60 * 60 * 24 * 60;
                setcookie("remember_me", '', $past, "/", "");
                setcookie("remember_me_username", '', $past, "/", "");
                setcookie("remember_me_password", '', $past, "/", "");
            }
            $session_data = get_logged_session();
           
            redirect(base_url() . 'admin/user/listing');
        }
    }

    function check_database($password) {
        $this->load->model('user_model');
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('user_name');

        //query the database
        $row = $this->user_model->login($username, $password);

        if ($row) {


            $sess_array = array();

            $user_id = $row->id;

            if ($row->is_deleted) {
                $this->session->set_flashdata('validate', array('message' => 'Your account has been deleted.', 'type' => 'warning'));
                redirect($refferer_url);
            } else if (!$row->is_active) {
                $this->session->set_flashdata('validate', array('message' => 'Your account has been deactivaed.', 'type' => 'error'));
                redirect($refferer_url);
            } else {
                $this->session->set_flashdata('validate', array('message' => 'You have successfully logged in.', 'type' => 'success'));
            }

            $sess_array = array(
                'login_user_id' => $row->id,
                'login_username' => $row->user_name,
                'login_name' => $row->first_name.' '.$row->last_name,
                'login_type' => $row->type,
                'group_id_fk' => $row->group_id_fk
            );
            
            $this->load->model('Db_model');
            $this->Db_model->save_user_session($row->id);

                            
            $this->session->set_userdata('user_login_session', $sess_array);
            $this->session->set_userdata('session_id', $row->id);
                
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    function logout() {
        if(has_logged_in()) {
            //$this->acl->clear_acl();
            $this->session->unset_userdata('user_login_session');
            session_destroy();
        }
        $this->session->set_flashdata('validate', array('message' => 'You are successfully logged out.', 'type' => 'success'));
        redirect(base_url() . 'admin/user/login');
    }

    public function edit_user($user_id) {
        
        if (!has_logged_in()) {
            redirect(base_url() . 'admin/user/login');
        }

        $user_info = $this->user_model->get_user_by_id($user_id);       
        
        if($this->input->post()){
            
            
            //$auth_pin = rand(0,9999);
            $user_add_array = array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'user_name'=>$this->input->post('user_name'),
            'type'=>$this->input->post('type'),
            'email'=>$this->input->post('email')
            //'group_id_fk'=>$this->input->post('group_id_fk')
            );
            if($this->input->post('user_password')!=''){
                $user_add_array['user_password'] = md5($this->input->post('user_password'));
            }
            $this->db->where('id', $user_id);
            $this->db->update('users',$user_add_array);
            //$user_id = $this->db->insert_id();
            
            
            /*if($user_info['group_id_fk'] != $this->input->post('group_id_fk'))
            {
                remove_user_role($user_id);
                add_user_role($user_id, $this->input->post('group_id_fk'));
            
            }*/

            redirect(base_url() . 'admin/user/listing');
        }else{
            $this->data = $user_info;
            $this->data['user_id'] = $user_id;
            
        }
        
        $this->data['setting'] = $this->settings;
                    
        // $group_list = $this->group_model->get_groups();
        // $this->data['group_list'] = $group_list;        
        
        $this->data['view'] = "admin/user/edit_user";
        $this->load->view('admin/default',$this->data);
            
    }
    
    public function user_role($slug) {
        
        $user_id_encoded = $slug;
        $user_id_arr = explode('#',base64_decode($user_id_encoded));
        $user_id = substr($user_id_arr[0], 3);
        $this->data['user_id_encoded'] = $user_id_encoded;
        
        
        if (!has_logged_in() || !$this->acl->has_permission('user','permission')) {
            redirect(base_url() . 'admin/user/login');
        } else {
            if($this->input->post(null, true)){
                $this->user_model->remove_role_by_user_id($user_id);
                $new_role_list=$this->input->post('user_role');
                if(!empty($new_role_list)) {
                    foreach($new_role_list as $role_asigned)
                    {
                        $role_asigned = explode('##', $role_asigned);
                        $role_array_assigned = array('user_id_fk'=>$user_id,'user_role_module'=>$role_asigned[0],'user_role_name'=>$role_asigned[1]);
                        $this->user_model->save_user_role($role_array_assigned);
                    }
                }
                redirect(base_url() . 'admin/user/listing');
            }
            $user_role_list = $this->user_model->get_user_role($user_id);
            $roles_list = $this->user_model->get_roles();
            $reg_role = array();
            foreach($roles_list as $role){
                $exist_in_array = 'no';
                if(array_search($role['role_module'].'_'.$role['role_name'], array_column($user_role_list, 'role_module_name')) !== false)
                {
                    $exist_in_array = 'yes';
                }
                if(isset($reg_role[$role['role_module']])){
                    $reg_role[$role['role_module']][]=array('role_id'=>$role['role_id'],'role_module'=>$role['role_module'],'role_name'=>$role['role_name'],'role_description'=>$role['role_description'],'user_role_status'=>$exist_in_array);
                }
                else{
                    $reg_role[$role['role_module']]=array();
                    $reg_role[$role['role_module']][]=array('role_id'=>$role['role_id'],'role_module'=>$role['role_module'],'role_name'=>$role['role_name'],'role_description'=>$role['role_description'],'user_role_status'=>$exist_in_array);
                }
            }
            $this->data['user_role_list'] = $reg_role;
            
            $this->data['view'] = "admin/user/user_role";
            $this->load->view('admin/default',$this->data);
        }
    }

    public function delete_user($user_id) {
        
        if (!has_logged_in()) {
            redirect(base_url() . 'admin/user/login');
        }

        $this->user_model->remove_role_by_user_id($user_id);
        $this->db->where('id', $user_id);
        $this->db->delete('users');
        redirect(base_url() . 'admin/user/listing');
    }

    public function forgotpassword() {
        if($this->input->post(null, true)){ 
            $post = $this->input->post(null, true);
            $res = $this->user_model->process_user_forgot_password($post);
            $type = ($res['status'])?'success':'error';
            $this->session->set_flashdata('validate', array('message' => $res['message'], 'type' => $type));
            redirect('admin/user/forgotpassword', 'refresh');
        }

        $this->load->helper(array('form'));
        $this->load->view('admin/user/forgotpassword', $this->data);
    }

    public function change_password($code = false) {
        if (!$code) {
            show_404();
        }

        $userId = $this->user_model->verify_code($code);
        if(!$userId) {
            $this->session->set_flashdata('validate', array('message' => 'Code is not valid!. Please try again!', 'type' => 'error'));
            redirect('admin/user/login', 'refresh');
        }

        if ($this->input->post('user_password') && $this->input->post('confirm_password') && $userId) {
            $response = $this->user_model->process_change_password($userId);
            if($response['status']){
                $this->session->set_flashdata('validate', array('message' => $response['message'], 'type' => 'success'));
                redirect('admin/user/login', 'refresh');
            }
            $this->session->set_flashdata('validate', array('message' => $response['message'], 'type' => 'error'));
        }

        
        $this->data['code'] = $code;
        $this->load->view('admin/user/change_password', $this->data);
    }

    public function reset_password() {
        
        if(!has_logged_in()) {
            redirect(base_url() . 'user/login');
        }
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_password', 'New Password', 'trim|required|matches[user_conf_password]');
        $this->form_validation->set_rules('user_conf_password', 'Confirm New Password', "trim|required");

        if ($this->form_validation->run() == FALSE) {
            $error =  validation_errors();
            $this->session->set_flashdata('validate', array('message' => $error, 'type' => 'warning'));
            $this->load->view('user/reset_password', $this->data);
        } else {
            
            $password_expire_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.EXPIRE_PASSWORD_IN_DAYS.' days'));
            //Go to private area
            $password = $this->input->post('user_password');
            $conf_password = $this->input->post('user_conf_password');
            $remember_me = $this->input->post('remember_me', NULL);
         
            $session_data = get_logged_session();
            $change_password = array(
                'user_password' => md5($password),
                'password_expire_date' => $password_expire_date
            );
            
            $this->db->where('user_id', $session_data['login_user_id']);
            $this->db->update('user', $change_password);
            $this->acl->clear_acl();
            $this->session->unset_userdata('user_login_session');
            session_destroy();
            $this->session->set_flashdata('validate', array('message' => 'Your password has been updated successfully. Please login with new password.', 'type' => 'success'));
            redirect(base_url() . 'user/login');

        }
    }

    public function check_email() {
        $email = $this->input->post('email', true);
        $res = $this->user_model->get_user_by_email($email);
        echo ($res)?'false':'true';
    }

    public function check_username() {
        $user_name = $this->input->post('user_name', true);
        $res = $this->user_model->get_user_by_name($user_name);
        echo ($res)?'false':'true';
    }


}
