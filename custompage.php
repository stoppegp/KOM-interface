<?php
if (is_numeric($active['custompageid'])) {
    $pages = $dblink->Select("custompages", "*", "WHERE `id`=".$active['custompageid']);
    if (isset($pages[0])) {
        echo $pages[0]->content;
    }
}

?>