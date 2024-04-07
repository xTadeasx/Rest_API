<?php

namespace App\Facade;

use App\Model\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Uzivatele;

class UzivateleFacade
{
    public function __construct(private EntityManagerDecorator $em) {
    }

    public function findAll(): array {
        return $this->em->getRepository(Uzivatele::class)->findAll();
    }

    /**
     * @param array $criteria
     * @return Uzivatele
     */
    public function findOneBy(array $criteria): Uzivatele {
        $entity  = $this->em->getRepository(Uzivatele::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }

    public function get_token(array $criteria): Uzivatele {
        $entity  = $this->em->getRepository(Uzivatele::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }
}
