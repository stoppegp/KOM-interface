
<?php

if (!is_numeric(KOM::$active['issueid'])) KOM::$active['issueid'] = 0;

$database = new Database(KOM::$dblink);
$database->setFilter("issues", KOM::$active['issueid']);
$database->loadContent();

$value0 = $database->getIssues();
$value = array_shift($value0);

include('templates/single.php');
?>
