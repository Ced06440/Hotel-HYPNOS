<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookingParisRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[ORM\Entity(repositoryClass: BookingParisRepository::class)]
class BookingParis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'bookingParis')]
    #[ORM\JoinColumn(nullable: false)]
    private $bookers;

    #[ORM\Column(type: 'datetime')]
    private $endDate;

    #[ORM\Column(type: 'datetime')]
    private $startDate;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: RoomsParis::class, inversedBy: 'bookingParis')]
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

    public function getRooms(): ?RoomsParis
    {
        return $this->rooms;
    }

    public function setRooms(?RoomsParis $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }
    
    private $session;

    public function _construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function delete ($id)
    {
        $booking = $this->session->get('bookingParis');

        unset($booking,$id);

        return $this->session->set('bookingParis', $booking);
    }
}
