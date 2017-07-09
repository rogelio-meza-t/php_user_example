<?php

function writeUser($user = NULL){
    $new_data = implode(',', [
        $user->id,
        $user->username,
        $user->getPassword(),
        implode('|', $user->roles)
    ]);

    file_put_contents('db/users.txt', implode('',
        array_map(function($data) use ($user, $new_data){
            $content = explode(',', $data);
            if($content[0] == $user->id){
                return $new_data.PHP_EOL;
            }
            else{
                return $data;
            }
        }, file('db/users.txt'))
    ));
}
