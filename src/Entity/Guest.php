<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuestRepository::class)
 */
class Guest
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="guest")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=CommentairesMedia::class, mappedBy="guest")
     */
    private $commentairesMedia;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->commentairesMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
            $commentaire->setGuest($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getGuest() === $this) {
                $commentaire->setGuest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommentairesMedia[]
     */
    public function getCommentairesMedia(): Collection
    {
        return $this->commentairesMedia;
    }

    public function addCommentairesMedium(CommentairesMedia $commentairesMedium): self
    {
        if (!$this->commentairesMedia->contains($commentairesMedium)) {
            $this->commentairesMedia[] = $commentairesMedium;
            $commentairesMedium->setGuest($this);
        }

        return $this;
    }

    public function removeCommentairesMedium(CommentairesMedia $commentairesMedium): self
    {
        if ($this->commentairesMedia->removeElement($commentairesMedium)) {
            // set the owning side to null (unless already changed)
            if ($commentairesMedium->getGuest() === $this) {
                $commentairesMedium->setGuest(null);
            }
        }

        return $this;
    }
}
