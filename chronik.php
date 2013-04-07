<?php
$KOM_SHOWSIDEMENU = false;
registerStyle('interface/css/chronik.css', true);

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
?>


<?
if (is_array($ausw->getStates("datum", "DESC")) && count($ausw->getStates("datum", "DESC")) > 0) {
    
     ob_start();

    echo "<table class=\"chronik\">";
    foreach ($ausw->getStates("datum", "DESC") as $value) {
            echo "<tr id=\"state-".$value->getID()."\" style=\"vertical-align:top;\"><td class=\"datum\"><a href=\"".dolink("single", array("issueid" => $value->getIssueLink()->getID()))."#state-".$value->getID()."\">".date("d.m.Y", $value->getDatum())."</a></td><td><a href=\"".dolink("single", array("issueid" => $value->getIssueLink()->getID()))."#state-".$value->getID()."\">".$value->getIssueLink()->getName().":<br><strong>".$value->getName()."</strong></a></td>";
            echo "</tr>";

    
    
        $pledgeidarray_geh = array();
        $pledgeidarray_geb = array();
        foreach ($value->getPledgestates() as $key2 => $val2) {
            if (in_array($val2->getPledgestatetypeLink()->getID(), array(3,4)) && !in_array($val2->getPledgeID(), $pledgeidarray_geh)) {
                $pledgeidarray_geh[] = $val2->getPledgeID();
                $tempar['datum'] = $value->getDatum();
                $tempar['pledge'] = &$val2->getPledgeLink();
                $pledgearray_geh[] = $tempar;
                //$value0 = $val2->getPledgeLink();
                //print_r($value0);

            } elseif (in_array($val2->getPledgestatetypeLink()->getID(), array(5,8,10)) && !in_array($val2->getPledgeID(), $pledgeidarray_geb)) {
                $pledgeidarray_geb[] = $val2->getPledgeID();
                $tempar['datum'] = $value->getDatum();
                $tempar['pledge'] = &$val2->getPledgeLink();
                $pledgearray_geb[] = $tempar;
                
                //$value0 = $val2->getPledgeLink();
                //print_r($value0);

            }
        }
    }
    
    echo "</table>";
    
    $text_states=ob_get_contents();
    ob_clean();
    $c = 0;
    echo "<table class=\"chronik umgesetzt\">";
    foreach ($pledgearray_geh as $val) {
        if ($c++ > 5) break;
                echo "<tr id=\"pledge-\" style=\"vertical-align:top;\"><td class=\"datum\"><a href=\"".dolink("single", array("issueid" => $val['pledge']->getIssueLink()->getID()))."#pledge-".$val['pledge']->getID()."\">".date("d.m.Y", $val['datum'])."</a></td><td><a href=\"".dolink("single", array("issueid" => $val['pledge']->getIssueLink()->getID()))."#pledge-".$val['pledge']->getID()."\">".$val['pledge']->getParty()->getName().": <strong>".$val['pledge']->getName()."</strong></a></td>";
                echo "</tr>";
    }
    echo "</table>";
    $text_gehalten=ob_get_contents();
    
    ob_clean();
    $c=0;
    echo "<table class=\"chronik gebrochen\">";
    foreach ($pledgearray_geb as $val) {
        if ($c++ > 5) break;
                echo "<tr id=\"pledge-\" style=\"vertical-align:top;\"><td class=\"datum\"><a href=\"".dolink("single", array("issueid" => $val['pledge']->getIssueLink()->getID()))."#pledge-".$val['pledge']->getID()."\">".date("d.m.Y", $val['datum'])."</a></td><td><a href=\"".dolink("single", array("issueid" => $val['pledge']->getIssueLink()->getID()))."#pledge-".$val['pledge']->getID()."\">".$val['pledge']->getParty()->getName().": <strong>".$val['pledge']->getName()."</strong></a></td>";
    }
    echo "</table>";
    $text_gebrochen=ob_get_contents();
    
    ob_end_clean();
} else {
    echo "Keine Einträge vorhanden.";
}

?>

<? include('templates/chronik.php'); ?>