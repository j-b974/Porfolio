<div class="cardProjet">
    <div class="box-image">
        <img src="./asset/images/bg_portfolio.jpg" alt="projet1">
    </div>
    <div class="cardBody">
        <div>
            <h3><?= $card->getTitre() ?></h3>
            <p><?= $card->getDescription() ?></p>
        </div>
        <h5 class="sous-titre"> Stack technique </h5>
        <ul class="box-techno">
            <?php foreach ($card->getTechno() as $techno) : ?>
                <li>
                    <img src="./asset/images/technologie/<?= $techno->getImage() ?>" alt="<?= $techno->getNom() ?>">
                </li>
            <?php endforeach; ?>
        </ul>
        <h5 class="sous-titre"> Voir le projet </h5>
        <div class="box-link">
            <div class="link">
                <a href="<?= $card->getLienWeb() ?>" class="card-link" target="_blank"><img src="./asset/images/bg_portfolio.jpg" alt="logo site web"></a>
            </div>
            <div class="link">
                <a href="<?= $card->getLienGit() ?>" class="card-link" target="_blank"><img src="./asset/images/bg_portfolio.jpg" alt="logo github"></a>
            </div>
        </div>
    </div>
</div>