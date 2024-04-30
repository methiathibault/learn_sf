<?php

namespace App\Entity;

use App\Repository\GoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoutRepository::class)]
class Gout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Fruit>
     */
    #[ORM\OneToMany(targetEntity: Fruit::class, mappedBy: 'gout')]
    private Collection $fruits;

    public function __construct()
    {
        $this->fruits = new ArrayCollection();
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

    /**
     * @return Collection<int, Fruit>
     */
    public function getFruits(): Collection
    {
        return $this->fruits;
    }

    public function addFruit(Fruit $fruit): static
    {
        if (!$this->fruits->contains($fruit)) {
            $this->fruits->add($fruit);
            $fruit->setGout($this);
        }

        return $this;
    }

    public function removeFruit(Fruit $fruit): static
    {
        if ($this->fruits->removeElement($fruit)) {
            // set the owning side to null (unless already changed)
            if ($fruit->getGout() === $this) {
                $fruit->setGout(null);
            }
        }

        return $this;
    }
}
