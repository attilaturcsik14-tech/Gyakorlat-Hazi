<?php
session_start();
require_once('includes/config.inc.php');
include('./includes/config.inc.php');
include('./config.php'); // Itt olvassuk be a $pdo-t!
$oldal = '/';
if (isset($_GET['page'])) {
    // Ha a modern formátumot használjuk: index.php?page=crud_add
    $oldal = $_GET['page'];
} else {
    // Ha a régi formátumot használjuk: index.php?belepes
    $parts = explode('&', $_SERVER['QUERY_STRING']);
    if (!empty($parts[0]) && strpos($parts[0], '=') === false) {
        $oldal = $parts[0];
    }
}

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