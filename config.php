<?php 
require "./service/database.php";
require "./service/class/Database.php";

define("CONFIG_SITE_TITLE", "Mon modèle MVC PHP");
define("CONFIG_ROUTES",[
    "home" => "home",
    "gallery" => "gallery",
    "messages" => "messages"
]);

$db = new Database;
session_start();