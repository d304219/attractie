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

<body>

    <?php require_once '../../header.php'; ?>
    <div class="container">

        <a href="create.php">+ Attractie Toevoegen</a>

        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM rides";
        $statement = $conn->prepare($query);
        $statement->execute();
        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="card-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Themeland</th>
                    <th>Img File</th>
                    <th>Description</th>
                    <th>Min_length</th>
                    <th>New</th>
                </tr>
                <?php foreach($rides as $ride): ?>
                    <tr>
                        <td><?php echo $ride['id']; ?></td>
                        <td><?php echo $ride['title']; ?></td>
                        <td><?php echo $ride['themeland']; ?></td>
                        <td><?php echo $ride['img_file']; ?></td>
                        <td><?php echo $ride['description']; ?></td>
                        <td><?php echo $ride['min_length']; ?></td>
                        <td><?php echo $ride['fast_pass']?></td>
                        <td><a href="edit.php?id=<?php echo $ride['id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>

</body>

</html>
