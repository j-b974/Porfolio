<?php

namespace Berti\Porfolio\Model\Repository;

use \PDO;
class Techno
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function addTechno(array $technos , int $idProjet = null)
    {
        foreach($technos as $techno)
        {
            $id = null;
            if(!$this->isUnique($techno['nom'])) {
                $sql = "INSERT INTO techno (nom, image) VALUES (:nom, :image)";
                $req = $this->pdo->prepare($sql);
                $req->execute($techno);
                $id = $this->pdo->lastInsertId();
            }else{
                $id = $this->getId($techno['nom']);
            }
            $this->attacheTechno($id, $idProjet);
        }
    }
    public function isUnique(string $nom):bool
    {
        $query= "SELECT COUNT(*) FROM techno WHERE techno.nom = ?";
        $req = $this->pdo->prepare($query);
        $req->execute([$nom]);
        return (bool) $req->fetchColumn();
    }
    public function getId(string $nom):int
    {
        $query= "SELECT id FROM techno WHERE techno.nom = ?";
        $req = $this->pdo->prepare($query);
        $req->execute([$nom]);
        return (int) $req->fetchColumn();
    }
    private function attacheTechno(int $idTechno, int $idProjet)
    {
        $sql = "INSERT INTO cardProjet_techno (id_techno, id_cardProjet) VALUES (:idTechno, :idProjet)";
        $req = $this->pdo->prepare($sql);
        $req->execute(['idTechno' => $idTechno, 'idProjet' => $idProjet]);

    }

}