<?php

class UsersController{

    // show user info
    // returns a json object
    public function show($params){
        if( apiAuthenticatedUser() ){
            $user = User::findBy("id", $params);
            if ( $user ){
                header('Content-Type: application/json');
                echo json_encode($user);
            }
            else{
                $this->apiNotFound();
            }
        }
    }

    // edit an user
    public function update($params){
        if( apiAuthenticatedUser() && apiIsAdmin() ){
            $user = User::findBy("id", $params);
            if( $user ){
                $input_post = file_get_contents('php://input');
                $post_params = json_decode($input_post);
                $attributes = [
                    "username" => $post_params->username,
                    "password" => $post_params->password,
                    "roles" => $post_params->roles
                ];
                $user->updateAttributes($attributes);
            }
            else{
                $this->apiNotFound();
            }
        }
    }

    private function apiNotFound(){
        header('Content-Type: application/json');
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(["error"=>"Resource not found"]);
    }
}
