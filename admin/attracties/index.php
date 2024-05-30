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

        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM rides ORDER BY id ASC";  // Hier sorteren we de resultaten op ID in oplopende volgorde
        $statement = $conn->prepare($query);
        $statement->execute();
        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container">
        <h1>Admin</h1>

        <a href="create.php">+ Attractie Toevoegen</a>
    
        <div class="top">
        <p>Totaal aantal Rides: <strong><?php echo count($rides); ?></strong></p>

        <form action="" method="GET">
            <?php
            $query = "SELECT * FROM rides";

            if (!empty($_GET['type'])) {
                $query .= " WHERE themeland = :type";
            }

            $query .= " ORDER BY id ASC";  // Hier sorteren we de resultaten op ID in oplopende volgorde

            $statement = $conn->prepare($query);

            if (!empty($_GET['type'])) {
                $statement->bindParam(':type', $_GET['type']);
            }

            $statement->execute();
            $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <select name="type" id="group">
                <option value="">-Kies een Themaland-</option>
                <option value="waterland">Waterland</option>
                <option value="familyland">Familyland</option>
                <option value="adventureland">Adventureland</option>
            </select>

            <input type="submit" value="Filter">
        </form>
        </div>

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
                <?php foreach($rides as $ride): ?>
                    <tr>
                        <td><?php echo $ride['id']; ?></td>
                        <td><?php echo $ride['title']; ?></td>
                        <td><?php echo $ride['themeland']; ?></td>
                        <td><?php echo $ride['img_file']; ?></td>
                        <td><?php echo $ride['description']; ?></td>
                        <td><?php echo $ride['min_length']; ?></td>
                        <td><?php echo $ride['new']?></td>
                        <td><a href="edit.php?id=<?php echo $ride['id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>

</body>

</html>
