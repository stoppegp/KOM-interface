<? 
  

function intRewrite($uri) {
    global $mainDB;
    global $dblink;
    global $catarray;
    global $cparray;
    
    $active['page'] = "home";
    

    $urisplit = explode("/", $uri);
    
    if ($urisplit[1] == "liste") {
        unset($active);
        $active['page'] = "list";
        
        if (in_array(filteruri($urisplit[2]), array_keys($catarray))) {
            $active['cat'] = $catarray[filteruri($urisplit[2])];
        }
        
    }
    

    
    if ($urisplit[1] == "chronik") {
        unset($active);
        $active['page'] = "chronik";
    }
    
    if ($urisplit[1] == "statistik") {
        unset($active);
        $active['page'] = "ausw";
    }
    
    if ($urisplit[1] == "alles") {
        unset($active);
        $active['page'] = "list";
    }
    if ($urisplit[1] == "detail") {
        unset($active);
        $active['page'] = "single";
        $active['issueid'] = $urisplit[2];
    }
    if ($urisplit[1] == "gehalten-gebrochen") {
        unset($active);
        $active['page'] = "geh";
    }       
    
    if (($urisplit[1] == "seite") && (isset($urisplit[2]))) {
        unset($active);
        $active['page'] = "custompage";
        if (in_array($urisplit[2], array_keys($cparray))) {
            $active['custompageid'] = $cparray[$urisplit[2]];
        } else {
            $active['custompageid'] = $urisplit[2];
        }
    } 

    if (in_array($urisplit[1], array_keys($cparray))) {
        unset($active);
        $active['page'] = "custompage";
        $active['custompageid'] = $cparray[$urisplit[1]];
    }
    
    return $active;
}

function intDoLink($page, $array) {
    global $mainDB;
    switch ($page) {
        case "list":
            $url = "liste/";
            if (isset($array['cat'])) {
                $url .= filteruri($mainDB->getCategory($array['cat'])->getName())."/";
            }
        break;
        case "chronik":
            $url = "chronik/";
        break;
        case "ausw":
            $url = "statistik/";
        break;
        case "single":
            $url = "detail/".$array['issueid'];
        break;
        case "geh":
            $url = "gehalten-gebrochen";
        break;
        case "custompage":
            if (isset($array['custompageid'])) {
                $url = "seite/";
                $url .= $array['custompageid']."/";
            }
        break;
        case "home":
            $url = "";
        break;
    }
    //print_r($array);
    
    return SITE_URL."/".$url;
}

function filteruri($str) {
    $str = strtolower($str);
    $uml = array ("ä" => "ae", "ö" => "oe", "ü" => "ue", "ß" => "ss");
    $str = str_replace(array_keys($uml), array_values($uml), $str);
    $str = preg_replace('![^a-z\s\-]!', '', $str);
    $str = str_replace(" ", "-", $str);
    while (strpos(" ".$str, "--") > 0) {
         $str = str_replace("--", "-", $str);
    }   
    return $str;
}
?>