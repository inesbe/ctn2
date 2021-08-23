<?php

namespace App\Entity;

use App\Repository\CommentairesMediaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentairesMediaRepository::class)
 */
class CommentairesMedia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $commentaireMed;

    /**
     * @ORM\ManyToOne(targetEntity=Medias::class, inversedBy="commentaire")
     */
    private $medias;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commentaireMedia")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Guest::class, inversedBy="commentairesMedia")
     */
    private $guest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaireMed(): ?string
    {
        return $this->commentaireMed;
    }

    public function setCommentaireMed(string $commentaireMed): self
    {
        $this->commentaireMed = $commentaireMed;

        return $this;
    }

    public function getMedias(): ?Medias
    {
        return $this->medias;
    }

    public function setMedias(?Medias $medias): self
    {
        $this->medias = $medias;

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

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }
}
