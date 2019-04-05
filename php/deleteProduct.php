<?php
include "connection.php";
if(isset($_POST["btn"])):

    $idP = $_POST["id"];
    $upit = "DELETE FROM proizvodi WHERE ID_proizvod = :id ";
    $prepare = $connection->prepare($upit);
    $prepare->bindParam(":id",$idP);
    try{
        $code = $prepare->execute() ? 204 : 500;
    }
    catch (PDOException $PDOException) {
        $PDOException->getMessage();
        $code = 409;
    }
endif;
http_response_code($code);