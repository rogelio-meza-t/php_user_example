<?php

class PagesController{
    public function show($params){
        //var_dump($params);

        // check if user s logged in
        if( $_SESSION["user_id"] ){
            // check if user has one of the permited roles
            $user_id = $_SESSION["user_id"];
            $user = $_GLOBALS['users'][$user_id];
            $roles = $user->roles;
            $role_page = "PAGE_".params;

            if( in_array($role_page, $roles) ){
                render('Users', 'show', $user);
            }
            else{
                //show error
            }
        }
        else{
            // send to login page
        }

    }
}
