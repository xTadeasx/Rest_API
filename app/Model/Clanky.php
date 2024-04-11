<?php declare(strict_types=1);

namespace App\Model;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="clanky")
 */
class clanky {
    use AuditColumnsTrait;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;
    /** @ORM\Column(type="integer") */
    protected string $kategorie;
    /** @ORM\Column(type="string") */
    protected string $name;
    /** @ORM\Column(type="string") */
    protected string $sub_name;
    /** @ORM\Column(type="datetime") */
    protected DateTime $cas_konani;
    /** @ORM\Column(type="string") */
    protected string $text;
    /** @ORM\Column(type="string") */
    protected string $img_file_name;
    /** @ORM\Column(type="string") */
    protected string $slag;
    /** @ORM\Column(type="integer") */
    protected int $active;

//GET
    /**
     * @param int $id
     * @param string $kategorie
     * @param string $name
     * @param string $sub_name
     * @param DateTime $cas_konani
     * @param string $text
     * @param string $img_file_name
     * @param string $slag
     * @param int $active
     */
    public function __construct(string $kategorie, string $name, string $sub_name, DateTime $cas_konani, string $text, string $img_file_name, string $slag, int $active)
    {
        $this->kategorie = $kategorie;
        $this->name = $name;
        $this->sub_name = $sub_name;
        $this->cas_konani = $cas_konani;
        $this->text = $text;
        $this->img_file_name = $img_file_name;
        $this->slag = $slag;
        $this->active = $active;

    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getKategorie(): string
    {
        return $this->kategorie;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getSubName(): string
    {
        return $this->sub_name;
    }
    
    public function getCasKonani(): DateTime
    {
        return $this->cas_konani;
    }

    public function getText(): string
    {
        return $this->text;
    }
    public function getImgfilename(): string
    {
        return $this->img_file_name;
    }
    public function getSlag(): string
    {
        return $this->slag;
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
    
    public function setKategorie(string $kategorie): void
    {
        $this->kategorie = $kategorie;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    public function setSubName(string $sub_name): void
    {
        $this->sub_name = $sub_name;
    }
    
    public function setCasKonani(DateTime $cas_konani): void
    {
        $this->cas_konani = $cas_konani;
    }
    
    public function setText(string $text): void
    {
        $this->text = $text;
    }
    public function setImgfilename(string $img_file_name): void
    {
        $this->img_file_name = $img_file_name;
    }
    public function setSlag(string $slag): void
    {
        $this->slag = $slag;
    }
    public function setActive(int $active): void
    {
        $this->active = $active;
    }
}
