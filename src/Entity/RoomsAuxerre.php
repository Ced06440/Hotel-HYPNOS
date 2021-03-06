<?php

namespace App\Entity;

use App\Repository\RoomsAuxerreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsAuxerreRepository::class)]
class RoomsAuxerre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Booking::class)]
    private $bookings;

    #[ORM\OneToMany(mappedBy: 'rooms', targetEntity: BookingAuxerre::class)]
    private $bookingAuxerres;


    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->bookingAuxerres = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setRooms($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getRooms() === $this) {
                $booking->setRooms(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingAuxerre>
     */
    public function getBookingAuxerres(): Collection
    {
        return $this->bookingAuxerres;
    }

    public function addBookingAuxerre(BookingAuxerre $bookingAuxerre): self
    {
        if (!$this->bookingAuxerres->contains($bookingAuxerre)) {
            $this->bookingAuxerres[] = $bookingAuxerre;
            $bookingAuxerre->setRooms($this);
        }

        return $this;
    }

    public function removeBookingAuxerre(BookingAuxerre $bookingAuxerre): self
    {
        if ($this->bookingAuxerres->removeElement($bookingAuxerre)) {
            // set the owning side to null (unless already changed)
            if ($bookingAuxerre->getRooms() === $this) {
                $bookingAuxerre->setRooms(null);
            }
        }

        return $this;
    }


}
