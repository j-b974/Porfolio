<?php

namespace Berti\Porfolio\Model\Repository;

use PDO;

class Skills
{
    private $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    public function addSkills(array $skills)
    {
        $keys = array_keys($skills);

        // initie les nom de paramettre des valeur
        $placeholders = array_map(fn($key) => ":$key", $keys);

        $sql = "INSERT INTO skills (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $placeholders) . ")";

        $req = $this->pdo->prepare($sql);

        foreach ($skills as $key => $value) {
                $req->bindValue(":$key", $value);
        }
        $req->execute();
    }
    public function getSkills(): array
    {
        $sql = "SELECT id , nom , skill , icon , description , exemple FROM skills";
        $req = $this->pdo->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, \Berti\Porfolio\Controller\Entity\Skill::class);
        return $req->fetchAll();
    }
}