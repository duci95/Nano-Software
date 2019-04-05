<div id="containerIndex">
    <div class="baner">
        <h2>Popularni proizvodi</h2>
    </div>
    <div id="imgSoft" class="cycle1">
        <?php
        $sql = "SELECT * FROM slikeslajder LIMIT 10";
        $call = executeQuery($sql);
        if(!empty($call)) :
        foreach($call as $item):
        ?>
        <img  src="<?=$item->putanja_slike_slajder?>" alt="<?=$item->naziv?>" title ="<?=$item->naziv?>" width="500" height="500">
        <?php
            endforeach;
            else: echo "";
        endif;
        ?>
    </div>
</div>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.ax.js"></script>