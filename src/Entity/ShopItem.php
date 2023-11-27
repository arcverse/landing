<?php

namespace App\Entity;

use App\Repository\ShopItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopItemRepository::class)]
class ShopItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?ShopCategory $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    private ?\DateInterval $removeAfter = null;

    #[ORM\Column(nullable: true)]
    private ?int $globalLimit = null;

    #[ORM\Column]
    private ?bool $onePerUser = null;

    #[ORM\ManyToMany(targetEntity: self::class)]
    private Collection $requiredItems;

    #[ORM\Column]
    private ?bool $requireOnlyOne = null;

    #[ORM\Column]
    private ?bool $allowQuantity = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $publishFrom = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $publishTill = null;

    #[ORM\Column]
    private ?bool $hideOnLogout = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: ShopMinecraftServer::class, inversedBy: 'items')]
    private Collection $minecraftServers;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ShopMinecraftAction::class, orphanRemoval: true)]
    private Collection $minecraftActions;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ShopSoldItem::class)]
    private Collection $soldItems;

    public function __toString(): string
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->requiredItems = new ArrayCollection();
        $this->minecraftServers = new ArrayCollection();
        $this->minecraftActions = new ArrayCollection();
        $this->soldItems = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategory(): ?ShopCategory
    {
        return $this->category;
    }

    public function setCategory(?ShopCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImagePath(): string
    {
        return 'uploads/shop/images/' . $this->getImage();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getRemoveAfter(): ?\DateInterval
    {
        return $this->removeAfter;
    }

    public function setRemoveAfter(?\DateInterval $removeAfter): static
    {
        $this->removeAfter = $removeAfter;

        return $this;
    }

    public function getGlobalLimit(): ?int
    {
        return $this->globalLimit;
    }

    public function setGlobalLimit(?int $globalLimit): static
    {
        $this->globalLimit = $globalLimit;

        return $this;
    }

    public function isOnePerUser(): ?bool
    {
        return $this->onePerUser;
    }

    public function setOnePerUser(bool $onePerUser): static
    {
        $this->onePerUser = $onePerUser;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRequiredItems(): Collection
    {
        return $this->requiredItems;
    }

    public function addRequiredItem(self $requiredItem): static
    {
        if (!$this->requiredItems->contains($requiredItem)) {
            $this->requiredItems->add($requiredItem);
        }

        return $this;
    }

    public function removeRequiredItem(self $requiredItem): static
    {
        $this->requiredItems->removeElement($requiredItem);

        return $this;
    }

    public function isRequireOnlyOne(): ?bool
    {
        return $this->requireOnlyOne;
    }

    public function setRequireOnlyOne(bool $requireOnlyOne): static
    {
        $this->requireOnlyOne = $requireOnlyOne;

        return $this;
    }

    public function isAllowQuantity(): ?bool
    {
        return $this->allowQuantity;
    }

    public function setAllowQuantity(bool $allowQuantity): static
    {
        $this->allowQuantity = $allowQuantity;

        return $this;
    }

    public function getPublishFrom(): ?\DateTimeImmutable
    {
        return $this->publishFrom;
    }

    public function setPublishFrom(?\DateTimeImmutable $publishFrom): static
    {
        $this->publishFrom = $publishFrom;

        return $this;
    }

    public function getPublishTill(): ?\DateTimeImmutable
    {
        return $this->publishTill;
    }

    public function setPublishTill(?\DateTimeImmutable $publishTill): static
    {
        $this->publishTill = $publishTill;

        return $this;
    }

    public function isHideOnLogout(): ?bool
    {
        return $this->hideOnLogout;
    }

    public function setHideOnLogout(bool $hideOnLogout): static
    {
        $this->hideOnLogout = $hideOnLogout;

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

    /**
     * @return Collection<int, ShopMinecraftAction>
     */
    public function getMinecraftActions(): Collection
    {
        return $this->minecraftActions;
    }

    public function addMinecraftAction(ShopMinecraftAction $minecraftAction): static
    {
        if (!$this->minecraftActions->contains($minecraftAction)) {
            $this->minecraftActions->add($minecraftAction);
            $minecraftAction->setItem($this);
        }

        return $this;
    }

    public function removeMinecraftAction(ShopMinecraftAction $minecraftAction): static
    {
        if ($this->minecraftActions->removeElement($minecraftAction)) {
            // set the owning side to null (unless already changed)
            if ($minecraftAction->getItem() === $this) {
                $minecraftAction->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ShopSoldItem>
     */
    public function getSoldItems(): Collection
    {
        return $this->soldItems;
    }

    public function addSoldItem(ShopSoldItem $soldItem): static
    {
        if (!$this->soldItems->contains($soldItem)) {
            $this->soldItems->add($soldItem);
            $soldItem->setItem($this);
        }

        return $this;
    }

    public function removeSoldItem(ShopSoldItem $soldItem): static
    {
        if ($this->soldItems->removeElement($soldItem)) {
            // set the owning side to null (unless already changed)
            if ($soldItem->getItem() === $this) {
                $soldItem->setItem(null);
            }
        }

        return $this;
    }
}
