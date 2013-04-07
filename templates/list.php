<div class="listside">
<?php if (is_array($nr)) { ?>
<div>
<h2>Wahlversprechen:</h1>
    <div class="meter">
        <? if ($group_perc[2] > 0) { ?><div style="background-color:#0f0;width:<? echo $group_perc[2]; ?>%">&nbsp;</div><? } ?>
        <? if ($group_perc[1] > 0) { ?><div style="background-color:#fbfbfb;width:<? echo $group_perc[1]; ?>%">&nbsp;</div><? } ?>
        <? if ($group_perc[3] > 0) { ?><div style="background-color:red;width:<? echo $group_perc[3]; ?>%">&nbsp;</div><? } ?>
    </div>
    <ul>
        <li><?=$group_nr[2];?> Versprechen wurden umgesetzt (<?=$group_perc[2];?>%)</li>
        <li><?=$group_nr[3];?> Versprechen wurden gebrochen (<?=$group_perc[3];?>%)</li>
        <li>Bei <?=$group_nr[1];?> Versprechen ist noch nichts passiert (<?=$group_perc[1];?>%)</li>
    </ul>
</div>
<? } ?>
<?php if (is_array($Knr)) { ?>
<div>
<h2>Koalitionsvertrag:</h1>
    <div class="meter">
        <? if ($Kgroup_perc[2] > 0) { ?><div style="background-color:#0f0;width:<? echo $Kgroup_perc[2]; ?>%">&nbsp;</div><? } ?>
        <? if ($Kgroup_perc[1] > 0) { ?><div style="background-color:#fbfbfb;width:<? echo $Kgroup_perc[1]; ?>%">&nbsp;</div><? } ?>
        <? if ($Kgroup_perc[3] > 0) { ?><div style="background-color:red;width:<? echo $Kgroup_perc[3]; ?>%">&nbsp;</div><? } ?>
    </div>
    <p>Von <strong><?=$Kcompl;?> Punkten</strong> im Koalitionsvertrag wurden bisher <strong><?=$Kgroup_nr[2];?></strong> umgesetzt. </p>
</div>
<? } ?>
<div>
<h2>Letzte Veränderungen:</h2>
<ul class="verlauf">
<?php
    $printedids = array();
    $ausw = new Analysis($database);
    foreach ($ausw->getStates("datum", "DESC") as $value) {
        if (!in_array($value->getIssueLink()->getID(), $printedids)) {
            echo "<li><a href=\"".dolink("single", array("issueid" => $value->getIssueLink()->getID()))."#state-".$value->getID()."\">".date("d.m.Y", $value->getDatum()).": ".$value->getIssueLink()->getName()."</a></li>";
            $printedids[] = $value->getIssueLink()->getID();
        }
        if (count($printedids) >= 5) break;
    }
?>
</ul>
</div>
</div>


<div class="list">


<?php
echo $text_liste;
?>

</div>

