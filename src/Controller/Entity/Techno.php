<?php

namespace Berti\Porfolio\Controller\Entity;

class Techno
{
    private int $id;
    private string $nom;
    private string $image;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Techno
    {
        $this->id = $id;
        return $this;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): Techno
    {
        $this->nom = $nom;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): Techno
    {
        $this->image = $image;
        return $this;
    }


}