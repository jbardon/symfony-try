<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Author;

class ChapterThirteenController extends Controller
{
   /**
    * @Route("/chapter13/validate")
    */
    public function validateAction()
    {
        $author = new Author();

        // ... do something to the $author object

        $validator = $this->get('validator');
        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            /*
            * Uses a __toString method on the $errors variable which is a
            * ConstraintViolationList object. This gives us a nice string
            * for debugging.
            */
            return $this->render('chapter13/validation.html.twig', array(
                'errors' => $errors,
            ));
        }

        return new Response('The author is valid! Yes!');
    }
}
