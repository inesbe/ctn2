<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_expiration;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_cont;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_vrac;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_roulant;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(\DateTimeInterface $date_expiration): self
    {
        $this->date_expiration = $date_expiration;

        return $this;
    }

    public function getMaxCont(): ?int
    {
        return $this->max_cont;
    }

    public function setMaxCont(int $max_cont): self
    {
        $this->max_cont = $max_cont;

        return $this;
    }

    public function getMaxVrac(): ?int
    {
        return $this->max_vrac;
    }

    public function setMaxVrac(int $max_vrac): self
    {
        $this->max_vrac = $max_vrac;

        return $this;
    }

    public function getMaxRoulant(): ?int
    {
        return $this->max_roulant;
    }

    public function setMaxRoulant(int $max_roulant): self
    {
        $this->max_roulant = $max_roulant;

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
}
