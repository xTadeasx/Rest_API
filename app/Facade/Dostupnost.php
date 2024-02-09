<?php

namespace App\Facade;

use App\Model\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Dostupnost;

class DostupnostFacade
{
    public function __construct(private EntityManagerDecorator $em) {
    }

    public function findAll(): array {
        return $this->em->getRepository(Dostupnost::class)->findAll();
    }

    /**
     * @param array $criteria
     * @return Dostupnost
     */
    public function findOneBy(array $criteria): Dostupnost {
        $entity  = $this->em->getRepository(Dostupnost::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }
}
