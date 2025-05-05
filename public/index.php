<?php
    require_once dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

    $db = \Berti\Porfolio\Model\DBPortefolio::connection();
    $TcardP = new \Berti\Porfolio\Model\Repository\CardPortfolio($db);
    $dataCard = $TcardP->getAllCard();

?>

<!DOCTYPE html>
<html lang="FR-fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bertil Portfolio</title>
    <meta name="description" content="Bertil Portfolio">
    <meta name="keywords" content="Bertil Portfolio">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <link rel="stylesheet" type="text/css" href="./asset/style.css">
    <script type="text/javascript" src="./asset/main.js" defer ></script>
</head>
<body>
    <div class="contenair">
        <header>
            <div class="box-btn">
                <button class="btn" id="openModal" >Contactez-moi</button>
            </div>
            <div class="box-banier">
                <div class="hearder-banier">
                    <h1>developpeur web & web mobile</h1>
                </div>
                <div class="body-banier">
                    <p>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam architecto dolor dolores error id inventore molestiae, mollitia natus porro quam quasi quo, reprehenderit sequi tenetur voluptatem. Ex minus quia unde?</span><span>A animi aperiam assumenda autem, corporis debitis deleniti ducimus esse excepturi ipsum nemo officiis quae quasi qui quo recusandae repellat repellendus repudiandae sapiente, suscipit temporibus velit veniam vitae? Fugit, rerum!</span><span>Amet aspernatur atque dolores eaque harum magnam perspiciatis possimus, quam tenetur totam vitae voluptates! Architecto at, dolore eaque est harum ipsa natus possimus ratione repudiandae saepe. Asperiores consequatur incidunt reprehenderit!</span>
                    </p>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,256L18.5,234.7C36.9,213,74,171,111,181.3C147.7,192,185,256,222,245.3C258.5,235,295,149,332,117.3C369.2,85,406,107,443,106.7C480,107,517,85,554,96C590.8,107,628,149,665,154.7C701.5,160,738,128,775,122.7C812.3,117,849,139,886,133.3C923.1,128,960,96,997,96C1033.8,96,1071,128,1108,144C1144.6,160,1182,160,1218,149.3C1255.4,139,1292,117,1329,133.3C1366.2,149,1403,203,1422,229.3L1440,256L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path></svg>

        </header>
        <main>
            <article>
                <h2>mes projet</h2>
                <div class="box-card">
                    <?php foreach ($dataCard as $card) : ?>
                        <?php require dirname(__DIR__,1).DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'Partials'.DIRECTORY_SEPARATOR.'cardProjet.php' ?>
                    <?php endforeach; ?>
                </div>
            </article>
            <article>
                <h2> mes Soft skills</h2>
            </article>
            <article>
                <div class="skills-container">
                    <div class="skill-card">
                        <div class="skill-icon">🤝</div>
                        <h3 class="skill-title">Communication</h3>
                        <p class="skill-description">Capacité à exprimer clairement des concepts techniques aux non-initiés et à discuter efficacement avec l'équipe pour résoudre des problèmes complexes.</p>
                        <p class="examples">Exemple: Documentation détaillée des projets, feedback constructif lors des code reviews, présentation claire des solutions.</p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">🧠</div>
                        <h3 class="skill-title">Esprit d'analyse</h3>
                        <p class="skill-description">Aptitude à décomposer des problèmes complexes en éléments simples et à trouver des solutions efficaces et élégantes.</p>
                        <p class="examples">Exemple: Optimisation de processus inefficaces, restructuration de code legacy, identification des goulots d'étranglement.</p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">📚</div>
                        <h3 class="skill-title">Apprentissage continu</h3>
                        <p class="skill-description">Volonté constante d'acquérir de nouvelles compétences et de se tenir informé des dernières tendances et technologies du web.</p>
                        <p class="examples">Exemple: Veille technologique régulière, participation à des hackathons, contribution à des projets open source.</p>
                    </div>

                    <div class="skill-card">
                        <div class="skill-icon">⏱️</div>
                        <h3 class="skill-title">Gestion du temps</h3>
                        <p class="skill-description">Capacité à prioriser les tâches, respecter les délais et équilibrer efficacement plusieurs projets simultanément.</p>
                        <p class="examples">Exemple: Utilisation de méthodes agiles, planification réaliste des sprints, transparence sur l'avancement des projets.</p>
                    </div>
            </article>
        </main>
        <footer>
            <h3> contact </h3>
        </footer>
    </div>
    <!-- La fenêtre modale -->
    <div id="formModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="form-title">Formulaire de contact</h2>
            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Sujet:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Envoyer</button>
            </form>
        </div>
    </div>
</body>