Curl Load
============================

A library to load remote JSON into Codeigniter config values via CURL.

I ran into a situation recently where I had multiple CodeIgniter apps which depended on the same config values. No problem, right? Just use a common third_party folder. That would work, except they were on different servers! My solution was to echo the config as JSON in one place, grab the JSON in other apps and load them as config values. Now you can do the same!

Setup
----------------------------

1. Install Sparks at [GetSparks.org](http://getsparks.org)
2. Edit **config/curl_load.php** with the addresses of JSON config files you want to load
3. I recommend just storing your remote config files as normal CodeIgniter config files, but use this code:


    <?php // DON'T put the usual !defined(BASEPATH) part up here

    // usual config file stuff with this at the end:

    if (!defined(BASEPATH)) echo json_encode($config);


4. If you have sensitive config files you can protect them via http authentication and pass the username/password in with this library when fetching. An example of this is below.

Usage
----------------------------

Load Spark (or autoload it)

    $this->load->spark('curl_load/x.x.x');

It will autoload the resources you specify in ***config/curl_load.php***. You can also load resources manually like this:

    $this->curl_load->load_config('http://examplesite/path/to/config.php', 'optional_http_auth_username', 'optional_http_auth_password');

You can also load an array:

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

----------------------------

Changelog
----------------------------

**1.0.0**

* Initial Release
