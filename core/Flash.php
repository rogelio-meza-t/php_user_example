<?php

// show/set flash messages
class Flash{
    public static function set($type, $value){
        $_SESSION['FLASH_'.strtoupper($type)] = $value;
    }

    public static function show($type){
        $message = $_SESSION['FLASH_'.strtoupper($type)];
        unset($_SESSION['FLASH_'.strtoupper($type)]);
        return $message;
    }

    public static function exists($type){
        if(isset($_SESSION['FLASH_'.strtoupper($type)])){
            return true;
        }
        return false;
    }
}
