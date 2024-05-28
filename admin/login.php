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
    <?php
        if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        ?>
        <div class="wrapper">

            <form action="backend/loginController.php" method="POSt">

            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text"name="username"id="username" placeholder="user1 t/m 4"> 
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password"name="password"id="password" placeholder="pass1 t/m 4">
            </div>
                
                <input class= "submit" type="submit"value="Login">

            </form>
        </div>
</body>

<style>
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
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
  }
   
  form .submit:hover,.form .submit:active,form .submit:focus {
    background: #3ED67D;
  }
</style>

</html>
