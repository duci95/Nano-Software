<div id='card'>
    <div class='baner'>
        <h2>ukupno za plaćanje =  <?php countCartPrice(); ?> RSD  </h2>
    </div>
    <div class="products">
<?php
$sql = "SELECT * FROM korisnik k INNER JOIN korpa c ON k.ID_korisnik=c.ID_korisnik INNER JOIN proizvodi p ON p.ID_proizvod=c.ID_proizvod INNER JOIN proizvodjac pr ON pr.ID_proizvodjac=p.ID_proizvodjac INNER JOIN linkovi l ON p.ID_link=l.ID_link  WHERE c.kupljeno = 0 AND k.ID_korisnik = :id";
$user = $_SESSION['user']->ID_korisnik;
$prepare = $connection->prepare($sql);
$prepare->bindParam(":id",$user);
try
{
    $sum = null;
    $prepare->execute();
    if($prepare->rowCount() >0):
    $sum= $prepare->fetchAll();
    if(empty($sum)) :
        echo "Nema nista";
    else:
        foreach($sum as $red) :
            echo "
            <div class='product'>
             <div class='productImage'>
                <img src=$red->src_proizvod alt=$red->naziv_proizvod width='150' height='100' >
              </div>
             <div class='productInfo'>
                    <h4>Proizvođač: </h4><p>$red->naziv_proizvodjac</p>
                    <h4>Karakteristike:</h4><p>$red->opis</p>
                    <h5>Cena: $red->cena RSD</h5>
             </div>
            <div class='productOptions'>";
            if(isset($_SESSION['user'])&&($_SESSION['user']->naziv_uloge=='korisnik')):
                echo "<button data-id=$red->ID_korpa data-p=$red->ID_proizvod class='userBuy btnProduct'>Kupi</button>
                    <button  data-id=$red->ID_korpa class='userDelete btnProduct' >Obriši</button>";
                else:
                    echo "<a href='log.php'><button  class='btnProduct'>Dodaj u korpu</button></a>";
                endif;
                echo "</div> </div>";
         endforeach;
    endif;
    endif;
}
catch(PDOException $e)
{
    $e->getMessage();
}
?>
</div>
</div>
