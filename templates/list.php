<div class="list">
<div class="listside">
<div class="fixed">
<?php if (is_array($nr)) { ?>
<div>
<h2>Wahlversprechen:</h1>
    <div class="meter">
        <? if ($group_perc[2] > 0) { ?><div style="background-color:green;width:<? echo $group_perc[2]; ?>%">&nbsp;</div><? } ?>
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
        <? if ($Kgroup_perc[2] > 0) { ?><div style="background-color:green;width:<? echo $Kgroup_perc[2]; ?>%">&nbsp;</div><? } ?>
        <? if ($Kgroup_perc[1] > 0) { ?><div style="background-color:#fbfbfb;width:<? echo $Kgroup_perc[1]; ?>%">&nbsp;</div><? } ?>
        <? if ($Kgroup_perc[3] > 0) { ?><div style="background-color:red;width:<? echo $Kgroup_perc[3]; ?>%">&nbsp;</div><? } ?>
    </div>
    <p>Von <strong><?=$Kcompl;?> Punkten</strong> im Koalitionsvertrag wurden bisher <strong><?=$Kgroup_nr[2];?></strong> umgesetzt. </p>
</div>
<? } ?>
</div>
</div>


<?php
if (is_array($database->getIssues("name")) && count($database->getIssues("name")) > 0) {

    foreach ($database->getIssues("name") as $value) {
        echo "<h3><a style=\"font-size:1.1em;\" href=\"".dolink("single", array("issueid" => $value->getID()))."\"><strong>".$value->getName()."</strong></a></h3><ul>";
        
        foreach ($database->getParties("order") as $value3) {
            if (is_array($value->getPledgesOfParty($value3->getID()))) {
                foreach ($value->getPledgesOfParty($value3->getID()) as $value2) {
                    echo "<li><span style=\"color:".$value2->getParty()->getColour()."\">".$value2->getParty()->getName()."</span>: ".$value2->getName()."</li>";
                }
            }
        }

        echo "</ul>";
        if ($value->getCurrentState()) {
            echo "Status: ".$value->getCurrentState()->getName()."<br>";
        }
    }
} else {
    echo "Keine Einträge vorhanden.";
}
?>

</div>