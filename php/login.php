<?php
session_start();
require "connection.php";
$code =404;
$data = null;
    if(isset($_POST['btn'])):
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $reUsername = "/^[a-zšđčćž]{4,10}[0-9]{1,4}$/";
        $rePassword =  "/^[A-ZŠĐČĆŽ][a-zšđčćž]{4,10}[0-9]{1,4}$/";
        $errors = [];
        if(!preg_match($reUsername, $username)):
            array_push($errors, "Korisničko ime mora imati mala slova, ne sme imati razmake");
         endif;
        if(!preg_match($rePassword, $password)) :
            array_push($errors, "Lozinka mora početi velikim slovom");
        endif;
        if($errors):
                    $data = $errors;
         else:
                $password = md5($password);
                $query = "SELECT * FROM korisnik k INNER JOIN uloge u ON k.ID_uloge = u.ID_uloge  WHERE username = :username AND password= :password AND aktivan = 1";
                $prepare = $connection->prepare($query);
                $prepare->bindParam(":username", $username);
                $prepare->bindParam(":password", $password);
                try
                {
                    $prepare->execute();

                    if($prepare->rowCount() == 1){
                        $korisnik = $prepare->fetch();
                        $_SESSION['user'] = $korisnik;
                        $code = 200;
                        } else {

                        $code = 403;
                    }
                }
                catch(PDOException $PDOException)
                {
                    $PDOException->getMessage();
                    $code  = 500;
                }
         endif;
    endif;
    http_response_code($code);
    
?>