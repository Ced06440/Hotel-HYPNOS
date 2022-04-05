<?php

namespace App\Entity;

use App\Repository\RoomsChamonixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsChamonixRepository::class)]
class RoomsChamonix
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

    #[ORM\OneToMany(mappedBy: 'rooms', targetEntity: BookingChamonix::class)]
    private $bookingChamonixes;

    public function __construct()
    {
        $this->bookingChamonixes = new ArrayCollection();
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
     * @return Collection<int, BookingChamonix>
     */
    public function getBookingChamonixes(): Collection
    {
        return $this->bookingChamonixes;
    }

    public function addBookingChamonix(BookingChamonix $bookingChamonix): self
    {
        if (!$this->bookingChamonixes->contains($bookingChamonix)) {
            $this->bookingChamonixes[] = $bookingChamonix;
            $bookingChamonix->setRooms($this);
        }

        return $this;
    }

    public function removeBookingChamonix(BookingChamonix $bookingChamonix): self
    {
        if ($this->bookingChamonixes->removeElement($bookingChamonix)) {
            // set the owning side to null (unless already changed)
            if ($bookingChamonix->getRooms() === $this) {
                $bookingChamonix->setRooms(null);
            }
        }

        return $this;
    }
}
