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
                'No product found for id ' . $productId
            );
        }

        return $this->render(
            'chapter10/product.html.twig',
            array(
                'product' => $product
            )
        );
    }

    /**
     * @Route("/chapter10/id/{productId}", defaults={"productId" = "1"})
     */
    // see @ParamConverter (FrameworkExtraBundle)to get object automatically
    public function idAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneById($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $productId
            );
        }

        return $this->render(
            'chapter10/product.html.twig',
            array(
                'product' => $product
            )
        );
    }

    /**
     * @Route("/chapter10/name/{name}", defaults={"name" = "Keyboard"})
     */
    // see @ParamConverter (FrameworkExtraBundle)to get object automatically
    public function nameAction($name)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneByName($name);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for name ' . $name
            );
        }

        return $this->render(
            'chapter10/product.html.twig',
            array(
                'product' => $product
            )
        );
    }

    /**
     * @Route("/chapter10/price/{price}", defaults={"price" = "19.99"})
     */
    // see @ParamConverter (FrameworkExtraBundle)to get object automatically
    public function priceAction($price)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneByPrice($price);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for price ' . $price
            );
        }

        return $this->render(
            'chapter10/product.html.twig',
            array(
                'product' => $product
            )
        );
    }

    /**
     * @Route("/chapter10/all")
     */
    // see @ParamConverter (FrameworkExtraBundle)to get object automatically
    public function allAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findAll();

        if (!$products) {
            throw $this->createNotFoundException(
                'No product found'
            );
        }

        return $this->render(
            'chapter10/list_product.html.twig',
            array(
                'products' => $products
            )
        );
    }

    /**
     * @Route("/chapter10/single/{name}/{price}", defaults={"name" = "Keyboard", "price" = "19.99"})
     */
    // see @ParamConverter (FrameworkExtraBundle)to get object automatically
    public function singleAdvancedAction($name, $price)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneBy(
                array('name' => $name, 'price' => $price)
            );

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found'
            );
        }

        return $this->render(
            'chapter10/product.html.twig',
            array(
                'product' => $product
            )
        );
    }

    /**
     * @Route("/chapter10/multiple/{name}", defaults={"name" = "Keyboard"})
     */
    // see @ParamConverter (FrameworkExtraBundle)to get object automatically
    public function multipleAdvancedAction($name)
    {
        $products = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findBy(
                array('name' => $name),
                array('price' => 'ASC')
            );

        if (!$products) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }

        return $this->render(
            'chapter10/list_product.html.twig',
            array(
                'products' => $products
            )
        );
    }
}
