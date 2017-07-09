<?php

function currentUser(){
    $user = NULL;
    // TODO: check if logged user is the same with the user_id
    if( isset($_SESSION['user_id']) ){
        $user = $GLOBALS['users'][$_SESSION['user_id']];
    }
    return $user;
}
