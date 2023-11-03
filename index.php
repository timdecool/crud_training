<?php
    // --- config file
    require "./config.php";
    // --- router file
    require "./service/router.php";
    // --- controller
    require "./controllers/controller_{$page}.php";