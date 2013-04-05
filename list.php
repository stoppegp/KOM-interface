<?php
$KOM_SHOWSIDEMENU = true;

$database = new Database($dblink);

if (is_numeric($active['cat'])) {
    $database->setFilter("categories", $active['cat']);
}
if (is_numeric($active['party'])) {
    $database->setFilter("parties", $active['party']);
}
if (is_numeric($active['pst'])) {
    $database->setFilter("pledgestatetypegroup", $active['pst']);
}


$database->loadContent();

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
