<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 *  @ORM\Entity
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity("email",
 *    message="Cet email est déja utilisé" )
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="S'il vous plaît entrer la langue")
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer l email")
     * @Assert\Email(message = "Veuillez saisir une adresse email valide .'{{ value }}' n'est pas valide ")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer le mot de passe")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer le prénom")
     *   @Assert\Regex(
     *     pattern = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     *     message="'{{ value }}' doit etre chaine de caractère"
     * )
     * @Assert\Length(min=3,
     *       max = 20,
     *      minMessage = "Cette chaine est trop courte.Elle doit avoir au minimum  {{ limit }} caractères",
     *      maxMessage = "Cette chaine est trop longue.Ele ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer le nom")
     *   @Assert\Regex(
     *     pattern = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     *     message="'{{ value }}' doit etre chaine de caractère"
     * )
     * @Assert\Length(min=3,
     *       max = 20,
     *      minMessage = "Cette chaine est trop courte.Elle doit avoir au minimum  {{ limit }} caractères",
     *      maxMessage = "Cette chaine est trop longue.Ele ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer le numéro de téléphone")
     * @Assert\Regex(
     *     pattern = "/^[0-9]+$/",
     *     message="'{{ value }}' doit etre chaine des nombres"
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer le nom du societe")
     */
    private $societe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typesociete;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer l'adresse")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complementadresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer la ville")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer le code postal")
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer le pays")
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $collegue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="integer")
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît choisir une image")
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $role_admin;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="user")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=Conteneur::class, mappedBy="user")
     */
    private $conteneurs;

    /**
     * @ORM\OneToMany(targetEntity=Chassis::class, mappedBy="user")
     */
    private $chassis;

    /**
     * @ORM\OneToMany(targetEntity=Vrack::class, mappedBy="user")
     */
    private $vracks;



    public function __construct()
    {
        $this->dateMin = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->conteneurs = new ArrayCollection();
        $this->chassis = new ArrayCollection();
        $this->vracks = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getTypesociete(): ?string
    {
        return $this->typesociete;
    }

    public function setTypesociete(?string $typesociete): self
    {
        $this->typesociete = $typesociete;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getComplementadresse(): ?string
    {
        return $this->complementadresse;
    }

    public function setComplementadresse(?string $complementadresse): self
    {
        $this->complementadresse = $complementadresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(?string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getCollegue(): ?string
    {
        return $this->collegue;
    }

    public function setCollegue(?string $collegue): self
    {
        $this->collegue = $collegue;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


    public function getRoles()
    {

        if( $this ->role == 0) {
            if ($this->etat == 1) {
                return ['ROLE_USER'];

            } else return ['ROLE_B'];
        }
        else if($this->role == 1)
        {
          return ['ROLE_ADMIN'];
        }
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRoleAdmin(): ?int
    {
        return $this->role_admin;
    }

    public function setRoleAdmin(int $role_admin): self
    {
        $this->role_admin = $role_admin;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conteneur[]
     */
    public function getConteneurs(): Collection
    {
        return $this->conteneurs;
    }

    public function addConteneur(Conteneur $conteneur): self
    {
        if (!$this->conteneurs->contains($conteneur)) {
            $this->conteneurs[] = $conteneur;
            $conteneur->setUser($this);
        }

        return $this;
    }

    public function removeConteneur(Conteneur $conteneur): self
    {
        if ($this->conteneurs->removeElement($conteneur)) {
            // set the owning side to null (unless already changed)
            if ($conteneur->getUser() === $this) {
                $conteneur->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Chassis[]
     */
    public function getChassis(): Collection
    {
        return $this->chassis;
    }

    public function addChassis(Chassis $chassis): self
    {
        if (!$this->chassis->contains($chassis)) {
            $this->chassis[] = $chassis;
            $chassis->setUser($this);
        }

        return $this;
    }

    public function removeChassis(Chassis $chassis): self
    {
        if ($this->chassis->removeElement($chassis)) {
            // set the owning side to null (unless already changed)
            if ($chassis->getUser() === $this) {
                $chassis->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vrack[]
     */
    public function getVracks(): Collection
    {
        return $this->vracks;
    }

    public function addVrack(Vrack $vrack): self
    {
        if (!$this->vracks->contains($vrack)) {
            $this->vracks[] = $vrack;
            $vrack->setUser($this);
        }

        return $this;
    }

    public function removeVrack(Vrack $vrack): self
    {
        if ($this->vracks->removeElement($vrack)) {
            // set the owning side to null (unless already changed)
            if ($vrack->getUser() === $this) {
                $vrack->setUser(null);
            }
        }

        return $this;
    }




}
