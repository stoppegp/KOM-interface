<?php
include_once('helpers/sto-highchart-parser.class.php');

KOM::$active['party'] = $_GET['party'];
KOM::$active['cat'] = $_GET['cat'];
KOM::$active['pstg'] = $_GET['pstg'];
KOM::$active['issueid'] = $_GET['issueid'];

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
        "page"          =>  "custompage",
        "text"          =>  "Impressum",
        "args"          =>  array("custompageid" => 1),
        "active"        =>  array("page" => "custompage", "custompageid" => 1),
        "clearargs"     =>  true,
    ),
);

foreach (KOM::$mainDB->getCategories("name", "ASC") as $val) {
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

KOM::registerMenu("main", $menu);

?>