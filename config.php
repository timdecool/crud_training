<?php 
require "./service/database.php";

define("CONFIG_SITE_TITLE", "Mon modèle MVC PHP");
define("CONFIG_ROUTES",[
    "home" => "home",
    "gallery" => "gallery",
]);

session_start();