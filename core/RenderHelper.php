<?php

//render html function
function render($class, $method, $object){
    include('app/views/'.$class.'/'.$method.'.php');
}
