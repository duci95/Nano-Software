<div id='card'>
    <?php
    if(isset($_GET['page'])) :
        $category =  $_GET['page'];
    endif;
    ?>
    <div class='baner'>
        <h2><?=$category; ?></h2>
    </div>
    <div class='products'>
    <?php
        $sql = "SELECT * FROM proizvodi p INNER JOIN proizvodjac pr ON p.ID_proizvodjac=pr.ID_proizvodjac INNER JOIN linkovi l ON p.ID_link=l.ID_link  WHERE lager NOT LIKE 0 AND ID_roditelj_link=2";
        $prepare = $connection->prepare($sql);
        $prepare->bindParam(':category', $category);
    try {
        $prepare->execute();
        if ($prepare->rowCount() > 0)
            $call = $prepare->fetchAll();
        if (empty($call)) :
            echo 'Nema nista';
        else:
            foreach ($call as $red) :
                echo "<div class='product'>
            <div class='productImage'>
                <img src='".$red->src_proizvod."' alt='".$red->naziv_proizvod."' width='150' height='100'>
            </div>
                <div class='productInfo'>
                    <h4>Proizvođač: </h4><p>$red->naziv_proizvodjac</p>
                    <h4>Karakteristike:</h4><p>$red->opis</p>
                    <h4>Na lageru: $red->lager</h4> 
                    <h5>Cena: $red->cena RSD</h5>
            </div>
            <div class='productOptions'>";
               if(isset($_SESSION['user'])&&($_SESSION['user']->naziv_uloge=='administrator')):
               echo " 
              <button  data-id='".$red->ID_proizvod."' class='btnProduct adminDelete' >Obriši</button>";
               elseif(isset($_SESSION['user'])&&($_SESSION['user']->naziv_uloge =='korisnik')):
               echo "<button  data-id='$red->ID_proizvod' class='btnProduct cart'>Dodaj u korpu</button><br>";
                else:
                echo "<a href='log.php'><button class='btnProduct'>Dodaj u korpu</button></a>";
                endif;
                echo"</div> </div>";
            endforeach;
            endif;
    }
    catch(PDOException $e)
    {
        $e->getMessage();
    }
    ?>
        </div>
</div>
