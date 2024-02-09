<?php

namespace App\Facade;

use App\Model\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Kategorie;

class KategorieFacade
{
    public function __construct(private EntityManagerDecorator $em) {
    }

    public function findAll(): array {
        return $this->em->getRepository(Kategorie::class)->findAll();
    }

    /**
     * @param array $criteria
     * @return Kategorie
     */
    public function findOneBy(array $criteria): Kategorie {
        $entity  = $this->em->getRepository(Kategorie::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }
}
