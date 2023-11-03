<?php
    // Le router a pour seule fonction de déterminer quelle page doit être affichée. On utilise une variable stockée dans get pour récupérer le nom de la page à chercher
    // if(isset($_GET['page']) && file_exists("./controllers/controller_".$_GET['page'].".php")) {
    //     $page = CONFIG_ROUTES[$_GET['page']];
    // } else {
    //     $page = "home";
    // }

    if(isset($_GET['page'])) $getPage = strtolower($_GET['page']);
    $page = isset($_GET['page']) && file_exists("./controllers/controller_".$_GET['page'].".php") ? $getPage: array_key_first(CONFIG_ROUTES);