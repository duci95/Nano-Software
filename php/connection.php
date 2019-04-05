<?php

    require "config.php";


    try
    {
        $connection=new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DATABASE.";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD );

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//funkcija za SELECT
        function executeQuery($query)
        {
            global $connection;
            $sum =  $connection->query($query)->fetchAll();
            return $sum;
        }
//funkcija za prikazivanje logoa
        function logo ()
        {
            global $connection;
            $sql = "SELECT * FROM slike_logo sl ORDER BY sl.putanja_logo DESC LIMIT 0,1";
            $sum =  $connection->query($sql)->fetchAll();
            foreach($sum as $item) :
                echo "<a href='index.php?page=pocetna'><img src=$item->putanja_logo alt=$item->ime_slike title='NanoSoft DeLux' width='177' height='106'/></a>";
             endforeach;
        }
//funkcija za prikazivanje potkategorija
        function prikazi_strukturu($roditelj)
        {
            $upit="SELECT * FROM linkovi WHERE roditelj_link=$roditelj";

            global $connection;

            $rezultat = $connection->query($upit);

            if ($rezultat->rowCount() > 0)
            {

                echo "<ul class='linkParent'>";

            }

            foreach($rezultat as $red)
            {
                echo "<li><a href='".$red->putanja_link."'>".$red->naziv_link."</a>";
                echo "</li>";
            }

            if ($rezultat->rowCount() == 0)
            {
                echo "</ul>";
            }
        }
//funkcija za paginaciju
        function pagination($category)
        {
                $sql = "SELECT * FROM proizvodi p INNER JOIN  linkovi l ON p.ID_link=l.ID_link WHERE naziv_link = :category";
                global $connection;
                $prepare = $connection->prepare($sql);
                $prepare->bindParam(":category",$category);
                $sum= $prepare->execute();
                $perPage = 3;
                $res = $prepare->rowCount();
                echo $res;
                while ($prepare->fetchAll()){
                    global $sum;
                    echo $sum->ID_proizvod . " " . $sum->naziv_proizvoda;
                }

        }
        //funkicja za korpu
        function countCart ()
        {
            $id = $_SESSION['user']->ID_korisnik;
            $sql = "SELECT * FROM korpa k INNER JOIN korisnik ko ON k.ID_korisnik=ko.ID_korisnik WHERE ko.ID_korisnik=:id AND k.kupljeno=0 ";
            global $connection;
            $prepare = $connection->prepare($sql);
            $prepare->bindParam(":id",$id);
            $prepare->execute();
            $prepare->fetchAll();
            echo $prepare->rowCount();
        }
        function countCartPrice ()
        {
            $id = $_SESSION['user']->ID_korisnik;
            $sql = "SELECT SUM(p.cena) as total FROM korpa k INNER JOIN korisnik ko ON k.ID_korisnik=ko.ID_korisnik INNER JOIN proizvodi p ON p.ID_proizvod=k.ID_proizvod WHERE ko.ID_korisnik=:id AND k.kupljeno=0";
            global $connection;
            $prepare = $connection->prepare($sql);
            $prepare->bindParam(":id",$id);
             $prepare->execute();
             $sum = $prepare->fetch();

             if($sum)
                if($sum->total >0) echo $sum->total;
             else echo "0";
        }
        function countUsers ()
        {
                $sql = "SELECT COUNT(ID_korisnik) as total FROM korisnik WHERE aktivan =1" ;
                global $connection;
                $a=  $connection->query($sql);
                $sum =  $a->fetch();
                if($sum->total >0)
                    echo $sum->total;
                else
                    echo 0;

        }
    }
    catch (PDOException $PDOException)
    {
        $PDOException->getMessage();
    }
