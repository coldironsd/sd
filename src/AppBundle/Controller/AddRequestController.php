<?php

// src/AppBundle/Controller/AddRequestController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\DeliveryRequestType;
use AppBundle\Entity\DeliveryRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AddRequestController extends Controller
{
    
    /**
     * @Route("/addRequest", name="addRequest")
     */
    public function addRequestAction(Request $request)
    {
        // 1) build the form
        $dr = new DeliveryRequest();
        $dr->setCreatedUserId($this->getUser());

        $form = $this->createForm(new DeliveryRequestType(), $dr);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            // parse delivery date value.
            // $time = strtotime($dr->getDeliveryDate());
            // $newformat = date('Y-m-d  H:i',$time);
            $dr->setDeliveryDate(new \DateTime($dr->getDeliveryDate()));
            // setup last updated date.
            $dr->setLastUpdated(new \DateTime(date('d/m/Y H:i:s')));
            $em = $this->getDoctrine()->getManager();
            $em->persist($dr);
            $em->flush();
            return new Response('Created delivery request id '.$dr->getId(). $dr->getName() .'|'. $dr->getDestAddr() .'|'. $dr->getPickupAddr() .'|'. $dr->getDeliveryDate()->format('d/m/Y H:i:s'));
        }
        
        return $this->render(
            'addrequest/addrequest.html.twig',
            array('form' => $form->createView())
        );
    }
}