<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $date_achat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $responsable_cle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $responsable_entretien;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo_vehicule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deplacement", mappedBy="vehicule")
     */
    private $deplacements;

    public function __construct()
    {
        $this->deplacements = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getDateAchat(): ?\DateTime
    {
        return $this->date_achat;
    }

    public function setDateAchat(?\DateTime $date_achat): self
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    public function getResponsableCle(): ?string
    {
        return $this->responsable_cle;
    }

    public function setResponsableCle(?string $responsable_cle): self
    {
        $this->responsable_cle = $responsable_cle;

        return $this;
    }

    public function getResponsableEntretien(): ?string
    {
        return $this->responsable_entretien;
    }

    public function setResponsableEntretien(?string $responsable_entretien): self
    {
        $this->responsable_entretien = $responsable_entretien;

        return $this;
    }

    public function getPhotoVehicule(): ?string
    {
        return $this->photo_vehicule;
    }

    public function setPhotoVehicule(?string $photo_vehicule): self
    {
        $this->photo_vehicule = $photo_vehicule;

        return $this;
    }

    /**
     * @return Collection|Deplacement[]
     */
    public function getDeplacements(): Collection
    {
        return $this->deplacements;
    }

    public function addDeplacement(Deplacement $deplacement): self
    {
        if (!$this->deplacements->contains($deplacement)) {
            $this->deplacements[] = $deplacement;
            $deplacement->setVehicule($this);
        }

        return $this;
    }

    public function removeDeplacement(Deplacement $deplacement): self
    {
        if ($this->deplacements->contains($deplacement)) {
            $this->deplacements->removeElement($deplacement);
            // set the owning side to null (unless already changed)
            if ($deplacement->getVehicule() === $this) {
                $deplacement->setVehicule(null);
            }
        }

        return $this;
    }
}
