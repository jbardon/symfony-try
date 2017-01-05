<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ChapterFiveController extends Controller
{
   /**
    * @Route("/chapter5/template")
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
    * @Route("/chapter5/template/simple")
    */
    public function numberSimpleAction()
    {
		return $this->render(
			'lucky/number.html.twig',
			array('luckyNumberList' => "1, 85, 21, 95")
		);
	}

   /**
    * @Route("/chapter5/name/{name}", name="toto")
    */
    public function nameAction($name){
        return new Response($name);
    }

   /**
    * @Route("/chapter5/default/params/{arg}")
    */
    public function defaultParamsAction($arg, $arg2 = "default"){
        return new Response($arg . " " . $arg2);
    }

   /**
    * @Route("/chapter5/redirect/home")
    */
    public function redirectHomeAction(){
        return $this->redirectToRoute('homepage');
    }

   /**
    * @Route("/chapter5/nothing")
    */
    public function notFoundAction(){
        throw $this->createNotFoundException('Nothing to see');
    }

   /**
    * @Route("/chapter5/request")
    */
    public function requestAction(Request $request){
        return new Response($request->query->get('page', 8));
    }

   /**
    * @Route("/chapter5/session")
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
    * @Route("/chapter5/flash")
    */
    public function flashAction(){
        // comme session mais utilisé une fois
        $this->addFlash('notice', 'flash action trigerred');

        return $this->render(
			'lucky/flash.html.twig'
        );
    }

}
