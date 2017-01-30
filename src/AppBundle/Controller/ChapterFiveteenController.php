<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ChapterFiveteenController extends Controller
{
    /**
     * @Route("/chapter15/admin")
     */
    public function adminAction()
    {
        return $this->render('chapter15/admin.html.twig');
    }

    /**
     * @Route("/chapter15/denied")
     */
    public function deniedAction()
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
    }

    /**
     * @Route("/chapter15/annoted")
     * @Security("has_role('ROLE_USER')")
     */
    public function annotedAction()
    {
        return $this->render('chapter15/admin.html.twig');
    }

    /**
     * @Route("/chapter15/isauth")
     */
    public function authAction()
    {
        // IS_AUTHENTICATED_REMEMBERED, IS_AUTHENTICATED_ANONYMOUSLY
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render(
            'chapter15/message.html.twig',
            array(
                'message' => "authenticated"
            )
        );
    }

    /**
     * @Route("/chapter15/user")
     */
    public function userAction()
    {

        // Toujours checker sinon $this->getUser() = null
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->getUser();

        // the above is a shortcut for this
        // $user = $this->get('security.token_storage')->getToken()->getUser()

        dump($user);

        return $this->render(
            'chapter15/message.html.twig',
            array(
                'message' => $user
            )
        );
    }
}
