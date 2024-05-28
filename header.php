<header>
    <div class="container header">
        <a href="index.php"><img src="<?php echo $base_url; ?>/img/logo-big-v4.png" alt="logo" class="logo"></a>
        <h1>Attracties</h1>
        <nav>     
            <a href="<?php echo $base_url ?>/index.php">Attracties</a>
            <a href="<?php echo $base_url ?>/admin/index.php">Admin</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <p><a href="<?php echo $base_url; ?>/admin/logout.php">Uitloggen</a></p>
                <?php else: ?>
                    <p><a href="<?php echo $base_url; ?>/admin//login.php">Inloggen</a></p>
                    <p><a href="<?php echo $base_url; ?>/admin/register.php">Registreren</a></p>
                <?php endif; ?>
        </nav>
    </div>
</header>

