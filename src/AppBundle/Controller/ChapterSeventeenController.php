<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ChapterSeventeenController extends Controller
{
    /**
     * @Route("/chapter17/translate/{_locale}", defaults={"_locale": "fr"})
     */
    public function translateAction(Request $request)
    {

        // Pas possible, doit être fait avant d'entrer dans le controller
        //$request->setLocale("fr");

        $translated = $this->get('translator')->trans('Symfony is great');

        return $this->render(
            'chapter17/translate.html.twig',
            array(
                'req_locale' => $request->getLocale(),
                'def_locale' => $request->getDefaultLocale(),
                'data' => $translated
            )
        );
    }

    /**
     * A creuser:
     * - Messages placeholders
     * - Pluralization (transChoice)
     * - Making the Locale "Sticky" during a User's Session
     * - Doctrine through the Translatable Extension or the Translatable Behavior
     */

    /**
     * @Route("/chapter17/template/{_locale}")
     */
    public function templateAction(Request $request)
    {
        return $this->render(
            'chapter17/transtemplate.html.twig',
            array(
                'count' => 1,
                'req_locale' => $request->getLocale()
            )
        );
    }
}
