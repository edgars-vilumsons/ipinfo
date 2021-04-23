<?php

spl_autoload_register('myAutoLoader');

function myAutoloader($className) {
    $path = "classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;

    include_once $fullPath;
}