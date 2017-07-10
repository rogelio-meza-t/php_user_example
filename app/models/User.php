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

    public function hasRole($role = ""){
        return in_array($role, $this->roles);
    }

    public function updateAttributes($attrs = []){
        $this->username = isset($attrs['username'])? $attrs['username'] : $this->username;
        $this->password = isset($attrs['password'])? $attrs['password'] : $this->password;
        if(isset($attrs['roles'])){
            array_push($this->roles, $attrs['roles']);
        }
        writeUser($this);
    }

    public function save(){
        saveUser($this);
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
