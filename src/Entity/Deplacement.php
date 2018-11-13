<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeplacementRepository")
 */
class Deplacement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_retour;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage_depart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kilometrage_retour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_retour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }

    public function setDateRetour(\DateTimeInterface $date_retour): self
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getKilometrageDepart(): ?int
    {
        return $this->kilometrage_depart;
    }

    public function setKilometrageDepart(int $kilometrage_depart): self
    {
        $this->kilometrage_depart = $kilometrage_depart;

        return $this;
    }

    public function getKilometrageRetour(): ?int
    {
        return $this->kilometrage_retour;
    }

    public function setKilometrageRetour(?int $kilometrage_retour): self
    {
        $this->kilometrage_retour = $kilometrage_retour;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieu_depart;
    }

    public function setLieuDepart(string $lieu_depart): self
    {
        $this->lieu_depart = $lieu_depart;

        return $this;
    }

    public function getLieuRetour(): ?string
    {
        return $this->lieu_retour;
    }

    public function setLieuRetour(string $lieu_retour): self
    {
        $this->lieu_retour = $lieu_retour;

        return $this;
    }
}
