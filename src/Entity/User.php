<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="user")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=CommentairesMedia::class, mappedBy="user")
     */
    private $commentaireMedia;


    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->commentaireMedia = new ArrayCollection();
    }

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
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|commentairesMedia[]
     */
    public function getCommentaireMedia(): Collection
    {
        return $this->commentaireMedia;
    }

    public function addCommentaireMedium(commentairesMedia $commentaireMedium): self
    {
        if (!$this->commentaireMedia->contains($commentaireMedium)) {
            $this->commentaireMedia[] = $commentaireMedium;
            $commentaireMedium->setUser($this);
        }

        return $this;
    }

    public function removeCommentaireMedium(commentairesMedia $commentaireMedium): self
    {
        if ($this->commentaireMedia->removeElement($commentaireMedium)) {
            // set the owning side to null (unless already changed)
            if ($commentaireMedium->getUser() === $this) {
                $commentaireMedium->setUser(null);
            }
        }

        return $this;
    }


}
