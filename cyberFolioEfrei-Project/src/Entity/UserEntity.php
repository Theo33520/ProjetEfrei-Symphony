<?php

namespace App\Entity;

use App\Repository\UserEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UserEntityRepository::class)]
class UserEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $git_url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $jobs = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'users')]
    private Collection $projects;


    #[ORM\OneToOne(targetEntity: ProfileEntity::class, inversedBy: 'users')]
    private ?ProfileEntity $profile = null;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    public function getGitUrl(): ?string
    {
        return $this->git_url;
    }

    public function setGitUrl(?string $git_url): static
    {
        $this->git_url = $git_url;

        return $this;
    }

    public function getJobs(): ?string
    {
        return $this->jobs;
    }

    public function setJobs(?string $jobs): static
    {
        $this->jobs = $jobs;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setUser($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->setUser(null);
        }

        return $this;
    }

    public function getProfile(): ?ProfileEntity
    {
        return $this->profile;
    }

    public function setProfile(?ProfileEntity $profile): static
    {
        $this->profile = $profile;

        return $this;
    }
    
}
