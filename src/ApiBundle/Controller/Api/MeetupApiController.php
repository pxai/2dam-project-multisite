<?php

namespace ApiBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use ApiBundle\Entity\Meetup;

class MeetupApiController extends Controller
{

        private $serializer;


    public function __construct () {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    private function response ($data) {
      //$this->get('logger')->info('This is what we have: ' . $this->serializer->serialize($data, 'json'));
      $response = new Response($this->serializer->serialize($data, 'json'));
      $response->headers->set('Content-Type','application/json');
      $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
      $response->headers->set('Access-Control-Allow-Origin', '*');
      return $response;
    }

    /**
     * @Route("/admin/api/meetup", name="api_meetup_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $meetups = $this->get("api_inventory.bo.meetup")->selectAll();
        return $meetups;
    }

    /**
     *
     * @Route("/admin/api/meetup/detail/{id}", name="api_meetup_detail")
     * @Rest\View
     */
    public function meetupDetailAction($id)
    {
        $meetup = $this->get("api_inventory.bo.meetup")->selectById($id);
        return $meetup;
    }



    /**
    *
    * @Route("/admin/api/meetup/create", name="api_meetup_new_save")
    * @Method({"POST"})
    */
   public function meetupNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(MeetupType::class, new Meetup());
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $meetup = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($meetup, 'json'));

           $this->get("api_inventory.bo.meetup")->create($meetup);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $meetup->getId()),
                       true // absolute
                   )
               );
           }*/

           return $response;
       }
           $this->get('logger')->info('NOT CORRECT');
       return View::create($form, 400);
   }

        /**
        *
        * @Route("/admin/api/meetup/delete/{id}", name="api_meetup_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function meetupDeleteAction(Meetup $meetup)
       {
           $this->get("api_inventory.bo.meetup")->remove($meetup);
       }


/**
    *
    * @Route("/admin/api/meetup/update", name="api_meetup_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function meetupUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(MeetupType::class, new Meetup(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $meetup = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($meetup, 'json'));

           $this->get("api_inventory.bo.meetup")->update($meetup);


           $response = new Response();
           $response->setStatusCode($statusCode);

           return $response;
       }
           $this->get('logger')->info('UPDATE NOT CORRECT');
       return View::create($form, 400);
        
   }


//
//     /**
//     *
//     * @Route("/admin/api/meetup/update", name="api_meetup_update_save")
//     * Method({"PUT"})
//     */
//    public function meetupUpdateSaveAction(Meetup $meetup)
//    {
//       $form = $this->createForm(MeetupType::class, new Meetup());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $meetup = $form->getData();
//
//            $this->get("api_inventory.bo.meetup")->update($meetup);
//            //$response =  $this->forward('apiInventoryBundle:Meetup:detail.html.twig', array('meetup' => $meetup));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:Meetup:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/meetup/delete/{id}", name="api_meetup_delete")
//     */
//    public function meetupDeleteAction($id)
//    {
//        $meetup = $this->get("api_inventory.bo.meetup")->selectById($id);
//        return $this->render('apiInventoryBundle:Meetup:delete.html.twig',array("meetup"=>$meetup));
//    }
//
//
}
