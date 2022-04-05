<?php

namespace App\Entity;

use App\Repository\BookingCannesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingCannesRepository::class)]
class BookingCannes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'bookingCannes')]
    #[ORM\JoinColumn(nullable: false)]
    private $bookers;

    #[ORM\Column(type: 'datetime')]
    private $endDate;

    #[ORM\Column(type: 'datetime')]
    private $startDate;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: RoomsCannes::class, inversedBy: 'bookingCannes')]
    #[ORM\JoinColumn(nullable: false)]
    private $rooms;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookers(): ?Users
    {
        return $this->bookers;
    }

    public function setBookers(?Users $bookers): self
    {
        $this->bookers = $bookers;

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

    public function getRooms(): ?roomsCannes
    {
        return $this->rooms;
    }

    public function setRooms(?roomsCannes $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function delete ($id)
    {
        $booking = $this->session->get('bookingCannes');

        unset($booking,$id);

        return $this->session->set('bookingCannes', $booking);
    }
}
