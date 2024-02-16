<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="workers")
 */
class Worker {
    use AuditColumnsTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;
    /** @ORM\Column(type="string") */
    protected string $name;
    /** @ORM\Column(type="string") */
    protected string $surName;
    /** @ORM\Column(type="string") */
    protected string $title;
    /** @ORM\Column(type="string") */
    protected string $job;
    /** @ORM\Column(type="string") */
    protected string $phoneNumber;
    /** @ORM\Column(type="string") */
    protected string $email;
    /** @ORM\Column(type="integer") */
    protected int $active;

//GET

    /**
     * @param int $id
     * @param string $name
     * @param string $surName
     * @param string $title
     * @param string $job
     * @param string $phoneNumber
     * @param string $email
     * @param int $active
     */
    public function __construct(string $name, string $surName, string $title, string $job, string $phoneNumber, string $email, int $active)
    {
        $this->name = $name;
        $this->surName = $surName;
        $this->title = $title;
        $this->job = $job;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurName(): string
    {
        return $this->surName;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getJob(): string
    {
        return $this->job;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getActive(): int
    {
        return $this->active;
    }
//SET
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurName(string $surName): void
    {
        $this->surName = $surName;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }
}
