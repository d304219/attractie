<?php
session_start();
require_once 'admin/backend/config.php';
?>

<!doctype html>
<html lang="nl">
    <?php require_once "head.php"; ?>
    <title>Attractiepagina</title>
<body>

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
                        <p class="description"><?php echo $ride['description']?></p>
                        <?php if($ride['min_length'] != 0): ?>
                            <p class="length"><span style="font-weight: 400"><?php echo $ride['min_length']; ?>cm</span> minimale lengte</p>
                        <?php else: ?>
                            <p class="length">Geen lengtebeperking</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- The Modal -->
    <div class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.card');
        const modal = document.querySelector('.modal');
        const modalContent = document.querySelector('.modal-content');
        const span = document.querySelector('.close');
        cards.forEach(card => {
            card.addEventListener('click', () => {
                modalContent.innerHTML = card.innerHTML;
                modal.style.display = "block";
            });
        });

        span.addEventListener('click', () => {
            modal.style.display = "none";
        });

        window.addEventListener('click', (event) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        document.querySelectorAll('.description').forEach(description => {
            const readMore = document.createElement('span');
            readMore.textContent = ' Lees meer';
            readMore.classList.add('read-more');
            description.parentNode.appendChild(readMore);

            readMore.addEventListener('click', () => {
                if (description.classList.contains('expanded')) {
                    description.classList.remove('expanded');
                    readMore.textContent = ' Lees meer';
                } else {
                    description.classList.add('expanded');
                    readMore.textContent = ' Lees minder';
                }
            });
        });
    });
    </script>
     <?php require_once 'footer.php'; ?>
</body>
</body>
</html>
