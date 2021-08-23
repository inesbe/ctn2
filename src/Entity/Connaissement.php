<?php

namespace App\Entity;

use App\Repository\ConnaissementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConnaissementRepository::class)
 */
class Connaissement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_reservation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_utilisateur;

    /**
     * @ORM\Column(type="integer")
     */
    private $bl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conditions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReservation(): ?int
    {
        return $this->id_reservation;
    }

    public function setIdReservation(int $id_reservation): self
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(int $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

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

    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(string $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }
}
