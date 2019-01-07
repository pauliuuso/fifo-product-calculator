<?php

namespace App\Service;

use App\Entity\Profit;
use App\Service\Traits\RepositoryResultsTrait;

/**
 * Class SaleService
 */
class ProfitService extends BaseService
{
    use RepositoryResultsTrait;

    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return Profit::class;
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\ORMException
     */
    public function getTotalProfit(): int
    {
        $profit = $this->getResult($this->repository->createAll());
        $totalProfit = 0;

        for($a = 0; $a < count($profit); $a++) {
            $totalProfit += $profit[$a]->getProfit();
        }

        return $totalProfit;
    }

}