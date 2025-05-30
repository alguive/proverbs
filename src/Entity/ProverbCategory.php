<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProverbCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProverbCategoryRepository::class)]
class ProverbCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'proverbCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proverb $proverb = null;

    #[ORM\ManyToOne(inversedBy: 'proverbCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProverb(): ?Proverb
    {
        return $this->proverb;
    }

    public function setProverb(?Proverb $proverb): static
    {
        $this->proverb = $proverb;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
