<?php

    // Establish base directories
    
    $this_directory = dirname(__FILE__) . '/';

    $argos_dotfile = $this_directory . '../.argos';

    if(file_exists($argos_dotfile)){
        define("ARGOS_APP_NAME", file_get_contents($argos_dotfile));
    }

    define("BASE", $this_directory . '../' . ARGOS_APP_NAME . '/');
    define("ARGOS_BASE", $this_directory);

    // Run

    include_once ARGOS_BASE . 'lib/run.php';

?>