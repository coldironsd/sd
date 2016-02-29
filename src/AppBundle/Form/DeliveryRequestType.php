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
use AppBundle\Form\DataTransformer\DateTimeTransformer;
// use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DeliveryRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $dr = new DeliveryRequest();
        
        // $form = $this->createFormBuilder($dr)
        $builder
            ->add('name', 'text', array(
                'label' => false))
            // ->add('description', 'text')
            ->add('pickupAddr', 'text', array(
                'label' => false))
            ->add('destAddr', 'text', array(
                'label' => false))
            // ->add('createdUserId', 'hidden', array(
            //     'data' => $user,
            // ))
            ->add('cost', 'money', array(
                // 'divisor' => 100
                'currency' => "USD",
                'label' => false))
            // ->add('deliveryDate', 'date')
            ->add('deliveryDate', null, array(
                'required' => true,
                'label' => false,
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'class' => 'form-control input-inline datetimepicker',
                    'data-provide' => 'datepicker',
                    'data-format' => 'dd-mm-yyyy HH:ii',
                ),
            ))
            // ->add('lastUpdated', 'date')
            // ->add('deliverUserId', 'hidden', array(
            //     'data' => $user,
            // ))

    ;
    
    $builder->get('deliveryDate')
            ->addModelTransformer(new DateTimeTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DeliveryRequest'
        ));
    }
    
    public function getName()
    {
        return 'add_request';
    }
}