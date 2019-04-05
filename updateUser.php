<?php
    include "php/connection.php";
    include "views/headReg.php"; ?>
<body>
<div class="container">
    <!-- Codrops top bar -->
    <div class="codrops-top">
        <div id="center">
             <?php
                logo();
                 if(isset($_GET['dugme'])) :
                    $firstlast=$_GET['firstLast'];
                    $user=$_GET['user'];
                    $email=$_GET['email'];
                    $street=$_GET['street'];
                    $ID=$_GET['ID'];
                endif;
                
             ?>
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
                        <h1>Izmena korisnika</h1>
                        <p>
                            <label for="firstLastName"  data-icon="u">Ime i prezime</label>
                            <input id="firstLast" name="firstLastName" value="<?=$firstlast?>"  autofocus="autofocus" type="text" placeholder="Ime Prezime" />
                            <span class="er" id="firstLastError">Ime i prezime moraju početi velikim slovom</span>
                        </p>
                        <input type="hidden" id="hidden" name="ID" value="<?=$ID?>">
                        <p>
                            <label for="address" data-icon="u">Ulica i broj</label>
                            <input id="address" name="addressName"  value="<?=$street?>" type="text" placeholder="Ulica i broj" />
                            <span class="er" id="addressError">Ime ulice mora početi velikim slovom</span>
                        </p>
                        <p>
                            <label for="username" class="uname" data-icon="u">Korisničko ime</label>
                            <input id="username" name="usernameName" value=<?=$user?> type="text"  />
                            <span class="er" id="usernameError">Korisničko ime mora imati između 4 i 10 karaktera i barem 1 do 4 broja</span>
                        </p>
                        <p>
                            <label for="img" class="youmail" data-icon="u" >Email</label>
                            <input id="email" name="emailName"  value="<?=$email?>" type="text" placeholder="neko@nesto.nesto"/>
                            <span class="er" id="emailError">Email nije u dobrom formatu</span>
                        </p>
                        <span id="feedback201"  class="ok">Uspešna izmena!</span>
                        <span id="feedback422" class="er">Podaci nisu kompletni!</span>
                        <span id="feedback409" class="er">Korisničko ime već postoji!</span>
                        <span id="feedback500" class="er">Izvinjavamo se, trenutno se ne moze promeniti informacije o korisniku!</span>
                          <p class="signin button">
                            <input type="button" value="OK" name="send" id="btn"/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/updateUser.js"></script>
</body>