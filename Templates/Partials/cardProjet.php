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
                <div class="projetct_links_img">
                    <?php if($card->getNomDepotGit() === "GitHub") : ?>
                    <svg class="github-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 0C5.374 0 0 5.373 0 12 0 17.302 3.438 21.8 8.207 23.387c.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                    </svg>
                    <?php else: ?>
                        <svg class="gitlab-icon icon-small" viewBox="0 0 24 24" role="img" aria-label="GitLab">
                            <path fill="#FC6D26" d="M12 21.42l3.684-11.333h-7.368L12 21.42z"/>
                            <path fill="#E24329" d="M12 21.42l-3.684-11.333H1.481L12 21.42z"/>
                            <path fill="#FC6D26" d="M1.481 10.087L.165 13.82a.762.762 0 00.277.853L12 21.42 1.481 10.087z"/>
                            <path fill="#FCA326" d="M1.481 10.087h6.835L5.583 2.262c-.188-.577-.981-.577-1.169 0L1.481 10.087z"/>
                            <path fill="#E24329" d="M12 21.42l3.684-11.333h6.835L12 21.42z"/>
                            <path fill="#FC6D26" d="M22.519 10.087l1.316 3.733a.762.762 0 01-.277.853L12 21.42l10.519-11.333z"/>
                            <path fill="#FCA326" d="M22.519 10.087h-6.835L18.417 2.262c.188-.577.981-.577 1.169 0l2.933 7.825z"/>
                        </svg>
                    <?php endif ; ?>
                </div>
                <div>Code Source</div>
            </div></a>
    </div>

</article>