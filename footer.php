</div>
<?
if ($KOM_SHOWSIDEMENU == true) {
?>
<div class="sidemenu">


  <h2>Kategorie</h2>
  <ul class="menu">
  
  <?php
    if (!is_numeric($active['cat'])) {
        $acac = "id=\"active_cat\"";
    } else {
        $acac = "";
    }
  ?>
  <li><a <?=$acac;?> href="<?=dolink("", array("cat" => ""));?>">Alles</a></li>
  <?php
  
  foreach ($mainDB->getCategories("name") as $value) {
    if ($value->getID() == $active['cat']) {
        $acac = "id=\"active_cat\"";
    } else {
        $acac = "";
    }
    echo "<li><a $acac href=\"".dolink("", array("cat" => $value->getID()))."\">".$value->getName()."</a></li>";
  }
  
  ?>
  </ul>
   <h2>Partei</h2>
  <ul class="menu">
  <?php
    if (!is_numeric($active['party'])) {
        $acac = "id=\"active_party\"";
    } else {
        $acac = "";
    }
  ?>
  <li><a <?=$acac;?> href="<?=dolink("", array("party" => ""));?>">Alle</a></li>
  <?php
  foreach ($mainDB->getParties("order") as $value) {
    if ($value->getDoValue() == 0) continue;
    if ($value->getID() == $active['party']) {
        $acac = "id=\"active_party\"";
    } else {
        $acac = "";
    }
    echo "<li><a $acac href=\"".dolink("", array("party" => $value->getID()))."\">".$value->getName()."</a></li>";
  }
  
  ?>
  </ul>
  <h2>Art</h2>
  <ul class="menu">
  <?php
    if (!is_numeric($active['pst'])) {
        $acac = "id=\"active_pst\"";
    } else {
        $acac = "";
    }
  ?>
  <li><a <?=$acac;?> href="<?=dolink("", array("pstg" => ""));?>">Alles</a></li>
  <?php
  foreach ($mainDB->getPledgestatetypegroups() as $value) {
    if ($value->getID() == $active['pst']) {
        $acac = "id=\"active_pst\"";
    } else {
        $acac = "";
    }
    echo "<li><a $acac href=\"".dolink("", array("pstg" => $value->getID()))."\">".$value->getName()."</a></li>";
  }
  
  ?>
  </ul>

</div>
  <?php
  }
  ?>
<div style="clear: both;"></div>
</div>
</body>
</html>