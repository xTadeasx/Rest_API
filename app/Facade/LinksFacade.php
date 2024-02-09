<?php

namespace App\Facade;

use App\Model\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Links;

class LinksFacade
{
    public function __construct(private EntityManagerDecorator $em) {
    }

    public function findAll(): array {
        return $this->em->getRepository(Links::class)->findAll();
    }

    /**
     * @param array $criteria
     * @return Links
     */
    public function findOneBy(array $criteria): Links {
        $entity  = $this->em->getRepository(Links::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }
}
