<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["destination"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["destination"])]
    private ?string $destname = null;

    #[ORM\Column]
    #[Groups(["destination"])]
    private ?int $deststatus = null;

    #[ORM\OneToMany(mappedBy: 'destid', targetEntity: Setdest::class)]
    #[Groups(["destination"])]
    private Collection $setdests;

    public function __construct()
    {
        $this->setdests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestname(): ?string
    {
        return $this->destname;
    }

    public function setDestname(string $destname): static
    {
        $this->destname = $destname;

        return $this;
    }

    public function getDeststatus(): ?int
    {
        return $this->deststatus;
    }

    public function setDeststatus(int $deststatus): static
    {
        $this->deststatus = $deststatus;

        return $this;
    }

    /**
     * @return Collection<int, Setdest>
     */
    public function getSetdests(): Collection
    {
        return $this->setdests;
    }

    public function addSetdest(Setdest $setdest): static
    {
        if (!$this->setdests->contains($setdest)) {
            $this->setdests->add($setdest);
            $setdest->setDestid($this);
        }

        return $this;
    }

    public function removeSetdest(Setdest $setdest): static
    {
        if ($this->setdests->removeElement($setdest)) {
            // set the owning side to null (unless already changed)
            if ($setdest->getDestid() === $this) {
                $setdest->setDestid(null);
            }
        }

        return $this;
    }
}
