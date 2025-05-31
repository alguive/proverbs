<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $parent = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, ProverbCategory>
     */
    #[ORM\OneToMany(targetEntity: ProverbCategory::class, mappedBy: 'category', orphanRemoval: true)]
    private Collection $proverbCategories;

    #[ORM\Column(
        enumType: CategoryStatusEnum::class,
        options: ['default' => ProverbStatusEnum::ENABLED->value]
    )]
    private CategoryStatusEnum $status = CategoryStatusEnum::ENABLED;

    public function __construct()
    {
        $this->proverbCategories = new ArrayCollection();
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

    public function getParent(): ?int
    {
        return $this->parent;
    }

    public function setParent(?int $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

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
            $proverbCategory->setCategory($this);
        }

        return $this;
    }

    public function removeProverbCategory(ProverbCategory $proverbCategory): static
    {
        if ($this->proverbCategories->removeElement($proverbCategory)) {
            // set the owning side to null (unless already changed)
            if ($proverbCategory->getCategory() === $this) {
                $proverbCategory->setCategory(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?CategoryStatusEnum
    {
        return $this->status;
    }

    public function setStatus(CategoryStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }
}
