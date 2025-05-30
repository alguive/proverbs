<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProverbRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProverbRepository::class)]
class Proverb
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'proverb', cascade: ['persist', 'remove'])]
    private ?ProverbContent $proverbContent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getProverbContent(): ?ProverbContent
    {
        return $this->proverbContent;
    }

    public function setProverbContent(ProverbContent $proverbContent): static
    {
        // set the owning side of the relation if necessary
        if ($proverbContent->getProverb() !== $this) {
            $proverbContent->setProverb($this);
        }

        $this->proverbContent = $proverbContent;

        return $this;
    }
}
