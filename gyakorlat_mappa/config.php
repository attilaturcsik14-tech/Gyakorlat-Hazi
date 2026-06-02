<?php
$host = 'ftp.nethely.hu'; // Nethely-nél általában maradhat localhost
$db   = 'sutemenyek'; // Ellenőrizd a Nethely panelen a pontos nevet!
$user = 'sutemenyek'; // Ellenőrizd a Nethely panelen!

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8;";
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Adatbázis hiba: " . $e->getMessage());
}
?>
