<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

require_once 'conn.php';
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([":username" => $username]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($statement->rowCount() < 1)
{
    $msg = "Account bestaat niet!";
    header("Location: ../login.php?msg=$msg");
    exit;
}

if(!password_verify($password, $user['password']))
{
    $msg = "Wachtwoord niet juist!";
    header("Location: ../login.php?msg=$msg");
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];

header("Location: ../index.php");
