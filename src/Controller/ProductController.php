<?php

namespace App\Controller;

use App\Entity\Product;
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


        //return new Response('Saved new product with id '. ['data'=>$data]);
//        var_dump($data);
//        exit;
        return $this->handleView(
            $this->view([ 'data' => $data], 200)
        );
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

    public function updateAction(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }

    public function deleteAction(Request $request)
    {
        $id = $request->request->get('id');
        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('App:Product')->findOneById($id);
        if (!$product) {
            return $this->view("Product not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $sn->remove($product);
            $sn->flush();
        }
        return $this->view("**********Deleted successfully**********", Response::HTTP_OK);
    }

    public function filtersProductList(Request $request): Response
    {
//        написать сервис который по id продукта возвращает массив с фильтрами (ProductFilters) для этого продукта
        $id = $request->request->get("id");

        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy($id);

        $productFilter = $request->request->get("productFilter");

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
