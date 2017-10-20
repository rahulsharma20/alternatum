<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Users;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Name',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('username', 'text', array(
                'label' => 'Username',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
            ->add('password', 'text', array(
                'label' => 'Password',
                'attr' => array('class' => 'col-xs-12 form-control')
            ))
        ;
    }

    public function getName()
    {
        return 'app_users';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Users::class,
        ));
    }
}
