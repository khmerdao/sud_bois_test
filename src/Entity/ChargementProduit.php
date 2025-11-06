<?php

namespace App\Entity;

use App\Repository\ChargementProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ChargementProduitRepository::class)]
class ChargementProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull(message: 'Choisissez un chargement.')]
    #[ORM\ManyToOne(inversedBy: 'chargementProduits')]
    private ?Chargement $chargement = null;

    #[Assert\NotNull(message: 'Choisissez un produit.')]
    #[ORM\ManyToOne(inversedBy: 'chargementProduits')]
    private ?Produit $produit = null;

    #[Assert\NotNull(message: 'Veuillez renseigné une quantité au dessus de 0.')]
    #[Assert\NegativeOrZero]
    #[ORM\Column(nullable: false)]
    private int $quantite = 1;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    public function __toString()
    {
        $produit = ($this->produit != null) ? $this->produit->__toString() . ' x ' . $this->quantite : 'aucun produit';
        
        return "#{$this->id} - {$produit}";
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChargement(): ?Chargement
    {
        return $this->chargement;
    }

    public function setChargement(?Chargement $chargement): static
    {
        $this->chargement = $chargement;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

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
}
