<h1>Fehler melden</h1>
<?php
if ($report_error) {
    echo "<p class=\"error\">Du musst einen Text eingeben.</p>";
}
?>
<form method="post">
<table>
<tr>
<td>Dein Name: </td>
<td>
<input name="report[name]" type="text" value="<?=$oldarray['name'];?>" />
</td>
</tr>
<tr>
<td>Deine E-Mail-Adresse: </td>
<td>
<input name="report[email]" type="text" value="<?=$oldarray['email'];?>" />
</td>
</tr>
<tr>
<td>Thema: </td>
<td>
<select name="report[issueid]">

<?php
    $issues = $database->getIssues("category");
    echo "<option value=\"0\">Allgemeines</option>";
    foreach ($database->getCategories("name") as $val1) {
        if ($val1->getDisabled()) continue;
        echo "<optgroup label=\"".$val1->getName()."\">";
        foreach ($issues[$val1->getID()] as $val2) {
            if ($val2->getID() == $oldarray['issueid']) {
                echo "<option selected=\"selected\" value=\"".$val2->getID()."\">".$val2->getName()."</option>";
            } else {
                echo "<option value=\"".$val2->getID()."\">".$val2->getName()."</option>";
            }
        }
        echo "</optgroup>";
    }

?>

</select>

</td>
</tr>
<tr>
<td>Text:</td>
<td><textarea name="report[text]"><?=$oldarray['text'];?></textarea></td>
</tr>
<tr>
<td></td>
<td><input type="submit" /></td>
</tr>
</table>
<input type="hidden" name="report[do]" value="report" />
</form>