<?php

namespace App\Entity;

use App\Repository\RoomsParisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsParisRepository::class)]
class RoomsParis
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

    #[ORM\OneToMany(mappedBy: 'rooms', targetEntity: BookingParis::class)]
    private $bookingParis;

    public function __toString()
    {
        return $this->getName();
    }
    
    public function __construct()
    {
        $this->bookingParis = new ArrayCollection();
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
     * @return Collection<int, BookingParis>
     */
    public function getBookingParis(): Collection
    {
        return $this->bookingParis;
    }

    public function addBookingPari(BookingParis $bookingPari): self
    {
        if (!$this->bookingParis->contains($bookingPari)) {
            $this->bookingParis[] = $bookingPari;
            $bookingPari->setRooms($this);
        }

        return $this;
    }

    public function removeBookingPari(BookingParis $bookingPari): self
    {
        if ($this->bookingParis->removeElement($bookingPari)) {
            // set the owning side to null (unless already changed)
            if ($bookingPari->getRooms() === $this) {
                $bookingPari->setRooms(null);
            }
        }

        return $this;
    }
}
