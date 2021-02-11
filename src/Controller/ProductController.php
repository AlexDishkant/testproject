<?php

namespace App\Controller;

use App\Entity\Catalog;
use App\Entity\Product;
use App\Repository\CatalogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\  AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;

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
        $name = $request->query->get('name');
        $price = $request->query->get('price');
        $description = $request->query->get('description');
        $code = $request->query->get('code');
        $catalogId = $request->query->get('catalogId');

        $catalog = $this->getDoctrine()->getRepository('App:Product')->findOneBy([$catalogId]);

        $product = new Product(
            $name,
            $price,
            $description,
            $code,
            $catalog
        );

        $catalog->addProduct($product);
        //$jsonContent = $serializer->serialize($product, 'json');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();


        $data = [
            'catalog' => $catalog,
        ];

        return new Response('Saved new product with id '. ['data'=>$data]);

//        return $this->handleView(
//            $this->view([ 'data' => $data], 200)
//        );
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

    public function updateAction(Request $request): Response
    {
        $id = $request->query->get('id');
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name!');
        $entityManager->flush();

        return new Response("*********Product is updated!!!**********", Response::HTTP_OK);
    }

    public function deleteAction(Request $request): Response
    {
        $id = $request->request->get('id');
        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('App:Product')->findOneById($id);

        if (!$product) {
            return new Response("Product not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $sn->remove($product);
            $sn->flush();
        }
        return new Response("**********Deleted successfully**********", Response::HTTP_OK);
    }

//    public function filtersProductList(Request $request): Response
//    {
//        написать сервис который по id продукта возвращает массив с фильтрами (ProductFilters) для этого продукта
//        $id = $request->query->get("id");
//
//        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy($id);
//
//        $productFilter = $request->query->get("productFilter");
//
//        $productFilter->findOneById($product);
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($productFilter);
//        $entityManager->flush();
//
//        $data = [
//            'productFilter' => $productFilter,
//        ];
//
//        return new Response('Hello ' . $data);
//
//    }

}
