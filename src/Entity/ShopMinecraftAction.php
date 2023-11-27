<?php

namespace App\Entity;

use App\Repository\ShopMinecraftActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopMinecraftActionRepository::class)]
class ShopMinecraftAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $trigger = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\ManyToMany(targetEntity: ShopMinecraftServer::class)]
    private Collection $minecraftServers;

    #[ORM\Column]
    private ?bool $requirePlayerOnline = null;

    #[ORM\Column]
    private ?int $requiredInventorySlots = null;

    #[ORM\ManyToOne(inversedBy: 'minecraftActions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShopItem $item = null;

    public function __toString(): string
    {
        return $this->trigger . ' ' . $this->value;
    }

    public function __construct()
    {
        $this->minecraftServers = new ArrayCollection();
        $this->requiredInventorySlots = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrigger(): ?string
    {
        return $this->trigger;
    }

    public function setTrigger(string $trigger): static
    {
        $this->trigger = $trigger;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, ShopMinecraftServer>
     */
    public function getMinecraftServers(): Collection
    {
        return $this->minecraftServers;
    }

    public function addMinecraftServer(ShopMinecraftServer $minecraftServer): static
    {
        if (!$this->minecraftServers->contains($minecraftServer)) {
            $this->minecraftServers->add($minecraftServer);
        }

        return $this;
    }

    public function removeMinecraftServer(ShopMinecraftServer $minecraftServer): static
    {
        $this->minecraftServers->removeElement($minecraftServer);

        return $this;
    }

    public function isRequirePlayerOnline(): ?bool
    {
        return $this->requirePlayerOnline;
    }

    public function setRequirePlayerOnline(bool $requirePlayerOnline): static
    {
        $this->requirePlayerOnline = $requirePlayerOnline;

        return $this;
    }

    public function getRequiredInventorySlots(): ?int
    {
        return $this->requiredInventorySlots;
    }

    public function setRequiredInventorySlots(int $requiredInventorySlots): static
    {
        $this->requiredInventorySlots = $requiredInventorySlots;

        return $this;
    }

    public function getItem(): ?ShopItem
    {
        return $this->item;
    }

    public function setItem(?ShopItem $item): static
    {
        $this->item = $item;

        return $this;
    }
}
