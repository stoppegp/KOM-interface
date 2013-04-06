<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <title><?=$KOM_PAGETITLE;?></title>
    <script src="<?=SITE_URL;?>/interface/js/jquery-1.9.1.min.js"></script>
    <meta name="robots" content="noindex">
    <script src="<?=SITE_URL;?>/interface/js/highcharts.js"></script>
    <? echo getScripts(); ?>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>/interface/css/layout.css">
    <? echo getStyles(); ?>
  </head>
  <body>
  <div class="main">
         <div class="header">
              <h1><? echo $mainDB->getOption("site_title"); ?></h1>
              <ul class="menu">
                <?php
                foreach ($KOM_MAINMENU as $key => $val) {
                    
                    $isactive = false;
                    
                    if (is_array($val['active'])) {
                        $isactive = true;
                        foreach ($val['active'] as $key2 => $val2) {
                            if($active[$key2] != $val2) {
                                $isactive = false;
                            }
                        }
                    } else {
                        $isactive = false;
                    }
                    
                    if (!$val['showonlywhenactive'] || $isactive) {
                    ?>
                        <li><a <? echo ($isactive) ? "id=\"active_main\"" : ""; ?>  href="<?=dolink($val['file'], $val['args'], $val['clearargs']);?>"><?=substr($val['text'], 0, 200);?></a></li>
                    <?
                    }
                }
                
                ?>
              
              </ul>
              <div style="clear:both;"></div>
          </div>
          <div class="backg"></div>
          <?php
            if ($KOM_SHOWSIDEMENU == true) {
          ?>
            <div class="content">
          <? } else { ?>
            <div class="content contentwide">
          <? } ?>