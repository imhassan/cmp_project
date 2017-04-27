<?php

// Autoload the required files
require_once( APPPATH . 'libraries/facebook/vendor/autoload.php' );

class Facebook {

    var $ci;
    var $session = false;
    var $fb;

    public function __construct() {
        // Get CI object.
        $this->ci = & get_instance();

        // Initialize the SDK
        $this->fb = new Facebook\Facebook(array(
            'app_id' => $this->ci->config->item('api_id', 'facebook'),
            'app_secret' => $this->ci->config->item('app_secret', 'facebook'),
            'default_graph_version' => 'v2.4',
        ));
    }

    /**
     * FETCH TOKEN functionality.
     */
    public function save_token() {

        $helper = $this->fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // There was an error communicating with Graph
            echo $e->getMessage();
            exit;
        }

        if (isset($accessToken)) {
            // User authenticated your app!
            // Save the access token to a session and redirect
            return (string) $accessToken;
            
        } elseif ($helper->getError()) {
            // The user denied the request
            // You could log this data . . .
            // var_dump($helper->getError());
            // var_dump($helper->getErrorCode());
            // var_dump($helper->getErrorReason());
            // var_dump($helper->getErrorDescription());
            $reason = array($helper->getError(), $helper->getErrorCode(), $helper->getErrorReason(), $helper->getErrorDescription());
            log_message('debug', 'FB:: Fetch Web Facebook accessToken failed! Reason => ' . var_export($reason, true));
            // You could display a message to the user
            // being all like, "What? You don't like me?"
            return false;
        }
    }

    /**
     * Returns the login URL.
     */
    public function login_url() {

        $helper = $this->fb->getRedirectLoginHelper();

        $permissions = $this->ci->config->item('permissions', 'facebook'); // optional
        $callback = $this->ci->config->item('redirect_url', 'facebook');
        $loginUrl = $helper->getLoginUrl($callback, $permissions);


        return $loginUrl;
    }

    /**
     * Returns the current user's info as an array.
     */
    public function get_user($accessToken = false) {
        if ($accessToken) {
            $response = $this->fb->get('/me?fields=id,name,first_name,gender,email,last_name', $accessToken);
            
            $user_details = $response->getDecodedBody();
            $user_details['profile_pic'] = $this->get_profile_pic($user_details['id'], $accessToken);
            
            return $user_details;
        }
        return false;
    }

    /**
     * Get user's profile picture.
     */
    public function get_profile_pic($user_id, $accessToken = false) {
        if ($accessToken) {
            $response = $this->fb->get($user_id.'/picture?width=400&height=400&type=large&redirect=false', $accessToken);
            $picArray = $response->getDecodedBody();
            //print_r($picArray);
            if (!empty($picArray) && !$picArray['data']['is_silhouette']) {
                return $picArray['data']['url'];
            }
        }
        return false;
    }

}