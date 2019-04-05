<?php
require "connection.php";
$code = 404;
if(isset($_POST["send"]) && $_SERVER["REQUEST_METHOD"]  == "POST") :
    $firstLast = trim($_POST["firstLastName"]);
    $username = trim($_POST["usernameName"]);
    $address = trim($_POST["address"]);
    $email = trim($_POST["emailName"]);
    $ID = $_POST["ID"];
    $reFirstLast = "/^([A-ZŠĐČĆŽ][a-zšđčćž]{3,15})(\s[A-ZŠĐČĆŽ][a-zšđčćž]{3,20})+$/";
    $reUsername = "/^[a-zšđčćž]{4,10}[0-9]{1,4}$/";
    $reAddress = "/^([A-ZŠĐČĆŽ][a-zšđčćž]{3,15})+(\s[A-ZŠĐČĆŽ][a-zšđčćž]{3,20})*(\s([0-9]{1,4}([a-z])?)|(bb))$/";
    $errors = [];
    if(!preg_match($reFirstLast,$firstLast)) :
        array_push($errors, "Ime i prezime moraju početi velikim slovom");
    endif;
    if(!preg_match($reUsername,$username)) :
        array_push($errors,"Korisničko ime mora imati mala slova, ne sme imati razmake");
    endif;
    if(!preg_match($reAddress,$address)) :
        array_push($errors,"Adresa mora početi velikim slovom");
    endif;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        array_push($errors, "Email nije u dobrom formatu");
    endif;
    if($errors) :
        $code = 422;
        $data= $errors;
    else:
        $queryMain = "UPDATE korisnik SET imePrezime=:imePrezime, username=:username, email=:email, adresa=:adresa WHERE ID_korisnik=:ID";
        $prepareMain = $connection->prepare($queryMain);
        $prepareMain->bindParam(":imePrezime", $firstLast);
        $prepareMain->bindParam(":username", $username);
        $prepareMain->bindParam(":email", $email);
        $prepareMain->bindParam(":adresa",$address);
        $prepareMain->bindParam(":ID",$ID);
        try {
            $code = $prepareMain->execute() ? 204 : 500;
        }
        catch (PDOException $e) {
            $data =  $e->getMessage();
            $code = 409;
        }
    endif;
endif;
http_response_code($code);


