
<?php
KOM::registerStyle('interface/css/single.css', true);

if (!is_numeric(KOM::$active['issueid'])) KOM::$active['issueid'] = 0;

$database = new Database(KOM::$dblink);
$database->setFilter("issues", KOM::$active['issueid']);
$database->loadContent();

$value0 = $database->getIssues();
$value = array_shift($value0);
?>
<div class="singleside">
<?php
    echo "<h3>Verlauf</h3><table class=\"chronik\">";
    if (is_array($value->getStates("datum", "DESC")) && count($value->getStates("datum", "DESC"))) {
        foreach ($value->getStates("datum", "DESC") as $value2) {
            echo "<tr id=\"state-".$value2->getID()."\" style=\"vertical-align:top;\"><td class=\"datum\">".date("d.m.Y", $value2->getDatum()).":</td><td style=\"padding-bottom:4px;\"><strong>".$value2->getName()."</strong>";
            echo "<div class=\"quote\"><span class=\"text\">".$value2->getQuoteText()."</span><span class=\"source\"><a href=\"".$value2->getQuoteURL()."\">".$value2->getQuoteSource()."</a></div>";
            echo "</tr>";
        }
    } else {
        echo "<p>Keine aktuellen Daten vorhanden.</p>";
    }
    
    echo "</table>";
?>
</div>
<div class="single">
<?php

    echo "<h2>".$value->getName()."</h2>";
    if ($value->getDesc()) {
        echo "<p>".$value->getDesc()."</p>";
    }
    foreach ($database->getParties("order") as $value3) {
        if (is_array($value->getPledgesOfParty($value3->getID()))) {
            foreach ($value->getPledgesOfParty($value3->getID()) as $value2) {
                echo "<div id=\"pledge-".$value2->getID()."\" class=\"pledge\"><div class=\"title\" style=\"border-color:".$value2->getParty()->getColour()."\" class=\"pledge\">";
                    $maingr = $value2->getCurrentPledgeStateType()->getID();
                    if ($value3->getDoValue() && $maingr >= 0) {
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
                    
                        echo "</span>";
                    }
                    echo "<div class=\"titletitle\">".$value2->getName();
                    echo "</div>";
                    echo "</div>";
                    if ($value2->getDesc()) {
                        echo "<div class=\"desc\">".$value2->getDesc()."</div>";
                    }
                    
                    if ($value2->getQuoteText()) {
                        echo "<div class=\"quote\"><span class=\"text\">".$value2->getQuoteText()."</span><span class=\"source\"><a href=\"".$value2->getQuoteURL()."\">".$value2->getQuoteSource()."</a></div>";
                    }
                    
                    if ($value3->getDoValue() && $value2->getCurrentPledgestatetype()) {
                        if ($value2->getCurrentState()) {
                            echo "<div class=\"currentstate\"><a href=\"#state-".$value2->getCurrentState()->getID()."\">".$value2->getCurrentPledgestatetype()->getName()."</a></div>";
                        } else {
                            echo "<div class=\"currentstate\">".$value2->getCurrentPledgestatetype()->getName()."</div>";
                        }
                    }
                echo "</div>";
            }
        }
    }
    



?>
</div>