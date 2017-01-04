<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}
