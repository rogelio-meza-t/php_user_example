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
                if($user->getPassword() == $password){
                    $_SESSION['username'] = $user->username;
                    $_SESSION['user_id'] = $user->id;
                    Flash::set("success", "Logged in successfuly");

                    if( $_SESSION['PAGE_REFERER'] ){
                        $referer = $_SESSION['PAGE_REFERER'];
                        unset($_SESSION['PAGE_REFERER']);
                        header('Location: '. $referer);
                    }
                    else{
                        render('sessions', 'new');
                    }
                }
                else{
                    //TODO: wrong password
                    Flash::set("error", "Wrong username or password");
                    render('sessions', 'new');
                }
            }
            else{
                Flash::set("error", "Wrong username or password");
                render('sessions', 'new');
            }
        }
        else{
            die("no login");
        }
    }

    public function destroy_session($params){
        // destroy session variables and redirect to login page
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);

        header('Location: /sign_in');
    }
}
