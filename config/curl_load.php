<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * curl_load
 *
 * Loads CodeIgniter config files from remote JSON sources.
 *
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @author		Mike Funk
 * @link		http://mikefunk.com
 * @email		mike@mikefunk.com
 *
 * @file		curl_load.php
 * @version		1.0.0
 * @date		04/25/2012
 */

// --------------------------------------------------------------------------

/**
 * loads an array of URLs which each evaluate to JSON.
 */
$config['curl_autoload'] = array(

	// sample array:
	//
	// array('url' => 'http://test.com/path/to/config.php'),
	// array(
	// 	'url' => 'http://test2.com/path/to/config.php',
	// 	'username' => 'test_user',
	// 	'password' => 'test_pass'
	// );
);

// --------------------------------------------------------------------------

/* End of file curl_load.php */
/* Location: /Library/WebServer/Documents/curl_load/config/curl_load.php */
