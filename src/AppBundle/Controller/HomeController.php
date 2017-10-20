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
        $all_buildings = $this->getDoctrine()->getRepository('AppBundle:Building')->findAll();
        // Get all user_building objects
        $user_buildings = $this->getDoctrine()->getRepository('AppBundle:UserBuilding')->findByUser($user_id);

        $buildings_assigned = [];
        foreach ($user_buildings as $user_building)
        {
            array_push($buildings_assigned, $user_building->getBuilding());
        }

        return $this->render('home/home.html.twig', array('buildings_assigned' => $buildings_assigned));
    }
}
