<?php
session_start();
require_once 'backend/config.php';
?>

<!doctype html>
<html lang="nl">

    <?php require_once "../head.php";?>
    <title>Attractiepagina / Admin</title>

<body>
    <?php require_once '../header.php'?>
        <div class="wrapper">

        <h1>Register</h1> <!-- Hier staat nu de h1 -->
            <form action="backend/registerController.php" method="POSt">

            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text"name="username"id="username"> 
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password"name="password"id="password">
            </div>
            <div class="form-group">
                <label for="verifyPassword">Bevestig Wachtwoord</label>
                <input type="password" name="verifyPassword" id="verifyPassword" required>
            </div>
            <input class= "submit" type="submit"value="Login">

            </form>
        </div>
</body>
<style>

    .wrapper h1 {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 400px;
        margin: 0 auto 100px;
        margin-top:20px;
        padding: 45px;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 400px;
        margin: 0 auto 100px;
        padding: 45px;
        margin-top: 80px;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    form input {
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        border-radius: 7px;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }
    form .submit {
        text-transform: uppercase;
        outline: 0;
        background: #219150;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        border-radius: 7px;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    form .submit:hover,
    form .submit:active,
    form .submit:focus {
        background: #3ED67D;
    }
</style>
</html>
