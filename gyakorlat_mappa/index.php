<?php
session_start();
include('./includes/config.inc.php');
include('./config.php'); // Itt olvassuk be a $pdo-t!

$oldal = $_GET['oldal'];

$oldal = str_replace("page=", "", $oldal);

if ($oldal != "" && isset($oldalak[$oldal])) {
    // Ha létezik a fájl, betöltjük
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