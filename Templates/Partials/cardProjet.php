<article class="project-card">
    <div class="project-image">
        <img src="./asset/images/bg_portfolio.jpg" alt="Projet E-commerce">
    </div>
    <div class="project-content">
        <h3 class="project-title"><?= $card->getTitre() ?></h3>
        <p class="project-description">
            <?= $card->getDescription() ?>
        </p>
        <div class="tech-stack">
            <span class="tech-label">Stack Technique</span>
            <ul class="tech-list">
                <?php foreach ($card->getTechno() as $techno) : ?>
                    <li class="tech-item">
                        <img src="./asset/images/technologie/69x69/<?= $techno->getImage() ?>" alt="<?= $techno->getNom() ?>">
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="project-links">
        <a href="<?= $card->getLienWeb() ?>" class="project-link" target="_blank"><ion-icon name="earth-outline"></ion-icon>   Demo</a>
        <a href="<?= $card->getLienGit() ?>" class="project-link" target="_blank">
            <div class="project_links_contain">
                <div class="projetct_links_img"><img src="./asset/images/technologie/69x69/github_25X25.png" height="25"></div>
                <div>Code Source</div>
            </div></a>
    </div>

</article>