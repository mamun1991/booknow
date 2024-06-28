<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["admin"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["admin"])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(["admin"])]
    private ?string $password = null;

    #[ORM\Column]
    #[Groups(["admin"])]
    private ?int $admintype = null;

    #[ORM\Column]
    #[Groups(["admin"])]
    private ?int $adminstatus = null;

    #[ORM\OneToMany(mappedBy: 'adminid', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAdmintype(): ?int
    {
        return $this->admintype;
    }

    public function setAdmintype(int $admintype): static
    {
        $this->admintype = $admintype;

        return $this;
    }

    public function getAdminstatus(): ?int
    {
        return $this->adminstatus;
    }

    public function setAdminstatus(int $adminstatus): static
    {
        $this->adminstatus = $adminstatus;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAdminid($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAdminid() === $this) {
                $user->setAdminid(null);
            }
        }

        return $this;
    }
}
