<?php
$c = 0;
/*
    foreach ($KOM_MAINMENU as $key => $val) {
        
        if ($c++ == 10) break;
        $isactive = false;
        
        if (is_array($val['active'])) {
            $isactive = true;
            foreach ($val['active'] as $key2 => $val2) {
                if(KOM::$active[$key2] != $val2) {
                    $isactive = false;
                }
            }
        } else {
            $isactive = false;
        }
        
        if (!$val['showonlywhenactive'] || $isactive) {
            $text_menu .= "<li><a ";
            $text_menu .= ($isactive) ? "id=\"active_main\"" : ""; 
            $text_menu .= "href=\"".KOM::dolink($val['file'], $val['args'], $val['clearargs'])."\">".substr($val['text'], 0, 200)."</a></li>";
        }
    }
    */
    
    foreach (KOM::getMenu("main") as $value) {
        $text_menu .= "<li><a ";
        $text_menu .= ($value['active']) ? "id=\"active_main\"" : ""; 
        $text_menu .= "href=\"".$value['link']."\">".$value['text']."</a></li>";
    }
    include('templates/header.php');
 ?>
 
 