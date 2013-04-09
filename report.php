<?php

$database = new Database(KOM::$dblink);
$database->loadContent();

$oldarray['issueid'] = KOM::$active['issueid'];

if ($_POST['report']['do'] == "report") {
    $workarray = $_POST['report'];
    if (trim($workarray['text']) == "") {
        $report_error = true;
        $oldarray = $workarray;
        include('templates/report.php');
    } else {
        $userm = KOM::$dblink->Select("users", "email", "WHERE `email` <> ''");
        if ($workarray['issueid'] == 0) {
            $issuetext = "Allgemeines";
        } else {
            $issue = $database->getIssue($workarray['issueid']);
            if ($issue) {
                $issuetext = "#".$workarray['issueid'].": ".$issue->getName();
            }
        }
        include('templates/report_mail.php');
        if (is_array($userm)) {
            foreach ($userm as $val) {
                mail($val->email, "KOM: Report", utf8_decode($mailtext));
            }
        }
        include('templates/report_success.php');
    }
} else {

    include('templates/report.php');
    
}

?>