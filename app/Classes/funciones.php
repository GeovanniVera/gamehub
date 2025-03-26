<?php

use App\Classes\Session;

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function redirect(string $field,array|object  $array,string $path){
    Session::set("$field",$array);
    header("Location: $path");
    exit;
}

function extractMessages($value){
    $messages = "";
    if (Session::has($value)) {
        $messages = Session::get($value);
        Session::delete($value);
    }

    return $messages;
}