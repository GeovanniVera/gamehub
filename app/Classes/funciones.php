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

function extractMessages(string $value): string{
    $messages = "";
    if (Session::has($value)) {
        $messages = Session::get($value);
        Session::delete($value);
    }
    if (is_array($messages)) {
        return implode("\n", $messages); 
    } elseif (is_string($messages)) {
        return $messages;
    } else {
        return "";
    }
}