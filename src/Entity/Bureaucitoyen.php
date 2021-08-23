<?php

namespace App\Entity;

use App\Repository\BureaucitoyenRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * @ORM\Entity(repositoryClass=BureaucitoyenRepository::class)
 */
class Bureaucitoyen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @Assert\NotBlank(message="Nom oblibatoire")
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="Prenom oblibatoire")
     * @ORM\Column(type="string", length=20)
     */
    private $prenom;


    /**
     *  @Assert\NotBlank(message="Nationalité oblibatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     *   @Assert\NotBlank(message="Email oblibatoire")
     * * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",
     *     message="Email non valide"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Adresse oblibatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @Assert\NotBlank(message="Code Postale oblibatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $codepostale;

    /**
     * @Assert\NotBlank(message="Ville oblibatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     *  @Assert\NotBlank(message="Télèphone oblibatoire")
     * * @Assert\Positive(message="Le numero du télèphone doit etre positif")
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @Assert\NotBlank(message="Message oblibatoire")
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true, options={"default":false})
     */
    private $etat;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostale(): ?string
    {
        return $this->codepostale;
    }

    public function setCodepostale(string $codepostale): self
    {
        $this->codepostale = $codepostale;

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

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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
}
