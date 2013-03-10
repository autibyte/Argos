<?php
    define("PRODUCTION_LOG_PATH", BASE . 'logs/production.log');
    define("DEVELOPMENT_LOG_PATH", BASE . 'logs/development.log');
    define("BASE_URL", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>