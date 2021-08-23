<?php

namespace App\Entity;

use App\Repository\InfoPratiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfoPratiqueRepository::class)
 */
class InfoPratique
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
    private $recommandations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recoepargne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reconecessaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecommandations(): ?string
    {
        return $this->recommandations;
    }

    public function setRecommandations(?string $recommandations): self
    {
        $this->recommandations = $recommandations;

        return $this;
    }

    public function getRecoepargne(): ?string
    {
        return $this->recoepargne;
    }

    public function setRecoepargne(?string $recoepargne): self
    {
        $this->recoepargne = $recoepargne;

        return $this;
    }

    public function getReconecessaire(): ?string
    {
        return $this->reconecessaire;
    }

    public function setReconecessaire(?string $reconecessaire): self
    {
        $this->reconecessaire = $reconecessaire;

        return $this;
    }
}
