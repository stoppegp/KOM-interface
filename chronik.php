<?php
$KOM_SHOWSIDEMENU = false;

$order0 = array(
    6 => 1,
    4 => 2,
    3 => 3,
    9 => 4,
    2 => 5,
    7 => 6,
    1 => 7,
    10 => 8,
    8 => 9,
    5 => 10,
);

$database = new Database($dblink);

if (is_numeric($active['cat'])) {
    $database->setFilter("categories", $active['cat']);
}
if (is_numeric($active['party'])) {
    $database->setFilter("parties", $active['party']);
}
if (isset($_GET['pstid'])) {
    $database->setFilter("pledgestatetypeids", $_GET['pstid']);
}

$database->loadContent();

$ausw = new Analysis($database);

$c2d = array();


if (is_array($ausw->getStates("datum", "DESC")) && count($ausw->getStates("datum", "DESC")) > 0) {
    echo "<table>";
    foreach ($ausw->getStates("datum", "DESC") as $value) {
            echo "<tr id=\"state-".$value->getID()."\" style=\"vertical-align:top;\"><td>".date("d.m.Y", $value->getDatum())."</td><td style=\"padding-bottom:4px;\"><strong>".$value->getIssueLink()->getName().":</strong> <a href=\"".dolink("single", array("issueid" => $value->getIssueLink()->getID()))."#state-".$value->getID()."\">".$value->getName()."</a>";
            echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Keine Einträge vorhanden.";
}

?>
