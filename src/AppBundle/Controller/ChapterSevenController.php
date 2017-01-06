<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ChapterSevenController extends Controller
{   
   /**
    * @Route("/chapter7/template")
    */
    public function templateAction()
    {      
        return $this->render(
			'chapter7/template.html.twig'
		);
    }

   /**
    * @Route("/chapter7/inheritance")
    */
    public function inheritanceAction()
    {      
        return $this->render(
			'chapter7/inheritance.html.twig'
		);
    }

    /**
    * @Route("/chapter7/child")
    */
    public function childAction()
    {      

        $entries = array(
            array(
                'title' => "First",
                'body' => "Body 1"
            ),
            array(
                'title' => "Second",
                'body' => "Body 2"
            )
        );

        return $this->render(
			'chapter7/child.html.twig',
            array(
                'blog_entries' => $entries
            )
		);
    }

   /**
    * @Route("/chapter7/container")
    */
    public function containerAction()
    {      
        $entries = array(
            array(
                'title' => "First",
                'authorName' => "Me",
                'body' => "Body 1"
            ),
            array(
                'title' => "Second",
                'authorName' => "Me",
                'body' => "Body 2"
            )
        );

        return $this->render(
			'chapter7/container.html.twig',
            array(
                'articles' => $entries
            )
		);
    }

}
