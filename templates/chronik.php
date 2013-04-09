<?php KOM::registerStyle('interface/css/chronik.css', true); ?>

<h1>Chronik</h1>
<div class="chronikside">
    <h2>Zuletzt gebrochene Versprechen</h2>
    <table class="chronik umgesetzt">
    <?php
        $c = 0;
        foreach ($pledgearray_geb as $val) {
            if ($c++ > 5) break;
            echo "<tr id=\"pledge-\" style=\"vertical-align:top;\"><td class=\"datum\"><a href=\"".KOM::dolink("single", array("issueid" => $val['pledge']->getIssue()->getID()))."#pledge-".$val['pledge']->getID()."\">".date("d.m.Y", $val['datum'])."</a></td><td><a href=\"".KOM::dolink("single", array("issueid" => $val['pledge']->getIssue()->getID()))."#pledge-".$val['pledge']->getID()."\">".$val['pledge']->getParty()->getName().": <strong>".$val['pledge']->getName()."</strong></a></td>";
        }
    ?>
    </table>
</div>
<div class="chronikside">
    <h2>Zuletzt umgesetzte Versprechen</h2>
    <table class="chronik umgesetzt">
    <?php
        $c = 0;
        foreach ($pledgearray_geh as $val) {
            if ($c++ > 5) break;
            echo "<tr id=\"pledge-\" style=\"vertical-align:top;\"><td class=\"datum\"><a href=\"".KOM::dolink("single", array("issueid" => $val['pledge']->getIssue()->getID()))."#pledge-".$val['pledge']->getID()."\">".date("d.m.Y", $val['datum'])."</a></td><td><a href=\"".KOM::dolink("single", array("issueid" => $val['pledge']->getIssue()->getID()))."#pledge-".$val['pledge']->getID()."\">".$val['pledge']->getParty()->getName().": <strong>".$val['pledge']->getName()."</strong></a></td>";
            echo "</tr>";
        }
    ?>
    </table>
</div>
<div style="clear:both;padding-top: 20px;">
    <h2>Letzte Ereignisse</h2>
    <table class="chronik">
    
    <?php
        $c = 0;
        foreach ($states as $value) {
            echo "<tr id=\"state-".$value->getID()."\" style=\"vertical-align:top;\"><td class=\"datum\"><a href=\"".KOM::dolink("single", array("issueid" => $value->getIssue()->getID()))."#state-".$value->getID()."\">".date("d.m.Y", $value->getDatum())."</a></td><td><a href=\"".KOM::dolink("single", array("issueid" => $value->getIssue()->getID()))."#state-".$value->getID()."\">".$value->getIssue()->getName().":<br><strong>".$value->getName()."</strong></a></td>";
            echo "</tr>";
        }
    ?>
    </table>
</div>