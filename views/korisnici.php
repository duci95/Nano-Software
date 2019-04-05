<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="author" content="Dusan Krsmanovic"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <title>NanoSoft DeLux</title>
</head>
<body>
<?php
     include "../php/connection.php";
    $sql = "SELECT * FROM korisnik k INNER JOIN grad g ON k.ID_grad=g.ID_grad INNER JOIN uloge u ON k.ID_uloge= u.ID_uloge";
    $call = executeQuery($sql);
    foreach ($call as $item) : ?>
        <div id="grid">
       <?=$item->imePrezime?><br>
       <?=$item->username?><br>
       <?=$item->adresa?><br>
       <?=$item->ime_grada?><br>
       <?=$item->email?><br>
       <?=$item->aktivan?><br>
       <?=$item->naziv_uloge?><br>
       <button class='adminDeleteUser btnProduct'  data-id=<?=$item->ID_korisnik?>>Obriši</button>
       <form action="../updateUser.php" method="get">
            <input type="hidden" name="firstLast"  value="<?=$item->imePrezime?>" />
            <input type="hidden" name="user"  value="<?=$item->username?>" />
            <input type="hidden" name="email"  value="<?=$item->email?>" />
            <input type="hidden" name="street"  value="<?=$item->adresa?>" />
            <input type="hidden"  name="ID" value="<?=$item->ID_korisnik?>"/>
            <input type="submit" class="adminChangeUser btnProduct"  name="dugme" value="Ažuriraj"/>
       </form>
       
</div>
    <?php endforeach; ?>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/users.js"></script>
</body>
</html>