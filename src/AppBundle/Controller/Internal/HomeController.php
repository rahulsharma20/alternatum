<?php

namespace AppBundle\Controller\Internal;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\UsersType;
use AppBundle\Entity\Users;
use AppBundle\Form\BuildingType;
use AppBundle\Entity\Building;

/**
 * @Route("/_internal/admin", name="internal_homepage")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="internal_homepage")
     */
    public function homeAction(Request $request)
    {

        return $this->render('internal/home.html.twig');
    }

    /**
     * @Route("/add/user", name="internal_add_user")
     */
    public function addUsersAction(Request $request)
    {

        $user = new Users;

        $builder = $this->get('form.factory')->createNamedBuilder(
                                                    "app_users",'form',$user,
                                                    array(
                                                        'validation_groups' => array('registration','Default'),
                                                        'csrf_protection' => false
                                                        )
                                                );

        $usersType = new UsersType();
        $options = array();
        $usersType->buildForm($builder, $options);
        $builder->add('save', 'submit', array('label' => 'Add User',
                                                'attr' => array('class' => 'btn btn-success'))) ;
        $users_form = $builder->getForm();
        $users_form->handleRequest($request);

        $entry_saved = false;
        if ($users_form->isSubmitted() && $users_form->isValid())
        {
            $old_user = $this->getDoctrine()->getRepository('AppBundle:Users')->findByUsername($user->getUsername());

            if (!empty($old_user))
            {
                return $this->render('internal/add-users.html.twig', array(
                                                                    'form_view' => $users_form->createView(),
                                                                    'entry_saved' => $entry_saved,
                                                                    'user_exists' => true
                                                                    ));
            }

            $user->setRole('User');
            try{
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $entry_saved = true;
            } catch (\Exception $e) {
                $this->get('logger')->error("Doctrine Error : [" . var_export($e->getCode(),true) . "] Message" . $e->getMessage());

                //Add error to form
                $main_form->addError(new FormError("Database error processing your request. Please try again." ));

                return $this->render('internal/add-users.html.twig', array(
                                                                    'form_view' => $users_form->createView(),
                                                                    'entry_saved' => $entry_saved
                                                                    ));
            }

            return $this->render('internal/add-users.html.twig', array(
                                                                'form_view' => $users_form->createView(),
                                                                'entry_saved' => $entry_saved
                                                                ));
        }

        return $this->render('internal/add-users.html.twig', array(
                                                            'form_view' => $users_form->createView(),
                                                            'entry_saved' => $entry_saved
                                                            ));
    }

    /**
     * @Route("/disable/user", name="internal_disable_user")
     */
    public function disableUsersAction(Request $request)
    {
        // Get all users
        $all_users = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();

        return $this->render('internal/disable-users.html.twig', array('users' => $all_users));
    }

    /**
     * @Route("/add/building", name="internal_add_building")
     */
    public function addBuildingAction(Request $request)
    {
        $building = new Building;

        $builder = $this->get('form.factory')->createNamedBuilder(
                                                    "app_users",'form',$building,
                                                    array(
                                                        'validation_groups' => array('registration','Default'),
                                                        'csrf_protection' => false
                                                        )
                                                );

        $buildingType = new BuildingType();
        $options = array();
        $buildingType->buildForm($builder, $options);
        $builder->add('save', 'submit', array('label' => 'Add Building',
                                                'attr' => array('class' => 'btn btn-success'))) ;
        $building_form = $builder->getForm();
        $building_form->handleRequest($request);

        $entry_saved = false;
        if ($building_form->isSubmitted() && $building_form->isValid())
        {
            $old_building = $this->getDoctrine()->getRepository('AppBundle:Building')->findByBuilding($building->getBuilding());

            if (!empty($old_building))
            {
                return $this->render('internal/add-building.html.twig', array(
                                                                    'form_view' => $building_form->createView(),
                                                                    'entry_saved' => $entry_saved,
                                                                    'user_exists' => true
                                                                    ));
            }

            try{
                $em = $this->getDoctrine()->getManager();
                $em->persist($building);
                $em->flush();
                $entry_saved = true;
            } catch (\Exception $e) {
                $this->get('logger')->error("Doctrine Error : [" . var_export($e->getCode(),true) . "] Message" . $e->getMessage());

                //Add error to form
                $main_form->addError(new FormError("Database error processing your request. Please try again." ));

                return $this->render('internal/add-building.html.twig', array(
                                                                    'form_view' => $building_form->createView(),
                                                                    'entry_saved' => $entry_saved
                                                                    ));
            }

            return $this->render('internal/add-building.html.twig', array(
                                                                'form_view' => $building_form->createView(),
                                                                'entry_saved' => $entry_saved
                                                                ));
        }

        return $this->render('internal/add-building.html.twig', array(
                                                            'form_view' => $building_form->createView(),
                                                            'entry_saved' => $entry_saved
                                                            ));

    }

    /**
     * @Route("/assign/users", name="internal_assign_users")
     */
    public function assignUsersAction(Request $request)
    {
        $all_buildings = $this->getDoctrine()->getRepository('AppBundle:Building')->findAll();

        return $this->render('internal/assign-users.html.twig', array('all_buildings' => $all_buildings));
    }

    /**
     * @Route("/assign/users/{building_id}/{building_name}", name="internal_assign_by_building")
     */
    public function assignByBuildingAction(Request $request)
    {
        $all_users = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();

        return $this->render('internal/assign-by-building.html.twig', array('all_users' => $all_users));
    }

    /**
     * @Route("/user/logs", name="internal_user_logs")
     */
    public function userLogsAction(Request $request)
    {

        return $this->render('internal/add-users.html.twig');
    }

    /**
     * @Route("/building/logs", name="internal_building_logs")
     */
    public function buildingLogsAction(Request $request)
    {

        return $this->render('internal/add-users.html.twig');
    }
}
