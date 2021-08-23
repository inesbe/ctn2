<?php

namespace App\Entity;

use App\Repository\RotationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RotationRepository::class)
 */
class Rotation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_navire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Port_depart;

    /**
     * @ORM\Column(type="date")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Port_arrive;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_arrive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_ligne;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNomNavire(): ?string
    {
        return $this->nom_navire;
    }

    public function setNomNavire(string $nom_navire): self
    {
        $this->nom_navire = $nom_navire;

        return $this;
    }

    public function getPortDepart(): ?string
    {
        return $this->Port_depart;
    }

    public function setPortDepart(string $Port_depart): self
    {
        $this->Port_depart = $Port_depart;

        return $this;
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

    public function getPortArrive(): ?string
    {
        return $this->Port_arrive;
    }

    public function setPortArrive(string $Port_arrive): self
    {
        $this->Port_arrive = $Port_arrive;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->Date_arrive;
    }

    public function setDateArrive(\DateTimeInterface $Date_arrive): self
    {
        $this->Date_arrive = $Date_arrive;

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

    public function getIdLigne(): ?int
    {
        return $this->id_ligne;
    }

    public function setIdLigne(?int $id_ligne): self
    {
        $this->id_ligne = $id_ligne;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
