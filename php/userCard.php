<?php
session_start();
include "connection.php";

$code = 404;

if(isset($_POST["btn"])):
    $idP = $_POST["id"];
    $user = $_SESSION['user']->ID_korisnik;
    $upit = "INSERT INTO korpa (ID_korisnik, ID_proizvod) VALUES (:idk, :idp)";
    $prepare = $connection->prepare($upit);
    $prepare->bindParam(":idk",$user);
    $prepare->bindParam(":idp",$idP);
    try{
        $code = $prepare->execute() ? 204 : 500;
    }
    catch (PDOException $PDOException) {
        $PDOException->getMessage();
        $code = 409;
    }

endif;
http_response_code($code);