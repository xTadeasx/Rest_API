<?php

namespace App\Facade;

use App\Model\Api\Request\ImagesCreateRequest;
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
    /**
     * @param ImagesCreateRequest $dto
     * @return Images
     */
    public function create(ImagesCreateRequest $dto): Images
    {
        $Images = new Images(
            $dto->id,
            $dto->file_name
        );

        $this->em->persist($Images);
        $this->em->flush($Images);

        return $Images;
    }
}
