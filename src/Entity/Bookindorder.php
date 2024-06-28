<?php

namespace App\Entity;

use App\Repository\BookindorderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookindorderRepository::class)]
class Bookindorder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["book"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["book"])]
    private ?string $hotel = null;

    #[ORM\Column(length: 255)]
    #[Groups(["book"])]
    private ?string $destination = null;

    #[ORM\Column(length: 255)]
    #[Groups(["book"])]
    private ?string $bookingdate = null;

    #[ORM\Column(length: 255)]
    #[Groups(["book"])]
    private ?string $orderdate = null;

    #[ORM\Column(length: 1600, nullable: true)]
    #[Groups(["book"])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(["book"])]
    private ?int $cabs = null;

    #[ORM\Column]
    #[Groups(["book"])]
    private ?int $rent = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["book"])]
    private ?int $status = null;

    #[ORM\Column(length: 255)]
    #[Groups(["book"])]
    private ?string $month = null;

    #[Groups(["book"])]
    #[ORM\Column(length: 255)]
    private ?string $year = null;

    #[Groups(["book"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cabdatacount = null;

    #[Groups(["book"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $time = null;
    // status 0 = approved, 1 = active, 2 = canceled, 3 = removed from admin

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotel(): ?string
    {
        return $this->hotel;
    }

    public function setHotel(string $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getBookingdate(): ?string
    {
        return $this->bookingdate;
    }

    public function setBookingdate(string $bookingdate): static
    {
        $this->bookingdate = $bookingdate;

        return $this;
    }

    public function getOrderdate(): ?string
    {
        return $this->orderdate;
    }

    public function setOrderdate(string $orderdate): static
    {
        $this->orderdate = $orderdate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCabs(): ?int
    {
        return $this->cabs;
    }

    public function setCabs(int $cabs): static
    {
        $this->cabs = $cabs;

        return $this;
    }

    public function getRent(): ?int
    {
        return $this->rent;
    }

    public function setRent(int $rent): static
    {
        $this->rent = $rent;

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

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(string $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getCabdatacount(): ?string
    {
        return $this->cabdatacount;
    }

    public function setCabdatacount(?string $cabdatacount): static
    {
        $this->cabdatacount = $cabdatacount;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): static
    {
        $this->time = $time;

        return $this;
    }
}
