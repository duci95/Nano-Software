<?php
session_start();
header("Location:https://nanosoftdelux.000webhostapp.com/log.php");
if(isset($_SESSION["user"])) :
    unset($_SESSION["user"]);
session_destroy();

endif;