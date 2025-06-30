<div class="skill-card">
    <div class="skill-icon"><ion-icon name="<?= $skill->getIcon()?>"></ion-icon></div>
    <h3 class="skill-title"><?=$skill->getNom()?></h3>
    <p class="skill-description">
        <?= $skill->getDescription()?>
    </p>
    <div class="skill-example">
        <strong>Exemple :</strong> <?=$skill->getExemple()?>
    </div>
</div>