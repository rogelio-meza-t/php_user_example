<?php

function currentUser(){
    $user = NULL;
    // TODO: check if logged user is the same with the user_id
    if( isset($_SESSION['user_id']) ){
        $user = $GLOBALS['users'][$_SESSION['user_id']];
    }
    return $user;
}

function apiAuthenticatedUser(){
    if(!isset($_SERVER['PHP_AUTH_USER'])){
        unauthorizedAction();
    }
    else{
        $user = User::findBy("username", $_SERVER['PHP_AUTH_USER']);
        if( $user ){
            if($user->getPassword() == $_SERVER['PHP_AUTH_PW']){
                return $user;
            }
            else{
                unauthorizedAction();
            }
        }
        else{
            unauthorizedAction();
        }
    }
}

function apiIsAdmin(){
    $user = User::findBy("username", $_SERVER['PHP_AUTH_USER']);

    if( $user ){
        return $user->hasRole("ADMIN");
    }
    else{
        unauthorizedAction();
    }
}

function unauthorizedAction(){
    header('WWW-Authenticate: Basic realm ="API"');
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode(["error" => "Unauthorized action"]);
    exit;
}
