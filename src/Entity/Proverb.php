<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProverbRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, ProverbCategory>
     */
    #[ORM\OneToMany(targetEntity: ProverbCategory::class, mappedBy: 'proverb', orphanRemoval: true)]
    private Collection $proverbCategories;

    #[ORM\Column(enumType: ProverbStatusEnum::class)]
    private ProverbStatusEnum $status = ProverbStatusEnum::DISABLED;

    public function __construct()
    {
        $this->proverbCategories = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ProverbCategory>
     */
    public function getProverbCategories(): Collection
    {
        return $this->proverbCategories;
    }

    public function addProverbCategory(ProverbCategory $proverbCategory): static
    {
        if (!$this->proverbCategories->contains($proverbCategory)) {
            $this->proverbCategories->add($proverbCategory);
            $proverbCategory->setProverb($this);
        }

        return $this;
    }

    public function removeProverbCategory(ProverbCategory $proverbCategory): static
    {
        if ($this->proverbCategories->removeElement($proverbCategory)) {
            // set the owning side to null (unless already changed)
            if ($proverbCategory->getProverb() === $this) {
                $proverbCategory->setProverb(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?ProverbStatusEnum
    {
        return $this->status;
    }

    public function setStatus(ProverbStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }
}
