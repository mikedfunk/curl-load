Curl Load
============================

A library to load remote JSON into Codeigniter config values via CURL.

I ran into a situation recently where I had multiple CodeIgniter apps which depended on the same config values. No problem, right? Just use a common third_party folder. That would work, except they were on different servers! My solution was to echo the config as JSON in one place, grab the JSON in other apps and load them as config values. Now you can do the same!

Setup
----------------------------

1. Install Sparks at [GetSparks.org](http://getsparks.org)
2. Install [this spark](http://getsparks.org/packages/curl_load/versions/HEAD/show)

Usage
----------------------------

First, do this in your config file:

    <?php // DON'T put the usual !defined(BASEPATH) part up here

    $config['this_key'] = 'value';
    $config['that_key'] = 'value';

    // if it's not loaded by CodeIgniter, echo it as JSON so
    // we can grab the keys/values remotely
    if (!defined(BASEPATH)) echo json_encode($config);

Now in your controller, use the curl_load spark to load the config file:

    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class test_controller extends CI_Controller
    {
        public function index()
        {
            // replace x.x.x with version number
            $this->load->spark('curl_load/x.x.x');

            $this->curl_load->load_config('http://example.com/path/to/config.php');
        }
    }

If you need to secure the values of the config file, you can add optional http authentication credentials:

    $this->curl_load->load_config('http://example.com/path/to/config.php', 'http_auth_username', 'http_auth_password');

Or you could load an array of config files:

    $this->curl_load->load_config(
        array(
            array(
                'url' => 'http://url1.com/config.php'
            ),
            array(
                'url' => 'http://url2.com/config.php',
                'username' => 'optional_http_auth_username',
                'password' => 'optional_http_auth_password'
            )
        )
    );

Last but not least: You can set it to autoload config files in ```config/curl_load.php```. Just add your config files in the same array format as above:

    $config['curl_autoload'] = array(
        array(
            'url' => 'http://url1.com/config.php'
        ),
        array(
            'url' => 'http://url2.com/config.php',
            'username' => 'optional_http_auth_username',
            'password' => 'optional_http_auth_password'
        )
    );

This is really cool, especially when you autoload the spark as well. Then your config values will automatically be loaded without you having to do anything!

    $autoload['sparks'] = array('curl_load/x.x.x');

If this helps you, leave me a comment. Have fun!

----------------------------

Changelog
----------------------------

**1.0.1**

* Made README a lot clearer, fixed sample config bug.

**1.0.0**

* Initial Release
