<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;


class ChapterSixController
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
}
