<?php


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

$database = new Database(KOM::$dblink);

if (is_numeric(KOM::$active['cat'])) {
    $database->setFilter("categories", KOM::$active['cat']);
}
if (is_numeric(KOM::$active['party'])) {
    $database->setFilter("parties", KOM::$active['party']);
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
    
    foreach ($ausw->getStates("datum", "DESC") as $value) {
            $states[] = $value;

    
    
        $pledgeidarray_geh = array();
        $pledgeidarray_geb = array();
        foreach ($value->getPledgestates() as $key2 => $val2) {
            if (in_array($val2->getPledgestatetype()->getID(), array(3,4)) && !in_array($val2->getPledgeID(), $pledgeidarray_geh)) {
                $pledgeidarray_geh[] = $val2->getPledgeID();
                $tempar['datum'] = $value->getDatum();
                $tempar['pledge'] = &$val2->getPledge();
                $pledgearray_geh[] = $tempar;
                //$value0 = $val2->getPledge();
                //print_r($value0);

            } elseif (in_array($val2->getPledgestatetype()->getID(), array(5,8,10)) && !in_array($val2->getPledgeID(), $pledgeidarray_geb)) {
                $pledgeidarray_geb[] = $val2->getPledgeID();
                $tempar['datum'] = $value->getDatum();
                $tempar['pledge'] = &$val2->getPledge();
                $pledgearray_geb[] = $tempar;
                
                //$value0 = $val2->getPledge();
                //print_r($value0);

            }
        }
    }
    
 include('templates/chronik.php'); 
} else {
    echo "Keine Einträge vorhanden.";
}

?>

