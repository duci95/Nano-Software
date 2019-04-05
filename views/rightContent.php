<aside id="rightContent">
    <div class="baner"><h2>Sponzori sajta</h2></div>
    <?php
        $sql = "SELECT * FROM sponzori ORDER BY slika DESC LIMIT 3";
        $call = executeQuery($sql);
        if(!empty($call)) :
        foreach($call as $value):
    $link = $value->link;
    $title = explode(".",$link);
    ?>
    <div id="sponzori">
        <a href="<?=$value->link?>" target="_blank"><img src="<?=$value->slika?>" alt="<?=$value->naziv?>" title="<?=$title[1]?>"   width="250" height="150"></a>

<?php
endforeach;
else:
 echo "";
 endif;
?>


    </div>

</aside>

