<?php

namespace App\Entity;

use App\Repository\MediasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MediasRepository::class)
 */
class Medias
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez ajouter un titre.")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "1024M",
     * )
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Assert\NotBlank(message="Veuillez ajouter une description.")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=CommentairesMedia::class, mappedBy="medias")
     */
    private $commentaire;

    public function __construct()
    {
        $this->commentaire = new ArrayCollection();
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

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    /**
     * @return Collection|CommentairesMedia[]
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(CommentairesMedia $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setMedias($this);
        }

        return $this;
    }

    public function removeCommentaire(CommentairesMedia $commentaire): self
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getMedias() === $this) {
                $commentaire->setMedias(null);
            }
        }

        return $this;
    }
}
