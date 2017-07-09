<?php

class User{

    public $id;
    public $username;
    public $roles = [];
    private $password;

    function __construct($id, $username, $password, $roles=NULL){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

    public function getPassword(){
        return $this->password;
    }

    // find a user by attribute
    static public function findBy($attribute, $value){
        $user = NULL;
        foreach($GLOBALS['users'] as $key => $u){
            $attrs = get_object_vars($u);
            if($value == $attrs[$attribute]){
                //set current ID position in "database"
                $user = $u;
                break;
            }
        }

        return $user;
    }

}
