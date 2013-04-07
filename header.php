<!DOCTYPE html>
<html lang="de">
  <head>
  <meta charset="utf-8" />
<title>KOM</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="include/highcharts/js/highcharts.js" type="text/javascript"></script>
<style type="text/css">
	body {
		font-family: sans-serif;
		font-size: 12px;
	}
	a {
		color: green;
	}
	.main {
		margin: auto;
		max-width: 900px;
		border: 1px solid black;
		background-color: white;
		height: 100%;
	}
	.header {
		height: 100px;
		background-color: green;
	}
	.header h2 {
		font-size: 1.3em;
		color: #900;
		font-weight: bold;
	}
	.footer {
		height: 50px;
		background-color: green;
		color: white;
		padding: 10px;
		text-align: center;
	}
	.footer a {
		color: white;
	}
	.content {
		//width: 100%;
		margin: 10px;
		clear: both;
		padding-top: 20px;
	}
	.header h1 {
		font-size: 250%;
		color: white;
		text-align: center;
		width: 100%;
		padding-top: 20px;
	}
	.header .mainmenu {
		border-bottom: 2px solid green;
		bottom: 0;
		//height: 30px;
		background-color: #fff;
		//width: 100%;
		line-height: 30px;
		font-size: 110%;
	}
	.header .mainmenu .button {
		height: 30px;
		display: block;
		float: left;
		line-height: 30px;
		padding-left: 7px;
		padding-right: 7px;
		width: auto !important;
		text-decoration: none;
		color: black;
	}
	.header .mainmenu .button:hover, .header .mainmenu .selected {
		background-color: yellow;
	}
	.thema {
	width: 100%;
	padding: 0;
}
.thema .titel, .einzelthema .titel {
	//width: 100%;
	//height: 20px;
	line-height: 20px;
	padding: 5px;
	margin: 0;
	background-color: green;
	font-weight: bold;
	color: white;
}
.einzelthema .unterversprechen {
	margin-top: 10px;
}
.einzelthema blockquote {
	border-left: 8px solid #eaeaea;
	padding-left: 5px;
	padding-top: 5px;
	padding-bottom: 5px;
	margin-left: 10px;
}
.einzelthema .quelle {
	margin: 0;
	padding: 0;
	font-size: 90%;
}

.thema .content, .einzelthema .content {
	padding: 8px;
}
.positionsstatus {
	padding: 0;
	margin: 0;
}
.thema .beschreibung, .thema .content .regierung {
	width: 49%;
	float:left;
}
.thema .status, {
	float:right;
	width: 49%;
}
 .thema .content .opposition {
	float:right;
	width: 49%;
	clear: both;
}
.thema .versprechen {
	clear: both;
	padding-top: 8px;
}
.thema .versprechen div {
	line-height: 20px;
}

.thema .kreis, .einzelthema .kreis {
  float:left;
  width: 10px;
  margin-top: 5px;
  margin-right: 5px;
  height: 10px !important;

  border-radius: 5px;
  background-color: #ff00ff  
}
.einzelthema .kreis {

	height: 20px;
	width: 20px;
	border: 1px solid white;
}

.thema .detaillink, .einzelthema .detaillink {
	text-align: right;
	clear: both;
}
.thema .detaillink a, .einzelthema .detaillink a {
	color: green;
	text-align: right;
}
.thema .titel .meter, .einzelthema .titel .meter {
	float: right;
	width: 80px;
	background-color: white;
	color: green;
	text-align: right;
	//padding-right: 5px;
	position: relative;
	left: 0px;
}
.einzelthema .status .titel, .einzelthema .chronik .titel {
	background-color: #777;
}
.chronik table {
	width: 100%;
}
.chronik table .datum {
	border-right: 3px solid #777;
}
.chronik table {
	border-collapse: separate;
	//border-spacing: 8px;
}
h2 {
	color: green;
}
.einzelthema .versprechen .status {
	background-color: red;
}
table.chronik {
	border: 1px solid black;
	border-collapse: collapse;
	margin-left: 10px;
}
table.chronik td {
	padding: 5px;
}
table.chronik .datum {
	background-color: green;
	color: white;
}
</style>

<?php
if (is_array($header_items)) {
	echo implode("\n", $header_items);
}
?>
</head>
<body>
<div class="main">
<div class="header">
<h1>Kretschmann-O-Meter TEST</h1>
<h2>Diese Seite ist nur zum Sammeln der Versprechen bestimmt und erhebt keinerlei Anspruch auf Korrektheit!</h2>
<div class="mainmenu">
<div class="button" style="float:left;"><strong>Seite: </strong></div>
<?
if ($g_do == "" || $g_do == "list_themen") {
	?> <a href="?do=list_themen&amp;kid=<?=$g_kid;?>" class="button selected">Liste</a> <?
} else {
	?> <a href="?do=list_themen&amp;kid=<?=$g_kid;?>" class="button">Liste</a> <?
}
if ($g_do == "show_stats") {
	?> <a href="?do=show_stats&amp;kid=<?=$g_kid;?>" class="button selected">Statistiken</a> <?
} else {
	?> <a href="?do=show_stats&amp;kid=<?=$g_kid;?>" class="button">Statistiken</a> <?
}
if ($g_do == "show_chronik") {
	?> <a href="?do=show_chronik&amp;kid=<?=$g_kid;?>" class="button selected">Chronik</a> <?
} else {
	?> <a href="?do=show_chronik&amp;kid=<?=$g_kid;?>" class="button">Chronik</a> <?
}
if ($g_do == "show_thema") {
	?> <a href="#" class="button selected">Details</a> <?
}
?>
<div style="clear:both;"></div>
</div>
<div class="mainmenu">
<div class="button" style="float:left;"><strong>Kategorie: </strong></div>
<?
if ($g_do == "show_thema") $g_do2 = "list_themen"; else $g_do2 = $g_do;
if ($g_kid == "" && $g_do != "show_thema") {
	?> <a href="?do=<?=$g_do2;?>&amp;kid=" class="button selected">Alles</a> <?
} else {
	?> <a href="?do=<?=$g_do2;?>&amp;kid=" class="button">Alles</a> <?
}



foreach ($database_akt->kategorien as $key => $val) {
	if ($val->id == $g_kid) {
		?> <a href="?do=<?=$g_do2;?>&amp;kid=<?=$val->id;?>" class="button selected"><?=$val->name;?></a> <?
	} else {
		?> <a href="?do=<?=$g_do2;?>&amp;kid=<?=$val->id;?>" class="button"><?=$val->name;?></a> <?
	}
}
?>
<div style="clear:both;"></div></div>
</div>
<div class="content">