<?php

class UsersController{

    public function show($params){
        if( apiAuthenticatedUser() ){
            $user = User::findBy("id", $params);
            if ( $user ){
                header('Content-Type: application/json');
                echo json_encode($user);
            }
            else{
                header('Content-Type: application/json');
                echo json_encode(NULL);
            }
        }
    }
}
