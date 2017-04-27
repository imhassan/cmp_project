<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['facebook']['api_id'] = '871200819649486';
$config['facebook']['app_secret'] = 'dce75ba2bc9f848dfd02631f799418d8';
$config['facebook']['redirect_url'] = 'http://localhost/sports/user/fb_callback';
$config['facebook']['permissions'] = array(
    'email',
);