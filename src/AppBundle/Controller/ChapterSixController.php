<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;


class ChapterSixController extends Controller
{
    /**
     * @Route("/chapter6/blog")
     */
    public function basicRouteAction()
    {
        return new Response("BasicRoute");
    }

    /**
     * @Route("/chapter6/blog/place/{integer}", requirements={"page": "\d+"})
     */
    public function IntegerRouteAction($integer)
    {
        return new Response("IntegerRoute: " .$integer);
    }

    /**
     * @Route("/chapter6/blog/place/{placeholder}")
     */
    public function placeholderRouteAction($placeholder)
    {
        return new Response("PlaceholderRoute: " .$placeholder);
    }

    /**
     * @Route("/chapter6/blog/opt/{optionalPlaceholder}", defaults={"optionalPlaceholder" = "test"})
     */
    public function optionalPlaceholderRouteAction($optionalPlaceholder)
    {
        return new Response("OptionalPlaceholderRoute: " .$optionalPlaceholder);
    }  

   /**
    * @Route("chapter6/{_locale}", defaults={"_locale": "en"}, requirements={
    * "_locale": "en|fr"
    * })
    */
    public function localeAction($_locale)
    {
        // Attention ne matche pas chapter6/ parce que _locale est optionnel
        return new Response("localeRoute: " .$_locale);
    }

   /**
    * @Route("/chapter6/api/posts/{id}")
    * @Method("PUT")
    */
    public function filterMethodAction($id)
    {
        return new Response("filterMethodRoute");
    }

   /**
    * @Route(  
    *    "/chapter6/format/post.{_format}",
    *    requirements={
    *       "_format": "html|json"
    *   }
    * )
    */
    public function formatRouteAction($_format)
    {
        // Some automatic changes on Request
        // 3 paramètres spéciaux: _controller, _format et _locale
        return new Response("formatRoute: " .$_format);
    }

   /**
    * @Route("/chapter6/hello/{name}", name="hello")
    */
    public function helloAction($name)
    {
        return new Response("helloAction: " .$name);
    }

   /**
    * @Route("/chapter6/generate")
    */
    public function generateAction()
    {
        $params = $this->get('router')->match('/chapter6/fr');

        $uri = $this->get('router')->generate('hello', array(
            'name' => 'world'
        ));

        $uri2 = $this->generateUrl('hello', array(
            'name' => 'world',
            'notdefined' => "toto" //Add as GET parameter
        ));

        $abs = $this->get('router')->generate('hello', array(
            'name' => 'world'
        ), UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->json(
            array(
                "params" => $params,
                "uri" => $uri,
                "uri2" => $uri2,
                "absolute" => $abs
            )
        );
    }

   /**
    * @Route("/chapter6/generate/template")
    */
    public function generateTemplateAction()
    {      
        return $this->render(
			'lucky/link.html.twig'
		);
    }

}
