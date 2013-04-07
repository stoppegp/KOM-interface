<? 
function intRewrite($uri) {
    global $mainDB;
    
    $active['page'] = "home";
    
    foreach ($mainDB->getCategories() as $val) {
        $catarray[filteruri($val->getName())] = $val->getID();
    }
    $urisplit = explode("/", $uri);
    
    if (in_array(filteruri($urisplit[1]), array_keys($catarray))) {
        unset($active);
        $active['page'] = "list";
        $active['cat'] = $catarray[filteruri($urisplit[1])];
    }
    
    if (in_array(preg_replace('![^0-9]!', '', $urisplit[1]), array_values($catarray))) {
        unset($active);
        $active['page'] = "list";
        $active['cat'] = preg_replace('![^0-9]!', '', $urisplit[1]);
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

    
    return $active;
}

function intDoLink($page, $array) {
    global $mainDB;
    switch ($page) {
        case "list":
            $url = "alles/";
            if (isset($array['cat'])) {
                $url = filteruri($mainDB->getCategory($array['cat'])->getName())."/";
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