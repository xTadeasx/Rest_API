<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Links")
 */
class Links {
    use AuditColumnsTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;
    /** @ORM\Column(type="string") */
    protected string $link_name;

//GET
    public function getId(): int
    {
        return $this->id;
    }

    public function getLinkName(): string
    {
        return $this->link_name;
    }
    
//SET
    
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setLinkName(string $link_name): void
    {
        $this->link_name = $link_name;
    }
}
