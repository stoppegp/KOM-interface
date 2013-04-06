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
<ul>
<?php
    $printedids = array();
    $ausw = new Analysis($database);
    foreach ($ausw->getStates("datum", "DESC") as $value) {
        if (!in_array($value->getIssueLink()->getID(), $printedids)) {
            echo "<li><a href=\"".dolink("single", array("issueid" => $value->getIssueLink()->getID()))."#state-".$value->getID()."\">".$value->getIssueLink()->getName()."</a></li>";
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
if (is_array($database->getIssues("name")) && count($database->getIssues("name")) > 0) {

    foreach ($database->getIssues("name") as $value) {
        echo "<h3><a href=\"".dolink("single", array("issueid" => $value->getID()))."\"><strong>".$value->getName()."</strong></a></h3><ul>";
        if ($value->getDesc()) {
            echo "<li class=\"desc\">".$value->getDesc()."</li>";
        }
        foreach ($database->getParties("order") as $value3) {
            if ($value3->getDoValue() == 0) continue;
            if (is_array($value->getPledgesOfParty($value3->getID()))) {
                foreach ($value->getPledgesOfParty($value3->getID()) as $value2) {
                    echo "<li class=\"pledge\"><a href=\"".dolink("single", array("issueid" => $value->getID()))."#pledge-".$value2->getID()."\">";
                    
                    
                    $maingr = $value2->getCurrentPledgeStateType()->getID();
                    echo '<span class="ampel" title="'.$value2->getCurrentPledgeStateType()->getName().'">';
                    switch ($maingr) {
                        case 1: $ampel = array("gray", "gray", "gray"); break;
                        case 2: $ampel = array("yellow", "yellow", "yellow"); break;
                        case 3: $ampel = array("green", "green", "gray"); break;
                        case 4: $ampel = array("green", "green", "green"); break;
                        case 5: $ampel = array("red", "red", "red"); break;
                        case 6: $ampel = array("green", "green", "gray"); break;
                        case 7: $ampel = array("red", "gray", "gray"); break;
                        case 8: case 10: $ampel = array("red", "red", "red"); break;
                        case 9: case -1: case -2: $ampel = array("gray", "gray", "gray"); break;
                    }
                    
                    foreach ($ampel as $ampval) {
                        echo ' <span class="'.$ampval.'">&nbsp;</span>';
                    }
                    
                    echo '</span>';
                    
                    echo "<span style=\"color:".$value2->getParty()->getColour()."\">".$value2->getParty()->getName()."</span>: ".$value2->getName();
                    ?>
                    
                    <?
                    echo "</a></li>";
                }
            }
        }

        echo "</ul>";
        if ($value->getCurrentState()) {
           // echo "Status: ".$value->getCurrentState()->getName()."<br>";
        }
    }
} else {
    echo "Keine Einträge vorhanden.";
}
?>

</div>

