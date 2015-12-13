<?php

// src/AppBundle/Controller/DefaultController.php

// ...
use AppBundle\Entity\DeliveryRequest;
use Symfony\Component\HttpFoundation\Response;

// ...
public function homeAction(Request $request)
{
    $dr = new DeliveryRequest();
    $dr->setName();
    $dr->setDescription();
    $dr->setPickupAddr();
    $dr->setDestAddr();
    $dr->setCreatedUserId();
    $dr->setCost();
    $dr->setDeliveryDate();
    $dr->setLastUpdated();
    $dr->setDeliverUserId();

    $em = $this->getDoctrine()->getManager();

    $em->persist($dr);
    $em->flush();

    return new Response('Created delivery request id '.$dr->getId());
    
    // return $this->render(
    //         'home/home.html.twig'
    //     );
}