<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private $booker;

    #[ORM\Column(type: 'datetime')]
    private $endDate;

    #[ORM\Column(type: 'datetime')]
    private $startDate;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: RoomsAuxerre::class, inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private $rooms;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'bookings')]
    private $hotels;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooker(): ?Users
    {
        return $this->booker;
    }

    public function setBooker(?Users $booker): self
    {
        $this->booker = $booker;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRooms(): ?RoomsAuxerre
    {
        return $this->rooms;
    }

    public function setRooms(?RoomsAuxerre $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getDuration()
    {
        $diff = $this->endDate->diff($this->startDate);
        return $diff->days;
    }

    public function getHotels(): ?Hotel
    {
        return $this->hotels;
    }

    public function setHotels(?Hotel $hotels): self
    {
        $this->hotels = $hotels;

        return $this;
    }

}
