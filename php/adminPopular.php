<?php
if(isset($_POST["popular"])):
    $popular_= $_FILES['filePopular'];
    $popular_name = $popular_['name'];
    $popular_type = $popular_['type'];
    $popular_size = $popular_['size'];
    $popular_tmp = $popular_['tmp_name'];

    $tipovi = ["image/jpeg","image/jpg","image/gif","image/png"];
    $errors =[];
    if(!in_array($popular_type,$tipovi)):
        $errors[] = "Tip slike nije podrzan";
        echo "Nije dobar format";
    endif;
    if($popular_size > 4000000) :
        echo "Fajl mora biti manji od 4MB";
        $errors[] = "Fajl mora biti manji od 4MB.";
    endif;

    if(count($errors)==0) :
        $naziv_fajla = time().$popular_name;
        $nova_putanja = "images/popular/".$naziv_fajla;
        move_uploaded_file($popular_tmp,$nova_putanja);
        $sql = "INSERT INTO slikeslajder (putanja_slike_slajder,naziv) VALUES (:slika,:naziv)";
        $prepare = $connection->prepare($sql);
        $prepare->bindParam(":slika",$nova_putanja);
        $prepare->bindParam(":naziv",$naziv_fajla);
        try{
            $prepare->execute();
            echo "Dodato";
        }
        catch(PDOException $e){
            $e->getMessage();
        }
    else: echo " Nije poslato";
    endif;
else: echo "";
endif;
?>
<div id="popular">
        <form id="adminSponsor" enctype="multipart/form-data" method="post" action="<?= htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);?>">
            <input type="file" name="filePopular" >
            <input type="submit" id="logoSubmit" name="popular" class="btnProduct" value="Promeni popularne">
        </form>
    </div>