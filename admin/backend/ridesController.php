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
    $min_length = isset($_POST['min_length']) && is_numeric($_POST['min_length']) ? (int)$_POST['min_length'] : NULL; // Set default value to NULL if min_length is empty

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

    // Query
    require_once 'conn.php';
 // Query for inserting data into the database
$query = "INSERT INTO rides (title, themeland, img_file, description, min_length) VALUES(:title, :themeland, :img_file, :description, :min_length)";
$statement = $conn->prepare($query);
$statement->execute([
    ":title" => $title,
    ":themeland" => $themeland,
    ":description" => $description,
    ":img_file" => $target_file,
    ":min_length" => $min_length
]);

// Fetch the ID of the newly inserted row
$newly_inserted_id = $conn->lastInsertId();

// Append the ID to the file name
$target_file = $newly_inserted_id . '_' . $target_file;

// Update the database with the new file name
$query = "UPDATE rides SET img_file = :img_file WHERE id = :id";
$statement = $conn->prepare($query);
$statement->execute([
    ":img_file" => $target_file,
    ":id" => $newly_inserted_id
]);

$destination_path = $target_dir . $target_file;
if (move_uploaded_file($_FILES['img_file']['tmp_name'], $destination_path)) {
    // File moved successfully
} else {
    // File not moved
    echo "Error moving file to destination.";
}

header("Location: ../attracties/index.php");
exit;
}

// De rest van je code voor update en delete acties...
if ($action == "update") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $themeland = $_POST['themeland'];
    $description = $_POST['description'];
    $min_length = isset($_POST['min_length']) && is_numeric($_POST['min_length']) ? (int)$_POST['min_length'] : NULL;

    // Query to fetch the current image file name
    require_once 'conn.php';
    $query = "SELECT img_file FROM rides WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);
    $ride = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$ride) {
        echo "Ride not found.";
        exit;
    }

    $current_img_file = $ride['img_file'];
    $target_file = $current_img_file; // Default to the current file name

    // Check if a new file is uploaded
    if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../../img/attracties/";
        $target_file_name = $_FILES['img_file']['name'];
        $target_file = $id . '_' . $target_file_name;

        // Check if the file already exists
        if (file_exists($target_dir . $target_file)) {
            $errors[] = "File already exists!";
        }

        // Delete the old file if it exists
        if (file_exists($target_dir . $current_img_file)) {
            if (!unlink($target_dir . $current_img_file)) {
                echo "Error deleting old file.";
                exit;
            }
        }

        // Move the uploaded file to the target directory
        $destination_path = $target_dir . $target_file;
        if (!move_uploaded_file($_FILES['img_file']['tmp_name'], $destination_path)) {
            echo "Error moving file to destination.";
            exit;
        }
    }

    // Handle errors
    if (isset($errors)) {
        var_dump($errors);
        die();
    }

    // Update query
    $query = "UPDATE rides SET title = :title, themeland = :themeland, img_file = :img_file, description = :description, min_length = :min_length WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":themeland" => $themeland,
        ":description" => $description,
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
