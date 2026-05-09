<?php
$host = 'ftp.nethely.hu'; // Nethely-nél általában maradhat localhost
$db   = 'sutemenyek'; // Ellenőrizd a Nethely panelen a pontos nevet!
$user = 'cukraszdak'; // Ellenőrizd a Nethely panelen!
$pass = 'JL27DQCt@zdHLju';
function getDB()
{
    static $dbh = null;
    if ($dbh === null) {
        try {
            $dbh = new PDO('mysql.omega;dbname=sutemenyek;charset=utf8', 'Linati', 'asdasd123!+', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8;";
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Adatbázis hiba: " . $e->getMessage());
        }
    }
}
?>
