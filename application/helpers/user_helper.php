<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Element
 *
 * Lets you determine whether an array index is set and whether it has a value.
 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
 *
 * @access    public
 * @param    string
 * @param    array
 * @param    mixed
 * @return    mixed    depends on what the array contains
 */
if (!function_exists('is_password_expire')) {

    function is_password_expire()
    {
        $ci = &get_instance();
        $user_login_session = $ci->session->userdata('user_login_session');
        if ($user_login_session['password_expire_status'] == 1) {
            return true;
        } else {
            return false;
        }

    }

}

if (!function_exists('redirect_to')) {

    function redirect_to()
    {
        $ci = &get_instance();
        if ($ci->acl->has_permission('challan', 'view')) {
            redirect(base_url() . 'challan');
        } else if ($ci->acl->has_permission('payment', 'view')) {
            redirect(base_url() . 'payment');
        } else if ($ci->acl->has_permission('inquiry', 'view')) {
            redirect(base_url() . 'inquiry');
        } else if ($ci->acl->has_permission('report', 'province_summary_report')) {
            redirect(base_url() . 'report/province_summary_report');
        } else if ($ci->acl->has_permission('report', 'district_summary_report')) {
            redirect(base_url() . 'report/district_summary_report');
        } else if ($ci->acl->has_permission('report', 'branch_summary_report')) {
            redirect(base_url() . 'report/branch_summary_report');
        } else if ($ci->acl->has_permission('report', 'tcs_report')) {
            redirect(base_url() . 'report/tcs_challan_listing');
        }

    }

}