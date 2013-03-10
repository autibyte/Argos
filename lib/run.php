<?php

    include_once ARGOS_BASE . 'lib/includes.php';

    // start the session
    Session::start();

    // create the application
    $app = new App();

    // configure the application
    include_once BASE . 'config/settings.php';

    // route incoming URLs
    include_once BASE . 'config/router.php';

    // up and away!

?>