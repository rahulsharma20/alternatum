<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\RoomNo;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomNoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('room_no')
        ;
    }

    public function getName()
    {
        return 'app_room_no';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => RoomNo::class,
        ));
    }
}
