<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Main;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add( 'description',
                  'textarea',
                  array_merge(array(
                      'label'  => "Description" ,
                      'attr' => array('class' => 'form-control',
                                      'placeholder' => 'Add Description')
                      )
                ))
            ->add('complete', 'checkbox',array(
                'required' => false,
                'data' => true
            ))
            ->add('inspectiondate', 'text', array(
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('imageFile', 'file', array(
            ))
            ->add('duedate', 'text', array(
                'attr' => array('class' => 'col-xs-12 form-control')
            ));
        $builder->add('responsible' ,'entity',array(
                'class' => 'AppBundle:Responsible',
                'attr' => array('class' => 'col-xs-12 form-control' ),
                'choices'  => $options['responsibles'],
                'data' => $options['responsibles'][0],
                'placeholder' => 'Choose an option',
                'expanded' => false,
                'multiple' => false
            ));
        $builder->add('level' ,'entity',array(
                'class' => 'AppBundle:Level',
                'attr' => array('class' => 'col-xs-12 form-control' ),
                'choices'  => $options['levels'],
                'data' => $options['levels'][0],
                'placeholder' => 'Choose an option',
                'expanded' => false,
                'multiple' => false
            ));
        $builder->add('room_no' ,'entity',array(
                'class' => 'AppBundle:RoomNo',
                'attr' => array('class' => 'col-xs-12 form-control' ),
                'choices'  => $options['roomNos'],
                'data' => $options['roomNos'][0],
                'placeholder' => 'Choose an option',
                'expanded' => false,
                'multiple' => false
            ));
        $builder->add('dorR' ,'entity',array(
                'class' => 'AppBundle:DorR',
                'attr' => array('class' => 'col-xs-12 form-control' ),
                'choices'  => $options['dorRs'],
                'data' => $options['dorRs'][0],
                'placeholder' => 'Choose an option',
                'expanded' => false,
                'multiple' => false
            ));
        $builder->add('save', 'submit', array(
           'attr' => array('class' => 'btn btn-default')
        ));
    }

    public function getName()
    {
        return 'app_main';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Main::class,
        ));
    }
}
