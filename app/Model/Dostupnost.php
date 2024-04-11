<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Dostupnost")
 */
class Dostupnost {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;
    /** @ORM\Column(type="string") */
    protected string $name;

//GET
    /**
     * @param int $id
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name= $name;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
//SET
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setFileName(string $name): void
    {
        $this->name = $name;
    }
}
