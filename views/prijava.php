<body>
<div class="container">

    <div class="codrops-top">

        <div id="center">

            <?php
                include "php/connection.php";
            logo(); ?>
        </div>
        <div class="clr"></div>
    </div><!--/ Codrops top bar -->
    <header>

        <nav class="codrops-demos">

        </nav>
    </header>
    <section>
        <div id="container_demo" ><!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->

            <div id="wrapper">
                <div id="login" class="animate form">
                    <form  id="formaLog" autocomplete="on">
                        <h1>Prijava</h1>
                        <p>
                            <label for="usernameLog" class="uname" data-icon="u" > Korisničko ime </label>
                            <input id="usernameLog" name="username" autofocus="autofocus"  type="text" placeholder="korisnik1234"/>

                        </p>
                        <p>
                            <label for="passwordLog" class="youpasswd" data-icon="p"> Lozinka </label>
                            <input id="passwordLog" name="password"  type="password" placeholder="Abcd1234" />

                        </p>
                        <span id="feedbackError" class="er">Uneti podaci nisu ispravni!</span>
                        <span id="feedback500L" class="er">Izvinjavamo se, trenutno se ne mozete prijaviti</span>
                        <span id="feedback200L" class="ok">Uspešna prijava!</span>

                        <p class="login button">

                            <input type="button" value="OK" name="send" id="btn" />
                        </p>
                        <p class="change_link">
                            Nemate nalog?
                            <a href="register.php" class="to_register">Registrujte se</a>
                        </p>
                    </form>
                </div>


            </div>

        </div>
    </section>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/scriptLog.js"></script>

</body>
</html>