</div>
<div class="footer">
    <a href="dokumentacija.pdf" class="">Dokumentacija</a>
    <h6>Sva prava zadržana &reg; Katarina Jovanic</h6>
    <?php
    if(isset($_SESSION['user'])&&($_SESSION['user']->naziv_uloge =="administrator")) :

        include "php/adminPopular.php";
        include "php/adminLogo.php";
        include "php/adminSponsor.php";

        if(isset($_POST['send'])) :
            $errors =[];
            $ime = $_POST['man'];
            $regex = "/^[\w\s]{3,50}$/";
            if(!preg_match($regex,$ime)) :
                $errros[] = "Ime nije u dobrom formatu";
            endif;
            if(count($errors)>0) :
                foreach($errors as $error)
                {
                    echo $error;
                }
             else:
              $sql = "INSERT INTO proizvodjac VALUES('',:naziv)";
              $prepare = $connection->prepare($sql);
              $prepare->bindParam(":naziv",$ime);
              try{
                  $code = $prepare->execute() ? 201 :500;
                  echo "Dodat proizvođač";
              }
              catch(PDOException $exception){
                  $code = 409;
                  $exception->getMessage();
              }
              http_response_code($code);
              endif;
        endif;
        ?>

        <form id="mform" action="<?= htmlentities($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);?>" method ="post">
            <input type="text" name="man"  id="mans" placeholder="Ime proizvođača">
            <input type="submit" name="send" id="man" class="adminInsert btnProduct" value="Dodaj proizvođača">
        </form>

    <?php endif; ?>
    

</div>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.ax.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script src="js/deleteProduct.js"></script>
<script src="js/updateProduct.js"></script>

</body>
</html>