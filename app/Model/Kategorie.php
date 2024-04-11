<?php declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Kategorie")
 */
class Kategorie {
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
    protected string $sub_kategori_to;
    /** @ORM\Column(type="integer") */
    protected int $active;

//GET
    /**
     * @param int $id
     * @param string $name
     * @param string $sub_kategori_to
     * @param int $active
     */
    public function __construct(string $name, string $sub_kategori_to, int $active)
    {
        $this->name= $name;
        $this->sub_kategori_to= $sub_kategori_to;
        $this->active= $active;

    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getSubKategoriTo(): string
    {
        return $this->sub_kategori_to;
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
    public function setSubKategoriTo(string $sub_kategori_to): void
    {
        $this->sub_kategori_to = $sub_kategori_to;
    }
    public function setActive(string $active): void
    {
        $this->active = $active;
    }
}
