<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ChapterSevenController extends Controller
{   
   /**
    * @Route("/chapter7/template", name="template")
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
    * @Route("/chapter7/child/{max}")
    */
    public function childAction($max)
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
	
   /**
    * @Route("/chapter7/embed")
    */
    public function embedAction()
    {      
        return $this->render(
			'chapter7/embed.html.twig'
		);
    }
	
   /**
    * @Route("/chapter7/embedded/{max}")
    */
    public function embeddedAction($max)
    {      
		$entries = array(
            array(
                'title' => "First",
				'slug' => 1
            ),
            array(
                'title' => "Second",
				'slug' => 2
            )
        );

        return $this->render(
			'chapter7/embedded.html.twig',
            array(
                'articles' => $entries
            )
		);
    }
	
   /**
    * @Route("/chapter7/async")
    */
    public function asyncAction()
    {      
        return $this->render(
			'chapter7/async.html.twig'
		);
    }
	
   /**
    * @Route("/chapter7/full")
    */
    public function fullAction()
    {      
        return $this->render(
			'chapter7/full.html.twig'
		);
    }

   /**
    * @Route("/chapter7/variables")
    */
    public function variablesAction()
    {      
        return $this->render(
			'chapter7/variables.html.twig'
		);
    }
}
