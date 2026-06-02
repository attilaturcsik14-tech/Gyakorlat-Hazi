<?php
$reg_uzenet = "";
$login_uzenet = "";


if (isset($_POST['regisztracio'])) {
    $cs_nev = trim($_POST['csaladi_nev']);
    $u_nev = trim($_POST['utonev']);
    $login = trim($_POST['login_nev']);
    $pw = $_POST['jelszo'];

    if (!empty($cs_nev) && !empty($u_nev) && !empty($login) && !empty($pw)) {
        
        $stmt = $dbh->prepare("SELECT id FROM felhasznalok WHERE bejelentkezes = ?");
        $stmt->execute([$login]);
        if ($stmt->fetch()) {
            $reg_uzenet = "<p style='color:red;'>A felhasználónév már foglalt!</p>";
        } else {
            
            $stmt = $dbh->prepare("INSERT INTO felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$cs_nev, $u_nev, $login, password_hash($pw, PASSWORD_DEFAULT)])) {
                $reg_uzenet = "<p style='color:green;'>Sikeres regisztráció! Most már beléphet.</p>";
            }
        }
    } else {
        $reg_uzenet = "<p style='color:red;'>Minden mező kitöltése kötelező!</p>";
    }
}


if (isset($_POST['bejelentkezes'])) {
    $login = trim($_POST['login_nev']);
    $pw = $_POST['jelszo'];

    $stmt = $dbh->prepare("SELECT * FROM felhasznalok WHERE bejelentkezes = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && password_verify($pw, $user['jelszo'])) {
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login_nev'] = $user['bejelentkezes'];
        $_SESSION['teljes_nev'] = $user['csaladi_nev'] . " " . $user['utonev'];
        header("Location: index.php"); 
    } else {
        $login_uzenet = "<p style='color:red;'>Hibás felhasználónév vagy jelszó!</p>";
    }
}
?>

<div style="display: flex; gap: 50px; flex-wrap: wrap;">
    <section style="flex: 1; min-width: 300px;">
        <h2>Bejelentkezés</h2>
        <?php echo $login_uzenet; ?>
        <form method="POST" action="index.php?belepes">
            <label>Felhasználónév:</label><br>
            <input type="text" name="login_nev" required><br><br>
            <label>Jelszó:</label><br>
            <input type="password" name="jelszo" required><br><br>
            <input type="submit" name="bejelentkezes" value="Belépés">
        </form>
    </section>

    <section style="flex: 1; min-width: 300px;">
        <h2>Regisztráció</h2>
        <?php echo $reg_uzenet; ?>
        <form method="POST" action="index.php?belepes">
            <label>Családi név:</label><br>
            <input type="text" name="csaladi_nev" required><br><br>
            <label>Utónév:</label><br>
            <input type="text" name="utonev" required><br><br>
            <label>Felhasználónév (Login):</label><br>
            <input type="text" name="login_nev" required><br><br>
            <label>Jelszó:</label><br>
            <input type="password" name="jelszo" required><br><br>
            <input type="submit" name="regisztracio" value="Regisztráció">
        </form>
    </section>
</div>