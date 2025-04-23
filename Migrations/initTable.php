<?php

require dirname(__DIR__,1).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$pdo = \Berti\Porfolio\Model\DBPortefolio::connection();

$sqlFilePath = __DIR__ . DIRECTORY_SEPARATOR.'initTable.sql';

$sqlContent = file_get_contents($sqlFilePath);

$result = $pdo->exec($sqlContent);

if ($result === false) {
    echo "Erreur d'exécution : " . print_r($pdo->errorInfo(), true);
} else {
    echo "Exécution réussie !!!";
}
$pdo = null;