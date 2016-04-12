<?php

// src/AppBundle/Controller/AccountController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\DeliveryRequest;
use AppBundle\Entity\TakeRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchController extends Controller
{
    /**
     * @Route("/searchindex", name="searchindex")
     */
    public function searchindexAction(Request $request)
    {
        $deliReq = new DeliveryRequest();
        $allReqs = null;
        $myTakenReqs = null;
        
        // fetch my taken requests.
        $takeRepository = $this->getDoctrine()->getRepository('AppBundle:TakeRequest');
        $myTakenReqs = $takeRepository->findBy(array('user_id' => $this->getUser()->getId()));
        
        // create form object.
        $form = $this->createFormBuilder($deliReq)
            ->add('dest_addr', 'text', array('label' => false, 'attr' => array(
                'class' => 'autocomplete-destAddr',
                'style' => 'width: 25em;',
                'id' => 'test',
                'maxlength' => 30,
                'placeholder' => 'To Where')))
            ->add('pickup_addr', 'text', array('label' => false, 'attr' => array(
                'class' => 'autocomplete-pickupAddr',
                'style' => 'width: 25em;',
                'id' => 'test',
                'maxlength' => 30,
                'placeholder' => 'From Where')))
            ->add('search', 'submit', array('label' => 'Search', 'attr' => array(
                'class'   => 'btn btn-primary')))
            ->getForm();
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            // fetch with pickup and dest address and sort by date.
            $repository = $this->getDoctrine()->getRepository('AppBundle:DeliveryRequest');
            
            $query = $repository->createQueryBuilder('dr')
                    ->where('dr.pickup_addr LIKE :pickupaddr OR dr.dest_addr LIKE :destaddr')
                    ->orderBy('dr.delivery_date', 'ASC')
                    ->getQuery();
                   
            // SEARCH BOTH VALUES
            if($form->get('pickup_addr')->getData()!== null && $form->get('dest_addr')->getData()!== null){
                $query->setParameter('pickupaddr', '%' . $form->get('pickup_addr')->getData() . '%');
                $query->setParameter('destaddr', '%' . $form->get('dest_addr')->getData() . '%');
            // ONLY SEARCH PICKUP ADDRESS
            }elseif($form->get('pickup_addr')->getData()!== null && $form->get('dest_addr')->getData()== null){
                $query->setParameter('pickupaddr', '%' . $form->get('pickup_addr')->getData() . '%');
                $query->setParameter('destaddr', '' . $form->get('dest_addr')->getData() . '');
            // ONLY SEARCH NAME
            }elseif($form->get('pickup_addr')->getData()== null && $form->get('dest_addr')->getData()!== null){
                $query->setParameter('pickupaddr', '' . $form->get('pickup_addr')->getData() . '');
                $query->setParameter('destaddr', '%' . $form->get('dest_addr')->getData() . '%');
            }
            $allReqs = $query->getResult();
                   
        }else{
             // fetch all.
            $allReqs = $this->getDoctrine()->getRepository('AppBundle:DeliveryRequest')->findAll();
        }
        
        return $this->render('search/search.html.twig', 
            array('form' => $form->createView(),
                'requests' => $allReqs,
                'myRequests' => $myTakenReqs));
    }
    
    /**
     * @Route("/search", name="task_search")
     */
    public function searchAction(Request $request)
    {
        $name = 'Search';
        return $this->render('search/search.html.twig', array('name' => $name));
    }
    
    /**
     * @Route("/takeInSearch_ajax_update", name="take_request")
     */
    public function takeRequestAction(Request $request)
    {
        $user = $this->getUser();
        // $request = $this->container->get('request');        
        $requestId = $request->request->get('data1');
        
        $deliveryRequest = $this->getDoctrine()->getRepository('AppBundle:DeliveryRequest')->find($requestId);
        
        $takeReq = new TakeRequest();
        $takeReq->setUserId($user);
        $takeReq->setRequestId($deliveryRequest);
        $takeReq->setLastUpdated(new \DateTime(date('d/m/Y H:i:s')));
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($takeReq);
        $em->flush();
        
        $response = array("code" => 100, "success" => true);
        return new Response(json_encode($response)); 
    }
}