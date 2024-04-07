<?php

namespace App\Facade;

use App\Model\Api\Request\DostupnostCreateRequest;
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
    /**
     * @param DostupnostCreateRequest $dto
     * @return Dostupnost
     */
    public function create(DostupnostCreateRequest $dto): Dostupnost
    {
        $Dostupnost = new Dostupnost(
            $dto->id,
            $dto->name
        );

        $this->em->persist($Dostupnost);
        $this->em->flush($Dostupnost);

        return $Dostupnost;
    }
}
