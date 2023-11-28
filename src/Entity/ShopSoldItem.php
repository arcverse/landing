<?php

namespace App\Entity;

use App\Repository\ShopSoldItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopSoldItemRepository::class)]
class ShopSoldItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'soldItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShopOrder $orderRef = null;

    #[ORM\ManyToOne(inversedBy: 'soldItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShopItem $item = null;

    #[ORM\Column]
    private ?int $amount = null;

    public function __toString(): string
    {
        return $this->item->getName() . ' x' . $this->amount;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderRef(): ?ShopOrder
    {
        return $this->orderRef;
    }

    public function setOrderRef(?ShopOrder $orderRef): static
    {
        $this->orderRef = $orderRef;

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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
}
