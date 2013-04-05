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

$ausw = new Analysis($database);

$chart1data = array();

$temp0 = $ausw->getCurrentNumberOfPledgestatetypes();
foreach ($database->getPledgestatetypes() as $value) {
    $o0 = $value->getOrder();
    $tempar['name'] = $value->getName();
    $tempar['color'] = $value->getColour();
    $tempar['y'] = $temp0[$value->getID()];
    if (($tempar['y']*($value->getMultipl())) > 0) {
        $t0ar[$o0] = $tempar;
    }
}
if (is_array($t0ar)) {
    ksort($t0ar);
    foreach ($t0ar as $val) {
        $chart1data[] = $val;
    }
}

$c2d = array();

for ($a = $database->getOption("start_datum"); $a < time(); $a += 30*86400) {
    unset($temp0);
    $temp0 = $ausw->getNumberOfPledgestatetypesAtDatum($a);
    if (is_array($temp0)) {
        foreach ($database->getPledgestatetypes() as $value) {
            if (!isset($temp0[$value->getID()])) $temp0[$value->getID()] = "0";
            $c2d[$value->getID()][$a] = $temp0[$value->getID()]*$value->getMultipl();
        }
    }
}



$chart = new Highchart();
$chart->title->text = "";
$chart->chart->renderTo = "container";
$chart->series[] = array('type' => 'pie', 'data' => $chart1data);

$chart2 = new Highchart();
$chart2->title->text = "";
$chart2->chart->renderTo = "container2";
$chart2->chart->type = "area";
$chart2->chart->zoomType = 'x';
$chart2->plotOptions->area->stacking = "normal";
$chart2->plotOptions->area->marker->enabled = false;
$chart2->plotOptions->area->marker->symbol = "circle";
$chart2->plotOptions->area->fillOpacity = 0.6;
$chart2->plotOptions->area->lineColor = "#ffffff";
$chart2->plotOptions->area->lineWidth = 0;
$chart2->plotOptions->area->trackByArea = true;
$chart2->xAxis->type = "datetime";
$chart2->yAxis->title = "";
$chart2->yAxis->endOnTick = false;
$chart2->xAxis->max = $database->getOption("end_datum")."000";
$now = time();


require_once('helpers/highroller/HighRoller.php');
require_once('helpers/highroller/HighRollerSeriesData.php');
require_once('helpers/highroller/HighRollerAreaChart.php');

$chartData = array(5324, 7534, 6234, 7234, 8251, 10324);
$chartData = array(
    array(
        'x' => 1,
        'y' => 5,
    ),
    array(
        'x' => 5,
        'y' => 3,
    ),
);
$chart3 = new HighRollerAreaChart();
$chart3->chart->renderTo = 'linechart';
$chart3->title->text = 'Line Chart';







foreach ($c2d as $key => $val) {

    $sno = $database->getPledgestatetype($key)->getOrder();
    $temp00 = null;
    $temp00 = array(
        'name' => $database->getPledgestatetype($key)->getName(),
        'color' => $database->getPledgestatetype($key)->getColour(),
        'opacity' => '0.1',
    );
    if (!array_sum($val) == 0) {
        foreach ($val as $key2 => $val2) {
            if (!isset($valbef) || $valbef != $val2 || true) {
                $temp000['x'] = $key2."000";
                $temp000['y'] = $val2;
                $temp00['data'][] = $temp000;  
            }
            $valbef = $val2;
        }
        $temp01 = $ausw->getNumberOfPledgestatetypesAtDatum($now);
        if (!isset($temp01[$key])) $temp01[$key] = "0";
        //$temp00['data'][] = "[".$now."000".",".$temp01[$key]."]";  
        unset($valbef);
        $arsno[$sno] = $temp00;
    }
}
if (is_array($t0ar)) {
    krsort($arsno);
    foreach ($arsno as $val) {
            $chart2->series[] = $val;
            $c3s = new HighRollerSeriesData();
            $c3s->addName($val['name'])->addColor($val['color'])->addData($val['data']);
            $chart3->addSeries($c3s);
    }
}



?>
<div style="width: 100%;" id="container"></div>
<div style="width: 100%;" id="container2"></div>
<div style="width: 100%;" id="linechart"></div>

<script type="text/javascript">
<?
echo $chart->render();
$temp1 = $chart2->render();
$temp1 = str_replace('"[', '[', $temp1);
$temp1 = str_replace(']"', ']', $temp1);
echo $temp1;
?>
</script>
<script type="text/javascript">
  <?php echo $chart3->renderChart();?>
</script>
<?


?>
