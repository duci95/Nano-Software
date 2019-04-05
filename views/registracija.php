<body>
<div class="container">
    <!-- Codrops top bar -->
    <div class="codrops-top">
        <div id="center">
             <?php logo(); ?>
                </div>
        <div class="clr"></div>
    </div>
    <header>

        <nav class="codrops-demos">

        </nav>
    </header>
    <section>
        <div id="container_demo" >


            <div id="wrapper">


                <div id="register" class="animate form">
                    <form   id="formReg">
                        <h1> Registracija </h1>
                        <p>
                            <label for="firstLastName"  data-icon="u">Ime i prezime</label>
                            <input id="firstLast" name="firstLastName"  autofocus="autofocus" type="text" placeholder="Ime Prezime" />
                            <span class="er" id="firstLastError">Ime i prezime moraju početi velikim slovom</span>
                        </p>

                        <p>
                            <label for="address" data-icon="u">Ulica i broj</label>
                            <input id="address" name="addressName"  type="text" placeholder="Ulica i broj" />
                            <span class="er" id="addressError">Ime ulice mora početi velikim slovom</span>
                        </p>
                        <label for="city"  data-icon="u">Grad</label>
                        <p>
                            <select  name="city" id="city">
                                <option value="0">Kliknite da odaberete grad</option>
                                <?php
                                $upit="SELECT * FROM grad";
                                $gradovi = executeQuery($upit);
                                foreach ($gradovi as $grad) : ?>
                                    <option value="<?= $grad->ID_grad; ?>"><?= $grad->ime_grada?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="er" id="cityError">Morate izabrati grad</span>
                        </p>

                        <p>
                            <label for="username" class="uname" data-icon="u">Korisničko ime</label>
                            <input id="username" name="usernameName"  type="text" placeholder="korisnik1234" />
                            <span class="er" id="usernameError">Korisničko ime mora imati između 4 i 10 karaktera i barem 1 do 4 broja</span>
                        </p>
                        <p>
                            <label for="email" class="youmail" data-icon="e" >Email</label>
                            <input id="email" name="emailName"  type="text" placeholder="neko@nesto.nesto"/>
                            <span class="er" id="emailError">Email nije u dobrom formatu</span>
                        </p>
                        <p>
                            <label for="password" class="youpasswd" data-icon="p">Lozinka</label>
                            <input id="password" name="passwordName"  type="password" placeholder="Abcdef1234"/>
                            <span class="er" id="passwordError">Lozinka mora imati između 4 do 10 karaktera i barem 1 do 4 broja i početi velikim slovom</span>
                        </p>
                        <p>
                            <label for="passwordConfirm" class="youpasswd" data-icon="p">Potvrdi lozinku </label>
                            <input id="passwordConfirm" name="passwordConfirmName"  type="password" placeholder="Abcdef1234"/>
                            <span class="er" id="passwordConfirmError">Lozinke se ne podudaraju</span>
                        </p>
                        <span id="feedback201"  class="ok">Uspešna registracija!<br/>Poslat vam je email sa aktivacionim linkom.</span>
                        <span id="feedback422" class="er">Podaci nisu kompletni!</span>
                        <span id="feedback409" class="er">Korisničko ime već postoji!</span>
                        <span id="feedback500" class="er">Izvinjavamo se, trenutno se ne mozete prijaviti</span>

                        <p class="signin button">

                            <input type="button" value="OK" name="send" id="btn"/>

                        </p>
                        <p class="change_link">
                            Već ste registrovani?
                            <a href="log.php" class="to_register">Prijavite se</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>

</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/scriptReg.js"></script>
</body>
