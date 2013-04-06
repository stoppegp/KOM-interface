<?php
$active['party'] = $_GET['party'];
$active['cat'] = $_GET['cat'];
$active['pstg'] = $_GET['pstg'];
$active['issueid'] = $_GET['issueid'];

$menu = array(
    array(
        "file"          =>  "home",
        "text"          =>  "Home",
        "active"        =>  array("home"),
        "clearargs"     =>  true,
    ),
    array(
        "file"          =>  "list",
        "text"          =>  "Liste",
        "active"        =>  array("list"),
    ),
    array(
        "file"          =>  "ausw",
        "text"          =>  "Statistik",
        "active"        =>  array("ausw"),
    ),
    array(
        "file"          =>  "chronik",
        "text"          =>  "Chronik",
        "active"        =>  array("chronik"),
    ),
    array(
        "file"          =>  "single",
        "text"          =>  "Einzelansicht",
        "active"        =>  array("single"),
        "showonlywhenactive" => true,
    ),
);

registerMenu($menu);

?>