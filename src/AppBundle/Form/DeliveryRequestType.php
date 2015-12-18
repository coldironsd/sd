<?php

// src/AppBundle/Form/DeliveryRequestType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DeliveryRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $dr = new DeliveryRequest();
        
        // $form = $this->createFormBuilder($dr)
        $builder
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('pickupAddr', 'text')
            ->add('destAddr', 'text')
            // ->add('createdUserId', 'hidden', array(
            //     'data' => $user,
            // ))
            ->add('cost', 'text')
            ->add('deliveryDate', 'date')
            ->add('lastUpdated', 'date')
            // ->add('deliverUserId', 'hidden', array(
            //     'data' => $user,
            // ))

    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DeliveryRequest'
        ));
    }
    
    public function getName()
    {
        return 'name';
    }
}