<?php

namespace Berti\Porfolio\Model\Repository;
USE \PDO;

class CardPortfolio
{
    private $pdo;
    private $Ttechno;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->Ttechno = new Techno($this->pdo);
    }
    public function addCardPortfolio(array $cardPortfolio)
    {

        $keys = array_keys($cardPortfolio);

        // supprime techno de la liste des clées
        $techno = array_search('techno', $keys);
        if ($techno !== false) {
            unset($keys[$techno]);
        }
        // initie paramettre pour requette
        $placeholders = array_map( fn ($key) => ":$key", $keys);

        $sql = "INSERT INTO cardProjet (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $placeholders) . ")";

        $req = $this->pdo->prepare($sql);

        foreach ($cardPortfolio as $key => $value) {
            if($key != 'techno') {
                $req->bindValue(":$key", $value);
            }
        }
        $req->execute();
        $id = $this->pdo->lastInsertId();
        $this->Ttechno->addTechno($cardPortfolio['techno'],$id);
    }
}