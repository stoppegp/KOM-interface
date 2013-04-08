<?php

$database = new Database(KOM::$dblink);
$database->setFilter("pledgestatetypegroup", 2);

$database->loadContent();

ob_start();
include('get_list.php');
$text_liste1 = ob_get_contents();
ob_end_clean();

$database = new Database(KOM::$dblink);
$database->setFilter("pledgestatetypegroup", 3);

$database->loadContent();

ob_start();
include('get_list.php');
$text_liste2 = ob_get_contents();
ob_end_clean();

KOM::registerStyle('interface/css/getlist.css', true);
KOM::registerStyle('interface/css/geh.css', true);


include('templates/geh.php');

?>