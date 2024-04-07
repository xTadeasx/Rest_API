<?php

namespace App\Facade;

use App\Model\Api\Request\UzivateleCreateRequest;
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
    /**
     * @param UzivateleCreateRequest $dto
     * @return Uzivatele
     */
    public function create(UzivateleCreateRequest $dto): Uzivatele
    {
        $Uzivatele = new Uzivatele(
            $dto->username,
            $dto->password,
            $dto->name,
            $dto->sur_name,
            $dto->dostupno,
            $dto->active
        );

        $this->em->persist($Uzivatele);
        $this->em->flush($Uzivatele);

        return $Uzivatele;
    }
}
