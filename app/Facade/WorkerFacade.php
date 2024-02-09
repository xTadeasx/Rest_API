<?php

namespace App\Facade;

use App\Model\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Worker;

class WorkerFacade
{
    public function __construct(private EntityManagerDecorator $em) {
    }

    public function findAll(): array {
        return $this->em->getRepository(Worker::class)->findAll();
    }

    /**
     * @param array $criteria
     * @return Worker
     */
    public function findOneBy(array $criteria): Worker {
        $entity  = $this->em->getRepository(Worker::class)->findOneBy($criteria);
        if ($entity === null) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }
}
