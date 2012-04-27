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
 * curl_load class.
 */
class curl_load
{
	// --------------------------------------------------------------------------

	/**
	 * holds the codeigniter superobject.
	 *
	 * @var object
	 */
	private $_ci;

	// --------------------------------------------------------------------------

	/**
	 * Load configured initial resources
	 *
	 * @param array $config The configuration array.
	 */
	public function __construct($config = array())
	{
		$this->_ci =& get_instance();

		// autoload JSON specified in the curl_load config file
		$this->load_config($config['curl_autoload']);
	}

	// --------------------------------------------------------------------------

	/**
	 * Loads a remote JSON config file.
	 *
	 * @param  mixed $url  The config file url. Can be a string or array
	 * of strings.
	 * @param string $username (default: '') http auth username (optional)
	 * @param string $password (default: '') http auth password (optional)
	 * @return bool
	 */
	public function load_config($url, $username = '', $password = '')
	{
		// allow for $url arrays
		if (!is_array($url))
		{
			$url = array(
				array(
					'url' => $url,
					'username' => $username,
					'password' => $password
				)
			);
		}

		// get remote config, set it
		foreach($url as $item)
		{
			// get username and password if they are set
			$username = (isset($item['username']) ? $item['username'] : '');
			$password = (isset($item['password']) ? $item['password'] : '');

			// get content via CURL
			$json = $this->_curl_get_contents($item['url'], $username, $password);
			$remote_config = json_decode($json);
			foreach($remote_config as $key => $value)
			{
				$this->_ci->config->set_item($key, $value);
			}
		}
	}

	// --------------------------------------------------------------------------

	/**
	 * Grabs the contents of a URL via CURL and returns it.
	 *
	 * @param string $url The remote url.
	 * @param string $username (default: '') http auth username (optional)
	 * @param string $password (default: '') http auth password (optional)
	 * @return string
	 */
	private function _curl_get_contents($url, $username = '', $password = '')
	{
		// load curl spark
		$this->_ci->load->spark('curl/1.2.1');
		$this->_ci->load->library('curl');

		// curl request
		$this->_ci->curl->create($url);
		if ($username != '' && $password != '')
		{
			$this->_ci->curl->http_login('username', 'password');
		}
		return $this->_ci->curl->execute();
	}

	// --------------------------------------------------------------------------
}

/* End of file curl_load.php */
/* Location: /Library/WebServer/Documents/curl_load/libraries/curl_load.php */
