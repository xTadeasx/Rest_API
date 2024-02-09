<?php

namespace App\Facade;

use App\Model\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Clanky;

class ClankyFacade
{
    public function __construct(private EntityManagerDecorator $em) {
    }

    public function findAll(): array {
        return $this->em->getRepository(Clanky::class)->findAll();
    }

    /**
     * @param array $criteria
     * @return Clanky
     */
    public function findOneBy(array $criteria): Clanky {
        $entity  = $this->em->getRepository(Clanky::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }
}
