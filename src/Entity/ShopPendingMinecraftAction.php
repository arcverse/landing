<?php

namespace App\Entity;

use App\Repository\ShopPendingMinecraftActionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopPendingMinecraftActionRepository::class)]
class ShopPendingMinecraftAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pendingMinecraftActions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShopOrder $orderRef = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShopMinecraftAction $minecraftAction = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $executedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function getMinecraftAction(): ?ShopMinecraftAction
    {
        return $this->minecraftAction;
    }

    public function setMinecraftAction(?ShopMinecraftAction $minecraftAction): static
    {
        $this->minecraftAction = $minecraftAction;

        return $this;
    }

    public function getExecutedAt(): ?\DateTimeImmutable
    {
        return $this->executedAt;
    }

    public function setExecutedAt(?\DateTimeImmutable $executedAt): static
    {
        $this->executedAt = $executedAt;

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
}
