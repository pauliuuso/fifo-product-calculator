<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\Profit;
use App\Service\Traits\RepositoryResultsTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class ProductService
 */
class ProductService extends BaseService
{
    use RepositoryResultsTrait;

    private $translator;
    private $profitService;
    private $flashBag;

    /**
     * ProductService constructor.
     *
     * @param EntityManagerInterface   $em
     * @param EventDispatcherInterface $dispatcher
     * @param TranslatorInterface      $translator
     * @param ProfitService            $profitService
     * @param FlashBagInterface        $flashBag
     */
    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator,
        ProfitService $profitService,
        FlashBagInterface $flashBag
    )
    {
        $this->translator = $translator;
        $this->profitService = $profitService;
        $this->flashBag = $flashBag;

        parent::__construct($em, $dispatcher);
    }

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

    public function buyProduct()
    {

    }

    /**
     * @param int   $sellCount
     * @param float $sellPrice
     *
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function sellProduct(
        int $sellCount,
        float $sellPrice
    ): bool
    {
        $products = $this->getAll();
        $productCount = 0;
        $saleValue = 0;
        $profitValue = 0;

        for($a = 0; $a < count($products); $a++) {
            $productCount += $products[$a]->getCount();
        }

        if($sellCount > $productCount) {
            $this->flashBag->add('error', $this->translator->trans('product.not_enough_products'));
            return false;
        }
        else {

            for($b = 0; $b < count($products); $b++) {
                $currentProduct = $products[$b];

                if($currentProduct->getCount() >= $sellCount) {

                    $saleValue += $sellCount * $sellPrice;
                    $profitValue += $sellCount * ($sellPrice - $currentProduct->getPrice());

                    $currentProduct->setCount($currentProduct->getCount() - $sellCount);

                    if($currentProduct->getCount() > 0) {
                        $this->update($currentProduct);
                    }
                    else {
                        $this->remove($currentProduct);
                    }

                    $profit = new Profit();
                    $profit->setTurnover($saleValue);
                    $profit->setProfit($profitValue);
                    $this->profitService->create($profit);

                    $this->flashBag->add('notice', $this->translator->trans('product.sold'));
                    return true;
                }
                else {
                    $saleValue += $currentProduct->getCount() * $sellPrice;
                    $profitValue += $currentProduct->getCount() * ($sellPrice - $currentProduct->getPrice());
                    $sellCount -= $currentProduct->getCount();
                    $this->remove($currentProduct);
                }
            }
        }

        return true;
    }

}