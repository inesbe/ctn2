<?php

namespace App\Entity;

use App\Repository\ChassisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChassisRepository::class)
 */
class Chassis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="chassis")
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="chassis")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $matricule_chassis;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $metre_linaire;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $largeur;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $hauteur;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $tare;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $numero_plomb;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $date_changement;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $date_enlevment;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $nature;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nb_unite;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $temeprature;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $poids_brute;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $unite_payante;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nb_colis;


    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $poids_unitaire;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $marchandises;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $emballage;

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
    private $remarque;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $bl;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $reservation_id;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $etat_bl;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $etat;














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
    public function getMatriculeChassis(): ?string
    {
        return $this->matricule_chassis;
    }

    public function setMatriculeChassis(string $matricule_chassis): self
    {
        $this->matricule_chassis = $matricule_chassis;

        return $this;
    }

    public function getMetreLinaire(): ?int
    {
        return $this->metre_linaire;
    }

    public function setMetreLinaire(int $metre_linaire): self
    {
        $this->metre_linaire = $metre_linaire;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getHauteur(): ?int
    {
        return $this->hauteur;
    }

    public function setHauteur(int $hauteur): self
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getTare(): ?int
    {
        return $this->tare;
    }

    public function setTare(int $tare): self
    {
        $this->tare = $tare;

        return $this;
    }

    public function getNumeroPlomb(): ?int
    {
        return $this->numero_plomb;
    }

    public function setNumeroPlomb(int $numero_plomb): self
    {
        $this->numero_plomb = $numero_plomb;

        return $this;
    }

    public function getDateChangement(): ?\DateTimeInterface
    {
        return $this->date_changement;
    }

    public function setDateChangement(\DateTimeInterface $date_changement): self
    {
        $this->date_changement = $date_changement;

        return $this;
    }

    public function getDateEnlevment(): ?\DateTimeInterface
    {
        return $this->date_enlevment;
    }

    public function setDateEnlevment(\DateTimeInterface $date_enlevment): self
    {
        $this->date_enlevment = $date_enlevment;

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

    public function getNbUnite(): ?int
    {
        return $this->nb_unite;
    }

    public function setNbUnite(int $nb_unite): self
    {
        $this->nb_unite = $nb_unite;

        return $this;
    }

    public function getTemeprature(): ?int
    {
        return $this->temeprature;
    }

    public function setTemeprature(int $temeprature): self
    {
        $this->temeprature = $temeprature;

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

    public function getUnitePayante(): ?int
    {
        return $this->unite_payante;
    }

    public function setUnitePayante(int $unite_payante): self
    {
        $this->unite_payante = $unite_payante;

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
    public function getPoidsUnitaire(): ?int
    {
        return $this->poids_unitaire;
    }

    public function setPoidsUnitaire(int $poids_unitaire): self
    {
        $this->poids_unitaire = $poids_unitaire;

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

    public function getEmballage(): ?string
    {
        return $this->emballage;
    }

    public function setEmballage(string $emballage): self
    {
        $this->emballage = $emballage;

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

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

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

    public function getEtatBl(): ?bool
    {
        return $this->etat_bl;
    }

    public function setEtatBl(bool $etat_bl): self
    {
        $this->etat_bl = $etat_bl;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
}
