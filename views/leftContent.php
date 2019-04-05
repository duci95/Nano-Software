<?php
    require_once "php/connection.php";
?>
<div id="content">
    <aside id="leftContent">

        <?php
        $upit_linkovi = "SELECT * FROM linkovi WHERE nivo NOT IN (0, -1)";
        $rezultat_linkovi = $connection->query($upit_linkovi);
        echo '<ul>';
        foreach($rezultat_linkovi as $red)
        {
            echo "<li><a href='".$red->putanja_link."'>".$red->naziv_link."</a>";
            echo "</li>";
        }
        echo "</ul>";
        ?>
    </aside>