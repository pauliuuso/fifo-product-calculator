<?php

namespace App\Service;

use App\Entity\Product;
use App\Service\Traits\RepositoryResultsTrait;

/**
 * Class ProductService
 */
class ProductService extends BaseService
{
    use RepositoryResultsTrait;

    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return Product::class;
    }

    /**
     * @return array
     * @throws \Doctrine\ORM\ORMException
     */
    public function getAll()
    {
        return $this->getResult($this->repository->createAll());
    }

}