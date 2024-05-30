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
        

        <?php require_once 'header.php'; ?>

<div class="hero">
    <div class="hero-content">
        <h1>Welkom Bij</h1>
        <!-- img spartan -->
        <img src="img/Spartan_Logo_Text_Only.png" alt="logo">
        <p>Ontdek spannende en adembenemende ritten!</p>
    </div>
</div>

    <div class="container">

        <?php
        require_once 'admin/backend/conn.php';
        $query = "SELECT * FROM rides";
        $statement = $conn->prepare($query);
        $statement->execute();
        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>



        <h1>Attracties</h1>

<p>Totaal aantal Attracties: <strong><?php echo count($rides); ?></strong></p>

        <div class="card-container">
                
            <?php foreach($rides as $ride): ?>
                    <div class="card">
                        <div class="card-img">
                        <?php if($ride['new'] != 0): ?>
                            <div class="new">Nieuw!</div>
                        <?php endif; ?>
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
            <?php endforeach; ?>
        </div>

    </div>
        </main>
    </div>

</body>

</html>
