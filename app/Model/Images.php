<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Images")
 */
class Images {
    use AuditColumnsTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;
    /** @ORM\Column(type="string") */
    protected string $file_name;

//GET
    public function getId(): int
    {
        return $this->id;
    }

    public function getFileName(): string
    {
        return $this->file_name;
    }
//SET
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setFileName(string $file_name): void
    {
        $this->file_name = $file_name;
    }
}
