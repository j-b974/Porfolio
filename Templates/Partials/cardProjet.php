<div class="cardProjet">
    <div class="box-image">
        <img src="./asset/images/bg_portfolio.jpg" alt="projet1">
    </div>
    <div class="cardBody">
        <div>
            <h3><?= $card['titre'] ?></h3>
            <p><?= $card['description']?></p>
        </div>
        <h5 class="sous-titre"> Stack technique </h5>
        <ul class="box-techno">
            <?php foreach ($card['techno'] as $techno) : ?>
                <li>
                    <img src="./asset/images/technologie/<?= $techno['image'] ?>" alt="<?= $techno['nom'] ?>">
                </li>
            <?php endforeach; ?>
        </ul>
        <h5 class="sous-titre"> Voir le projet </h5>
        <div class="box-link">
            <div class="link">
                <a href="<?= $card['lien_web']?>" class="card-link" target="_blank"><img src="./asset/images/bg_portfolio.jpg" alt="logo site web"></a>
            </div>
            <div class="link">
                <a href="<?= $card['lien_git']?>" class="card-link" target="_blank"><img src="./asset/images/bg_portfolio.jpg" alt="logo github"></a>
            </div>
        </div>
    </div>
</div>