<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    public function createProduct(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');
        $product->setCode('Code');
        $product->setCatalogId(1);

        $entityManager->persist($product);

        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    public function showAction()
    {
        $product = $this->getDoctrine()
            ->getRepository('App:Product')
            ->findAll();
        $data = [
            'product'=> $product
        ];


        return new Response('Show products'.$data);

    }

    public function filtersProductList(Request $request): string
    {
//        написать сервис который по id продукта возвращает массив с фильтрами (ProductFilters) для этого продукта
        $id = $request->request->get("id");
        
        $product = $this->getDoctrine()->getRepository('App:Product')->findOneById($id);
        $productFilter = $request->request->get("filterGroupCode");

        $productFilter = new ProductFilter(

        );

        $product->findOneById($product);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($productFilter);
        $entityManager->flush();

        $data = [
            'filterGroupCode' => $productFilter,
        ];

        return new Response('Hello '. $product->getfilterGroupCode("id"));

    }


}
