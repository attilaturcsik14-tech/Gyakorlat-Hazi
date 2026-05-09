<?php
session_start();
include('./includes/config.inc.php'); 
//include('./config.php');

$oldal = $_SERVER['QUERY_STRING'];

$oldal = str_replace("page=", "", $oldal);

if ($oldal != "" && isset($oldalak[$oldal])) {
    
    if (file_exists("./templates/pages/{$oldalak[$oldal]['fajl']}.tpl.php")) {
        $keres = $oldalak[$oldal];
    } else {
        $keres = $hiba_oldal;
    }
} else if ($oldal == "") {
    $keres = $oldalak['/'];
} else {
    $keres = $hiba_oldal;
}

include('./templates/index.tpl.php');
?>