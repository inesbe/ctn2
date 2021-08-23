<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="S'il vous plaît entrer le nom")
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
     *  @Assert\NotBlank(message="S'il vous plaît entrer le prénom")
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
     *  @Assert\NotBlank(message="S'il vous plaît entrer la nationalité")
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
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer votre email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer votre adresse")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît entrer la ville")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern = "/^[0-9]+$/",
     *     message="'{{ value }}' doit etre chaine des nombres"
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="S'il vous plaît entrer votre message")
     * @Assert\Length(min=20,
     *       max = 1000,
     *      minMessage = "Votre message est trop court.Il doit avoir au minimum  {{ limit }} caractères",
     *      maxMessage = "Votre message est trop long.Il ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255, columnDefinition="enum('Marchandise', 'Passager')")
     */
    private $type;

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

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(?string $codepostal): self
    {
        $this->codepostal = $codepostal;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
