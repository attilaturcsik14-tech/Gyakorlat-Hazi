<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title><?php echo $ablakcim['cim']; ?><?php if(($cim = $keres['szoveg']) != $ablakcim['cim']) echo ' - ' . $cim; ?></title>
   
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
    <div id="user-info">
        <?php if(isset($_SESSION['user_id'])): ?>
            <p>Bejelentkezett: <strong><?= $_SESSION['teljes_nev'] ?> (<?= $_SESSION['login_nev'] ?>)</strong></p>
        <?php else: ?>
            <p>Bejelentkezett: Vendég</p>
        <?php endif; ?>
    </div>
    
    <nav>
        <ul>
            <?php foreach ($oldalak as $url => $oldal): ?>
                <?php 
                    
                    if(!isset($_SESSION['user_id']) && $url == 'kilepes') continue; 
                    if(isset($_SESSION['user_id']) && $url == 'belepes') continue;

                ?>
                <li<?= (($keres == $oldal) ? ' class="active"' : '') ?>>
                    <a href="<?= ($url == '/') ? '.' : "?$url" ?>">
                        <?= $oldal['szoveg'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

    <main>

        <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; <?= date('Y') ?> - <?php echo $ablakcim['cim']; ?></p>
            <p>Web-programozás I. gyakorlat</p>
        </div>
    </footer>
</body>
</html>