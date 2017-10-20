<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class InternalSecurityController extends Controller
{
    /**
     * @Route("/_internal/login", name="internal_login_route")
     */
    public function internalLoginAction(Request $request)
    {

        return $this->render('security/_internal/login.html.twig' , array(
            'last_username' => $this->get('security.authentication_utils')->getLastUsername(),
            'error'         => $this->get('security.authentication_utils')->getLastAuthenticationError(),
            'request'       => $request
	    ));
    }

    /**
     * @Route("/_internal/login_check", name="internal_login_check")
     */
    public function internalLoginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
        throw $this->createNotFoundException("Login CheckAction should not be called here");
    }

    /**
     * @Route("/_internal/logout", name="internal_logout")
    */
    public function internalLogout()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }
}
