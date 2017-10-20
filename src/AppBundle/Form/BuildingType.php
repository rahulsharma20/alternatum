<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Building;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuildingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('building', 'text', array(
                'label' => 'Building Name',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
        ;
    }

    public function getName()
    {
        return 'app_building';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Building::class,
        ));
    }
}
