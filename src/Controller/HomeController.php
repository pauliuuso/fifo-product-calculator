<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\ProductService;
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
     * @param Request             $request
     *
     * @param ProductService      $productService
     *
     * @param TranslatorInterface $translator
     *
     * @return Response
     * @throws \Exception
     */
    public function index(
        Request $request,
        ProductService $productService,
        TranslatorInterface $translator
    )
    {
        $product = new Product();
        $products = $productService->getAll();

        $buyForm = $this->createForm(ProductType::class, $product);
        $buyForm->handleRequest($request);

        if($buyForm->isSubmitted() && $buyForm->isValid()) {
            $product->setCreatedAt(new \DateTime('now'));
            $productService->create($product);
            $this->addFlash('notice', $translator->trans('product.bought'));

            return $this->redirectToRoute('home');
        }

        return $this->render('home.html.twig', [
            'buyForm' => $buyForm->createView(),
            'products' => $products
        ]);
    }
}