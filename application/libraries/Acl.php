<?php

class Acl {

    var $permissions = array();  //Array : Stores the permissions for the user
    var $super_admin;   
    var $ci;

    function __construct($config = array()) {

        $this->ci = &get_instance();
    }

    function buildACL() {
        if(!has_logged_in())
        {
            return false;
        }
         
        /*add_new_role('user', 'view', 'Have permission to view user');
        add_new_role('user', 'add', 'Have permission to add user');
        add_new_role('user', 'edit', 'Have permission to edit user');
        add_new_role('user', 'delete', 'Have permission to delete user');
        add_new_role('user', 'permission', "Have permission to update user's permission");

        add_new_role('pages', 'view', 'Have permission to view pages');
        add_new_role('pages', 'edit', 'Have permission to edit pages');

        add_new_role('slides', 'view', 'Have permission to view slides');
        add_new_role('slides', 'add', 'Have permission to add slides');
        add_new_role('slides', 'delete', 'Have permission to delete slides');

        add_new_role('news', 'view', 'Have permission to view news');
        add_new_role('news', 'add', 'Have permission to add news');
        add_new_role('news', 'edit', 'Have permission to edit news');
        add_new_role('news', 'delete', 'Have permission to delete news');
        
        add_new_role('team', 'view', 'Have permission to view team');
        add_new_role('team', 'add', 'Have permission to add team');
        add_new_role('team', 'edit', 'Have permission to edit team');
        add_new_role('team', 'delete', 'Have permission to delete team');
        
        add_new_role('partner', 'view', 'Have permission to view partner');
        add_new_role('partner', 'add', 'Have permission to add partner');
        add_new_role('partner', 'edit', 'Have permission to edit partner');
        add_new_role('partner', 'delete', 'Have permission to delete partner');

        add_new_role('feature', 'view', 'Have permission to view feature');
        add_new_role('feature', 'add', 'Have permission to add feature');
        add_new_role('feature', 'edit', 'Have permission to edit feature');
        add_new_role('feature', 'delete', 'Have permission to delete feature');

        add_new_role('project', 'view', 'Have permission to view project');
        add_new_role('project', 'add', 'Have permission to add project');
        add_new_role('project', 'edit', 'Have permission to edit project');
        add_new_role('project', 'delete', 'Have permission to delete project');

        add_new_role('gallery', 'view', 'Have permission to view gallery');
        add_new_role('gallery', 'add', 'Have permission to add gallery');
        add_new_role('gallery', 'edit', 'Have permission to edit gallery');
        add_new_role('gallery', 'delete', 'Have permission to delete gallery');
        
        add_new_role('settings', 'view', 'Have permission to view settings');
        add_new_role('settings', 'edit', 'Have permission to edit settings');*/                
        
        $session_data = get_logged_session();
        $user_id = $session_data['login_user_id'];
        $this->ci->db->select('*');
        $this->ci->db->from('users u');
        $this->ci->db->where('u.id', $user_id);
        $this->ci->db->limit(1);
        $query = $this->ci->db->get();
        $perm = $query->row_array();
        if ($perm['group_id_fk'] == 1) {
            $this->super_admin = true;
        } else {
            $this->super_admin = false;
        }



        $this->ci->db->select('*');
        $this->ci->db->from('user_role');
        $this->ci->db->where('user_id_fk', $user_id);

        $query = $this->ci->db->get();

        $perm = $query->result();
        if ($perm) {
            foreach ($perm as $key => $value) {
                $this->permissions[$value->user_role_module][$value->user_role_name] = 'yes';
            }
        }

    }

    function clear_acl() {
        unset($this->permissions);
        unset($this->super_admin);
        unset($this->ci);
    }

    /**
     * 
     * @return type
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    function has_super_admin() {
        return $this->super_admin;
    }

    /**
     * 
     * @param type $module
     * @param type $role
     * @return boolean
     * @author Zahid Nadeem <zahidiubb@yahoo.com>
     */
    function has_permission($module = 'super', $role = 'adminonly') {
        if ($this->super_admin) {
            return true;
        } else {
            if (isset($this->permissions[$module][$role]))
                return true;
            else
                return false;
        }
    }

}

?>