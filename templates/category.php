<div class="listside">
<?php if (is_array($nr)) { ?>
<div>
<h2>Wahlversprechen:</h1>
    <div class="meter gradient">
        <? if ($group_perc[2] > 0) { ?><span class="green" style="width:<? echo $group_perc[2]; ?>%">&nbsp;</span><? } ?>
        <? if ($group_perc[3] > 0) { ?><span class="red" style="width:<? echo $group_perc[3]; ?>%">&nbsp;</span><? } ?>
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
    <div class="meter gradient">
        <? if ($Kgroup_perc[2] > 0) { ?><span class="green" style="background-color:#0f0;width:<? echo $Kgroup_perc[2]; ?>%">&nbsp;</span><? } ?>
        <? if ($Kgroup_perc[3] > 0) { ?><span class="red" style="background-color:red;width:<? echo $Kgroup_perc[3]; ?>%">&nbsp;</span><? } ?>
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
        if (!in_array($value->getIssue()->getID(), $printedids)) {
            echo "<li><a href=\"".KOM::dolink("single", array("issueid" => $value->getIssue()->getID()))."#state-".$value->getID()."\">".date("d.m.Y", $value->getDatum()).": ".$value->getIssue()->getName()."</a></li>";
            $printedids[] = $value->getIssue()->getID();
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

