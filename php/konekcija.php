<?php

    $host = "";
    $databaseName = "";
    $username ="";
    $password = "";

    try {
        $connection = new PDO("mysql:host=$host; dbname=$databaseName", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        echo "Greska sa konekcijom" . $e->getMessage();
    }