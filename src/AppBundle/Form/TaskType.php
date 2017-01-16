<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;

use AppBundle\Form\Project;


class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task')
            ->add('dueDate', null, array('widget' => 'single_text')) // null = default guess system
            ->add('agree', null, array('mapped' => false)) // All field in form correspond to attribute in class Task, except if not mapped
            ->add('project', ProjectType::class)
            ->add('save', SubmitType::class)
        ;

        //$builder->add('taskCategory', CategoryType::class);
    }

    // Or automatically guessed in createForm function
    // Not good for embedded forms
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task',
        ));
    }
}
