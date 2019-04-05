<?php if(isset($_POST['logo'])):
$slika = $_FILES['fileLogo'];
$slika_ime = $slika['name'];
$slika_tip = $slika['type'];
$slika_velicina = $slika['size'];
$slika_tmp = $slika["tmp_name"];
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
if(count($errors)==0) :
$naziv_fajla = time().$slika_ime;
$nova_putanja = "images/logo/".$naziv_fajla;
move_uploaded_file($slika_tmp,$nova_putanja);
$sql = "INSERT INTO slike_logo (ime_slike, putanja_logo) VALUES (:ime,:putanja)";
$prepare = $connection->prepare($sql);
$prepare->bindParam(":ime",$naziv_fajla);
$prepare->bindParam(":putanja",$nova_putanja);
try{
$prepare->execute();
}
catch(PDOException $e){
$e->getMessage();
}
endif;
else: echo "";
endif;
?>
<div id="logoChange">
    <form  id="adminLogo" enctype="multipart/form-data" method="post" action="<?= htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);?>">
        <input type="file" name="fileLogo" >
        <input type="submit" id="logoSubmit" name="logo" class="btnProduct" value="Promeni logo">
    </form>
</div>