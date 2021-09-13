<?php

namespace App\Entity;


use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 *
 *
 * @method string getUserIdentifier()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     * @Groups({"classifiedAd"})
     * @Groups({"classifiedAdById"})
     * @Groups({"garages"})
     */
    private int $id;

    /**
     * @Groups({"classifiedAdById"})
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Unique(message="Ce nom d'utilisateur est déja pris!")
     * @Assert\Length(
     *      min = 4,
     *      max = 16,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Groups({"classifiedAd"})
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     * @Groups ({"garages"})
     *
     */
    private ?string $username;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 4,
     *      max = 16,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     *
     *
     */
    private ?string $password;

    //confirmation de mot de passe
    /**
     * @Assert\NotBlank()
     * @Assert\EqualTo(propertyPath="password",message="les mots de passe doivent correspondre !")
     *
     *
     */
    private ?string $passwordConfirm;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Unique
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     *
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     *
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private string $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private string $siret;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotBlank()
     * @Groups ({"users"})
     */
    private DateTimeInterface $dateOfRegistration;

    /**
     * @ORM\Column(type="json", nullable=false)
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     *
     *
     */
    private array $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Garage::class, mappedBy="user", orphanRemoval=true)
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private Collection $garages;

    /**
     * @ORM\OneToMany(targetEntity=ClassifiedAd::class, mappedBy="user", orphanRemoval=true)
     * @Groups ({"users"})
     * @Groups ({"users-details"})
     */
    private Collection $ClassifiedAd;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\NotBlank()
     * @Groups ({"users"})
     */
    private DateTimeInterface $updatedOn;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return User
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return User
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPasswordConfirm(): ?string
    {
        return $this->passwordConfirm;
    }

    /**
     * @param string|null $passwordConfirm
     * @return User
     */
    public function setPasswordConfirm(?string $passwordConfirm): User
    {
        $this->passwordConfirm = $passwordConfirm;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return User
     */
    public function setPhoneNumber(string $phoneNumber): User
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getSiret(): string
    {
        return $this->siret;
    }

    /**
     * @param string $siret
     * @return User
     */
    public function setSiret(string $siret): User
    {
        $this->siret = $siret;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDateOfRegistration(): DateTimeInterface
    {
        return $this->dateOfRegistration;
    }

    /**
     * @param DateTimeInterface $dateOfRegistration
     * @return User
     */
    public function setDateOfRegistration(DateTimeInterface $dateOfRegistration): User
    {
        $this->dateOfRegistration = $dateOfRegistration;
        return $this;
    }

    public function getRoles():array
    {
        $roles = $this->roles;
        $roles[] = "ROLE_USER";
        return array_unique($roles);

        // TODO: Implement getRoles() method.
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getGarages(): Collection
    {
        return $this->garages;
    }

    /**
     * @param Collection $garages
     * @return User
     */
    public function setGarages(Collection $garages): User
    {
        $this->garages = $garages;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getClassifiedAd(): Collection
    {
        return $this->ClassifiedAd;
    }

    /**
     * @param Collection $ClassifiedAd
     * @return User
     */
    public function setClassifiedAd(Collection $ClassifiedAd): User
    {
        $this->ClassifiedAd = $ClassifiedAd;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedOn(): DateTimeInterface
    {
        return $this->updatedOn;
    }

    /**
     * @param DateTimeInterface $updatedOn
     * @return User
     */
    public function setUpdatedOn(DateTimeInterface $updatedOn): User
    {
        $this->updatedOn = $updatedOn;
        return $this;
    }


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    public function getUser(array $toArray)
    {
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
