<?php
require_once dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__,1));
$dotenv->load();

$headers = getallheaders();
if (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] === 'XMLHttpRequest') {

    // Récupérer les données JSON brutes
    $postData = json_decode(file_get_contents('php://input'), true);
    $sendMail = false;
    $reponse = [];
    if(!empty($postData)){
        $email = htmlspecialchars($postData['email']);
        $name = htmlspecialchars($postData['name']);
        $subject = htmlspecialchars($postData['subject']);
        $message = htmlspecialchars($postData['message']);

        try{
            $mailler = new \Berti\Porfolio\Controller\SenderMail();

            $mailler->setEmail($email , $subject , $message , $name);

            $sendMail = $mailler->envoyer();

        }catch(Exception $e){
            // TODO LOGGER  !!
        }


        if($sendMail){
            $noReply = new \Berti\Porfolio\Controller\SenderMail();
            $noReply->setNoReply($email , $name , $subject);
            $noReply->envoyer();
            $reponse['Success']=" {$postData['name']} , Votre email à bien était envoyer !!!";
        }else{
            $reponse['error']='Quelquechose c\'est mal passé !!!';
        }
    }

    header('Content-Type: application/json');
    echo json_encode($reponse);
    exit();
}

$db = \Berti\Porfolio\Model\DBPortefolio::connection();
$TcardP = new \Berti\Porfolio\Model\Repository\CardPortfolio($db);
$dataCard = $TcardP->getAllCard();
$TSkills = new \Berti\Porfolio\Model\Repository\Skills($db);
$dataSkills = $TSkills->getSkills();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bertil Portfolio - Développeur Web & Web Mobile</title>
    <meta name="description" content="Portfolio de Bertil - Développeur Web & Mobile passionné">
    <meta name="keywords" content="Bertil, Portfolio, Développeur Web, Web Mobile, Frontend, Backend">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="asset/style.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="./asset/main.js" defer ></script>
</head>
<body>
<div class="container">
    <header>
        <nav class="header-nav">
            <button class="btn" id="openModal">
                <span>📧</span>
                Contactez-moi
            </button>
        </nav>

        <div class="header-content">
            <div class="hero">
                <h1>Développeur Web & Mobile</h1>
                <p class="hero-description">
                    Passionné par la création d'expériences numériques exceptionnelles,
                    je développe des solutions web et mobile modernes, performantes et
                    centrées sur l'utilisateur. Mon expertise couvre le développement
                    frontend et backend avec les dernières technologies.
                </p>
            </div>
        </div>

        <div class="wave"></div>
    </header>

    <main>
        <section class="section">
            <h2 class="section-title">Mes Projets</h2>
            <div class="projects-grid">
                <?php foreach ($dataCard as $card) : ?>
                    <?php require dirname(__DIR__,1).DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'Partials'.DIRECTORY_SEPARATOR.'cardProjet.php' ?>
                <?php endforeach; ?>
                <article class="project-card">
                    <div class="project-image">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=200&fit=crop" alt="Projet Dashboard">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Dashboard Analytics</h3>
                        <p class="project-description">
                            Tableau de bord analytique en temps réel avec visualisations interactives,
                            rapports personnalisés et gestion des utilisateurs.
                        </p>
                        <div class="tech-stack">
                            <span class="tech-label">Stack Technique</span>
                            <ul class="tech-list">
                                <li class="tech-item">📊</li>
                                <li class="tech-item">⚛️</li>
                                <li class="tech-item">🔥</li>
                                <li class="tech-item">📈</li>
                            </ul>
                        </div>
                        <div class="project-links">
                            <a href="#" class="project-link">🌐 Demo</a>
                            <a href="#" class="project-link">📂 Code</a>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Soft Skills</h2>
            <div class="skills-grid">
                <?php foreach ($dataSkills as $skill) : ?>
                    <?php if($skill->getSkill() === 'Soft'): ?>
                        <?php require dirname(__DIR__,1).DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'Partials'.DIRECTORY_SEPARATOR.'cardSkill.php' ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div class="skill-card">
                    <div class="skill-icon">🎯</div>
                    <h3 class="skill-title">Gestion de projet</h3>
                    <p class="skill-description">
                        Organisation méthodique des tâches, respect des délais et coordination efficace
                        des ressources pour mener les projets à terme avec succès.
                    </p>
                    <div class="skill-example">
                        <strong>Exemple :</strong> Pilotage d'un projet de refonte complète avec une équipe
                        de 5 développeurs, livré dans les temps et sous budget.
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Hard Skills</h2>
            <div class="skills-grid">
                <?php
                    foreach ($dataSkills as $skill){
                        if ($skill->getSkill() === 'Hard') {
                            require dirname(__DIR__) . '/Templates/Partials/cardSkillHard.php';
                        }
                    }
                ?>
                <div class="skill-card">
                    <div class="skill-icon">📱</div>
                    <h3 class="skill-title">Développement Mobile</h3>
                    <p class="skill-description">
                        Développement d'applications mobiles natives et hybrides avec React Native,
                        Flutter, et intégration avec les APIs natives des plateformes.
                    </p>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">Compétences Transversales</h2>
            <div class="skills-grid">
                <?php
                    foreach ($dataSkills as $skill) {
                        if ($skill->getSkill() === 'Transversal') {
                            require dirname(__DIR__) . '/Templates/Partials/cardSkill.php';
                        }
                    }
                ?>
                <div class="skill-card">
                    <div class="skill-icon">🔧</div>
                    <h3 class="skill-title">DevOps</h3>
                    <p class="skill-description">
                        Maîtrise des outils DevOps : Docker, Kubernetes, AWS, monitoring et
                        observabilité des applications en production.
                    </p>
                    <div class="skill-example">
                        <strong>Exemple :</strong> Containerisation d'une application legacy
                        et déploiement sur AWS avec 99.9% d'uptime.
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <h3>Contactez-moi pour discuter de votre projet</h3>
    </footer>
</div>

<!-- Modale de contact -->
<div id="formModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Contactez-moi</h2>
            <button class="close" onclick="closeModal()">&times;</button>
        </div>

        <form id="contactForm" >
            <div class="form-group">
                <label for="name" class="form-label">Nom complet *</label>
                <input type="text" id="name" name="name" class="form-input" required>
                <div class="error-message" id="nameError">Veuillez entrer votre nom</div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Adresse e-mail *</label>
                <input type="email" id="email" name="email" class="form-input" required>
                <div class="error-message" id="emailError">Veuillez entrer une adresse e-mail valide</div>
            </div>

            <div class="form-group">
                <label for="subject" class="form-label">Sujet *</label>
                <input type="text" id="subject" name="subject" class="form-input" required>
                <div class="error-message" id="subjectError">Veuillez entrer un sujet</div>
            </div>

            <div class="form-group">
                <label for="message" class="form-label">Message *</label>
                <textarea id="message" name="message" class="form-input" rows="5" required placeholder="Votre message..."></textarea>
                <div class="error-message" id="messageError">Veuillez entrer votre message</div>
            </div>

            <button type="submit" class="btn-submit">Envoyer le message</button>
        </form>
    </div>
</div>

<!-- Alert -->
<div id="alert" class="alert">
    <button class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
    <span id="alertMessage"></span>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>