<?php

class User{

    public $username;
    public $roles = [];
    public $password;

    function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

}
