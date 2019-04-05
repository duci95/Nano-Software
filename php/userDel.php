<?php

include "connection.php";
if(isset($_POST["btn"])):

    $idC = $_POST["id"];
    $upit = "DELETE FROM korpa WHERE ID_korpa = :id_c ";
    $prepare = $connection->prepare($upit);
    $prepare->bindParam(":id_c",$idC);

    try{
        $code = $prepare->execute() ? 204 : 500;
    }
    catch (PDOException $PDOException) {
        $PDOException->getMessage();
        $code = 409;
    }

endif;
http_response_code($code);