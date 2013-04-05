<?php
/* Statistik für Grün/Rot */
    $databaseGR = new Database($dblink);
    $databaseGR->setFilter("parties", array(1,2));
    $databaseGR->loadContent();

    $auswGR = new Analysis($databaseGR);

    /* Aktuelle Verteilung */
    $nrGR = $auswGR->getCurrentNumberOfPledgestatetypes();
    
    foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
        foreach ($databaseGR->getPledgestatetypegroup($value0->getID())->getPledgestatetypeLinks() as $value) {
            $group_nrGR[$value0->getID()] += $nrGR[$value->getID()];
        }
    }

    

/* Statistik für die Koalition */

    $databaseK = new Database($dblink);
    $databaseK->setFilter("parties", array(3));
    $databaseK->loadContent();

    $auswK = new Analysis($databaseK);

    /* Aktuelle Verteilung */
    $nrK = $auswK->getCurrentNumberOfPledgestatetypes();
    
    foreach ($databaseK->getPledgestatetypegroups() as $value0) {
        foreach ($databaseK->getPledgestatetypegroup($value0->getID())->getPledgestatetypeLinks() as $value) {
            $group_nrK[$value0->getID()] += $nrK[$value->getID()];
        }
    }


/* Verteilungsdiagramm für Grün/Rot */
    $chart1data = array();
    foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
        $tempar['name'] = $value0->getName();
        $tempar['color'] = $value0->getColour();
        $tempar['url'] = dolink("list", array("pst" => $value0->getID()));
        $tempar['y'] = $group_nrGR[$value0->getID()];
        $chart1data[] = $tempar;
    }
    
    /* Diagramm erstellen */
        $chart = new KOM_Highchart("GR_verteilung");
        $chart->options['title']['text'] = "";
        $chart->options['plotOptions']['pie']['dataLabels']['enabled'] = false;
        $chart->options['plotOptions']['pie']['dataLabels']['color'] = "#f00";
        $chart->options['plotOptions']['pie']['dataLabels']['connectorColor'] = "#00f";
        $chart->activateLinks();
        $chart->options['series'][] = array(   'type' => 'pie',
                                    'data' => $chart1data,
                                );
                                
/* Verlauf für Grün/Rot */
    $c2d = array();

    for ($a = $databaseGR->getOption("start_datum"); $a < time(); $a += 30*86400) {
        unset($temp0);
        $temp0 = $auswGR->getNumberOfPledgestatetypesAtDatum($a);
        if (is_array($temp0)) {
            foreach ($databaseGR->getPledgestatetypegroups() as $val0) {
                foreach ($databaseGR->getPledgestatetypegroup($val0->getID())->getPledgestatetypeLinks() as $value) {
                    if (!isset($temp0[$value->getID()])) $temp0[$value->getID()] = "0";
                    $c2d[$val0->getID()][$a] += $temp0[$value->getID()]*$value->getMultipl();
                }
            }
        }
    }
    
    $now = time();
    
    $oder0 = array(
                2=>1,
                1=>2,
                3=>3,
            );
    
    foreach ($c2d as $key => $val) {
        $sno = $oder0[$key];
        $temp00 = null;
        $temp00 = array(
            'name' => $databaseGR->getPledgestatetypegroup($key)->getName(),
            'color' => $databaseGR->getPledgestatetypegroup($key)->getColour(),
            'fillOpacity' => "0.5",
            'url' => dolink("list", array("pst" => $key))
        );
        if (!array_sum($val) == 0) {
            foreach ($val as $key2 => $val2) {
                if (!isset($valbef) || $valbef != $val2 || true) {
                    //$temp00['data'][] = "[".$key2."000".",".$val2."]";  
                    $ar['x'] = $key2."000";
                    $ar['y'] = $val2;
                    
                    $temp00['data'][] = $ar;
                }
                $valbef = $val2;
            }
            $temp01 = $auswGR->getNumberOfPledgestatetypesAtDatum($now);
            foreach ($databaseGR->getPledgestatetypegroup($key)->getPledgestatetypeLinks() as $value) {
                if (!isset($temp01[$value->getID()])) $temp01[$value->getID()] = "0";
                $temp010[$key] += $temp01[$value->getID()];
            }
            unset($valbef);
            $arsno[$sno] = $temp00;
        }
    }
    krsort($arsno);

    
    /* Diagramm erstellen */
            
        $chart2 = new KOM_Highchart("GR_verlauf");
        $chart2->options['chart']['type'] = "area";
        $chart2->options['title']['text'] = "";
        $chart2->options['plotOptions']['area']['stacking'] = "normal";
        $chart2->options['plotOptions']['area']['trackByArea'] = true;
        $chart2->options['plotOptions']['area']['marker']['enabled'] = false;
        $chart2->options['plotOptions']['area']['marker']['symbol'] = "circle";
        $chart2->options['xAxis']['max'] = $databaseGR->getOption("end_datum")."000";
        $chart2->options['xAxis']['type'] = "datetime";
        $chart2->options['yAxis']['min'] = 0;
        $chart2->options['yAxis']['endOnTick'] = false;
        $chart2->activateLinks("series");
    /*    $chart2 = new Highchart();
        $chart2->title->text = "";
        $chart2->chart->renderTo = "GR_verlauf";
        $chart2->chart->type = "area";
        $chart2->plotOptions->area->stacking = "normal";
        $chart2->plotOptions->area->marker->enabled = false;
        $chart2->plotOptions->area->marker->symbol = "circle";
        $chart2->plotOptions->area->lineColor = "#ffffff";
        $chart2->plotOptions->area->lineWidth = 0;
        $chart2->plotOptions->area->trackByArea = true;
        $chart2->plotOptions->series->fillOpacity = "0.1";
        $chart2->xAxis->type = "datetime";
        $chart2->xAxis->max = $databaseGR->getOption("end_datum")."000";
        $chart2->yAxis->title = "";
        $chart2->yAxis->min = 0;
        $chart2->yAxis->endOnTick = false;
        $chart2->yAxis->max = array_sum($auswGR->getCurrentNumberOfPledgestatetypes());
*/
        foreach ($arsno as $val) {
            $chart2->options['series'][] = $val;
        }
    
?>



<? include('templates/home.php'); ?>

<script type="text/javascript">
<?
echo $chart->render();
echo $chart2->render();

//$temp1 = $chart2->render();
$temp1 = str_replace('"[', '[', $temp1);
$temp1 = str_replace(']"', ']', $temp1);
echo $temp1;
?>
</script>
