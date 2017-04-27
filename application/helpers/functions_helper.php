<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Array Helpers
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category    Helpers
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/helpers/array_helper.html
 */
// ------------------------------------------------------------------------

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
if (!function_exists('session_to_page')) {

    function session_to_page($session, &$data) {
        foreach ($session as $key => $value) {
            $data[$key] = $value;
        }
    }

}


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
if (!function_exists('has_logged_in')) {

    function has_logged_in() {
        $ci = &get_instance();
        if ($ci->session->userdata('user_login_session')!=null) {
            return true;
        } else {
            return false;
        }

    }

}

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
if (!function_exists('has_web_logged_in')) {

    function has_web_logged_in() {
        $ci = &get_instance();
        if ($ci->session->userdata('webuser_login_session')!=null) {
            return true;
        } else {
            return false;
        }

    }

}

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
if (!function_exists('get_logged_session')) {

    function get_logged_session() {
        $ci = &get_instance();
        if ($ci->session->userdata('user_login_session')) {
            return $ci->session->userdata('user_login_session');
        }
        return false;
    }
}


function get_web_logged_session() {
    $ci = &get_instance();
    if ($ci->session->userdata('webuser_login_session')) {
        return $ci->session->userdata('webuser_login_session');
    }
    return false;
}

function get_user_id()
{
    $result = get_logged_session();

    if ($result) {
        return $result['login_user_id'];
    }
    return false;
}

function get_group_id()
{
    $result = get_logged_session();

    if ($result) {
        return $result['group_id_fk'];
    }
    return false;
}

function get_session_id()
{
    $ci = &get_instance();
    if ($ci->session->userdata('session_id')) {
        return $ci->session->userdata('session_id');
    }
    return false;
}

function get_district_id()
{
    $session_data = get_logged_session();
    if ($session_data) {
        return $session_data['login_district_id'];
    }
    return false;
}

function get_loggedin_person_name()
{
    $session_data = get_logged_session();
    if ($session_data) {
        return @$session_data['login_name'];
    }
    return false;
}

function get_web_loggedin_person_name()
{
    $session_data = get_web_logged_session();
    if ($session_data) {
        return $session_data['first_name'].' '.$session_data['last_name'];
    }
    return '';
}

function get_web_loggedin_person_image()
{
    $session_data = get_web_logged_session();
    if ($session_data) {
        return base_url()."assets/uploads/images/".$session_data['profile_image_name'].'.'.$session_data['profile_image_ext'];
    }
    return base_url()."assets/frontend/images/profile.jpg";
}

function getProfileImage($rowUser){
	$img = base_url()."assets/frontend/images/profile.jpg";
	if($rowUser['profile_image_name']!=""){
		$img = base_url()."assets/uploads/images/".$rowUser['profile_image_name'].'.'.$rowUser['profile_image_ext'];
	}
	return $img;
}

function get_web_loggedin_person_score()
{
    $session_data = get_web_logged_session();
    if ($session_data) {
        return $session_data['score'];
    }
    return 0;
}

function is_admin_login()
{
    $session_data = get_logged_session();
    if ($session_data) {
        return ($session_data['login_type'] == 'admin')?true:false;
    }
    return false;
}

function is_district_login()
{
    $session_data = get_logged_session();
    if ($session_data) {
        return ($session_data['login_type'] == 'district')?true:false;
    }
    return false;
}


// --------------------------------------------------------------------

/**
 * Elements
 *
 * Returns only the array items specified.  Will return a default value if
 * it is not set.
 *
 * @access    public
 * @param    array
 * @param    array
 * @param    mixed
 * @return    mixed    depends on what the array contains
 */
if (!function_exists('elements')) {

    function elements($items, $array, $default = FALSE) {
        $return = array();

        if (!is_array($items)) {
            $items = array($items);
        }

        foreach ($items as $item) {
            if (isset($array[$item])) {
                $return[$item] = $array[$item];
            } else {
                $return[$item] = $default;
            }
        }

        return $return;
    }

}


//This function for checking the table exestance into selected Database
function is_table_exist($table_name) {
    $ci = &get_instance();
    $query = "SHOW tables LIKE '$table_name'";
    $rec = $ci->db->query($query);
    $tab_array = $rec->result_array();
    if (count($tab_array) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//This function for adding new role in role list
function add_new_role($module, $role, $description) {
    $ci = &get_instance();
    $query = "select * from role where role_module='$module' and role_name='$role'";
    $rec = $ci->db->query($query);
    $tab_array = $rec->result_array();
    if (count($tab_array) > 0) {
        return false;
    } else {
        $new_roll = array('role_module' => $module, 'role_name' => $role, 'role_description' => $description);
        $rec = $ci->db->insert('role', $new_roll);
        return true;
    }


}

//This function for assigning the role from group role
function add_user_role($user_id, $group_id) {
    $ci = &get_instance();
    $query = "select * from group_role where group_id_fk='$group_id'";
    $rec = $ci->db->query($query);
    $group_role_array = $rec->result_array();
    if (count($group_role_array) > 0) {
        foreach($group_role_array as $role)
        {
            $new_roll = array('user_id_fk'=>$user_id,'user_role_module' => $role['group_role_module'], 'user_role_name' => $role['group_role_name']);
            $rec = $ci->db->insert('user_role', $new_roll);
        }
    }
}
//This function for checking the table exestance into selected Database
function remove_user_role($user_id) {
    $ci = &get_instance();
    $ci->db->delete('user_role', array('user_id_fk' => $user_id));

}

if (!function_exists('debug')) {

    function debug($data, $die = 0) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if ($die == 1) {
            die;
        }
    }
}

// api key to use in rest api
function generate_api_key() {
    $key = md5(microtime() . rand());
    return $key;
}

/**
 * generation of challan no
 *
 * @access    public
 * @param    int challan_id
 * @param    int passport_type
 * @param    int TCS (0 for no, 1 for tcs within district, 2 for tcs outside distrit)
 * @param    int branch_code
 * @return    int
 */
if (!function_exists('generate_challan_no')) {

    function generate_challan_no($challan_id = '1' , $branch_type = '11' , $tcs = '0' , $branch_code = '0200') {

        $challan_id = str_pad($challan_id ,10,'0',STR_PAD_LEFT);
        return $branch_type . $tcs . $branch_code . $challan_id;
    }
}

function generate_reg_no($farmer_id = '1' , $district_id = '11' , $tehsil_id = '0') {

    $farmer_id = str_pad($farmer_id ,7,'0',STR_PAD_LEFT);
    $district_id = str_pad($district_id ,2,'0',STR_PAD_LEFT);
    $tehsil_id = str_pad($tehsil_id ,3,'0',STR_PAD_LEFT);
    return '1'.$district_id . $tehsil_id . $farmer_id;
}

if (!function_exists('no_to_words_in_PKR')) {
    function no_to_words_in_PKR($number1)
    {   
    
   if($number1<1 || empty($number1)){
        return '';
    }
   
   $no = floor($number1);
   $point = ($number1 - $no) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
           while ($i < $digits_1) {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2;
             if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
             } else $str[] = null;
          }

          $str = array_reverse($str);
          $result = implode('', $str);
          
//        $points = ($point) ? $words[$point] : '';

          $points = ($point) ?
            "." . $words[($point - ($point % 10))] . " " . 
                  $words[$point = $point % 10] : '';

          if($points){        
            return ucwords($result) . " rupees  and " . $points . " paise only";
          }else{
            return ucwords($result) . " rupees only";
          }
    }
}

function convert_number_to_words_ENG($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words_ENG(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words_ENG($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words_ENG($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words_ENG($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return ucwords($string);
}




function get_pagination_config()
{
    $config["per_page"] = 10;
    $config['use_page_numbers'] = TRUE;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a name="active">';
    $config['cur_tag_close'] = '</a></li>';
    $config['prev_tag_open'] = $config['next_tag_open'] = '<li>';
    $config['prev_tag_close'] = $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = $config['first_tag_open'] = '<li>';
    $config['last_tag_close'] = $config['first_tag_close'] = '</li>';
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['next_link'] = 'Next';
    $config['prev_link'] = 'Previous';
    return $config;
}


function get_branch_name($branch_id) {
    $ci = &get_instance();
    
    $query = "SELECT branch_id,branch_code,branch_name FROM branches WHERE branch_id='".$branch_id."' LIMIT 1";
    $rec = $ci->db->query($query);
    $res = $rec->row_array();
    if (count($res) > 0) {
        return $res['branch_code'].'-'.$res['branch_name'];
    } else {
        return 'unknown';
    }
}




function generate_excel_report($filename, $header_array, $column_names, $data) 
{
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
 
    for ($i = 0; $i < count($header_array); $i++) {
        echo $header_array[$i] . "\t";
    }
    echo "\n";
    $j = 0;
    foreach ($data as $row) {
        $k = 0;
        for ($i = 0; $i < count($header_array); $i++) {            
                /*if ($i == 0) {
                    echo '"' . ++$j . '"' . "\t";
                } else {*/
                    //echo chr(255) . chr(254) . mb_convert_encoding($row[$column_names[$i]], 'UTF-16LE', 'UTF-8');
                    echo '="' . $row[$column_names[$k]] . '"' . "\t";
                    //echo '"' . $row[$column_names[$k]] . '"' . "\t";
                    $k++;
                //}            
        }
        echo "\n";
    }
}

function generate_pdf_report($HTML,$FILE_NAME_1)
{
    $ci =& get_instance();
    $ci->load->helper('download');      
    set_time_limit(0);
    require_once(APPPATH.'controllers/prince_pdf_lib.php');

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $pth = APPPATH.'third_party/Prince/Engine/bin/prince.exe';
    } else {
        $pth = '/usr/bin/prince';
    }
    
    $pdf = new Prince($pth);
    
    if($_SERVER['HTTP_HOST'] == "dev.bapps.pitb.gov.pk"){
        $pdf->setLog($_SERVER['DOCUMENT_ROOT'].'/passport/assets/uploads/prince.log');
    }else{
        $pdf->setLog('./assets/uploads/prince.log');
    }
    
    $header = '<html>
                    <head>
                    <title>NBP</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">                     
                    
                    <style>@import url("'.base_url().'assets/css/theme-core.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-essentials.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-material.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-layout.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-navbar.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-colors-background.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-colors-buttons.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-colors-text.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/module-carousel-slick.min.css");</style>
                    <style>@import url("'.base_url().'assets/css/common.css");</style>              
                    <style>@import url("'.base_url().'assets/css/pdf_style.css");</style>
                                        
                    </head>
                    <body>';

            $content = '';              
            $content .= $HTML;              
            $footer = '</body>
                    </html>';


    $content = $header . $content . $footer;    

    //$content = str_replace('?', '', utf8_decode($content));
            
    $file_name        = $FILE_NAME_1;
    $pdf->setHTML(true);    
    if($_SERVER['HTTP_HOST'] == "dev.bapps.pitb.gov.pk"){
        $pdfPath        = $_SERVER['DOCUMENT_ROOT'].'/passport/assets/uploads/'.$file_name;
    }else{
        $pdfPath        = './assets/uploads/'.$file_name;
    }
            
    $res = $pdf->convert_string_to_file($content, $pdfPath);

    //Force download
    $file_url = $pdfPath;   
    header('Content-Type: text/html; charset=utf-8');
    header('Content-Type: application/force-download');
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
    force_download($pdfPath, NULL);
}

function create_dynamic_months() {

    $start_date = '2016-01-01';
    $start = date('01-m-Y', strtotime($start_date));
    $current_month_year = '1-' . date('m-Y');
    $end = date('01-m-Y', strtotime('-0 month', strtotime($current_month_year)));

    $month_array = array();
    $i = 0;
    $next_month = $start;

    while ($next_month != $end) {
        $month_array[$i]['month_value'] = date('m,Y', strtotime($next_month)); # value of month 
        $month_array[$i]['month_name'] = date('M. Y', strtotime($next_month)); # Name of the Month */
        $next_month = date('01-m-Y', strtotime('+1 month', strtotime($next_month)));
        $i++;
    }
    $month_array[$i]['month_value'] = date('m,Y', strtotime($next_month)); # value of month 
    $month_array[$i]['month_name'] = date('M. Y', strtotime($next_month)); # Name of the Month */
    return $month_array;
}


function create_drop_down($month_array, $month_year1, $month_year2 = false) {
    $data = array();
    $tr = '';
    $selected1 = '';
    $selected2 = '';
    $tr.='<select id="month1" name="month1" class="customSelectMenu text_box" >';
    foreach ($month_array as $info) {
        if ($info['month_value'] == $month_year1) {
            $selected1 = 'selected="selected"';
        }
        $tr.='   <option ' . $selected1 . ' value="' . $info['month_value'] . '">' . $info['month_name'] . '</option>';
        $selected1 = '';
    }
    $tr.=' </select>';
    $month_one = $tr;
    $data['month_one_drop_down'] = $month_one;

    /* Month Two Drop Down */
    if ($month_year2) {
        $tr = '';
        $tr.='<select id="month2" name="month2" class="customSelectMenu text_box"  >';
        foreach ($month_array as $info) {
            if ($info['month_value'] == $month_year2) {
                $selected2 = 'selected="selected"';
            }
            $tr.='   <option ' . $selected2 . ' value="' . $info['month_value'] . '">' . $info['month_name'] . '</option>';
            $selected2 = '';
        }
        $tr.=' </select>';
        $month_two = $tr;
        $data['month_two_drop_down'] = $month_two;
    }
    return $data;
}

function generate_download_pdf($HTML,$FILE_NAME_1)
{
    $ci =& get_instance();
    $ci->load->helper('download');      
    set_time_limit(0);
    require_once(APPPATH.'controllers/prince_pdf_lib.php');

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $pth = APPPATH.'third_party/Prince/Engine/bin/prince.exe';
    } else {
        $pth = '/usr/bin/prince';
    }
    
    $pdf = new Prince($pth);
    
    if($_SERVER['HTTP_HOST'] == "dev.bapps.pitb.gov.pk"){
        $pdf->setLog($_SERVER['DOCUMENT_ROOT'].'/passport/assets/uploads/prince.log');
    }else{
        $pdf->setLog('./assets/uploads/prince.log');
    }
    
    $header = '<html>
                    <head>
                    <title>NBP</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">                     
                    <style>@import url("'.base_url().'assets/css/pdf_style.css");</style>   
                    <style>@import url("'.base_url().'assets/css/theme-core.min.css");</style>                      
                    </head>
                    <body>';

            $content = '';              
            $content .= $HTML;              
            $footer = '</body>
                    </html>';


    $content = $header . $content . $footer;    

    //$content = str_replace('?', '', utf8_decode($content));
            
    $file_name        = $FILE_NAME_1;
    $pdf->setHTML(true);    
    if($_SERVER['HTTP_HOST'] == "dev.bapps.pitb.gov.pk"){
        $pdfPath        = $_SERVER['DOCUMENT_ROOT'].'/passport/assets/uploads/'.$file_name;
    }else{
        $pdfPath        = './assets/uploads/'.$file_name;
    }
            
    $res = $pdf->convert_string_to_file($content, $pdfPath);

    //Force download
    //$file_url = $pdfPath; 
    //header('Content-Type: text/html; charset=utf-8');
    //header('Content-Type: application/force-download');
    //header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
    //force_download($pdfPath, NULL);
}

function amount_format($amount) {
    setlocale(LC_MONETARY, 'ur_PK');
    $amount = money_format('%!i', $amount);
    return $amount;
}

function my_number_format($number){
    if(is_numeric($number))
    {       
        // Make sure its numeric and has no decimal point
        if ( strpos( $number, '.' ) === false ){
            return number_format($number, 0, '.', ',');
        }else{
            return number_format($number, 2, '.', ',');
        }   
    }else{
        return $number;
    }
}

// Multidimensional Array Searching (Find key by specific value)
function multi_array_search($arrays, $field, $value) {
   foreach($arrays as $key => $arr)
   {
      if ( $arr[$field] === $value )
         return $key;
   }
   return false;
}

/*
 * do uploding of original file
 * return destination file name
 */

function upload_original($param = array()) {
    $ci = & get_instance();
    $ci->load->library('my_upload');
    if ($param["file"]["name"] != "") {
        $ci->my_upload->upload($param["file"]);
        if ($ci->my_upload->uploaded == true) {
            $ci->my_upload->file_new_name_body = $param['new_name'];
            $ci->my_upload->process($param['dst_path']);
            return array('file_name' => $ci->my_upload->file_dst_name, 'file_ext' => $ci->my_upload->file_dst_name_ext);
        }else{
        	return false;
        }
        
    }
    return false;
}

/*
 * do resizing of source file
 * upload to server
 */

function upload_resized_images($param = array()) {
    $ci = & get_instance();
    $ci->load->library('my_upload');
    $ci->my_upload->upload($param['src_path']);
    if ($ci->my_upload->uploaded == true) {
        $ci->my_upload->image_resize = true;
        if(isset($param['image_ratio'])){
            $ci->my_upload->image_ratio = $param['image_ratio'];
        }
        if(isset($param['image_ratio_fill'])){
            $ci->my_upload->image_ratio_fill = $param['image_ratio_fill'];
        }
        if(isset($param['image_ratio_crop'])){
            $ci->my_upload->image_ratio_crop = $param['image_ratio_crop'];
        }
        $ci->my_upload->image_x = $param['image_x'];
        $ci->my_upload->image_y = $param['image_y'];
        $ci->my_upload->file_new_name_body = $param['new_name'];
        $ci->my_upload->process($param['dst_path']);
    }
    return false;
}
