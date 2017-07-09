<?php

class User{

    public $id;
    public $username;
    public $roles = [];
    public $password;

    function __construct($username, $password, $roles=NULL){
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

    // find a user by attribute
    static public function findBy($attribute, $value){
        $user = NULL;
        foreach($GLOBALS['users'] as $key => $u){
            $attrs = get_object_vars($u);
            if($value == $attrs[$attribute]){
                //set current ID position in "database"
                $u->id = $key;
                $user = $u;
                break;
            }
        }

        return $user;
    }

}
