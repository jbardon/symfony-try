<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


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

   /**
    * @Route("/chapter7/dump")
    */
    public function dumpAction()
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

        $outries = array(
            array(
                'name' => "First",
				'social' => 1
            ),
            array(
                'name' => "Second",
				'social' => 2
            )
        );

        dump($entries);

        return $this->render(
			'chapter7/dump.html.twig',
            array(
                'outries' => $outries
            )
		);
    }

   /**
    * @Route("/chapter7/format", name="format")
    */
    public function formatAction(Request $request)
    {      
        // Marche pas : à creuser
        $format = $request->getRequestFormat();

        //Alternative
        $format = $request->query->get('_format');

        return $this->render(
			'chapter7/format.' .$format. '.twig'
		);
    }
}
