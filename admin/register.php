<?php
session_start();
require_once 'backend/config.php';
?>

<!doctype html>
<html lang="nl">

    <?php require_once "../head.php"; ?>
    <!-- link to loginregister.css with base url -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/loginregister.css">

    <title>Attractiepagina / Admin</title>

<body>
    <?php require_once '../header.php'; ?>
    <div class="wrapper">

    <?php
        if (isset($_SESSION['msg'])) {
            echo "<p class='msg'>" . $_SESSION['msg'] . "</p>";
            unset($_SESSION['msg']);
        }
        ?>
        <h1>Register</h1> 

        <form action="backend/registerController.php" method="POST">

            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" id="username" > 
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" >
            </div>

            <div class="form-group">
                <label for="verifyPassword">Bevestig wachtwoord</label>
                <input type="password" name="verifyPassword" id="verifyPassword" >
            </div>

            <input class="submit" type="submit" value="Register">

        </form>
    </div>
    <?php require_once '../footer.php'; ?>
</body>
</html>
