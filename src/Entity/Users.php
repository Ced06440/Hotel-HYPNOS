<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToOne(targetEntity: Hotel::class, cascade: ['persist', 'remove'])]
    private $hotel;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lastname;

    #[ORM\OneToMany(mappedBy: 'booker', targetEntity: Booking::class)]
    private $endDate;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingAuxerre::class)]
    private $bookingAuxerres;



    public function __toString()
    {
        return $this->getlastName();
    }

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->endDate = new ArrayCollection();
        $this->bookingAuxerres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getEndDate(): Collection
    {
        return $this->endDate;
    }

    public function addEndDate(Booking $endDate): self
    {
        if (!$this->endDate->contains($endDate)) {
            $this->endDate[] = $endDate;
            $endDate->setBooker($this);
        }

        return $this;
    }

    public function removeEndDate(Booking $endDate): self
    {
        if ($this->endDate->removeElement($endDate)) {
            // set the owning side to null (unless already changed)
            if ($endDate->getBooker() === $this) {
                $endDate->setBooker(null);
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
            $bookingAuxerre->setBookers($this);
        }

        return $this;
    }

    public function removeBookingAuxerre(BookingAuxerre $bookingAuxerre): self
    {
        if ($this->bookingAuxerres->removeElement($bookingAuxerre)) {
            // set the owning side to null (unless already changed)
            if ($bookingAuxerre->getBookers() === $this) {
                $bookingAuxerre->setBookers(null);
            }
        }

        return $this;
    }


}
