<?php
require dirname(__DIR__,1).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$pdo = \Berti\Porfolio\Model\DBPortefolio::connection();

$json = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'data.json');
$data = json_decode($json, true);

$TCardPortofio = new \Berti\Porfolio\Model\Repository\CardPortfolio($pdo);
$TSkills = new \Berti\Porfolio\Model\Repository\Skills($pdo);;


foreach ($data['cardProjet'] as $row) {

    $TCardPortofio->addCardPortfolio($row);

}
foreach ($data['skills'] as $row) {
    $TSkills->addSkills($row);
}
echo "Remplissage réussie !!!/n";