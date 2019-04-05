<body>
<div id="wrapper">
    <header id="header">
        <div id="logo">
              <?php logo(); ?>
        </div>
        <nav id="navigation">
            <ul id="navigation-ul">
                <?php
                $sql = "SELECT * FROM linkovi WHERE nivo = 0";
                $call = executeQuery($sql);
                foreach($call as $item) : ?>
                <li  ><a href='<?=$item->putanja_link?>'><?=$item->naziv_link?></a></li>
               <?php endforeach; ?>
            </ul>
        </nav>
        <div id="btn">
            <?php if(isset($_SESSION['user'])) :
                if($_SESSION['user']->ID_uloge==2): ?>
                    <li class="btnRegLog btnHover aVisited" id = "userInfo"><a href="index.php?page=korpa"><?= $_SESSION["user"]->username ?><br/>U korpi : <?php countCart(); ?></a>
                    </li><a href="php/logout.php"><button class="btnRegLog btnHover" id = "logout">Odjavite se</button></a>
                <?php else: ?>
                    <li class="btnRegLog btnHover aVisited adminInfo"><?= $_SESSION["user"]->username ?></a></li>
                    <a href="php/logout.php"><button class="btnRegLog btnHover adminInfo"  id = "logout">Odjavite se</button></a>
                    <li class="btnRegLog btnHover aVisited" id="control"><a href="views/korisnici.php" >Korisnici (<?php countUsers() ?>)</a></li>
                <?php endif;?>
            <?php else: ?>
            <a href="register.php"><button class="btnRegLog btnHover" id = "reg">Registracija</button></a>
            <a href="log.php"><button class="btnRegLog btnHover" id = "login">Prijava</button></a>
            <?php endif; ?>
        </div>
    </header>