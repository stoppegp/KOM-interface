<div class="list">
<?
if (is_array($database->getIssues("name")) && count($database->getIssues("name")) > 0) {

    foreach ($database->getIssues("name") as $value) {
        echo "<h3><a href=\"".KOM::dolink("single", array("issueid" => $value->getID()))."\"><strong>".$value->getName()."</strong></a></h3><ul>";
        if ($value->getDesc()) {
            echo "<li class=\"desc\">".$value->getDesc()."</li>";
        }
        foreach ($database->getParties("order") as $value3) {
            if ($value3->getDoValue() == 0) continue;
            if (is_array($value->getPledgesOfParty($value3->getID()))) {
                foreach ($value->getPledgesOfParty($value3->getID()) as $value2) {
                    echo "<li class=\"pledge\"><a href=\"".KOM::dolink("single", array("issueid" => $value->getID()))."#pledge-".$value2->getID()."\">";
                    
                    
                    $maingr = $value2->getCurrentPledgeStateType()->getID();
                    if ($maingr >= 0) {
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
                    }
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