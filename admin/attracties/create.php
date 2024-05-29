<?php
session_start();
require_once '../backend/config.php';
if(!isset($_SESSION['user_id']))
{
    $msg = "Je moet eerst inloggen!";
    header("Location: $base_url/admin/login.php?msg=$msg");
    exit;
}
?>

<!doctype html>
<html lang="nl">

<?php require_once "../../head.php";?>
    <title>Attractiepagina / Admin</title>

<body>

    <?php require_once '../../header.php'; ?>
    <div class="container">

        <h2>Nieuwe attractie</h2>

        <form action="../backend/ridesController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create">
        
            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" name="title" id="title" class="form-input">
            </div>
            <div class="form-group">
                <label for="themeland">Themagebied:</label>
                <select name="themeland" id="themeland" class="form-input">
                    <option value=""> - kies een optie - </option>
                    <option value="familyland">Familyland</option>
                    <option value="waterland">Waterland</option>
                    <option value="adventureland">Adventureland</option>
                </select>
            </div>
            <div class="form-group">
                <label for="img_file">Afbeelding:</label>
                <input type="file" name="img_file" id="img_file" class="form-input">
            </div>

            <div class="form-group">
                <label for="description">description</label>
                <textarea name="description" id="description" cols="65" rows="10"></textarea>
            </div>


            <div class="form-group">
                <label for="fast_pass">FAST PASS:</label>
                <input type="checkbox" name="fast_pass" id="fast_pass">
                <label for="fast_pass">Voor deze attractie is een FAST PASS nodig.</label>
            </div>


            <input type="submit" value="Attractie aanmaken">


    </div>

</body>

</html>
