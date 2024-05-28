<?php
session_start();
require_once 'admin/backend/config.php';
?>

<!doctype html>
<html lang="nl">
    <?php require_once "head.php";?>
    <title>Attractiepagina</title>
<body>

    <?php require_once 'header.php'; ?>
    <div class="container content">
        <aside>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia modi dolore magnam! Iste libero voluptatum autem, sapiente ullam earum nostrum sed magnam vel laboriosam quibusdam, officia, esse vitae dignissimos nulla?
        </aside>
        <main>

        <?php require_once '../../header.php'; ?>
    <div class="container">

        <a href="create.php">Nieuwe attractie maken &gt;</a>

        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM rides";
        $statement = $conn->prepare($query);
        $statement->execute();
        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="card-container">
                
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
        </div>

    </div>
        </main>
    </div>

</body>

</html>
