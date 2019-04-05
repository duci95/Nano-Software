<?php
if(isset($_GET['param'])):

    $hashToken = $_GET['param'];

    include "connection.php";
    $upit = "SELECT * FROM korisnik WHERE token = :token";
    $prepare = $connection->prepare($upit);

    $prepare->bindParam(":token", $hashToken);
    try
    {
        $sum= $prepare->execute();
        if($sum):
                $user =  $prepare->fetch();
                if(empty($user)) :
                    header("Location:https://nanosoftdelux.000webhostapp.com/register.php");
                 else :
                    $query =" UPDATE korisnik SET aktivan=1 WHERE token=:token";
                    $prepare = $connection->prepare($query);
                    $prepare->bindParam(":token", $hashToken);
                    $sum = $prepare->execute();
                    if($sum):
                        header("Location:https://nanosoftdelux.000webhostapp.com/log.php");
                    else:
                        header("Location:https://nanosoftdelux.000webhostapp.com/404");
                    endif;
                 endif;
         endif;
    }
    catch(PDOException $PDOException)
    {
        $PDOException->getMessage();
    }

endif;

?>