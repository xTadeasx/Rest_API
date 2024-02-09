<?php declare(strict_types=1);

namespace App\Model;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait AuditColumnsTrait{
    /** @ORM\Column(type="integer") */
    protected int $createdBy;
    /** @ORM\Column(type="datetime") */
    protected DateTime $createdAt;
    /** @ORM\Column(type="integer") */
    protected int $updatedBy;
    /** @ORM\Column(type="datetime") */
    protected DateTime $updatedAt;

//GET    
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    
    
    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }
    
    
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
    
//SET    
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedBy(int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}
