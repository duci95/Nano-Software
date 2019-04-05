<div id='card'>
    <?php
    if(isset($_GET['page'])) :
        $category =  $_GET['page'];
    endif;
    
    ?>
    <div class='baner'>
        <h2><?=$category; ?>
        <?php
    if(isset($_SESSION['user'])&&($_SESSION['user']->naziv_uloge =="administrator")) :?>
        <a href="https://nanosoftdelux.000webhostapp.com/addProduct.php"><button class='btnProduct adminInsert' >Dodaj</button></a></h2>
        <?php endif;?>
    </div>
    <div class='products'>
    <?php
        $sql = 'SELECT *,p.ID_link as plink,p.ID_roditelj_link as ID_rlink FROM proizvodi p INNER JOIN proizvodjac pr ON p.ID_proizvodjac=pr.ID_proizvodjac INNER JOIN linkovi l ON p.ID_link=l.ID_link where naziv_link = :category AND lager NOT LIKE 0';
        $prepare = $connection->prepare($sql);
        $prepare->bindParam(':category', $category);
    try {
        $prepare->execute();
        $call = $prepare->fetchAll();
        if ($prepare->rowCount()) :
            if (empty($call)) :
            echo '';
        else:
            foreach ($call as $red) :
                echo "<div class='product'> 
            <div class='productImage'>
                <img src='".$red->src_proizvod."' alt='".$red->naziv_proizvod."' width='150' height='100' >
            </div>
                <div class='productInfo'>
                    <h4>Proizvođač: </h4><p>$red->naziv_proizvodjac</p>
                    <h4>Karakteristike:</h4><p>$red->opis</p>
                    <h4>Na lageru: $red->lager</h4> 
                    <h5>Cena: $red->cena RSD</h5>
            </div>
            <div class='productOptions'>";
                if(isset($_SESSION['user'])&&($_SESSION['user']->naziv_uloge=='administrator')):
               echo "<form action='updateProduct.php' method='get'>
                            <input type='hidden' value=$red->src_proizvod name='src'>
                            <input type='hidden' value=$red->naziv_proizvod name='name'>
                            <input type='hidden' value=$red->naziv_proizvodjac name='man'>
                            <input type='hidden' value='$red->opis' name='opis'>
                            <input type='hidden' value=$red->lager name='lager'>
                            <input type='hidden' value=$red->cena name='cena'>
                            <input type='hidden' value=$red->ID_proizvod name='ID_p'>
                            <input type='hidden' value=$red->ID_proizvodjac name='ID_man'>
               <button  name='btn'  class='btnProduct adminUpdate'>Izmeni</button>
                <button  data-id='".$red->ID_proizvod."' class='btnProduct adminDelete' >Obriši</button>
                </form>";
                elseif(isset($_SESSION['user'])&&($_SESSION['user']->naziv_uloge =='korisnik')):
                    echo "<button  class='cart btnProduct' data-id=$red->ID_proizvod>Dodaj u korpu</button><br>";
                else:
                    echo "<a href='https://nanosoftdelux.000webhostapp.com/log.php'><button class='btnProduct'>Dodaj u korpu</button></a>";
                endif;
                echo"</div> </div>";
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

