<?php if(isset($_POST['btn'])):
    $slika = $_FILES['sponzor'];
    $slika_ime = $slika['name'];
    $slika_tip = $slika['type'];
    $slika_velicina = $slika['size'];
    $slika_tmp = $slika["tmp_name"];
    $link = $_POST["link"];
    $tipovi = ["image/jpeg","image/jpg","image/gif","image/png"];
    $errors =[];
    if(!in_array($slika_tip,$tipovi)):
        $errors[] = "Tip slike nije podrzan";
        echo "Nije dobar format";
    endif;
    if($slika_velicina > 4000000) :
        echo "Fajl mora biti manji od 4MB";
        $errors[] = "Fajl mora biti manji od 4MB.";
    endif;
    if(!filter_var($link,FILTER_VALIDATE_URL)) :
        echo "Link nije ispravan";
        $errors[] = "Link nije ispravan.";
    endif;
    if(count($errors)==0) :
        $naziv_fajla = time().$slika_ime;
        $nova_putanja = "images/sponzori/".$naziv_fajla;
        move_uploaded_file($slika_tmp,$nova_putanja);
        $sql = "INSERT INTO sponzori (slika, naziv, link) VALUES (:slika,:naziv,:link)";
        $prepare = $connection->prepare($sql);
        $prepare->bindParam(":slika",$nova_putanja);
        $prepare->bindParam(":naziv",$slika_ime);
        $prepare->bindParam(":link",$link);
        try{
            $prepare->execute();
            echo "Dodato";
        }
        catch(PDOException $e){
            $e->getMessage();
        }
    endif;
else: echo "";
endif;
?>
<div id="admin">
    <form  id="spon" enctype="multipart/form-data" method="post" action="<?= htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);?>">
        <input type="file" name="sponzor" >
        LINK<input type="text" name="link"placeholder="LINK" value="http://">
        <input type="submit" id="sponsorSubmit" name="btn"  class="btnProduct" value="Promeni sponzore">
    </form>
</div>