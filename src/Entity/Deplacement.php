<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_retour;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage_depart;

    /**
     * @ORM\Column(type="integer", nullable=true, nullable=true)
     */
    private $kilometrage_retour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_depart;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu_retour;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="deplacements")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * @var User;
     */
    private $chauffeur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PleinCarburant", mappedBy="deplacement", orphanRemoval=true)
     */
    private $pleins_carburant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nature;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="deplacements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule;

    public function __construct()
    {
        $this->pleins_carburant = new ArrayCollection();
    }
    

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

    /**
     * @return User
     */
    public function getChauffeur(): User
    {
        return $this->chauffeur;
    }

    /**
     * @param User $chauffeur
     */
    public function setChauffeur(User $chauffeur): void
    {
        $this->chauffeur = $chauffeur;
    }

    public function estEnCours(): bool
    {
        return (!$this->getLieuRetour()?true:false);
    }

    /**
     * @return Collection|PleinCarburant[]
     */
    public function getPleinsCarburant(): Collection
    {
        return $this->pleins_carburant;
    }

    public function addPleinsCarburant(PleinCarburant $pleinsCarburant): self
    {
        if (!$this->pleins_carburant->contains($pleinsCarburant)) {
            $this->pleins_carburant[] = $pleinsCarburant;
            $pleinsCarburant->setDeplacement($this);
        }

        return $this;
    }

    public function removePleinsCarburant(PleinCarburant $pleinsCarburant): self
    {
        if ($this->pleins_carburant->contains($pleinsCarburant)) {
            $this->pleins_carburant->removeElement($pleinsCarburant);
            // set the owning side to null (unless already changed)
            if ($pleinsCarburant->getDeplacement() === $this) {
                $pleinsCarburant->setDeplacement(null);
            }
        }

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /*---------------------------Validation----------------------------*/
    /**
     * @return bool
     * @Assert\IsTrue(message="La date de retour doit être postérieure à la date de départ.")
     */
    public function isCoherentDate(){
        return (!$this->date_retour || $this->date_retour > $this->date_depart);
    }
    /**
     * @return bool
     * @Assert\IsTrue(message="La kilométrage d'arrivé doit être supérieur au kilométrage de départ. Où alors il faut nous donner ta technique !")
     */
    public function isCoherentKilometrage(){
        return (!$this->kilometrage_retour || $this->getKilometrageRetour() > $this->kilometrage_depart);
    }


}
