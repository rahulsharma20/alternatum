<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Project;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Project Name',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('address', 'textarea', array(
                'label' => 'Address',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('imageFile', 'file', array(
            ))
            ->add('gpsCoordinates', 'text', array(
                'label' => 'Gps Coordinates',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('ownership', 'text', array(
                'label' => 'Ownership',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('occupant', 'text', array(
                'label' => 'Occupant',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('save', 'submit', array(
               'attr' => array('class' => 'btn btn-default')
            ))
        ;
    }

    public function getName()
    {
        return 'app_project';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Project::class,
        ));
    }
}
