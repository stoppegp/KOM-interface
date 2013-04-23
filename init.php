<?php

require_once('helpers/sto_highchart_parser.class.php');

$page[0]['name'] = "chronik";
$page[0]['file'] = "chronik";
$page[1]['name'] = "statistik";
$page[1]['file'] = "ausw";
$page[2]['name'] = "gehalten-gebrochen";
$page[2]['file'] = "geh";
KOM::registerPages($page);



$menu = array(
    array(
        "page"          =>  "home",
        "text"          =>  "Home",
        "active"        =>  array("page" => "home"),
        "clearargs"     =>  true,
    ),
    array(
        "page"          =>  "ausw",
        "text"          =>  "Statistik",
        "active"        =>  array("page" => "ausw"),
        "clearargs"     =>  true,
    ),
    array(
        "page"          =>  "chronik",
        "text"          =>  "Chronik",
        "active"        =>  array("page" => "chronik"),
        "clearargs"     =>  true,
    ),
    array(
        "page"          =>  "geh",
        "text"          =>  "Gehalten / Gebrochen",
        "active"        =>  array("page" => "geh"),
        "clearargs"     =>  true,
    ),
    
);
$c=0;
foreach (KOM::$mainDB->getCategories("name", "ASC") as $val) {
    if ($c++ == 5) break;
    if ($val->getDisabled()) continue;
    $menua = array(
        "page"          =>  "category",
        "text"          =>  $val->getName(),
        "active"        =>  array("page" => "category", "cat" => $val->getID()),
        "clearargs"     =>  true,
        "args"          =>  array(
            "cat"   =>  $val->getID(),
        ),
    );
    $menu[] = $menua;
}
$menu[] = array(
        "page"          =>  "report",
        "text"          =>  "Fehler melden",
        "active"        =>  array("page" => "report"),
    );

KOM::registerMenu("main", $menu);

?>