<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

use AppBundle\Common\SessionAndCookieKeys;

class SecurityEventListner implements LogoutSuccessHandlerInterface
{
   //to redirect users after login/logout
   private $router;
   private $container;
   private $requestStack;

   /**
    * Desc - instantiate event listener
    * @param TokenStorageInterface $security
    */
   public function __construct( TokenStorageInterface $security,
                                Router $router,
                                ContainerInterface $container,
                                RequestStack $requestStack)
   {
       $this->security = $security;
       $this->router = $router;
       $this->container = $container;
       $this->requestStack = $requestStack;
   }

   public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
   {

        $user = $this->security->getToken()->getUser();
   }

    public function onLogoutSuccess(Request $request)
    {
        $session = $request->getSession();

        return new RedirectResponse($this->router->generate('homepage'));
    }

}
