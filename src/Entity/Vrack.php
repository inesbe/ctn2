<?php

namespace App\Entity;

use App\Repository\VrackRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VrackRepository::class)
 */
class Vrack
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="vracks")
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="vracks")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $codeEmballage;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $marchandises;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nb_colis;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $poids_brute;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $poids_unitaire;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $nom_destinataire;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $code_postale;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $matricule_vrac;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $bl;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $reservation_id;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $etat_bl;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getReservationId(): ?int
    {
        return $this->reservation_id;
    }

    public function setReservationId(?int $id): self
    {
        $this->reservation_id = $id;

        return $this;
    }
    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getCodeEmballage(): ?string
    {
        return $this->codeEmballage;
    }

    public function setCodeEmballage(string $codeEmballage): self
    {
        $this->codeEmballage = $codeEmballage;

        return $this;
    }
    public function getMarchandises(): ?string
    {
        return $this->marchandises;
    }

    public function setMarchandises(string $marchandises): self
    {
        $this->marchandises = $marchandises;

        return $this;
    }

    public function getNbColis(): ?int
    {
        return $this->nb_colis;
    }

    public function setNbColis(int $nb_colis): self
    {
        $this->nb_colis = $nb_colis;

        return $this;
    }

    public function getPoidsBrute(): ?int
    {
        return $this->poids_brute;
    }

    public function setPoidsBrute(int $poids_brute): self
    {
        $this->poids_brute = $poids_brute;

        return $this;
    }
    public function getPoidsUnitaire(): ?int
    {
        return $this->poids_unitaire;
    }

    public function setPoidsUnitaire(int $poids_unitaire): self
    {
        $this->poids_unitaire = $poids_unitaire;

        return $this;
    }

    public function getNomDestinataire(): ?string
    {
        return $this->nom_destinataire;
    }

    public function setNomDestinataire(string $nom_destinataire): self
    {
        $this->nom_destinataire = $nom_destinataire;

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

    public function getCodePostale(): ?int
    {
        return $this->code_postale;
    }

    public function setCodePostale(int $code_postale): self
    {
        $this->code_postale = $code_postale;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getMatriculeVrac(): ?string
    {
        return $this->matricule_vrac;
    }

    public function setMatriculeVrac(string $matricule_vrac): self
    {
        $this->matricule_vrac = $matricule_vrac;

        return $this;
    }

    public function getBl(): ?int
    {
        return $this->bl;
    }

    public function setBl(int $bl): self
    {
        $this->bl = $bl;

        return $this;
    }
    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getEtatBl(): ?bool
    {
        return $this->etat_bl;
    }

    public function setEtatBl(bool $etat_bl): self
    {
        $this->etat_bl = $etat_bl;

        return $this;
    }
}
