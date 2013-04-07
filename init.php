<?php
include_once('helpers/sto-highchart-parser.class.php');

$active['party'] = $_GET['party'];
$active['cat'] = $_GET['cat'];
$active['pstg'] = $_GET['pstg'];
$active['issueid'] = $_GET['issueid'];

$menu = array(
    array(
        "file"          =>  "home",
        "text"          =>  "Home",
        "active"        =>  array("page" => "home"),
        "clearargs"     =>  true,
    ),
    array(
        "file"          =>  "ausw",
        "text"          =>  "Statistik",
        "active"        =>  array("page" => "ausw"),
        "clearargs"     =>  true,
    ),
    array(
        "file"          =>  "chronik",
        "text"          =>  "Chronik",
        "active"        =>  array("page" => "chronik"),
        "clearargs"     =>  true,
    ),
);

foreach ($mainDB->getCategories("name", "ASC") as $val) {
    if ($val->getDisabled()) continue;
    $menua = array(
        "file"          =>  "list",
        "text"          =>  $val->getName(),
        "active"        =>  array("page" => "list", "cat" => $val->getID()),
        "clearargs"     =>  true,
        "args"          =>  array(
            "cat"   =>  $val->getID(),
        ),
    );
    $menu[] = $menua;
}

registerMenu($menu);
setRewrite("intRewrite");
setDoLink("intDoLink");

?>