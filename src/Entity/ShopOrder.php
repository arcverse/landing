<?php

namespace App\Entity;

use App\Repository\ShopOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopOrderRepository::class)]
class ShopOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ref = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $aff = null;

    #[ORM\Column(length: 255)]
    private ?string $minecraftName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $giftToMinecraftName = null;

    #[ORM\Column]
    private ?int $gross = null;

    #[ORM\Column]
    private ?int $net = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'orderRef', targetEntity: ShopPayment::class)]
    private Collection $payments;

    #[ORM\OneToMany(mappedBy: 'orderRef', targetEntity: ShopSoldItem::class)]
    private Collection $soldItems;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\OneToMany(mappedBy: 'orderRef', targetEntity: ShopPendingMinecraftAction::class)]
    private Collection $pendingMinecraftActions;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $orderId = null;

    public function __toString(): string
    {
        return $this->minecraftName." - ".$this->createdAt->format('Y-m-d H:i:s');
    }

    public function __construct()
    {
        $this->payments = new ArrayCollection();
        $this->soldItems = new ArrayCollection();
        $this->pendingMinecraftActions = new ArrayCollection();
        $this->orderId = uniqid();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getAff(): ?string
    {
        return $this->aff;
    }

    public function setAff(?string $aff): static
    {
        $this->aff = $aff;

        return $this;
    }

    public function getMinecraftName(): ?string
    {
        return $this->minecraftName;
    }

    public function setMinecraftName(string $minecraftName): static
    {
        $this->minecraftName = $minecraftName;

        return $this;
    }

    public function getGiftToMinecraftName(): ?string
    {
        return $this->giftToMinecraftName;
    }

    public function setGiftToMinecraftName(?string $giftToMinecraftName): static
    {
        $this->giftToMinecraftName = $giftToMinecraftName;

        return $this;
    }

    public function getGross(): ?int
    {
        return $this->gross;
    }

    public function setGross(int $gross): static
    {
        $this->gross = $gross;
        $this->net = $gross + ($gross * 0.19);

        return $this;
    }

    public function getNet(): ?int
    {
        return $this->net;
    }

    public function setNet(int $net): static
    {
        $this->net = $net;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

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
     * @return Collection<int, ShopPayment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(ShopPayment $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setOrderRef($this);
        }

        return $this;
    }

    public function removePayment(ShopPayment $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getOrderRef() === $this) {
                $payment->setOrderRef(null);
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
            $soldItem->setOrderRef($this);
        }

        return $this;
    }

    public function removeSoldItem(ShopSoldItem $soldItem): static
    {
        if ($this->soldItems->removeElement($soldItem)) {
            // set the owning side to null (unless already changed)
            if ($soldItem->getOrderRef() === $this) {
                $soldItem->setOrderRef(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, ShopPendingMinecraftAction>
     */
    public function getPendingMinecraftActions(): Collection
    {
        return $this->pendingMinecraftActions;
    }

    public function addPendingMinecraftAction(ShopPendingMinecraftAction $pendingMinecraftAction): static
    {
        if (!$this->pendingMinecraftActions->contains($pendingMinecraftAction)) {
            $this->pendingMinecraftActions->add($pendingMinecraftAction);
            $pendingMinecraftAction->setOrderRef($this);
        }

        return $this;
    }

    public function removePendingMinecraftAction(ShopPendingMinecraftAction $pendingMinecraftAction): static
    {
        if ($this->pendingMinecraftActions->removeElement($pendingMinecraftAction)) {
            // set the owning side to null (unless already changed)
            if ($pendingMinecraftAction->getOrderRef() === $this) {
                $pendingMinecraftAction->setOrderRef(null);
            }
        }

        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }
}
