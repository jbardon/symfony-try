<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
     * @Route("/chapter14/new/hand", name="hand")
     */
    public function newHandAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->setAction($this->generateUrl('hand')) // custom
            ->setMethod('GET')                      // custom
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return new Response("Submited with custom method & url");
        }

        return $this->render('chapter14/renderinghand.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/chapter14/new/deported")
     */
    public function newDeportedAction(Request $request)
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class, $task);

        return $this->render('chapter14/buildingform.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/chapter14/new/infos")
     */
    public function newInfoAction(Request $request)
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class, $task);

        // Set data (even mapped)
        //$form->get('dueDate')->setData(new \DateTime());

        // Get data (even mapped)
        //$form->get('dueDate')->getData();

        return new Response("OK");
    }

    /**
     * @Route("/chapter14/new/save")
     */
    public function newSaveAction(Request $request)
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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush();

            return new Response("Success");
        }

        return $this->render('chapter14/buildingform.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/chapter14/new/embedded")
     */
    public function newEmbeddedAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        // Pas obligatoire
        $project = new Project();
        $project->setName("NoName");

        $task->setProject($project);
        //

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->persist($task->getProject()); // Attention sous-entité
            $em->flush();

            return new Response("Success");
        }

        return $this->render('chapter14/withcategory.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/chapter14/new/simple")
     */
    public function newSimpleAction(Request $request)
    {
        $defaultData = array('message' => 'Type your message here');

        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class, array(
                'constraints' => new Length(array('min' => 3)),
            ))
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' <= 3))
                ),
            ))
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            dump($data);

            return new Response("OK");
        }

        return $this->render('chapter14/buildingform.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}