<?php
$c = 0;
    
    
    $databaseGR = new Database(KOM::$dblink);
    $databaseGR->loadContent();
    $auswGR = new Analysis($databaseGR);
    
    unset($group_nr);
    unset($group_perc);
    $group_nr = array();
	$group_perc = array();
    /* Aktuelle Verteilung */
    $nr = $auswGR->getCurrentNumberOfPledgestatetypes();
    if (is_array($nr)) {
        $compl = array_sum($nr);
        foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
			$group_nr[$value0->getID()] = 0;
            foreach ($databaseGR->getPledgestatetypegroup($value0->getID())->getPledgestatetypes() as $value) {
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
    
    include('templates/header.php');
 ?>
 
 