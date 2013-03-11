<?php

class App{

    public $settings;
    public $properties;

	function __construct(){
		$strings = new Strings("en_us");
        $settings = array();
        $properties = array();
	}

    public function save_settings($new_settings){
        
        if(array_key_exists('default_timezone', $new_settings)){
            date_default_timezone_set($new_settings['default_timezone']);
        }else{
            date_default_timezone_set('America/New_York');    
        }

        if(array_key_exists('uses_db', $new_settings)){

            $env_config = ($new_settings['env'] == Env::Development) ? $new_settings['development'] : $new_settings['production'];

            if($new_settings['uses_db']){
                ORM::configure('mysql:host=' . $env_config['db_host'] . ';dbname=' . $env_config['db_name']);
                ORM::configure('username', $env_config['db_username']);
                ORM::configure('password', $env_config['db_password']);
            }
        }

        ini_set('display_errors', 'Off');
        set_error_handler("script_error");
        register_shutdown_function('shutdown_error'); 

        if(array_key_exists('env', $new_settings)){
            if($new_settings['env'] == Env::Development){
                define("ARGOS_ENV", "development");
                ini_set('log_errors', 'Off');
                error_reporting(E_ALL ^ E_STRICT);

            }else{
                define("ARGOS_ENV", "other");
                ini_set('log_errors', 'On');
                error_reporting(0);
            }
        }

        if(array_key_exists('default_layout', $new_settings))
            define("ARGOS_DEFAULT_LAYOUT", $new_settings['default_layout']);

        $this->settings = $new_settings;
    }

    public function setting($setting_name){
        $settings = $this->settings;
        return $settings[$setting_name];
    }

    public function property($property_name){
        $properties = $this->properties;
        return $properties[$property_name];
    }

}

?>