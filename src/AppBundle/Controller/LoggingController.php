<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Main;
use AppBundle\Entity\Level;
use AppBundle\Form\MainType;
use Symfony\Component\Form\FormError;

class LoggingController extends Controller
{
    /**
     * @Route("/log/{building_id}/{building_name}.html", name="log_building")
     */
    public function loggingAction(Request $request, $building_id, $building_name)
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('login_route');
        }
        $building = $this->getDoctrine()->getRepository('AppBundle:Building')->find($building_id);

        // If building name does not match with DB, throw error.
        if ($building->getBuilding() != $building_name)
        {
            throw $this->createNotFoundException('Sorry the page you are looking for is not foundon the server');
        }
        $main = new Main;

        $builder = $this->get('form.factory')->createNamedBuilder(
                                                    "app_main",'form',$main,
                                                    array(
                                                        'validation_groups' => array('registration','Default'),
                                                        'csrf_protection' => false
                                                        )
                                                );

        $levels = $this->getDoctrine()->getRepository('AppBundle:Level')->findAll();
        $responsibles = $this->getDoctrine()->getRepository('AppBundle:Responsible')->findAll();
        $dorRs = $this->getDoctrine()->getRepository('AppBundle:DorR')->findAll();

        $roomNos = $this->getDoctrine()->getRepository('AppBundle:RoomNo')->findAll();

        $mainType = new MainType();

        $options = array (  'levels' => $levels ,
                            'responsibles' => $responsibles,
                            'dorRs' => $dorRs,
                            'roomNos' => $roomNos,
                            'building' => $building
                         );

        $mainType->buildForm($builder,$options);

        $main_form = $builder->getForm();
        $main_form->handleRequest($request);

        $entry_saved = false;
        if ($main_form->isSubmitted() && $main_form->isValid())
        {
            $main->setBuilding($building);
            $main->setDueDate(new \DateTime($main->getDueDate()));
            $main->setInspectionDate(new \DateTime($main->getInspectionDate()));
            $user = $this->getDoctrine()->getRepository('AppBundle:Users')->find($this->getUser()->getId());
            $main->setUser($user);
            try{
                $em = $this->getDoctrine()->getManager();
                $em->persist($main);
                $em->flush();
                $entry_saved = true;
            } catch (\Exception $e) {
                $this->get('logger')->error("Doctrine Error : [" . var_export($e->getCode(),true) . "] Message" . $e->getMessage());

                //Add error to form
                $main_form->addError(new FormError("Database error processing your request. Please try again." ));

                return $this->render('logging/logging.html.twig', array(
                    'building' => $building,
                    'levels' => $levels,
                    'responsibles' => $responsibles,
                    'dorRs' => $dorRs,
                    'roomNos' => $roomNos,
                    'form_view' => $main_form->createView()
                ));
            }

            return $this->render('logging/logging.html.twig', array(
                'building' => $building,
                'levels' => $levels,
                'responsibles' => $responsibles,
                'dorRs' => $dorRs,
                'roomNos' => $roomNos,
                'form_view' => $main_form->createView(),
                'entry_saved' => $entry_saved
            ));
        }else {
            return $this->render('logging/logging.html.twig', array(
                'building' => $building,
                'levels' => $levels,
                'responsibles' => $responsibles,
                'dorRs' => $dorRs,
                'roomNos' => $roomNos,
                'form_view' => $main_form->createView()
            ));
        }
    }
}
