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

use ApiBundle\Form\Type\EventType;
use ApiBundle\Entity\Event;

class EventApiController extends Controller
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
     * @Route("/admin/api/event", name="api_event_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $events = $this->get("api_inventory.bo.event")->selectAll();
        return $events;
    }

    /**
     *
     * @Route("/admin/api/event/detail/{id}", name="api_event_detail")
     * @Rest\View
     */
    public function eventDetailAction($id)
    {
        $event = $this->get("api_inventory.bo.event")->selectById($id);
        return $event;
    }



    /**
    *
    * @Route("/admin/api/event/create", name="api_event_new_save")
    * @Method({"POST"})
    */
   public function eventNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(EventType::class, new Event());
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $event = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($event, 'json'));

           $this->get("api_inventory.bo.event")->create($event);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $event->getId()),
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
     * @Route("/admin/api/form/event/create", name="api_form_event_new_save")
     * @Method({"POST"})
     */
    public function beatFormNewSaveAction(Request $request)
    {
        $statusCode = 201;
        $this->get('logger')->info($request);
        $form = $this->createForm(EventType::class, new Event());
        $form->handleRequest($request);

        $this->get('logger')->info('Here we go.' . $this->serializer->serialize($form->getData(), 'json'));

        if ($form->isValid()) {
            $event = $form->getData();
            // $event->setIdUser(1);
            $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($event, 'json'));

            $this->get("api_inventory.bo.event")->create($event);


            $response = new Response();
            $response->setStatusCode($statusCode);

            return $response;
        }
        $this->get('logger')->info('NOT CORRECT: ' . $this->serializer->serialize($form->getErrors(), 'json'));
        return View::create($form, 400);
    }
    
        /**
        *
        * @Route("/admin/api/event/delete/{id}", name="api_event_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function eventDeleteAction(Event $event)
       {
           $this->get("api_inventory.bo.event")->remove($event);
       }


/**
    *
    * @Route("/admin/api/event/update", name="api_event_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function eventUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(EventType::class, new Event(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $event = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($event, 'json'));

           $this->get("api_inventory.bo.event")->update($event);


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
//     * @Route("/admin/api/event/update", name="api_event_update_save")
//     * Method({"PUT"})
//     */
//    public function eventUpdateSaveAction(Event $event)
//    {
//       $form = $this->createForm(EventType::class, new Event());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $event = $form->getData();
//
//            $this->get("api_inventory.bo.event")->update($event);
//            //$response =  $this->forward('apiInventoryBundle:Event:detail.html.twig', array('event' => $event));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:Event:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/event/delete/{id}", name="api_event_delete")
//     */
//    public function eventDeleteAction($id)
//    {
//        $event = $this->get("api_inventory.bo.event")->selectById($id);
//        return $this->render('apiInventoryBundle:Event:delete.html.twig',array("event"=>$event));
//    }
//
//
}
