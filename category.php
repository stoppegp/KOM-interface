<?php
$database = new Database(KOM::$dblink);
$databaseGR = new Database(KOM::$dblink);
$databaseK = new Database(KOM::$dblink);

if (isset(KOM::$active['cat']) && is_numeric(KOM::$active['cat'])) {
    $database->setFilter("categories", KOM::$active['cat']);
    $databaseK->setFilter("categories", KOM::$active['cat']);
    $databaseGR->setFilter("categories", KOM::$active['cat']);
}
if (isset(KOM::$active['pstg']) && is_numeric(KOM::$active['pstg'])) {
    $database->setFilter("pledgestatetypegroup", KOM::$active['pstg']);
    $databaseK->setFilter("pledgestatetypegroup", KOM::$active['pstg']);
    $databaseGR->setFilter("pledgestatetypegroup", KOM::$active['pstg']);
}

$catname = KOM::$mainDB->getCategory(KOM::$active['cat'])->getName();

$databaseGR->setFilter("parties", array(1,2));
$databaseK->setFilter("parties", array(3));

$database->loadContent();
$databaseGR->loadContent();
$databaseK->loadContent();

KOM::registerStyle('interface/css/list.css', true);
ob_start();
include('get_list.php');
$text_liste = ob_get_contents();
ob_end_clean();


    $auswGR = new Analysis($databaseGR);
    $auswK = new Analysis($databaseK);

    /* Aktuelle Verteilung */
    $nr = $auswGR->getCurrentNumberOfPledgestatetypes();
	$group_nr = array();
	$group_perc = array();
    if (is_array($nr)) {
        $compl = array_sum($nr);
        foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
			$group_nr[$value0->getID()] = 0;
            foreach ($databaseGR->getPledgestatetypegroup($value0->getID())->getPledgestatetypes() as $value) {
                if (isset($nr[$value->getID()])) {
					$group_nr[$value0->getID()] += $nr[$value->getID()];
				}
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
		$Kgroup_nr = array();
		$Kgroup_perc = array();
        foreach ($databaseK->getPledgestatetypegroups() as $value0) {
			$Kgroup_nr[$value0->getID()] = 0;
            foreach ($databaseK->getPledgestatetypegroup($value0->getID())->getPledgestatetypes() as $value) {
				if (isset($Knr[$value->getID()])) {
					$Kgroup_nr[$value0->getID()] += $Knr[$value->getID()];
				}
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


   



include('templates/category.php');
?>
