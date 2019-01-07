<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Profit;
use App\Form\BuyType;
use App\Form\SellType;
use App\Service\ProductService;
use App\Service\ProfitService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class HomeController
 *
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @param ProductService $productService
     *
     * @param ProfitService  $profitService
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function index(ProductService $productService, ProfitService $profitService)
    {
        $products = $productService->getAll();
        $totalTurnover = $profitService->getTotalTurnover();
        $totalProfit = $profitService->getTotalProfit();

        return $this->render('home.html.twig', [
            'products' => $products,
            'totalTurnover' => $totalTurnover,
            'totalProfit' => $totalProfit
        ]);
    }

    /**
     * @Route("/buy", name="buy")
     *
     * @param Request             $request
     * @param ProductService      $productService
     * @param ProfitService       $profitService
     * @param TranslatorInterface $translator
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function buy(
        Request $request,
        ProductService $productService,
        ProfitService $profitService,
        TranslatorInterface $translator
    )
    {
        $product = new Product();
        $products = $productService->getAll();
        $totalTurnover = $profitService->getTotalTurnover();
        $totalProfit = $profitService->getTotalProfit();

        $buyForm = $this->createForm(BuyType::class, $product);
        $buyForm->handleRequest($request);

        if($buyForm->isSubmitted() && $buyForm->isValid()) {

            $product->setCreatedAt(new \DateTime('now'));
            $productService->create($product);

            $profit = new Profit();
            $profitService->create($profit);

            $this->addFlash('notice', $translator->trans('product.bought'));

            return $this->redirectToRoute('buy');
        }

        return $this->render('buy.html.twig', [
            'buyForm' => $buyForm->createView(),
            'products' => $products,
            'totalTurnover' => $totalTurnover,
            'totalProfit' => $totalProfit
        ]);
    }

    /**
     * @Route("/sell", name="sell")
     *
     * @param Request        $request
     * @param ProductService $productService
     *
     * @param ProfitService  $profitService
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function sell(
        Request $request,
        ProductService $productService,
        ProfitService $profitService
    )
    {
        $products = $productService->getAll();
        $totalTurnover = $profitService->getTotalTurnover();
        $totalProfit = $profitService->getTotalProfit();

        $sellForm = $this->createForm(SellType::class);
        $sellForm->handleRequest($request);

        if($sellForm->isSubmitted() && $sellForm->isValid()) {

            $sellCount = (int) $sellForm->get('count')->getData();
            $sellPrice = (float) $sellForm->get('price')->getData();

            try {
                $productService->sellProduct($sellCount, $sellPrice);
                return $this->redirectToRoute('sell');
            }
            catch (\Exception $exception) {
                error_log($exception->getMessage());
            }
        }

        return $this->render('sell.html.twig', [
            'sellForm' => $sellForm->createView(),
            'products' => $products,
            'totalTurnover' => $totalTurnover,
            'totalProfit' => $totalProfit
        ]);
    }
}