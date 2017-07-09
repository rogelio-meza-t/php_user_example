<?php

class SessionsController{

    function __construct(){

    }

    public function new_session($params){
        render('sessions','new', NULL);
    }

    public function create_session($params){
        // login user
        if( isset($_POST['login']) ){
            $password = $_POST['password'];
            $username = $_POST['username'];

            $user = User::findBy("username", $username);

            if( $user ){
                if($user->password == $password){
                    $_SESSION['username'] = $user->username;
                    $_SESSION['user_id'] = $user->id;
                    Flash::set("success", "Logged in successfuly");

                    if( $_SESSION['PAGE_REFERER'] ){
                        header('Location: '. $_SESSION['PAGE_REFERER']);
                    }
                    else{
                        header('Location: /sign_in');
                    }
                }
                else{
                    //TODO: wrong password
                }
            }
            else{
                // TODO: users doesn't exists in database
            }
        }
    }
}
