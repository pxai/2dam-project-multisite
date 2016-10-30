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

use ApiBundle\Form\Type\MessageType;
use ApiBundle\Entity\Message;

class MessageApiController extends Controller
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
     * @Route("/admin/api/message", name="api_message_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $messages = $this->get("api_inventory.bo.message")->selectAll();
        return $messages;
    }

    /**
     * @Route("/admin/api/message/last/{id}", name="api_message_last", defaults={"id":0})
     * @Rest\View
     */
    public function lastMessageAction($id)
    {
        $messages = $this->get("api_inventory.bo.message")->selectLast($id);
        return $messages;
    }
    /**
     *
     * @Route("/admin/api/message/detail/{id}", name="api_message_detail")
     * @Rest\View
     */
    public function messageDetailAction($id)
    {
        $message = $this->get("api_inventory.bo.message")->selectById($id);
        return $message;
    }



    /**
    *
    * @Route("/admin/api/message/create", name="api_message_new_save")
    * @Method({"POST"})
    */
   public function messageNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(MessageType::class, new Message());
     $form->handleRequest($request);
       $this->get('logger')->info('Almost there');

       $message = $form->getData();
     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $message = $form->getData();
           //$this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($message, 'json'));

           $this->get("api_inventory.bo.message")->create($message);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $message->getId()),
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
        * @Route("/admin/api/message/delete/{id}", name="api_message_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function messageDeleteAction(Message $message)
       {
           $this->get("api_inventory.bo.message")->remove($message);
       }


/**
    *
    * @Route("/admin/api/message/update", name="api_message_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function messageUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(MessageType::class, new Message(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $message = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($message, 'json'));

           $this->get("api_inventory.bo.message")->update($message);


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
//     * @Route("/admin/api/message/update", name="api_message_update_save")
//     * Method({"PUT"})
//     */
//    public function messageUpdateSaveAction(Message $message)
//    {
//       $form = $this->createForm(MessageType::class, new Message());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $message = $form->getData();
//
//            $this->get("api_inventory.bo.message")->update($message);
//            //$response =  $this->forward('apiInventoryBundle:Message:detail.html.twig', array('message' => $message));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:Message:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/message/delete/{id}", name="api_message_delete")
//     */
//    public function messageDeleteAction($id)
//    {
//        $message = $this->get("api_inventory.bo.message")->selectById($id);
//        return $this->render('apiInventoryBundle:Message:delete.html.twig',array("message"=>$message));
//    }
//
//
}
