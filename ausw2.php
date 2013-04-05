<?php
/* Beginn */
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

    $ausw = new Analysis($database);

                                
/* Verlauf für Grün/Rot */

require_once('helpers/highroller/HighRoller.php');
require_once('helpers/highroller/HighRollerSeriesData.php');
require_once('helpers/highroller/HighRollerAreaChart.php');

    $chart3 = new HighRollerAreaChart();
    $chart3->plotOptions = new HighRollerPlotOptions('area');
    $chart3->chart->renderTo = 'linechart';
    $chart3->title->text = 'Line Chart';
    

    $c2d = array();

    for ($a = $database->getOption("start_datum"); $a < time(); $a += 30*86400) {
        $temp0[$a] = $ausw->getNumberOfPledgestatetypesAtDatum($a);
    }
    foreach ($database->getPledgestatetypes() as $value) {
        $c2d[$value->getOrder()]['id'] = $value->getID();
        foreach ($temp0 as $key => $val) {
            if (!isset($val[$value->getID()])) $val[$value->getID()] = "0";
            $c2d[$value->getOrder()]['data'][$key] = $val[$value->getID()]*$value->getMultipl();
        }
    }
    
    $now = time();
    
    foreach ($c2d as $key => $val) {
        //$sno = $oder0[$key];
        $id = $val['id'];
        $temp00 = null;
            foreach ($val['data'] as $key2 => $val2) {
                if (!isset($valbef) || $valbef != $val2 || true) {
                    //$temp00['data'][] = "[".$key2."000".",".$val2."]";  
                    $ar['x'] = $key2."000";
                    $ar['y'] = $val2;
                    
                    $temp00[] = $ar;
                }
                $valbef = $val2;
            }
            $temp01 = $ausw->getNumberOfPledgestatetypesAtDatum($now);
            if (!isset($temp01[$id])) $temp01[$id] = "0";
            $ar['x'] = $now."000";
            $ar['y'] = $temp01[$id];
            $temp00[] = $ar;

            unset($valbef);

            
            $c3s = new HighRollerSeriesData();
            $c3s->addName($database->getPledgestatetype($id)->getName())->addColor($database->getPledgestatetype($id)->getColour())->addData($temp00);
            $chart3->addSeries($c3s);


    }

    
?>



<? include('templates/ausw2.php'); ?>

<script type="text/javascript">
  <?php echo $chart3->renderChart();?>
</script>
