<?php

// src/AppBundle/Controller/HomeController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\DeliveryRequestType;
use AppBundle\Entity\DeliveryRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    
    /**
     * @Route("/home", name="add_request")
     */
    public function addAction(Request $request)
    {
        // 1) build the form
        $dr = new DeliveryRequest();
        $dr->setCreatedUserId($this->getUser());
        $dr->setDeliverUserId($this->getUser());

        $form = $this->createForm(new DeliveryRequestType(), $dr);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
           
            // $user->setPassword($password);

        //   ->add('start', SubmitType::class, array('label' => 'Make Request'))
        //     ->getForm();
    
            $em = $this->getDoctrine()->getManager();
        
            $em->persist($dr);
            $em->flush();
        
            return new Response('Created delivery request id '.$dr->getId());
        }
        
        return $this->render(
            'home/home.html.twig',
            array('form' => $form->createView())
        );
    }
}