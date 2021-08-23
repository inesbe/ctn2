<?php

namespace App\Entity;

use App\Repository\ConteneurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConteneurRepository::class)
 */
class Conteneur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="conteneurs")
     */
    private $reservation;



    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="conteneurs")
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
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $num_plomb;
    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $reservation_id;

    /**
     * @ORM\Column(type="date" , nullable=true)
     */
    private $date_chargement;

    /**
     * @ORM\Column(type="date" , nullable=true)
     */
    private $date_enlevement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $poids_unitaire;

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
    private $temperature;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $prorietaire;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $bl;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $bl_etat;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    public $num_container;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_destinataire;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $code_postale;

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
    public function getNumPlomb(): ?int
    {
        return $this->num_plomb;
    }

    public function setNumPlomb(int $num_plomb): self
    {
        $this->num_plomb = $num_plomb;

        return $this;
    }

    public function getDateChargement(): ?\DateTimeInterface
    {
        return $this->date_chargement;
    }

    public function setDateChargement(\DateTimeInterface $date_chargement): self
    {
        $this->date_chargement = $date_chargement;

        return $this;
    }

    public function getDateEnlevement(): ?\DateTimeInterface
    {
        return $this->date_enlevement;
    }

    public function setDateEnlevement(\DateTimeInterface $date_enlevement): self
    {
        $this->date_enlevement = $date_enlevement;

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
    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getProrietaire(): ?string
    {
        return $this->prorietaire;
    }

    public function setProrietaire(string $prorietaire): self
    {
        $this->prorietaire = $prorietaire;

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

    public function getBlEtat(): ?bool
    {
        return $this->bl_etat;
    }

    public function setBlEtat(bool $bl_etat): self
    {
        $this->bl_etat = $bl_etat;

        return $this;
    }

    public function getNumContainer(): ?int
    {
        return $this->num_container;
    }

    public function setNumContainer(int $num_container): self
    {
        $this->num_container = $num_container;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    public function getCodePostale(): ?string
    {
        return $this->code_postale;
    }

    public function setCodePostale(string $code_postale): self
    {
        $this->code_postale = $code_postale;

        return $this;
    }
}
