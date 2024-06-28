<?php

namespace App\Entity;

use App\Repository\SetdestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: SetdestRepository::class)]
class Setdest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getset"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getset"])]
    private ?string $price = null;

    #[ORM\Column]
    #[Groups(["getset"])]
    private ?int $status = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getset"])]
    private ?string $clientname = null;

    #[ORM\ManyToOne(inversedBy: 'setdests')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["getset"])]
    private ?Destination $destid = null;

    #[ORM\Column]
    #[Groups(["getset"])]
    private ?int $hotelid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getClientname(): ?string
    {
        return $this->clientname;
    }

    public function setClientname(string $clientname): static
    {
        $this->clientname = $clientname;

        return $this;
    }

    public function getDestid(): ?Destination
    {
        return $this->destid;
    }

    public function setDestid(?Destination $destid): static
    {
        $this->destid = $destid;

        return $this;
    }

    public function getHotelid(): ?int
    {
        return $this->hotelid;
    }

    public function setHotelid(int $hotelid): static
    {
        $this->hotelid = $hotelid;

        return $this;
    }
}
