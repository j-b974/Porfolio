<?php

namespace Berti\Porfolio\Model\Repository;
use Berti\Porfolio\Controller\Entity\CardProjet;
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
        $placeholders = array_map(fn($key) => ":$key", $keys);

        $sql = "INSERT INTO cardProjet (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $placeholders) . ")";

        $req = $this->pdo->prepare($sql);

        foreach ($cardPortfolio as $key => $value) {
            if ($key != 'techno') {
                $req->bindValue(":$key", $value);
            }
        }
        $req->execute();
        $id = $this->pdo->lastInsertId();
        $this->Ttechno->addTechno($cardPortfolio['techno'], $id);
    }

    public function getAllCard(): array
    {
        // Récupère toutes les cartes avec les technos liées regroupées par carte
        $sql = "SELECT id , titre , description , lien_git as lienGit , lien_web as lienWeb FROM cardProjet";
        $req = $this->pdo->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS , CardProjet::class);
        $lstCard = $req->fetchAll();
        return $this->addTechnologiesToCards($lstCard);
    }

    private function addTechnologiesToCards(array $cards): array
    {
        return array_map(function ($card) {
            $techno = $this->Ttechno->getTechno($card->getId());;
            $card->setTechno($techno);
            return $card;
        }, $cards);
    }
}

