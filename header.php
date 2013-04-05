<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <title><?=$KOM_PAGETITLE;?></title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <? echo getScripts(); ?>
    <link rel="stylesheet" type="text/css" href="css/layout.css">
  </head>
  <body>
      <div class="main">
          <div class="header">
              <h1><? echo $mainDB->getOption("site_title"); ?></h1>
              <ul class="menu">
                <?php
                foreach ($KOM_MAINMENU as $key => $val) {
                    if (!$val['showonlywhenactive'] || (in_array($active['page'], $val['active']))) {
                    ?>
                        <li><a <? echo (in_array($active['page'], $val['active'])) ? "id=\"active_main\"" : ""; ?>  href="<?=dolink($val['file'], $val['args'], $val['clearargs']);?>"><?=$val['text'];?></a></li>
                    <?
                    }
                }
                
                ?>
              
              </ul>
              <div style="clear:both;"></div>
          </div>
          <?php
            if ($KOM_SHOWSIDEMENU == true) {
          ?>
            <div class="content">
          <? } else { ?>
            <div class="content contentwide">
          <? } ?>