<?php

namespace AppBundle\Controller\Internal;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\UsersType;
use AppBundle\Entity\Users;
use AppBundle\Form\BuildingType;
use AppBundle\Entity\Building;
use AppBundle\Entity\UserBuilding;

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
     * @Route("/add/building", name="internal_add_building_to_project")
     */
    public function addBuildingToProjectAction(Request $request)
    {
        $all_projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAll();

        return $this->render('internal/add-building-to-project.html.twig', array('all_projects' => $all_projects));
    }

    /**
     * @Route("/add/building/{project_id}/{project_name}/{building_id}", defaults={"building_id"="new"}, name="internal_add_building")
     */
    public function addBuildingAction(Request $request, $project_id, $project_name, $building_id)
    {
        if ($building_id != "new")
        {
            $building = $this->getDoctrine()->getRepository('AppBundle:Building')->findById($building_id);
        } else {
            $building = new Building;
        }

        $builder = $this->get('form.factory')->createNamedBuilder(
                                                    "app_users",'form',$building,
                                                    array(
                                                        'validation_groups' => array('registration','Default'),
                                                        'csrf_protection' => false
                                                        )
                                                );

        $building_types = $this->getDoctrine()->getRepository('AppBundle:BuildingTypes')->findAll();
        $buildingType = new BuildingType();
        $options = array('building_types' => $building_types);
        $buildingType->buildForm($builder, $options);
        $builder->add('save', 'submit', array('label' => 'Add Building',
                                                'attr' => array('class' => 'btn btn-success'))) ;
        $building_form = $builder->getForm();
        $building_form->handleRequest($request);
        $all_buildings = $this->getDoctrine()->getRepository('AppBundle:Building')->findByProject($project_id);

        $entry_saved = false;
        if ($building_form->isSubmitted() && $building_form->isValid())
        {
            $old_building = $this->getDoctrine()->getRepository('AppBundle:Building')->findByBuilding($building->getBuilding());
            $project = $this->getDoctrine()->getRepository('AppBundle:Project')->findOneById($project_id);
            $building->setProject($project);

            if (!empty($old_building))
            {
                return $this->render('internal/add-building.html.twig', array(
                                                                    'form_view' => $building_form->createView(),
                                                                    'entry_saved' => $entry_saved,
                                                                    'project_id' => $project_id,
                                                                    'project_name' => $project_name,
                                                                    'all_buildings' => $all_buildings,
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
                                                                    'entry_saved' => $entry_saved,
                                                                    'project_id' => $project_id,
                                                                    'project_name' => $project_name,
                                                                    'all_buildings' => $all_buildings
                                                                    ));
            }

            return $this->render('internal/add-building.html.twig', array(
                                                                'form_view' => $building_form->createView(),
                                                                'entry_saved' => $entry_saved,
                                                                'project_id' => $project_id,
                                                                'project_name' => $project_name,
                                                                'all_buildings' => $all_buildings
                                                                ));
        }

        return $this->render('internal/add-building.html.twig', array(
                                                            'form_view' => $building_form->createView(),
                                                            'entry_saved' => $entry_saved,
                                                            'project_id' => $project_id,
                                                            'project_name' => $project_name,
                                                            'all_buildings' => $all_buildings
                                                            ));

    }

    /**
     * @Route("/assign/users", name="internal_assign_users")
     */
    public function assignUsersAction(Request $request)
    {
        $all_projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAll();

        return $this->render('internal/assign-users-to-project.html.twig', array('all_projects' => $all_projects));
    }


    /**
     * @Route("/assign/users/project/{project_id}/{project_name}", name="internal_assign_users_by_project")
     */
    public function assignUsersByBuildingAction(Request $request, $project_id, $project_name)
    {
        $all_buildings = $this->getDoctrine()->getRepository('AppBundle:Building')->findByProject($project_id);

        return $this->render('internal/assign-users.html.twig', array('all_buildings' => $all_buildings, 'project_name' => $project_name));
    }

    /**
     * @Route("/assign/users/building/{building_id}/{building_name}", name="internal_assign_by_building")
     */
    public function assignByBuildingAction(Request $request, $building_id, $building_name)
    {
        $all_users = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();

        $all_users_assigned = $this->getDoctrine()->getRepository('AppBundle:Users')->getAllUsersAssignedByBuilding($building_id);

        return $this->render('internal/assign-by-building.html.twig', array('all_users' => $all_users, 'all_users_assigned' => $all_users_assigned));
    }

    /**
     * @Route("/assign/user/building", name="assign_user_to_building")
     * @Method("POST")
     */
    public function assignUserToBuildingAction(Request $request)
    {
        $content = $request->getContent();
        // Check if content is empty
        if(empty($content))
        {
            $response = array( "code" => 400, "success" => false,
                               "msg" => "Malformed Request. Empty content");
            return new Response(json_encode($response),$response["code"]);
        }
        $data = json_decode($content,true); // 2nd param to get as array

        // Check if request containes valid JSON.
        if (empty($data))
        {
            $response = array( "code" => 400, "success" => false,
                               "msg" => "Malformed Request. Not valid json");
            return new Response(json_encode($response),$response["code"]);
        }

        if (array_key_exists("user_id",$data))
            $user_id = $data['user_id'];
        if (array_key_exists("building_id",$data))
            $building_id = $data['building_id'];

        // Check if request contains user id
        if (empty($user_id))
        {
            $response = array( "code" => 400, "success" => false,
                                "msg" => "Malformed Request. User id not found");
            return new Response(json_encode($response),$response["code"]);
        }
        // Check if request contains building id
        if (empty($building_id))
        {
            $response = array( "code" => 400, "success" => false,
                                "msg" => "Malformed Request. Building id not found");
            return new Response(json_encode($response),$response["code"]);
        }

        $user_building = new UserBuilding;
        $user = $this->getDoctrine()->getRepository('AppBundle:Users')->findOneById($user_id);
        $building = $this->getDoctrine()->getRepository('AppBundle:Building')->findOneById($building_id);
        $user_building->setUser($user);
        $user_building->setBuilding($building);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user_building);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error("Doctrine Error : [" . var_export($e->getCode(),true) . "] Message" . $e->getMessage());

            $response = array( "code" => 500, "success" => false,
                                "msg" => $e->getMessage());
            return new Response(json_encode($response),$response["code"]);
        }

        $response = array( "code" => 200, "success" => true,
                            "msg" => "Member has been assigned to the building.");
        return new Response(json_encode($response),$response["code"]);
    }

    /**
     * @Route("/remove/user/building", name="remove_user_from_building")
     * @Method("POST")
     */
    public function removeUserFromBuildingAction(Request $request)
    {
        $content = $request->getContent();
        // Check if content is empty
        if(empty($content))
        {
            $response = array( "code" => 400, "success" => false,
                               "msg" => "Malformed Request. Empty content");
            return new Response(json_encode($response),$response["code"]);
        }
        $data = json_decode($content,true); // 2nd param to get as array

        // Check if request containes valid JSON.
        if (empty($data))
        {
            $response = array( "code" => 400, "success" => false,
                               "msg" => "Malformed Request. Not valid json");
            return new Response(json_encode($response),$response["code"]);
        }

        if (array_key_exists("user_id",$data))
            $user_id = $data['user_id'];
        if (array_key_exists("building_id",$data))
            $building_id = $data['building_id'];

        // Check if request contains user id
        if (empty($user_id))
        {
            $response = array( "code" => 400, "success" => false,
                                "msg" => "Malformed Request. User id not found");
            return new Response(json_encode($response),$response["code"]);
        }
        // Check if request contains building id
        if (empty($building_id))
        {
            $response = array( "code" => 400, "success" => false,
                                "msg" => "Malformed Request. Building id not found");
            return new Response(json_encode($response),$response["code"]);
        }

        $user_building = $this->getDoctrine()->getRepository('AppBundle:UserBuilding')->findOneByUserAndBuilding($user_id, $building_id);

        $user_building_object = $user_building = $this->getDoctrine()->getRepository('AppBundle:UserBuilding')->findOneById($user_building[0]->getId());

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user_building_object);
            $em->flush();
        }catch (\Exception $e) {
            $this->get('logger')->error("Doctrine Error : [" . var_export($e->getCode(),true) . "] Message" . $e->getMessage());

            $response = array( "code" => 500, "success" => false,
                                "msg" => $e->getMessage());
            return new Response(json_encode($response),$response["code"]);
        }

        $response = array( "code" => 200, "success" => true,
                            "msg" => "Member has been removed from the building.");
        return new Response(json_encode($response),$response["code"]);
    }

    /**
     * @Route("/user/logs", name="internal_user_logs")
     */
    public function userLogsAction(Request $request)
    {
        $all_users = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();

        return $this->render('internal/all-users.html.twig', array('users' => $all_users));
    }

    /**
     * @Route("/user/logs/{user_id}/{user_name}", name="internal_user_logs_by_user_id")
     */
    public function userLogsByUserIdAction(Request $request, $user_id)
    {
        $all_user_logs = $this->getDoctrine()->getRepository('AppBundle:Main')->findByUser($user_id);

        return $this->render('internal/all-user-logs.html.twig', array('all_user_logs' => $all_user_logs));
    }

    /**
     * @Route("/building/logs", name="internal_building_logs")
     */
    public function buildingLogsAction(Request $request)
    {
        $all_buildings = $this->getDoctrine()->getRepository('AppBundle:Building')->findAll();

        return $this->render('internal/all-buildings.html.twig', array('buildings' => $all_buildings));
    }

    /**
     * @Route("/building/logs/{building_id}/{building_name}", name="internal_building_logs_by_building_id")
     */
    public function buildingLogsByBuildingIdAction(Request $request, $building_id)
    {
        $all_building_logs = $this->getDoctrine()->getRepository('AppBundle:Main')->findByBuilding($building_id);

        return $this->render('internal/all-building-logs.html.twig', array('all_building_logs' => $all_building_logs));
    }
}
