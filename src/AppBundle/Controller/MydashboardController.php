<?php

// src/AppBundle/Controller/MydashboardController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\DeliveryRequestType;
use AppBundle\Entity\DeliveryRequest;
use AppBundle\Entity\TakeRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MydashboardController extends Controller
{
    
    /**
     * @Route("/mydashboard", name="mydashboard")
     */
    public function mydashboardAction(Request $request)
    {
        $userId = $this->getUser()->getId();
        $mydrs = $this->getDoctrine()
                ->getRepository('AppBundle:DeliveryRequest')
                ->findBy(array('created_user_id' => $userId));

        
        return $this->render('mydashboard/mydashboard.html.twig', array('mydrs' => $mydrs));
    }
    
    /**
     * @Route("/mytakerequest", name="mytakerequest")
     */
    public function mytakerequestAction(Request $request){
        $userId = $this->getUser()->getId();
        $mytrs = $this->getDoctrine()
                ->getRepository('AppBundle:TakeRequest')
                ->findBy(array('user_id' => $userId));

        
        return $this->render('mydashboard/mydashboard.html.twig', array('mytrs' => $mytrs));
    }
}
