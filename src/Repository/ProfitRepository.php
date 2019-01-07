<?php

namespace App\Repository;

use App\Entity\Profit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * ProfitRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class ProfitRepository extends ServiceEntityRepository
{
    /**
     * ProfitRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Profit::class);
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createAll()
    {
        return $this->createQueryBuilder('p');
    }
}
