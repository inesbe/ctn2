<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="reservations")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMin;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMax;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateExacte;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $confirme;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tarif;

    /**
     * @ORM\OneToMany(targetEntity=Conteneur::class, mappedBy="reservation")
     */
    private $conteneurs;

    /**
     * @ORM\OneToMany(targetEntity=Chassis::class, mappedBy="reservation")
     */
    private $chassis;

    /**
     * @ORM\OneToMany(targetEntity=Vrack::class, mappedBy="reservation")
     */
    private $vracks;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $portArrive;

    /**
     * @ORM\Column(type="string", length=10000, nullable=true)
     */
    private $reservationText;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archive;


    public function __construct()
    {
        $this->conteneurs = new ArrayCollection();
        $this->chassis = new ArrayCollection();
        $this->vracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateMin(): ?\DateTimeInterface
    {
        return $this->dateMin;
    }

    public function setDateMin(\DateTimeInterface $dateMin): self
    {
        $this->dateMin = $dateMin;

        return $this;
    }

    public function getDateMax(): ?\DateTimeInterface
    {
        return $this->dateMax;
    }

    public function setDateMax(\DateTimeInterface $dateMax): self
    {
        $this->dateMax = $dateMax;

        return $this;
    }

    public function getDateExacte(): ?\DateTimeInterface
    {
        return $this->dateExacte;
    }

    public function setDateExacte(\DateTimeInterface $dateExacte): self
    {
        $this->dateExacte = $dateExacte;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getConfirme(): ?bool
    {
        return $this->confirme;
    }

    public function setConfirme(?bool $confirme): self
    {
        $this->confirme = $confirme;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(?float $tarif): self
    {
        $this->tarif = $tarif;

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
            $conteneur->setReservation($this);
        }

        return $this;
    }

    public function removeConteneur(Conteneur $conteneur): self
    {
        if ($this->conteneurs->removeElement($conteneur)) {
            // set the owning side to null (unless already changed)
            if ($conteneur->getReservation() === $this) {
                $conteneur->setReservation(null);
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
            $chassis->setReservation($this);
        }

        return $this;
    }

    public function removeChassis(Chassis $chassis): self
    {
        if ($this->chassis->removeElement($chassis)) {
            // set the owning side to null (unless already changed)
            if ($chassis->getReservation() === $this) {
                $chassis->setReservation(null);
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
            $vrack->setReservation($this);
        }

        return $this;
    }

    public function removeVrack(Vrack $vrack): self
    {
        if ($this->vracks->removeElement($vrack)) {
            // set the owning side to null (unless already changed)
            if ($vrack->getReservation() === $this) {
                $vrack->setReservation(null);
            }
        }

        return $this;
    }

    public function getPortArrive(): ?string
    {
        return $this->portArrive;
    }

    public function setPortArrive(string $portArrive): self
    {
        $this->portArrive = $portArrive;

        return $this;
    }

    public function getReservationText(): ?string
    {
        return $this->reservationText;
    }

    public function setReservationText(?string $reservationText): self
    {
        $this->reservationText = $reservationText;

        return $this;
    }

    public function getValidationText(): ?string
    {
        return $this->validationText;
    }

    public function setValidationText(?string $validationText): self
    {
        $this->validationText = $validationText;

        return $this;
    }

    public function getConfirmationText(): ?string
    {
        return $this->confirmationText;
    }

    public function setConfirmationText(?string $confirmationText): self
    {
        $this->confirmationText = $confirmationText;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(?bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }
}
