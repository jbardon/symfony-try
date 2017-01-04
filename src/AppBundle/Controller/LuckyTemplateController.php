<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class LuckyTemplateController extends Controller
{
   /**
    * @Route("/lucky/template")
    */
    public function numberAction()
    {
        $html = $this->container->get('templating')->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => "1, 85, 21, 95")
        );

        return new Response($html);
    }
	
   /**
    * @Route("/lucky/template/simple")
    */
    public function numberSimpleAction()
    {
		return $this->render(
			'lucky/number.html.twig',
			array('luckyNumberList' => "1, 85, 21, 95")
		);
	}

// A quoi sert name ?
   /**
    * @Route("/lucky/name/{name}", name="toto")
    */
    public function nameAction($name){
        return new Response($name);
    }

   /**
    * @Route("/lucky/default/params/{arg}")
    */
    public function defaultParamsAction($arg, $arg2 = "default"){
        return new Response($arg . " " . $arg2);
    }

   /**
    * @Route("/lucky/redirect/home")
    */
    public function redirectHomeAction(){
        return $this->redirectToRoute('homepage');
    }

   /**
    * @Route("/lucky/nothing")
    */
    public function notFoundAction(){
        throw $this->createNotFoundException('Nothing to see');
    }

   /**
    * @Route("/lucky/request")
    */
    public function requestAction(Request $request){
        return new Response($request->query->get('page', 8));
    }

   /**
    * @Route("/lucky/session")
    */
    public function sessionAction(Request $request){

        $session = $request->getSession();

        // store an attribute for reuse during a later user request
        $session->set('foo', 'bar');

        // get the attribute set by another controller in another request
        $foobar = $session->get('foobar');

        // use a default value if the attribute doesn't exist
        $filters = $session->get('filters', array());

        return new Response($session->get('foo'));
    }

   /**
    * @Route("/lucky/flash")
    */
    public function flashAction(){
        // comme session mais utilisé une fois
        $this->addFlash('notice', 'flash action trigerred');

        return $this->render(
			'lucky/flash.html.twig'
        );
    }

}
