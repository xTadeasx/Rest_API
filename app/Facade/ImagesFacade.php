<?php

namespace App\Facade;

use App\Model\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Images;

class ImagesFacade
{
    public function __construct(private EntityManagerDecorator $em) {
    }

    public function findAll(): array {
        return $this->em->getRepository(Images::class)->findAll();
    }

    /**
     * @param array $criteria
     * @return Images
     */
    public function findOneBy(array $criteria): Images {
        $entity  = $this->em->getRepository(Images::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }
}
