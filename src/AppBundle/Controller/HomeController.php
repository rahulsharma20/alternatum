<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request)
    {
        // Send to login page if user is not logged in
        if (!$this->getUser())
        {
            return $this->redirectToRoute('login_route');
        }

        // User Id
        $user_id = $this->getUser()->getId();

        // Initiate all buildings
        $buildings_assigned = $this->getDoctrine()->getRepository('AppBundle:Building')->getBuildingsAssignedToUser($user_id);

        return $this->render('home/home.html.twig', array('buildings_assigned' => $buildings_assigned));
    }
}
