<?php
    session_start();
    $page = null;

    if(isset($_GET['page'])) :
        $page = $_GET['page'];
    endif;

    require "php/connection.php";
    include "views/head.php";
    include "views/header.php";
    include  "views/leftContent.php";


    switch($page):

        case "pocetna":
            include "views/contentIndex.php";
            break;
        case "korpa":
            include "php/korpa.php";
            break;
        case "404":
            include "views/content404.php";
            break;
        case "softver":
            include"php/softver.php";
            break;

         case "hardver":
            include "php/hardver.php";
            break;

        case "aplikativni":
            include "php/proizvodi.php";
            break;

        case "drajveri":
            include "php/proizvodi.php";
            break;

        case "optimizacija":
            include "php/proizvodi.php";
            break;

        case "procesori":
            include "php/proizvodi.php";
            break;

        case "ram":
            include "php/proizvodi.php";
            break;

        case "hard diskovi":
            include "php/proizvodi.php";
            break;

        case "kontakt":
            include "views/kontakt.php";
            break;

        case "autor":
            include "views/autor.php";
            break;

    endswitch;

    include "views/rightContent.php";
    include "views/footer.php";

?>


