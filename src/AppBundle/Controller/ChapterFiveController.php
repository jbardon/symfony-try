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

   /**
    * @Route("/chapter5/request/details")
    */	
	public function requestDetailsAction(Request $request)
	{
		$request->isXmlHttpRequest(); // is it an Ajax request?
		
		$request->getPreferredLanguage(array('en', 'fr'));
		
		// retrieve GET and POST variables respectively
		$request->query->get('page');
		$request->request->get('page');
		
		// retrieve SERVER variables
		$request->server->get('HTTP_HOST');
		
		// retrieves an instance of UploadedFile identified by foo
		$request->files->get('foo');
		
		// retrieve a COOKIE value
		$request->cookies->get('PHPSESSID');
		
		// retrieve an HTTP request header, with normalized, lowercase keys
		$request->headers->get('host');
		$request->headers->get('content_type');
		
		$response = new Response(
			'<p>GET[page]: ' .$request->query->get('page'). '</p>'
			.'<p>POST[page]: ' .$request->request->get('page'). '</p>'
			.'<p>SERVER[HTTP_POST]: ' .$request->server->get('HTTP_HOST'). '</p>'
			.'<p>COOKIE[PHPSESSID]: ' .$request->cookies->get('PHPSESSID'). '</p>'
			.'<p>HEADER[CONTENT-TYPE]: ' .$request->headers->get('content_type'). '</p>',
			
			Response::HTTP_OK
		);
		
		$request->headers->set('Content-Type', 'text/html');
		
		return $response;
		
		// Exists JsonResponse, BinaryFileResponse and StreamedResponse
	}

   /**
    * @Route("/chapter5/json")
    */
    public function jsonAction(){
        return $this->json(array('username' => 'John Doe'));
    }
	
   /**
    * @Route("/chapter5/forward")
    */
    public function forwardAction(){
		$response = $this->forward('AppBundle:ChapterFour:forward', array(
			'name' => 'toto',
			'color' => 'green',
		));
		
		// ... further modify the response or return it directly
		
		return $response;
    }
}
