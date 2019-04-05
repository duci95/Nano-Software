<?php

$code = 404;
include "connection.php";
if(isset($_POST["btn"])):
    $idC = $_POST["id"];
    $idP = $_POST["p"];
    $upit = "UPDATE korpa SET kupljeno = 1 WHERE ID_korpa =:id_c;
UPDATE proizvod p SET lager=lager -1 WHERE p.ID_proizvod=:id_p";
    $prepare = $connection->prepare($upit);
    $prepare->bindParam(":id_c",$idC);
    $prepare->bindParam(":id_p",$idP);

    try{
        $code = $prepare->execute() ? 204 : 500;
    }
    catch (PDOException $PDOException) {
        $PDOException->getMessage();
        $code = 409;
    }
endif;
http_response_code($code);