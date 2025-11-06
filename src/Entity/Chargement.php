<?php

namespace App\Entity;

use App\Repository\ChargementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ChargementRepository::class)]
class Chargement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull(message: 'Choisissez un client.')]
    #[ORM\ManyToOne(inversedBy: 'chargements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[Assert\NotNull(message: 'Choisissez un transporteur.')]
    #[ORM\ManyToOne(inversedBy: 'chargements')]
    private ?Transporteur $transporteur = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, ChargementProduit>
     */
    #[ORM\OneToMany(targetEntity: ChargementProduit::class, mappedBy: 'chargement', cascade: ["all"])]
    private Collection $chargementProduits;

    public function __construct()
    {
        $this->chargementProduits = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public function __toString()
    {
        return "#{$this->id} - client: {$this->client->__toString()} + transporteur: {$this->transporteur->__toString()}";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getTransporteur(): ?Transporteur
    {
        return $this->transporteur;
    }

    public function setTransporteur(?Transporteur $transporteur): static
    {
        $this->transporteur = $transporteur;

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
            $chargementProduit->setChargement($this);
        }

        return $this;
    }

    public function removeChargementProduit(ChargementProduit $chargementProduit): static
    {
        if ($this->chargementProduits->removeElement($chargementProduit)) {
            // set the owning side to null (unless already changed)
            if ($chargementProduit->getChargement() === $this) {
                $chargementProduit->setChargement(null);
            }
        }

        return $this;
    }
}
