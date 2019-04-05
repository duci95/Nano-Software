<?php
session_start();
if(isset($_SESSION["korisnik"])) :
session_destroy();
header("Location:../login.php");
endif;