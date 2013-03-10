<?php

class Session{

    public static function start(){
        session_start();
    }

    public static function set($key, $value){
        $_SESSION[$key] = clean_string($value);
    }

    public static function get($key){
        return $_SESSION[$key];
    }

    public static function stop(){
        session_unset();
        session_destroy();
    }

}