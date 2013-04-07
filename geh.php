<?php

$database = new Database($dblink);
$database->setFilter("pledgestatetypegroup", 2);

$database->loadContent();

ob_start();
include('get_list.php');
$text_liste1 = ob_get_contents();
ob_end_clean();

$database = new Database($dblink);
$database->setFilter("pledgestatetypegroup", 3);

$database->loadContent();

ob_start();
include('get_list.php');
$text_liste2 = ob_get_contents();
ob_end_clean();

registerStyle('interface/css/getlist.css', true);
registerStyle('interface/css/geh.css', true);


include('templates/geh.php');

?>