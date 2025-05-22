<div class="skill-card">
    <div class="skill-icon"><?=$skill->getIcon() ?></div>
    <h3 class="skill-title"><?=$skill->getNom()?></h3>
    <p class="skill-description"><?= $skill->getDescription()?></p>
    <p class="examples">Exemple: <?=$skill->getExemple()?></p>
</div>