<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Log extends CI_Log {

    /**
     * Write Log into File and DB
     *
     * Generally this function will be called using the global log_message() function
     *
     * @access    public
     * @param    string    the error level
     * @param    string    the error message
     * @param    bool    whether the error is a native PHP error
     * @return    bool
     */

    /**
     * Level of logging
     *
     * @var int
     */
    protected $_threshold = 1;

    /**
     * Array of threshold levels to log
     *
     * @var array
     */
    protected $_threshold_array = array();

    /**
     * Predefined logging levels
     *
     * @var array
     */
    protected $_levels = array('ERROR' => 1, 'DEBUG' => 2, 'TRACE' => 3, 'INFO' => 4, 'ALL' => 5);

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * @return	void
     */

    public function __construct() {
        parent::__construct();

        // Pull config information for database
        //if(!defined('ENVIRONMENT')) {
        // something bad has happened; make a guess...
        // define('ENVIRONMENT','staging');
        //define('BASEPATH','.');
        //}
        // Is the config file in the environment folder?
        if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/database.php'))
        {
            $file_path = APPPATH.'config/database.php';
        }
        include($file_path);

        $this->db = $db;
        $config =& get_config();
        if (is_numeric($config['log_threshold']))
        {
            $this->_threshold = (int) $config['log_threshold'];
        }
        elseif (is_array($config['log_threshold']))
        {
            $this->_threshold = 0;
            $this->_threshold_array = array_flip($config['log_threshold']);
        }
    }


    public function write_log($level = 'error', $msg, $php_error = FALSE)
    {
        if(config_item('log_to_file') && !config_item('log_to_db'))
            parent::write_log($level, $msg, $php_error);
        elseif(!config_item('log_to_file') && config_item('log_to_db'))
            $this->write_log_into_db($level,$msg, $php_error);
        else{
            parent::write_log($level, $msg, $php_error);
            $this->write_log_into_db($level,$msg, $php_error);
        }


    }

    public function write_log_into_db($level = 'error', $msg, $php_error = FALSE){
        $log_source = ($php_error == FALSE)?'CI':'PHP';

        $level = strtoupper($level);
        if($level != 'TRACE') {
            return FALSE;
        }

        if (( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
            && ! isset($this->_threshold_array[$this->_levels[$level]]))
        {
            return FALSE;
        }

        // connect to server
        $con = mysqli_connect($this->db['default']['hostname'],
            $this->db['default']['username'],
            $this->db['default']['password']);
        if (!$con)
        {
            //die('Could not connect: ' . mysql_error());
            $parent::write_log('error','DB Error Logging: Could not connect: ' . mysqli_error(),$php_error);
        }
        else{
            // select databse
            mysqli_select_db($con, $this->db['default']['database']);
            // insert log
            $msg = mysqli_real_escape_string($con, $msg);
            $err_num = 0;
            $query = "INSERT INTO application_logs (err_num,log_num,log_source,log_msg,log_time,log_host_ip) 
                      VALUES ('".$err_num."','".$this->_levels[$level]."','".$log_source."','".$msg."',NOW(),'".$_SERVER['SERVER_ADDR']."')";
            mysqli_query($con, $query);
            mysqli_close($con);
        }
    }
}
