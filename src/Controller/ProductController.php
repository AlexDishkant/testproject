<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductFilter;
//use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Repository\ProductRepository;
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

    public function createProduct(Request $request): Response
    {
        $name = $request->request->get('name');
        $price = $request->request->get('price');
        $description = $request->request->get('description');
        $code = $request->request->get('code');
        $catalogId = $request->request->get('catalogId');

        $product = new Product(
            $name,
            $price,
            $description,
            $code,
            $catalogId
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        $data = [
            'product' => $product,
        ];


        return new Response('Saved new product with id '. ['data'=>$data]);
    }

    public function showAction(): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $data = [
            'product'=> $product
        ];

        //return new Response('Check out this great product: '.$data);
        var_dump($data);
        exit;
    }
    public function filtersProductList(Request $request): string
    {
//        написать сервис который по id продукта возвращает массив с фильтрами (ProductFilters) для этого продукта
        $id = $request->request->get("id");
        $product = $this->getDoctrine()->getRepository(ProductRepository::class)->findOneBy($id);

        $productFilter = $request->request->get("filterGroupCode");

        $productFilter->findOneById($product);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($productFilter);
        $entityManager->flush();

        $data = [
            'productFilter' => $productFilter,
        ];

        return new Response('Hello ' . $data);

    }

}
