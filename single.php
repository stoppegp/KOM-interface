<?php

if (!is_numeric($_GET['issueid'])) $_GET['issueid'] = 0;

$database = new Database($dblink);
$database->setFilter("issues", $_GET['issueid']);
$database->loadContent();
echo "<br><br>";
foreach ($database->getIssues() as $value) {
    echo "<h2>".$value->getName()."</h2>";
    
    foreach ($database->getParties("order") as $value3) {
        if (is_array($value->getPledgesOfParty($value3->getID()))) {
            foreach ($value->getPledgesOfParty($value3->getID()) as $value2) {
                echo "<h3 class=\"pledge\"><span style=\"color:".$value2->getParty()->getColour()."\">".$value2->getParty()->getName()."</span>: ".$value2->getName()."</h3>";
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

            }
        }
    }
    
    echo "<h3>Verlauf</h3><table>";
    foreach ($value->getStates("datum", "DESC") as $value2) {
        echo "<tr id=\"state-".$value2->getID()."\" style=\"vertical-align:top;\"><td>".date("d.m.Y", $value2->getDatum()).":</td><td style=\"padding-bottom:4px;\"><strong><a href=\"#state-".$value2->getID()."\">".$value2->getName()."</a></strong>";
        echo "<div class=\"quote\"><span class=\"text\">".$value2->getQuoteText()."</span><span class=\"source\"><a href=\"".$value2->getQuoteURL()."\">".$value2->getQuoteSource()."</a></div>";
        echo "</tr>";
    }
    
    echo "</table>";
}


?>
