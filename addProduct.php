<?php
include "php/connection.php";
include "views/headReg.php";?>
<?php
$code = 404;
if(isset($_POST["btn"])) :
        $name = $_POST['proizvod'];
        $char = $_POST['char'];
        $cat = $_POST['cat'];
        $pcat = $_POST['pcat'];
        $cena= $_POST['cena'];
        $stanje = $_POST['stanje'];
        $idman = $_POST['man'];
        $slika = $_FILES['img'];
        $slika_ime =$slika["name"];
        $slika_velicina =$slika["size"];
        $slika_tip =$slika["type"];
        $slika_tmp =$slika["tmp_name"];
        $tipovi = ["image/png", "image/jpg", "image/jpeg","image/gif"];
        $limit = 4000000;
        $errors = [];
        $regex ="/^[\w\s]+$/";
        if($cat==="0") :
            $errors[] = "Kategorija nije odabrana";
         endif;

         if($pcat==="0") :
            $errors[] = "Potkategorija nije odabrana";
        endif;

        if($idman=="0") :
            $errors[] = "Proizvođač nije odabran";
        endif;

        if(!preg_match($regex,$name)) :
            $errors[] = "Ime proizvoda nije u dobrom formatu";
        endif;
        if(!preg_match($regex,$char)) :
            $errors [] ="Karakteristike nisu u dobrom formatu";
        endif;
        if($slika_velicina>$limit):
            $errors[] = "Slika ne sme biti veca od 4MB";
        endif;
        if(!in_array($slika_tip,$tipovi)):
            $errors[] = "Format nije podrzan";
        endif;
        if(count($errors)>0):
            
            foreach ($errors as $error):
                echo $error;
            endforeach;
        else:
            $ime = time().$slika_ime;
            $nova_putanja = "images/$ime";
            move_uploaded_file($slika_tmp,$nova_putanja);
            $sql = "INSERT INTO proizvodi (naziv_proizvod, ID_proizvodjac, ID_link, ID_roditelj_link, src_proizvod,opis,cena,lager)
VALUES(:naziv,(SELECT ID_proizvodjac FROM proizvodjac WHERE ID_proizvodjac=:p), (SELECT ID_link FROM linkovi WHERE ID_link=:l),(SELECT roditelj_link FROM linkovi WHERE roditelj_link=:rl),:src,:opis,:cena,:lager)";
            $prepare=$connection->prepare($sql);
            $prepare->bindParam(":naziv",$name);
            $prepare->bindParam(":p",$idman);
            $prepare->bindParam(":l",$pcat);
            $prepare->bindParam(":rl",$cat);
            $prepare->bindParam(":src",$nova_putanja);
            $prepare->bindParam(":opis",$char);
            $prepare->bindParam(":cena",$cena);
            $prepare->bindParam(":lager",$stanje);
            try{

                $code =  $prepare->execute() ? 201: 500;

            }
            catch(PDOException $e){
                $e->getMessage();
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
                    <form  method="post"  id="formReg" enctype="multipart/form-data" action="<?php htmlentities($_SERVER['PHP_SELF'])?>">
                        <h1>Dodavanje proizvoda</h1>
                        <p>
                            <label for="pName" data-icon="u">Ime proizvoda</label>
                            <input id="pName"    autofocus="autofocus" type="text" name="proizvod" />
                        </p>
                        <label for="cat"  data-icon="u">Kategorija</label>
                        <p>
                            <select  name="cat" id="cat">
                                <option value="0">Kliknite da odaberete kategoriju</option>
                                <option value="2">Softver</option>
                                <option value="3">Hardver</option>
                            </select>
                        </p>
                        <label for="pcat"  data-icon="u">Potkategorija</label>
                        <p>
                            <select  name="pcat" id="pcat">
                                <option value="0">Kliknite da odaberete potkategoriju</option>
                                <?php
                                $upit="SELECT * FROM linkovi  WHERE nivo=1";
                                $pkat = executeQuery($upit);
                                foreach ($pkat as $p) : ?>
                                    <option value="<?= $p->ID_link; ?>"><?= $p->naziv_link?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                        <p>
                            <label for="char" data-icon="u">Karakteristike</label>
                            <input id="char"  value="" type="text" name="char"/>
                        </p>
                        <label for="man"  data-icon="u">Proizvođač</label>
                        <p>
                            <select  name="man" id="man">
                                <option value="0">Kliknite da odaberete proizvođača</option>
                                <?php
                                $upit="SELECT * FROM proizvodjac";
                                $mans = executeQuery($upit);
                                foreach ($mans as $man) : ?>
                                    <option value="<?= $man->ID_proizvodjac; ?>"><?= $man->naziv_proizvodjac?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                        <p>
                            <label for="stanje" class="uname" data-icon="u">Stanje</label>
                            <input id="stanje"  type="number" required="required" name="stanje"  />
                        </p>
                        <p>
                            <label for="cena"  class="uname" data-icon="u" >Cena</label>
                            <input id="cena"  required="required"  type="number" name="cena"/>
                        </p>
                        <p>
                            <label for="img"  data-icon="u" >Slika</label>
                            <input id="img" required="required" name="img"  value="Slika..." type="file" />
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