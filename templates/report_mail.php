<?php
$mailtext = <<< MAIL

Über das Webformular wurde ein Fehler im Kretschmann-O-Meter gemeldet:

Name: {$workarray['name']}
E-Mail: {$workarray['email']}

Thema: {$issuetext}
Text:
{$workarray['text']}


MAIL;

?>