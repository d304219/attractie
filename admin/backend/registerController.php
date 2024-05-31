<?php
session_start();
require_once 'conn.php';

$username = $_POST['username'];
$password = $_POST['password'];
$verifyPassword = $_POST['verifyPassword'];

// Controleer of geen van de invoervelden zijn ingevuld
if (empty($username) && empty($password) && empty($verifyPassword)) {
    $_SESSION['msg'] = "Geen velden zijn ingevuld.";
    header("Location: ../register.php");
    die();
}

// Controleer of alle invoervelden zijn ingevuld
if (empty($username) || empty($password) || empty($verifyPassword)) {
    $_SESSION['msg'] = "Vul alle velden in.";
    header("Location: ../register.php");
    die();
}

// Controleer of de wachtwoorden overeenkomen
if ($password != $verifyPassword) {
    $_SESSION['msg'] = "Wachtwoorden komen niet overeen.";
    header("Location: ../register.php");
    die();
}

// Controleer of de gebruikersnaam al bestaat
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([
    ":username" => $username,
]);
$foundUser = $statement->fetch(PDO::FETCH_ASSOC);

if ($foundUser) {
    $_SESSION['msg'] = "Gebruikersnaam bestaat al.";
    header("Location: ../register.php");
    die();
}

// Voeg de nieuwe gebruiker toe aan de database
$query = "INSERT INTO users (username, password) VALUES (:username, :password)";
$statement = $conn->prepare($query);
$statement->execute([
    ":username" => $username,
    ":password" => password_hash($password, PASSWORD_DEFAULT),
]);

$_SESSION['msg'] = "Account succesvol aangemaakt";
header("Location: ../login.php");
die();
?>
