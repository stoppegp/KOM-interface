<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <title><?=KOM::$pagetitle;?></title>
    <script src="<?=KOM::$site_url;?>/interface/js/jquery-1.9.1.min.js"></script>
    <meta name="robots" content="noindex">
    <script src="<?=KOM::$site_url;?>/interface/js/highcharts.js"></script>
    <? echo KOM::getScripts(); ?>
    <link rel="stylesheet" type="text/css" href="<?=KOM::$site_url;?>/interface/css/layout.css">
    <? echo KOM::getStyles(); ?>
  </head>
  <body>
  <div class="main">
         <div class="header">
            <img class="headerimg" src="<?=KOM::$site_url;?>/interface/images/kretschmann.png" als="Kretschmann" />
              <div class="title">
                  <h1><? echo KOM::$mainDB->getOption("site_title"); ?></h1>
                  <h2>Wahlversprechen auf dem Prüfstand</h2>
              </div>
                  <div class="meter gradient" style="width: 200px;">
                        <? if ($group_perc[2] > 0) { ?><span class="green" style="width:<? echo $group_perc[2]; ?>%">&nbsp;</span><? } ?>
                        <? if ($group_perc[3] > 0) { ?><span class="red" style="width:<? echo $group_perc[3]; ?>%">&nbsp;</span><? } ?>
                    </div>
              <ul class="menu">
                <?php
                    foreach (KOM::getMenu("main") as $value) {
                        echo "<li><a ";
                        echo ($value['active']) ? "id=\"active_main\"" : ""; 
                        echo "href=\"".$value['link']."\">".$value['text']."</a></li>";
                    }
                ?>

              </ul>
          </div>
          <div class="content">