<?php

//render html function
function render($class, $method){
    include('app/views/'.$class.'/'.$method.'.php');
}
