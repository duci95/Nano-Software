<body>
<div id="wrapper">
    <header id="header">

        <div id="logo">
            <a href="../index.php"><img src="images/logo.png" alt="logo" title="NanoSoft DeLux"/></a>
        </div>

        <nav id="navigation">
            <ul id="navigation-ul">
                <li  ><a href="index.php">Početna</a></li>
                <li  ><a href="#">Softver</a>
                    <ul id="softwareHidden">
                        <li><a href="index.php?page=aplikativni">Aplikativni</a></li>
                        <li><a href="index.php?page=drajveri">Drajveri</a></li>
                        <li><a href="index.php?page=optimizacija">Optimizacija</a></li>
                    </ul>
                </li>
                <li  ><a href="#">Hardver</a>
                    <ul id="hardwareHidden">
                        <li><a href="index.php?page=procesori">Procesori</a></li>
                        <li><a href="index.php?page=ram">Ram memorije</a></li>
                        <li><a href="index.php?page=diskovi">Hard diskovi i SSD</a></li>

                    </ul>
                </li>
                <li ><a href="index.php?page=kontakt">Kontakt</a></li>
                <li ><a href="index.php?page=autor">O autoru</a></li>
            </ul>
        </nav>

        <div id="btn">
            <ul id="userRootInfo">
               <li class="btnRegLog btnHover" id = "userInfo">dusan1995
                    <ul id="userInfoHidden">
                        <li><a href="userInfo.php">Pogledaj profil</a></li>
                        <li><a href="izmeni.php">Izmeni profil</a></li>
                        <li><a href="korpa.php">Korpa <?="(3)"?></a></li>
                    </ul>
                </li>
            </ul>

            <a href="log.php"><button class="btnRegLog btnHover" id = "logout">Odjavite se</button></a>

        </div>
    </header>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function () {
               $("#btn ul >li >ul").hide();
            });
            $("#userInfo").hover(function (e) {
                e.stopPropagation();
                $(this).find("ul").slideToggle("fast");
            });
    </script>
