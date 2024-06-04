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

    // Eventuele foutmeldingen weergeven
    if (isset($errors)) {
        var_dump($errors);
        die();
    }

    // Query
    require_once 'conn.php';
    // Insert data into the database with a placeholder for img_file
    $query = "INSERT INTO rides (title, themeland, description, min_length, img_file) VALUES(:title, :themeland, :description, :min_length, '')";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":themeland" => $themeland,
        ":description" => $description,
        ":min_length" => $min_length
    ]);

    // Fetch the ID of the newly inserted row
    $newly_inserted_id = $conn->lastInsertId();

    $target_dir = "../../img/attracties/";
    $target_file = $newly_inserted_id . '.' . pathinfo($_FILES['img_file']['name'], PATHINFO_EXTENSION);

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

if ($action == 'update') {
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

    $old_img_file = $ride['img_file'];
    $target_dir = "../../img/attracties/";
    $new_img_file = isset($_FILES['img_file']['name']) && !empty($_FILES['img_file']['name']) ? $id . '.' . pathinfo($_FILES['img_file']['name'], PATHINFO_EXTENSION) : $old_img_file;

    // Handle errors
    if (isset($errors)) {
        var_dump($errors);
        die();
    }
    
    if (!empty($_FILES['img_file']['name'])) {
        $destination_path = $target_dir . $new_img_file;
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['img_file']['tmp_name'], $destination_path)) {
            // File moved successfully
        } else {
            echo "Error moving file to destination.";
            exit;
        }
    }

    // Update query
    $query = "UPDATE rides SET title = :title, themeland = :themeland, img_file = :img_file, description = :description, min_length = :min_length WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":themeland" => $themeland,
        ":description" => $description,
        ":img_file" => $new_img_file,
        ":min_length" => $min_length,
        ":id" => $id
    ]);

    header("Location: ../attracties/index.php");
    exit;
}

if ($action == "delete") {
    $id = $_POST['id'];
    require_once 'conn.php';
    $query = "SELECT img_file FROM rides WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);
    $ride = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$ride) {
        echo "Ride not found.";
        exit;
    }

    $old_img_file = $ride['img_file'];
    $target_dir = "../../img/attracties/";

    // Delete the record from the database
    $query = "DELETE FROM rides WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);

    // Delete the old image file
    if ($old_img_file) {
        unlink($target_dir . $old_img_file);
    }

    header("Location: ../attracties/index.php");
    exit;
}
?>
