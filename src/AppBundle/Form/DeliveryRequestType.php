<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use AppBundle\Form\DataTransformer\DateTimeTransformer;

class DeliveryRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array(
                'placeholder' => 'What',),
                'label' => false))
            ->add('cost', 'money', array('attr' => array(
                'placeholder' => 'How much you want to pay',),
                'currency' => "USD",
                'label' => false))
            ->add('pickup_addr', 'text', array('label' => false, 'attr' => array(
                'class' => 'autocomplete-pickupAddr',
                'maxlength' => 30,
                'placeholder' => 'From where')))
            ->add('dest_addr', 'text',  array('label' => false, 'attr' => array(
                'class'   => 'autocomplete-destAddr',
                'maxlength' => 30,
                'placeholder' => 'To where')))
            ->add('delivery_date', 'text', array(
                'required' => true,
                'label' => false,
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'class' => 'form-control input-inline datetimepicker',
                    'data-provide' => 'datepicker',
                    'data-format' => 'dd-mm-yyyy HH:ii'
                    'placeholder' => 'When'
                )
            ))->add('Send Product', 'submit', array('attr' => array('class' => 'pull-right btn btn-primary')));
            
            // $builder->get('delivery_date')->addModelTransformer(new DateTimeTransformer()); // not working as expected.
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