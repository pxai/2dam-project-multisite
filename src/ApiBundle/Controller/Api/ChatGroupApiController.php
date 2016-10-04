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

use ApiBundle\Form\Type\ChatGroupType;
use ApiBundle\Entity\ChatGroup;

class ChatGroupApiController extends Controller
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
     * @Route("/admin/api/chatgroup", name="api_chatgroup_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $chatgroups = $this->get("api_inventory.bo.chatgroup")->selectAll();
        return $chatgroups;
    }

    /**
     *
     * @Route("/admin/api/chatgroup/detail/{id}", name="api_chatgroup_detail")
     * @Rest\View
     */
    public function chatgroupDetailAction($id)
    {
        $chatgroup = $this->get("api_inventory.bo.chatgroup")->selectById($id);
        return $chatgroup;
    }



    /**
    *
    * @Route("/admin/api/chatgroup/create", name="api_chatgroup_new_save")
    * @Method({"POST"})
    */
   public function chatgroupNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(ChatGroupType::class, new ChatGroup());
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $chatgroup = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($chatgroup, 'json'));

           $this->get("api_inventory.bo.chatgroup")->create($chatgroup);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $chatgroup->getId()),
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
        * @Route("/admin/api/chatgroup/delete/{id}", name="api_chatgroup_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function chatgroupDeleteAction(ChatGroup $chatgroup)
       {
           $this->get("api_inventory.bo.chatgroup")->remove($chatgroup);
       }


/**
    *
    * @Route("/admin/api/chatgroup/update", name="api_chatgroup_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function chatgroupUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(ChatGroupType::class, new ChatGroup(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $chatgroup = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($chatgroup, 'json'));

           $this->get("api_inventory.bo.chatgroup")->update($chatgroup);


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
//     * @Route("/admin/api/chatgroup/update", name="api_chatgroup_update_save")
//     * Method({"PUT"})
//     */
//    public function chatgroupUpdateSaveAction(ChatGroup $chatgroup)
//    {
//       $form = $this->createForm(ChatGroupType::class, new ChatGroup());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $chatgroup = $form->getData();
//
//            $this->get("api_inventory.bo.chatgroup")->update($chatgroup);
//            //$response =  $this->forward('apiInventoryBundle:ChatGroup:detail.html.twig', array('chatgroup' => $chatgroup));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:ChatGroup:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/chatgroup/delete/{id}", name="api_chatgroup_delete")
//     */
//    public function chatgroupDeleteAction($id)
//    {
//        $chatgroup = $this->get("api_inventory.bo.chatgroup")->selectById($id);
//        return $this->render('apiInventoryBundle:ChatGroup:delete.html.twig',array("chatgroup"=>$chatgroup));
//    }
//
//
}
