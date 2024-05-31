<?php
session_start();
require_once '../backend/config.php';

if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: $base_url/admin/login.php?msg=$msg");
    exit;
}

$action = $_POST['action'];

if ($action == 'create') {
    // Validatie
    $title = $_POST['title'];
    $themeland = $_POST['themeland'];
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $min_length = isset($_POST['min_length']) ? $_POST['min_length'] : 0; // Standby waarde ingesteld als min_length leeg is

    if (!is_numeric($min_length) && !is_null($min_length)) {
        $errors[] = "Vul een geldig getal in voor de minimale lengte!";
    }

    if (empty($title)) {
        $errors[] = "Vul een titel in!";
    }

    if (empty($themeland)) {
        $errors[] = "Vul een themagebied in!";
    }

    if (empty($description)) {
        $errors[] = "Vul een beschrijving in!";
    }

    if (isset($_POST['new'])) {
        $new = 1;
    } else {
        $new = 0;
    }

    $target_dir = "../../img/attracties/";
    $target_file = $_FILES['img_file']['name'];
    if (file_exists($target_dir . $target_file)) {
        $errors[] = "Bestand bestaat al!";
    }

    // Eventuele foutmeldingen weergeven
    if (isset($errors)) {
        var_dump($errors);
        die();
    }

    // Bestand verplaatsen naar map
    move_uploaded_file($_FILES['img_file']['tmp_name'], $target_dir . $target_file);

    // Query
    require_once 'conn.php';
    $query = "INSERT INTO rides (title, themeland, img_file, description, new, min_length) VALUES(:title, :themeland, :img_file, :description, :new, :min_length)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":themeland" => $themeland,
        ":description" => $description,
        ":new" => $new,
        ":img_file" => $target_file,
        ":min_length" => $min_length
    ]);

    header("Location: ../attracties/index.php");
    exit;
}

// De rest van je code voor update en delete acties...



if($action == "update")
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $themeland = $_POST['themeland'];
    $description = $_POST['description'];
    $min_length = isset($_POST['min_length']) && is_numeric($_POST['min_length']) ? (int)$_POST['min_length'] : NULL;
    if(isset($_POST['new']))
    {
        $new = 1;
    }
    else
    {
        $new = 0;
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
    $query = "UPDATE rides SET title = :title, themeland = :themeland, img_file = :img_file, description = :description, new = :new, min_length = :min_length WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":themeland" => $themeland,
        ":description" => $description,
        ":new" => $new,
        ":img_file" => $target_file,
        ":min_length" => $min_length,
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
