<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OffresRepository::class)
 */
class Offres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="Veuillez entrer une date.")
     */
    private $dateRelease;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=10000, nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="offres")
     */
    private $commentaires;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $pdfResultat;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $resultRelDate;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateRelease(): ?\DateTimeInterface
    {
        return $this->dateRelease;
    }

    public function setDateRelease(?\DateTimeInterface $dateRelease): self
    {
        $this->dateRelease = $dateRelease;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setOffres($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getOffres() === $this) {
                $commentaire->setOffres(null);
            }
        }

        return $this;
    }

    public function getPdfResultat(): ?string
    {
        return $this->pdfResultat;
    }

    public function setPdfResultat(?string $pdfResultat): self
    {
        $this->pdfResultat = $pdfResultat;

        return $this;
    }

    public function getResultRelDate(): ?\DateTimeInterface
    {
        return $this->resultRelDate;
    }

    public function setResultRelDate(?\DateTimeInterface $resultRelDate): self
    {
        $this->resultRelDate = $resultRelDate;

        return $this;
    }
}
