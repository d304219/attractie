<?php
session_start();
require_once 'backend/config.php';
?>

<!doctype html>
<html lang="nl">

    <?php require_once "../head.php";?>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/loginregister.css">
    <title>Attractiepagina / Admin</title>

<body>
    <?php require_once '../header.php'?>
    <?php
        if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        ?>
        <div class="wrapper">
        <h1>Login</h1>
            <form action="backend/loginController.php" method="POSt">

            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text"name="username"id="username" > 
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password"name="password"id="password" >
            </div>
                
                <input class= "submit" type="submit"value="Login">

            </form>
        </div>
</body>


</html>
