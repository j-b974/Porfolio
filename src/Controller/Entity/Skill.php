<?php

namespace Berti\Porfolio\Controller\Entity;

class Skill
{
    private int $id;
    private string $nom;
    private string $icon;
    private string $description;
    private string $skill ;
    private string $exemple ;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Skill
    {
        $this->id = $id;
        return $this;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): Skill
    {
        $this->nom = $nom;
        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): Skill
    {
        $this->icon = $icon;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Skill
    {
        $this->description = $description;
        return $this;
    }

    public function getSkill(): string
    {
        return $this->skill;
    }

    public function setSkill(string $skill): Skill
    {
        $this->skill = $skill;
        return $this;
    }

    public function getExemple(): string
    {
        return $this->exemple;
    }

    public function setExemple(string $exemple): Skill
    {
        $this->exemple = $exemple;
        return $this;
    }

}