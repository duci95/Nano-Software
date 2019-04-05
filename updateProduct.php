<?php
require "php/connection.php";
include "views/headReg.php";
if(isset($_GET['btn'])) :
    $idp = $_GET['ID_p'];
    $idman = $_GET['ID_man'];
    $src = $_GET['src'];
    $naziv_proizvod = $_GET['name'];
    $man = $_GET['man'];
    $opis = $_GET['opis'];
    $lager = $_GET['lager'];
    $cena= $_GET['cena'];
endif;
$code = 404;
$data = null;
if(isset($_POST["btn"])&&(isset($_FILES["img"]))) :

        $name = $_POST['proizvod'];
        $char = $_POST['char'];
        $cena= $_POST['cena'];
        $stanje = $_POST['stanje'];
        $idp = $_POST['idp'];
        $idman = $_POST['idm'];
        $man = $_POST['man'];
        $slika_ime = $_FILES['img']["name"];
        $slika_velicina = $_FILES['img']["size"];
        $slika_tip = $_FILES['img']["type"];
        $slika_tmp = $_FILES['img']["tmp_name"];
        $tipovi = ["image/png", "image/jpg", "image/jpeg","image/gif"];
        $limit = 4000000;
        $errors = [];
        $regex ="/^[\w\s]+$/";
        if(!preg_match($regex,$name)) :
            $errors[] = "Ime proizvoda nije u dobrom formatu";
        endif;
        if(!preg_match($regex,$char)) :
            $errors [] ="Karakteristike nisu u dobrom formatu";
        endif;
        if(!preg_match($regex,$man)):
            $errors[]="Ime proizvodjaca nije u dobrom formatu";
        endif;
        if($slika_velicina>$limit):
            $errors[] = "Slika ne sme biti veca od 4MB";
        endif;
        if(!in_array($slika_tip,$tipovi)):
            $errors[] = "Format nije podrzan";
         endif;
         if(count($errors)>0):
             $data = $errors;
             foreach ($errors as $error):
                 echo $error;
             endforeach;
          else:
              $ime = time().$slika_ime;
              $nova_putanja = "images/$slika_ime";
              move_uploaded_file($slika_tmp,$nova_putanja);
              $sql = "UPDATE proizvodi SET naziv_proizvod=:naziv, src_proizvod=:src,opis=:opis,cena=:cena,lager=:lager WHERE ID_proizvod=:idp;
UPDATE proizvodjac SET naziv_proizvodjac = :man WHERE ID_proizvodjac=:idman";
              $prepare=$connection->prepare($sql);
              $prepare->bindParam(":naziv",$name);
              $prepare->bindParam(":idp",$idp);
              $prepare->bindParam(":idman",$Idman);
              $prepare->bindParam(":man",$man);
              $prepare->bindParam(":src",$nova_putanja);
              $prepare->bindParam(":opis",$char);
              $prepare->bindParam(":cena",$cena);
              $prepare->bindParam(":lager",$stanje);
              try{
                  $code =  $prepare->execute() ? 204: 500;
              }
              catch(PDOException $e){
                  $e->getMessage();
                  $code=409;
              }
          endif;
          endif;

    if(isset($_POST['btn'])):
        $name = $_POST['proizvod'];
        $char = $_POST['char'];
        $cena= $_POST['cena'];
        $stanje = $_POST['stanje'];
        $idp = $_POST['idp'];
        $idman = $_POST['idm'];
        $man = $_POST['man'];
        $errors = [];
        $regex ="/^[\w\s]+$/";
        if(!preg_match($regex,$name)) :
            $errors[] = "Ime proizvoda nije u dobrom formatu";
        endif;
        if(!preg_match($regex,$char)) :
            $errors [] ="Karakteristike nisu u dobrom formatu";
        endif;
        if(!preg_match($regex,$man)):
            $errors[]="Ime proizvodjaca nije u dobrom formatu";
        endif;
        if(count($errors)>0):
            $data =$errors;
            foreach ($errors as $error ):
                echo $error;
            endforeach;
        else:
            $sql = "UPDATE proizvodi SET naziv_proizvod=:naziv, opis=:opis,cena=:cena,lager=:lager WHERE ID_proizvod=:idp;
                         UPDATE proizvodjac SET naziv_proizvodjac = :man WHERE ID_proizvodjac=:idman";
            $prepare=$connection->prepare($sql);
            $prepare->bindParam(":naziv",$name);
            $prepare->bindParam(":man",$man);
            $prepare->bindParam(":idp",$idp);
            $prepare->bindParam(":idman",$idman);
            $prepare->bindParam(":opis",$char);
            $prepare->bindParam(":cena",$cena);
            $prepare->bindParam(":lager",$stanje);

            try{
                $code =  $prepare->execute() ? 204 : 500;
            }
            catch(PDOException $e){
                var_dump($e->getMessage());
                $code=409;
            }
        endif;

endif;
http_response_code($code);
?>
<body>
<div class="container">
    <!-- Codrops top bar -->
    <div class="codrops-top">
        <div id="center">
             <?php   logo();     ?>
                </div>
        <div class="clr"></div>
    </div>
    <header>
        <nav class="codrops-demos">
        </nav>
    </header>
    <section>
        <div id="container_demo" >
            <div id="wrapper">
                <div id="register" class="animate form">
                    <form   id="formReg" method="post" enctype="multipart/form-data" action="<?php htmlentities($_SERVER['PHP_SELF'])?>">
                        <h1>Izmena proizvoda</h1>
                        <p>
                            <label for="pName" data-icon="u">Ime proizvoda</label>
                            <input id="pName"  value="<?=$naziv_proizvod?>"  autofocus="autofocus" type="text" name="proizvod" />

                        </p>
                        <input type="hidden" id="hiddenP" value="<?=$idp?>" name="idp">
                        <input type="hidden" id="hiddenM" value="<?=$idman?> " name="idm">
                        <p>
                            <label for="char" data-icon="u">Karakteristike</label>
                            <input id="char"  value="<?=$opis?>" type="text" name="char" />

                        </p>
                        <p>
                            <label for="man" data-icon="u">Proizvodjac</label>
                            <input id="man"  value="<?=$man?>" type="text" name="man" />
                        </p>
                        <p>
                            <label for="stanje" class="uname" data-icon="u">Stanje</label>
                            <input id="stanje" value=<?=$lager?> type="number" name="stanje" />
                        </p>
                        <p>
                            <label for="cena"  class="uname" data-icon="u" >Cena</label>
                            <input id="cena"   value="<?=$cena?>" type="number" name="cena"/>
                        </p>
                        <p>
                            <label for="img"  data-icon="u" >Slika</label>
                            <input id="img"   type="file" name="img"/>
                        </p>

                        <p class="signin button">
                            <input type="submit" value="OK" name="btn" id="btn"/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</body>