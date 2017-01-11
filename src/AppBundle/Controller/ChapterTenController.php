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
     * @Route("/chapter10/all", name="all")
     */
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

    /**
     * @Route("/chapter10/update/{id}/{name}", defaults={"id" = 1, "name" = "New Keyboard"})
     */
    public function updateAction($id, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName($name);

        // Pas obligatoire car
        //$em->persist($product)
        $em->flush();

        return $this->forward('AppBundle:ChapterTen:show', array(
            'productId' => $id
        ));
    }

    /**
     * @Route("/chapter10/delete/{id}", defaults={"id" = 4})
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->findOneById($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($product);

        // Delete que après ça
        $em->flush();

        return $this->redirectToRoute("all");
    }

    /**
     * @Route("/chapter10/dql/writing/simple/{price}", defaults={"price" = 10})
     */
    public function dqlWritingSimpleAction($price)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
             FROM AppBundle:Product p
             WHERE p.price > :price
             ORDER BY p.price ASC'
        )->setParameter('price', $price);

        $product = $query->setMaxResults(1)->getOneOrNullResult();

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
     * @Route("/chapter10/dql/writing/multiple/{price}", defaults={"price" = 10})
     */
    public function dqlWritingMultipleAction($price)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
             FROM AppBundle:Product p
             WHERE p.price > :price
             ORDER BY p.price ASC'
        )->setParameter('price', $price);

        // setParameter prevents SQL attacks
        $products = $query->getResult();

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

    /**
     * @Route("/chapter10/dql/builder/simple/{price}", defaults={"price" = 10})
     */
    public function dqlBuilderSimpleAction($price)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');

        // createQueryBuilder automatically selects FROM AppBundle:Product
        // and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $product = $query->setMaxResults(1)->getOneOrNullResult();

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
     * @Route("/chapter10/dql/builder/multiple/{price}", defaults={"price" = 10})
     */
    public function dqlBuilderMultipleAction($price)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');

        // createQueryBuilder automatically selects FROM AppBundle:Product
        // and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $products = $query->getResult();

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
