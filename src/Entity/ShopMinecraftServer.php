<?php

namespace App\Entity;

use App\Repository\ShopMinecraftServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopMinecraftServerRepository::class)]
class ShopMinecraftServer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $secret = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: ShopItem::class, mappedBy: 'minecraftServers')]
    private Collection $items;

    public function __toString(): string
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->secret = bin2hex(random_bytes(32));
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

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): static
    {
        $this->secret = $secret;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, ShopItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(ShopItem $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->addMinecraftServer($this);
        }

        return $this;
    }

    public function removeItem(ShopItem $item): static
    {
        if ($this->items->removeElement($item)) {
            $item->removeMinecraftServer($this);
        }

        return $this;
    }
}
