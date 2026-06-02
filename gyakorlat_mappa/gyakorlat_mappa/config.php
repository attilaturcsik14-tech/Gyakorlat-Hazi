<?php
$is_local = true;

try {
    if ($is_local) {
        // Helyi XAMPP beállítások
        $host = 'localhost';
        $dbname = 'cukraszda';
        $user = 'root';
        $password = '';
    } else {
        // Nethely.hu éles beállítások (a kapott adatok alapján) [cite: 63, 65, 66, 67, 68]
        $host = 'localhost'; // Nethelyen is localhost marad a host [cite: 65]
        $dbname = 'sutemenyek'; // [cite: 66]
        $user = 'Linati'; // [cite: 67]
        $password = 'asdasd123!+'; // [cite: 68]
    }

    // A kötelezően előírt PDO csatlakozási struktúra
    $dbh = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

} catch (PDOException $e) {
    die("Adatbázis hiba: " . $e->getMessage());
}
?>
