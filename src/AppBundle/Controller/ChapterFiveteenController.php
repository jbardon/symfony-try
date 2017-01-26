<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ChapterFiveteenController extends Controller
{
    /**
     * @Route("/chapter15/admin")
     */
    public function adminAction()
    {
        return $this->render('chapter15/admin.html.twig');
    }

    /*
    public function numberSimpleAction()
    {
        return $this->render(
            'chapter5/number.html.twig',
            array('luckyNumberList' => "1, 85, 21, 95")
        );
    }
    */

}
