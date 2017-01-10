<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ChapterTenController extends Controller
{
   /**
    * @Route("/chapter10/create")
    */
    public function createAction()
    {
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

   /**
    * @Route("/chapter10/show/{productId}")
    */
    // see @ParamConverter (FrameworkExtraBundle)to get object automatically 
    public function showAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        dump($product);
        return new Response('See dump show');

        // AUTO GENERATED REPOSITORY
/*
        // dynamic method names to find a single product based on a column value
        $product = $repository->findOneById($productId);
        $product = $repository->findOneByName('Keyboard');

        // dynamic method names to find a group of products based on a column value
        $products = $repository->findByPrice(19.99);

        // find *all* products
        $products = $repository->findAll();
*/

        // COMPLEX findOneBy et findBy
/*
        // query for a single product matching the given name and price
        $product = $repository->findOneBy(
            array('name' => 'Keyboard', 'price' => 19.99)
        );

        // query for multiple products matching the given name, ordered by price
        $products = $repository->findBy(
            array('name' => 'Keyboard'),
            array('price' => 'ASC')
        );
*/
    }
}
