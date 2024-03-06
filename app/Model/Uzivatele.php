<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="uzivatele")
 */
class Uzivatele {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected Int $id;
    /** @ORM\Column(type="string") */
    protected string $username;
    /** @ORM\Column(type="string") */
    protected string $password;
    /** @ORM\Column(type="string") */
    protected string $name;
    /** @ORM\Column(type="string") */
    protected string $sur_name;
    /** @ORM\Column(type="integer") */
    protected int $dostupnost;
    /** @ORM\Column(type="integer") */
    protected int $active;
    /** @ORM\Column(type="string") */
    protected string $token;
    
//GET
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->sur_name;
    }

    public function getDostupnost(): int
    {
        return $this->dostupnost;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function getToken(): string
    {
        return $this->token;
    }

//SET
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(string $sur_name): void
    {
        $this->sur_name = $sur_name;
    }

    public function setDostupnost(string $dostupnost): void
    {
        $this->dostupnost = $dostupnost;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

}
