<?php
require_once 'conn.php';

$username = $_POST['username'];
$password = $_POST['password'];
$verifyPassword = $_POST['verifyPassword'];

$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([
    ":username" => $username,
]);
$foundUser = $statement->fetch(PDO::FETCH_ASSOC);

if ($foundUser) {
    $msg = "Gebruikersnaam bestaat al.";
    header("Location: ../register.php?msg=$msg");
    die();
}

if ($password != $verifyPassword) {
    $msg = "Wachtwoorden komen niet overeen.";
    header("Location: ../register.php?msg=$msg");
    die();
}

$query = "INSERT INTO users (username, password) VALUES (:username, :password)";
$statement = $conn->prepare($query);
$statement->execute([
    ":username" => $username,
    ":password" => password_hash($password, PASSWORD_DEFAULT),
]);

header("Location: ../login.php?msg=Account succesvol aangemaakt");
die();
?>
