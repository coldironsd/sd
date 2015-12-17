<?php

// src/AppBundle/Controller/HomeController

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\DeliveryRequest;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller{
    
    /**
     * @Route("/home", name="add_request")
     */
    public function addAction(Request $request)
    {
        $dr = new DeliveryRequest();
        
        $form = $this->createFormBuilder($dr)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('pickupAddr', TextType::class)
            ->add('destAddr', TextType::class)
            ->add('createdUserId', TextType::class)
            ->add('cost', TextType::class)
            ->add('deliveryDate', TextType::class)
            ->add('lastUpdated', TextType::class)
            ->add('deliverUserId', TextType::class)
    
            ->add('start', SubmitType::class, array('label' => 'Make Request'))
            ->getForm();
    
        $em = $this->getDoctrine()->getManager();
    
        $em->persist($dr);
        $em->flush();
    
        return new Response('Created delivery request id '.$dr->getId());
    }
}