<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PleinCarburantRepository")
 */
class PleinCarburant
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
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @ORM\Column(type="float")
     */
    private $litrage;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_litre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deplacement", inversedBy="pleins_carburant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deplacement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getLitrage(): ?float
    {
        return $this->litrage;
    }

    public function setLitrage(float $litrage): self
    {
        $this->litrage = $litrage;

        return $this;
    }

    public function getPrixLitre(): ?float
    {
        return $this->prix_litre;
    }

    public function setPrixLitre(float $prix_litre): self
    {
        $this->prix_litre = $prix_litre;

        return $this;
    }

    public function getDeplacement(): ?Deplacement
    {
        return $this->deplacement;
    }

    public function setDeplacement(?Deplacement $deplacement): self
    {
        $this->deplacement = $deplacement;

        return $this;
    }
}
