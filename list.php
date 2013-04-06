<?php
$KOM_SHOWSIDEMENU = false;

$database = new Database($dblink);
$databaseGR = new Database($dblink);
$databaseK = new Database($dblink);

if (is_numeric($active['cat'])) {
    $database->setFilter("categories", $active['cat']);
    $databaseK->setFilter("categories", $active['cat']);
    $databaseGR->setFilter("categories", $active['cat']);
}
if (is_numeric($active['pstg'])) {
    $database->setFilter("pledgestatetypegroup", $active['pstg']);
    $databaseK->setFilter("pledgestatetypegroup", $active['pstg']);
    $databaseGR->setFilter("pledgestatetypegroup", $active['pstg']);
}

$databaseGR->setFilter("parties", array(1,2));
$databaseK->setFilter("parties", array(3));

$database->loadContent();
$databaseGR->loadContent();
$databaseK->loadContent();

registerStyle('interface/css/list.css', true);


    $auswGR = new Analysis($databaseGR);
    $auswK = new Analysis($databaseK);

    /* Aktuelle Verteilung */
    $nr = $auswGR->getCurrentNumberOfPledgestatetypes();
    if (is_array($nr)) {
        $compl = array_sum($nr);
        foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
            foreach ($databaseGR->getPledgestatetypegroup($value0->getID())->getPledgestatetypeLinks() as $value) {
                $group_nr[$value0->getID()] += $nr[$value->getID()];
            }
            $group_perc[$value0->getID()] = floor($group_nr[$value0->getID()]/$compl*100);
        }
        
       $gesperc = array_sum($group_perc);
       if ($gesperc < 100) {
            foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
                if ($group_perc[$value0->getID()] > 0) {
                    $group_perc[$value0->getID()] += (100-$gesperc);
                    break;
                }
            }
       }
        
    }
    
    
    $Knr = $auswK->getCurrentNumberOfPledgestatetypes();
    if (is_array($Knr)) {
        $Kcompl = array_sum($Knr);
        foreach ($databaseK->getPledgestatetypegroups() as $value0) {
            foreach ($databaseK->getPledgestatetypegroup($value0->getID())->getPledgestatetypeLinks() as $value) {
                $Kgroup_nr[$value0->getID()] += $Knr[$value->getID()];
            }
            $Kgroup_perc[$value0->getID()] = floor($Kgroup_nr[$value0->getID()]/$Kcompl*100);
        }
        
        $Kgesperc = array_sum($Kgroup_perc);
        if ($Kgesperc < 100) {
            foreach ($databaseK->getPledgestatetypegroups() as $value0) {
                if ($Kgroup_perc[$value0->getID()] > 0) {
                    $Kgroup_perc[$value0->getID()] += (100-$Kgesperc);
                    break;
                }
            }
        }

    }


   



include('templates/list.php');
?>
