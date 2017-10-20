<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request)
    {

        return $this->render('security/login.html.twig' , array(
            'last_username' => $this->get('security.authentication_utils')->getLastUsername(),
            'error'         => $this->get('security.authentication_utils')->getLastAuthenticationError(),
            'request'       => $request
	    ));
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
        throw $this->createNotFoundException("Login CheckAction should not be called here");
    }

    /**
     * @Route("/logout", name="logout")
    */
    public function logout()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }
}
