<?php

class Db_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->db->flush_cache();
    }
    
    public function save($table,$data){
        if(empty($table) || empty($data))
        {
            return FALSE;
        }
        
        $insert_id = NULL;
        
        if($this->db->insert($table,$data))
        {
            $insert_id = $this->db->insert_id();       
            $last_query = $this->db->last_query();
            $this->save_insert_log($table,$data,$insert_id,$last_query);
        }

        return $insert_id;
    }
    
    public function save_multiple($table,$data)
    {
        if(empty($table) || empty($data))
        {
            return FALSE;
        }
        foreach ($data as $key => $value) {
            $this->save($table,$value);
        }

    }

    public function update($table,$data,$condtions = array()){
        if(empty($table) || empty($data) || empty($condtions))
        {
            return FALSE;
        }

        $fields = array_keys($data);

        if($this->db->field_exists('id', $table))
        {
            $fields[] = 'id';
        }
        $this->db
            ->where($condtions)
            ->select($fields);
        
        $q          = $this->db->get($table);
        $old_data   = $q->result_array();
        
        $this->db->reset_query();
        $this->db->where($condtions);
        if($this->db->update($table,$data)){
            $last_query = $this->db->last_query();
            $this->save_update_log($table,$data,$old_data,$last_query);
            return TRUE;
        }
        return FALSE;
    }

    public function update_single($table,$data,$condtions = array()){
        if(empty($table) || empty($data) || empty($condtions))
        {
            return FALSE;
        }

        $fields = array_keys($data);

        if($this->db->field_exists('id', $table))
        {
            $fields[] = 'id';
        }
        if($this->db->field_exists('challan_id', $table))
        {
            $fields[] = 'challan_id';
        }
        $this->db
            ->where($condtions)
            ->select($fields)
            ->limit(1);

        $q          = $this->db->get($table);
        $old_data   = $q->result_array();

        $this->db->reset_query();
        $this->db->where($condtions);
        if($this->db->update($table,$data)){
            $last_query = $this->db->last_query();
            $this->save_update_log($table,$data,$old_data,$last_query);
            return TRUE;
        }
        return FALSE;
    }

    public function trans_save($table,$data) {
        $actual = $data;
        unset($data['branch_code']);
        $this->db->trans_start();

        // save in db
        $insert_id = $this->save($table, $data);
        // generate challan number
        $challan_no = generate_challan_no($insert_id, $actual['branch_type'], $actual['tcs'], $actual['branch_code']);
        // update challan with challan number
        $this->update_single('challan', array('challan_no' => $challan_no), array('challan_id' => $insert_id));

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            $actual['challan_no'] = $challan_no;
            return $actual;
        }
    }

    public function delete($table,$data) {
        try {
            if(!$this->db->delete($table, $data)) {
                $error = $this->db->error();
                if ($error['code'] > 0) {
                    throw new Exception($error['message']);
                    return false;
                }
            }
            if($this->db->affected_rows()) {
                $last_query = $this->db->last_query();
                $this->save_query_log($table,$last_query,'delete');
                return true;
            }
            return false;
        } catch (Exception $e) {
            $error = $e->getMessage();
            log_message('trace', 'Exception:: Deletion failed: Input =>  ' . var_export($error, true));
            return false;
        }
    }
    
    public function save_user_session($user_id) {
        
        if (empty($user_id)) {
            return false;
        }
        $user_session_data                  = array();
        $user_session_data['user_id']       = $user_id;
        $user_session_data['ip_address']    = $this->input->ip_address();
        $user_session_data['browser']       = substr($this->input->user_agent(), 0, 120);
        $user_session_data['created_at']    = date('Y-m-d h:i:s');
        
        $this->db->insert('session_log', $user_session_data);
        $this->session->set_userdata('u_session_log_id', $this->db->insert_id());
        return $this->db->insert_id();
    }
    
    
    public function save_insert_log($table,$row,$insert_id,$sql_string)
    {
        $this->save_query_log($table,$sql_string,'create');
        $data = array();
        foreach ($row as $key => $value) {
            if($key == 'created_at' || $key == 'updated_at' || $key == 'created_by' || $key == 'updated_by')
            {
                continue;
            }
            $temp = $this->prepareLogArray($table,$insert_id,$key,null,$value,'create');   
            $data[] = $temp;
        }
        $this->db->insert_batch('session_activity_log',$data);
    }
    
    public function save_update_log($table,$new,$old,$sql_string)
    {
        $this->save_query_log($table,$sql_string,'update');

        $data = array();
        $row_id = null;
        foreach ($old as $index => $myVal) {

            foreach ($myVal as $key => $value) {
                if(isset($myVal['id']))
                {
                    $row_id = $myVal['id'];
                }
                if(isset($myVal['challan_id']))
                {
                    $row_id = $myVal['challan_id'];
                }
                if($key == 'id' || $key == 'challan_id' || $key == 'created_at' || $key == 'updated_at' || $key == 'created_by' || $key == 'updated_by')
                {
                    continue;
                }

                $temp = $this->prepareLogArray($table,$row_id,$key,$value,$new[$key],'update');
                $data[] = $temp;
            }
            
        }
        if(!empty($data))
        {
            $this->db->insert_batch('session_activity_log',$data);
        }
    }
    public function prepareLogArray($table,$row_id,$field,$old_value,$new_value,$type)
    {
        $temp = array();
        $temp['session_id']     = $this->session->userdata('u_session_log_id');
        $temp['table_name']     = $table;
        $temp['user_id']        = $this->session->userdata('session_id');
        $temp['row_id']         = $row_id;
        $temp['field_name']     = $field;
        $temp['old_value']      = $old_value;
        $temp['new_value']      = $new_value;
        $temp['type']           = $type;
        $temp['created_at']     = date('Y-m-d H:i:s');

        return $temp;
    }
    public function save_query_log($table,$sql_string,$query_type)
    {
        $session = $this->session->userdata('user_login_session');
        $sql_log                = array();
        $sql_log['table_name']  = $table;
        $sql_log['sql_query']   = $sql_string;
        $sql_log['query_type']  = $query_type;
        $sql_log['created_at']  = date('Y-m-d H:i:s');
        $sql_log['user_id']     = $this->session->userdata('session_id');
        $this->db->insert('sql_query_log',$sql_log);
    }  
    
    
    function find(
        $table, $select = false, $where = false, $joins = false, $joins_on = false, $join_type = false,
        $group = false, $order = false, $having = false,
        $limit1 = false, $limit2 = false, $where_in = FALSE, $where_in_col = FALSE
    ) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }

        if (is_array($joins) && is_array($joins_on)) {
            $index = 0;
            foreach ($joins as $join) {
                $this->db->join($join, $joins_on[$index]);
                $index++;
            }
        } else {
            if ($joins && $joins_on) {
                $this->db->join($joins, $joins_on, $join_type);
            }
        }

        if ($where) {
            //$where array or string
            // print_r($where); die();
            $this->db->where($where);
        }
        if ($where_in) {
            //$where array or string
            $this->db->where_in($where_in_col, $where_in);
        }
        if ($group) {
            //$group array or string
            $this->db->group_by($group);
        }
        if ($order) {
            //$order string
            $this->db->order_by($order);
        }
        if ($having) {
            //$having string or array
            $this->db->having($having);
        }
        if (!$limit2 && $limit1) {
            $this->db->limit($limit1);
        } else {
            if ($limit1) {
                $this->db->limit($limit1, $limit2);
            }
        }
        $query = $this->db->get($table);
        //echo $this->db->last_query(); die;
		//echo $this->db->last_query();
        //echo mysql_error();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function find_all_data($table, $select = false, $where = false, $joins = false, $joins_on = false, $join_type = false, $group = false, $order = false, $having = false, $limit1 = false, $limit2 = false, $where_in = FALSE, $where_in_col = FALSE) 
    {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }

        if (is_array($joins) && is_array($joins_on)) {
            $index = 0;
            foreach ($joins as $join) {
                $this->db->join($join, $joins_on[$index]);
                $index++;
            }
        } else {
            if ($joins && $joins_on) {
                $this->db->join($joins, $joins_on, $join_type);
            }
        }

        if ($where) {
            //$where array or string
            // print_r($where); die();
            $this->db->where($where);
        }
        if ($where_in) {
            //$where array or string
            $this->db->where_in($where_in_col, $where_in);
        }
        if ($group) {
            //$group array or string
            $this->db->group_by($group);
        }
        if ($order) {
            //$orde r string
            $this->db->order_by($order);
        }
        if ($having) {
            //$having string or array
            $this->db->having($having);
        }
        if (!$limit2 && $limit1) {
            $this->db->limit($limit1);
        } else {
            if ($limit1) {
                $this->db->limit($limit1, $limit2);
            }
        }
        $query = $this->db->get($table);
//        echo $this->db->last_query(); die;

        $result_array = array();
        if ($query->num_rows() > 0) {
            foreach($query->result_array() as $result_obj){
                $result_array[] = $result_obj;
            }
            return json_encode($result_array);
        } else {
            return json_encode($result_array);
        }
//        print_r(json_encode($result_array)); die;
    }


}//class-ends