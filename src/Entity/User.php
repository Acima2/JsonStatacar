<?php

namespace App\Entity;

use App\Repository\DeplacementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Deplacement as Deplacement;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Vich\Uploadable
 *
 */
class User implements UserInterface
{
    public function __construct()
    {
        $this->activeDeplacement = false;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */

    private $date_embauche;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $ecole;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $permis_valide;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image",)
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var Deplacement[]
     * @ORM\OneToMany(targetEntity="App\Entity\Deplacement", mappedBy="chauffeur")
     *
     */
    private $deplacements;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $activeDeplacement;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return \DateTime
     */
    public function getDateEmbauche(): ?\DateTime
    {
        return $this->date_embauche;
    }

    /**
     * @param \DateTime $date_embauche
     */
    public function setDateEmbauche(\DateTime $date_embauche)
    {
        if(!$date_embauche) {
            $this->date_embauche = null;
        }
        else {
            $this->date_embauche = $date_embauche;
        }
    }

    /**
     * @return string
     */
    public function getEcole(): string
    {
        return $this->ecole;
    }

    /**
     * @param string $ecole
     */
    public function setEcole(string $ecole)
    {
        $this->ecole = $ecole;
    }

    /**
     * @return bool
     */
    public function isPermisValide(): bool
    {
        return $this->permis_valide;
    }

    /**
     * @param bool $permis_valide
     */
    public function setPermisValide(bool $permis_valide)
    {
        $this->permis_valide = $permis_valide;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Deplacement[]
     */
    public function getDeplacements(): array
    {
        return $this->deplacements;
    }

    /**
     * @param Deplacement[] $deplacements
     */
    public function setDeplacements(array $deplacements): void
    {
        $this->deplacements = $deplacements;
    }

    /**
     * @return bool
     */
    public function hasActiveDeplacement(): bool
    {
        return $this->activeDeplacement;
    }

    /**
     * @param bool $activeDeplacement
     * @return User
     */
    public function setActiveDeplacement(bool $activeDeplacement)
    {
        $this->activeDeplacement = $activeDeplacement;
    }
}
