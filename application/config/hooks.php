<?php

//
// COPY THE FOLLOWING CODE (lines 7-16) INTO YOUR config/hook.php FILE
//

/* ----------------------------------------------------------------- */
/*
|
| Added as part of the usertracking library by Casey McLaughlin.  Please ensure
| that you have the Usertracking.php file installed in your application/library folder!
*/
$hook['post_system'][] = array('class' 		=> 'Usertracking', 
							   'function' 	=> 'auto_track',
							   'filename' 	=> 'Usertracking.php',
							   'filepath' 	=> 'libraries');


/*$hook['post_controller_constructor'][] = array(
        'class' 	=> 'QueryLogHook',
        'function' 	=> 'log_quiry_string',
        'filename' 	=> 'QueryLogHook.php',
        'filepath' 	=> 'hooks'
);*/

/*$hook['post_system'][] = array(
        'class' 	=> 'QueryLogHook',
        'function' 	=> 'log_queries',
        'filename' 	=> 'QueryLogHook.php',
        'filepath' 	=> 'hooks'
);*/
/* End of file hooks.php */
/* Location: /system/application/config/hooks.php */