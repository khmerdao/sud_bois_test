<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull(message: 'Votre produit doit être nommé.')]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, ChargementProduit>
     */
    #[ORM\OneToMany(targetEntity: ChargementProduit::class, mappedBy: 'produit')]
    private Collection $chargementProduits;

    public function __construct()
    {
        $this->chargementProduits = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public function __toString()
    {
        return "#{$this->id} - {$this->name}";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, ChargementProduit>
     */
    public function getChargementProduits(): Collection
    {
        return $this->chargementProduits;
    }

    public function addChargementProduit(ChargementProduit $chargementProduit): static
    {
        if (!$this->chargementProduits->contains($chargementProduit)) {
            $this->chargementProduits->add($chargementProduit);
            $chargementProduit->setProduit($this);
        }

        return $this;
    }

    public function removeChargementProduit(ChargementProduit $chargementProduit): static
    {
        if ($this->chargementProduits->removeElement($chargementProduit)) {
            // set the owning side to null (unless already changed)
            if ($chargementProduit->getProduit() === $this) {
                $chargementProduit->setProduit(null);
            }
        }

        return $this;
    }
}
