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
                    
        <?php
        require_once '../../conn.php';

        $status_filter = isset($_GET['status']) ? $_GET['status'] : '';


        $query = "SELECT * FROM rides";
        if ($status_filter !== '') {
        $query .= " WHERE themeland = :status"; 
        $statement = $conn->prepare($query);
        $statement->execute([':status' => $status_filter]);
        } else {
        $statement = $conn->prepare($query);
        $statement->execute();
        }


        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);    
        ?>
<<<<<<< HEAD
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
=======
        
        <?php
        require_once '../../conn.php';

        $status_filter = isset($_GET['status']) ? $_GET['status'] : '';


        $query = "SELECT * FROM rides";
        if ($status_filter !== '') {
        $query .= " WHERE themeland = :status"; 
        $statement = $conn->prepare($query);
        $statement->execute([':status' => $status_filter]);
        } else {
        $statement = $conn->prepare($query);
        $statement->execute();
        }

        


        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);    
        ?>

<div class="status">
            <p><span class="badge text-bg-danger">Warning</span><strong><?php echo count($rides) ?><i class="fa-solid fa-triangle-exclamation" style="color: #ff4013;"></i></strong></p>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <select name="status">
                    <option value=""> - kies status om te filteren - </option>
                    <option value="1" <?php if ($status_filter === '1') echo 'selected'; ?>>prioriteiten</option>
                    <option value="0" <?php if ($status_filter === '0') echo 'selected'; ?>>Geen prioriteiten</option>
                </select>
                <input type="submit" value="filter">
            </form>
        </div>

                
            <?php foreach($rides as $ride): ?>
                <?php if($ride['fast_pass'] == "0"): ?>
                    <div class="card">
                        <div class="card-img">
                            <img src="<?php echo $base_url; ?>/img/attracties/<?php echo $ride['img_file']; ?>" alt="<?php echo $ride['title']; ?>">
                        </div>
                        <div class="card-info">
                            <div class="card-info-title">
                                <h4><span style="text-transform:uppercase;"><?php echo $ride['themeland']; ?></span></h4>
                                <h3><?php echo $ride['title']; ?></h3>
                            </div>                    

                            <p><?php echo $ride['description']?></p>
                            <?php if($ride['min_length'] != 0): ?>
                                <p class="length"><span style="font-weight: 400"><?php echo $ride['min_length']; ?>cm</span> minimale lengte</p>
                            <?php else:?>
                                <p class="length">Geen lengtebeperking</p>
                            <?php endif; ?>
                            <!-- <a href="edit.php?id=<?php echo $ride['id']; ?>">Aanpassen</a> -->
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="card fastpass">
                        <div class="card-img">
                            <img src="<?php echo $base_url; ?>/img/attracties/<?php echo $ride['img_file']; ?>" alt="<?php echo $ride['title']; ?>">
                        </div>
                        <div class="card-info">

                            <div class="card-info-title">
                                <h4><span style="text-transform:uppercase;"><?php echo $ride['themeland']; ?></span></h4>
                                <h3><?php echo $ride['title']; ?></h3>
                            </div>                    

                            <p><?php echo $ride['description']?></p>
                            <?php if($ride['min_length'] != 0): ?>
                                <p class="length"><span style="font-weight: 400"><?php echo $ride['min_length']; ?>cm</span> minimale lengte</p>
                            <?php else:?>
                                <p class="length">Geen lengtebeperking</p>
                            <?php endif; ?>
                            <!-- <a href="edit.php?id=<?php echo $ride['id']; ?>">Aanpassen</a> -->
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
>>>>>>> 812711b564ae14716cb3b1ad6a5c38504f396f2c
        </div>

    </div>

</body>

</html>
