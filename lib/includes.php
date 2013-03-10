<?php

    /**
     * Include Argos files
     */
    
        include_once ARGOS_BASE . "lib/static.php";
    
    	// Packages
	    foreach(glob(ARGOS_BASE . "packages/*.php") as $package){
            include_once $package;
        }

        // Functions
        foreach(glob(ARGOS_BASE . "functions/*.func.php") as $function){
            include_once $function;
        }

		// Core classes
		foreach(glob(ARGOS_BASE . "core/*.class.php") as $class){
            include_once $class;
        }
    
    /**
     * Include files for this app
     */
	
		// Functions
		foreach(glob(BASE . "lib/functions/*.func.php") as $function){
            include_once $function;
        }
			
		// Models
		foreach(glob(BASE . "app/models/*.class.php") as $model){
			include_once $model;
        }

		// Helpers
		foreach(glob(BASE . "lib/helpers/*.php") as $helper){
            include_once $helper;
        }
        
?>