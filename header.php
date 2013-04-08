<?php
$c = 0;
    
    foreach (KOM::getMenu("main") as $value) {
        $text_menu .= "<li><a ";
        $text_menu .= ($value['active']) ? "id=\"active_main\"" : ""; 
        $text_menu .= "href=\"".$value['link']."\">".$value['text']."</a></li>";
    }
    
    $databaseGR = new Database(KOM::$dblink);
    //$databaseGR->setFilter("parties", array(1,2));
    $databaseGR->loadContent();
    $auswGR = new Analysis($databaseGR);
    
    unset($group_nr);
    unset($group_perc);
    
    /* Aktuelle Verteilung */
    $nr = $auswGR->getCurrentNumberOfPledgestatetypes();
    if (is_array($nr)) {
        $compl = array_sum($nr);
        foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
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
 
 