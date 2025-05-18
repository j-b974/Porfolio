<?php

namespace Berti\Porfolio\Controller\Entity;

class CardProjet
{
    private int $id;
    private string $titre;

    private string $description;

    /**
     * @var Techno[];
     */
    private array $techno = [];
    private string $lienGit;
    private string $lienWeb;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CardProjet
    {
        $this->id = $id;
        return $this;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): CardProjet
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CardProjet
    {
        $this->description = $description;
        return $this;
    }

    public function getTechno(): array
    {
        return $this->techno;
    }

    public function setTechno(array $techno): CardProjet
    {
        $this->techno = $techno;
        return $this;
    }

    public function getLienGit(): string
    {
        return $this->lienGit;
    }

    public function setLienGit(string $lien_git): CardProjet
    {
        $this->lienGit = $lien_git;
        return $this;
    }

    public function getLienWeb(): string
    {
        return $this->lienWeb;
    }

    public function setLienWeb(string $lien_site): CardProjet
    {
        $this->lienWeb = $lien_site;
        return $this;
    }

}