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
              <h1><? echo KOM::$mainDB->getOption("site_title"); ?></h1>
              <ul class="menu">
                <? echo $text_menu; ?>
              
              </ul>
          </div>
          <div class="content">