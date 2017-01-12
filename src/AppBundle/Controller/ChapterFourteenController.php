<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ChapterFourteenController extends Controller
{

    /**
     * @Route("/chapter14/new/build")
     */
    public function newBuildAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        return $this->render('chapter14/buildingform.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/chapter14/new/build/handle")
     */
    public function newBuildHandleAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        // Forcément avant createView
        // do nothing if form not submitted OR fill task object with results form fields
        $form->handleRequest($request);

        // Si pas valide, form rendu avec erreurs de validation
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //$em->persist($task);
            //$em->flush();

            // Redirect pour pas que l'utilisateur refresh et renvoie le form
            return new Response("Success");
        }

        return $this->render('chapter14/buildingform.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/chapter14/new/build/submits")
     */
    public function newBuildMultipleSubmitAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->add('saveAndAdd', SubmitType::class, array('label' => 'Save and Add'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nextAction = $form->get('saveAndAdd')->isClicked()
                ? 'task_new'
                : 'task_success';

            return new Response($nextAction);
        }

        return $this->render('chapter14/buildingform.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/chapter14/new/hand")
     */
    public function newHandAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        return $this->render('chapter14/renderinghand.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}