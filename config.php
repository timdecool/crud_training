<?php 
define("CONFIG_SITE_TITLE", "Mon modèle MVC PHP");
define("CONFIG_ROUTES",[
    "home" => "home",
    "gallery" => "gallery",
]);
const DB_NAME = "dwwm_231020";
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";

function connectDB(): PDO{
    $db = new PDO('mysql:host='.DB_HOST.';port=3306;dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
    return $db;
}

session_start();