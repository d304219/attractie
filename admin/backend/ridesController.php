<?php
session_start();
require_once '../backend/config.php';
if(!isset($_SESSION['user_id']))
{
    $msg = "Je moet eerst inloggen!";
    header("Location: $base_url/admin/login.php?msg=$msg");
    exit;
}

$action = $_POST['action'];
if($action == 'create')
{
    //Validatie
    $title = $_POST['title'];
    $themeland = $_POST['themeland'];
    $description = isset($_POST['description']) ? $_POST['description'] : ''; // Controleer of de beschrijving is ingesteld

    if(empty($title))
    {
        $errors[] = "Vul een titel in!";
    }

    if(empty($themeland))
    {
        $errors[] = "Vul een themagebied in!";
    }

    if(empty($description)) // Controleer of de beschrijving leeg is
    {
        $errors[] = "Vul een beschrijving in!";
    }

    if(isset($_POST['fast_pass']))
    {
        $fast_pass = 1;
    }
    else
    {
        $fast_pass = 0;
    }

    $target_dir = "../../img/attracties/";
    $target_file = $_FILES['img_file']['name'];
    if(file_exists($target_dir . $target_file))
    {
        $errors[] = "Bestand bestaat al!";
    }

    //Evt. errors dumpen
    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    //Plaats geuploade bestand in map
    move_uploaded_file($_FILES['img_file']['tmp_name'], $target_dir . $target_file);

    //Query
    require_once 'conn.php';
    $query = "INSERT INTO rides (title, themeland, img_file, description, fast_pass ) VALUES(:title, :themeland, :img_file, :description,  :fast_pass)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":themeland" => $themeland,
        ":description" => $description,
        ":fast_pass" => $fast_pass,
        ":img_file" => $target_file,
    ]);

    header("Location: ../attracties/index.php");
    exit;
}


if($action == "update")
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $themeland = $_POST['themeland'];
    $description = $_POST['description'];
    if(isset($_POST['fast_pass']))
    {
        $fast_pass = 1;
    }
    else
    {
        $fast_pass = 0;
    }

    if(empty($_FILES['img_file']['name']))
    {
        $target_file = $_POST['old_img'];
    }
    else
    {
        $target_dir = "../../img/attracties/";
        $target_file = $_FILES['img_file']['name'];
        if(file_exists($target_dir . $target_file))
        {
            $errors[] = "Bestand bestaat al!";
        }

        //Plaats geuploade bestand in map
        move_uploaded_file($_FILES['img_file']['tmp_name'], $target_dir . $target_file);
    }

    //Evt. errors dumpen
    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    //Query
    require_once 'conn.php';
    $query = "UPDATE rides SET title = :title, themeland = :themeland, img_file = :img_file, description = :description, fast_pass = :fast_pass WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":themeland" => $themeland,
        ":description" => $description,
        ":fast_pass" => $fast_pass,
        ":img_file" => $target_file,
        ":id" => $id
    ]);

    header("Location: ../attracties/index.php");
    exit;
}

if($action == "delete")
{
    $id = $_POST['id'];
    require_once 'conn.php';
    $query = "DELETE FROM rides WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id
    ]);
    header("Location: ../attracties/index.php");
    exit;
}
