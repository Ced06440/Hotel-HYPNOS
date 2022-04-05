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

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingParis::class)]
    private $bookingParis;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingCannes::class)]
    private $bookingCannes;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingNice::class)]
    private $bookingNices;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingMandelieu::class)]
    private $bookingMandelieus;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingTheoule::class)]
    private $bookingTheoules;

    #[ORM\OneToMany(mappedBy: 'bookers', targetEntity: BookingChamonix::class)]
    private $bookingChamonixes;



    public function __toString()
    {
        return $this->getlastName();
    }

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->endDate = new ArrayCollection();
        $this->bookingAuxerres = new ArrayCollection();
        $this->bookingParis = new ArrayCollection();
        $this->bookingCannes = new ArrayCollection();
        $this->bookingNices = new ArrayCollection();
        $this->bookingMandelieus = new ArrayCollection();
        $this->bookingTheoules = new ArrayCollection();
        $this->bookingChamonixes = new ArrayCollection();
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
            $bookingPari->setBookers($this);
        }

        return $this;
    }

    public function removeBookingPari(BookingParis $bookingPari): self
    {
        if ($this->bookingParis->removeElement($bookingPari)) {
            // set the owning side to null (unless already changed)
            if ($bookingPari->getBookers() === $this) {
                $bookingPari->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingCannes>
     */
    public function getBookingCannes(): Collection
    {
        return $this->bookingCannes;
    }

    public function addBookingCanne(BookingCannes $bookingCanne): self
    {
        if (!$this->bookingCannes->contains($bookingCanne)) {
            $this->bookingCannes[] = $bookingCanne;
            $bookingCanne->setBookers($this);
        }

        return $this;
    }

    public function removeBookingCanne(BookingCannes $bookingCanne): self
    {
        if ($this->bookingCannes->removeElement($bookingCanne)) {
            // set the owning side to null (unless already changed)
            if ($bookingCanne->getBookers() === $this) {
                $bookingCanne->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingNice>
     */
    public function getBookingNices(): Collection
    {
        return $this->bookingNices;
    }

    public function addBookingNice(BookingNice $bookingNice): self
    {
        if (!$this->bookingNices->contains($bookingNice)) {
            $this->bookingNices[] = $bookingNice;
            $bookingNice->setBookers($this);
        }

        return $this;
    }

    public function removeBookingNice(BookingNice $bookingNice): self
    {
        if ($this->bookingNices->removeElement($bookingNice)) {
            // set the owning side to null (unless already changed)
            if ($bookingNice->getBookers() === $this) {
                $bookingNice->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingMandelieu>
     */
    public function getBookingMandelieus(): Collection
    {
        return $this->bookingMandelieus;
    }

    public function addBookingMandelieu(BookingMandelieu $bookingMandelieu): self
    {
        if (!$this->bookingMandelieus->contains($bookingMandelieu)) {
            $this->bookingMandelieus[] = $bookingMandelieu;
            $bookingMandelieu->setBookers($this);
        }

        return $this;
    }

    public function removeBookingMandelieu(BookingMandelieu $bookingMandelieu): self
    {
        if ($this->bookingMandelieus->removeElement($bookingMandelieu)) {
            // set the owning side to null (unless already changed)
            if ($bookingMandelieu->getBookers() === $this) {
                $bookingMandelieu->setBookers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookingTheoule>
     */
    public function getBookingTheoules(): Collection
    {
        return $this->bookingTheoules;
    }

    public function addBookingTheoule(BookingTheoule $bookingTheoule): self
    {
        if (!$this->bookingTheoules->contains($bookingTheoule)) {
            $this->bookingTheoules[] = $bookingTheoule;
            $bookingTheoule->setBookers($this);
        }

        return $this;
    }

    public function removeBookingTheoule(BookingTheoule $bookingTheoule): self
    {
        if ($this->bookingTheoules->removeElement($bookingTheoule)) {
            // set the owning side to null (unless already changed)
            if ($bookingTheoule->getBookers() === $this) {
                $bookingTheoule->setBookers(null);
            }
        }

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
            $bookingChamonix->setBookers($this);
        }

        return $this;
    }

    public function removeBookingChamonix(BookingChamonix $bookingChamonix): self
    {
        if ($this->bookingChamonixes->removeElement($bookingChamonix)) {
            // set the owning side to null (unless already changed)
            if ($bookingChamonix->getBookers() === $this) {
                $bookingChamonix->setBookers(null);
            }
        }

        return $this;
    }


}
