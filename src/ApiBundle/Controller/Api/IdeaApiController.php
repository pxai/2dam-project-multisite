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

use ApiBundle\Form\Type\IdeaType;
use ApiBundle\Entity\Idea;

class IdeaApiController extends Controller
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
     * @Route("/admin/api/idea", name="api_idea_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $ideas = $this->get("api_inventory.bo.idea")->selectAll();
        return $ideas;
    }

    /**
     *
     * @Route("/admin/api/idea/detail/{id}", name="api_idea_detail")
     * @Rest\View
     */
    public function ideaDetailAction($id)
    {
        $idea = $this->get("api_inventory.bo.idea")->selectById($id);
        return $idea;
    }



    /**
    *
    * @Route("/admin/api/idea/create", name="api_idea_new_save")
    * @Method({"POST"})
    */
   public function ideaNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(IdeaType::class, new Idea());
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $idea = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($idea, 'json'));

           $this->get("api_inventory.bo.idea")->create($idea);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $idea->getId()),
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
     * @Route("/admin/api/form/idea/create", name="api_form_idea_new_save")
     * @Method({"POST"})
     */
    public function beatFormNewSaveAction(Request $request)
    {
        $statusCode = 201;
        $this->get('logger')->info($request);
        $form = $this->createForm(IdeaType::class, new Idea());
        $form->handleRequest($request);

        $this->get('logger')->info('Here we go.' . $this->serializer->serialize($form->getData(), 'json'));

        if ($form->isValid()) {
            $idea = $form->getData();
            // $event->setIdUser(1);
            $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($idea, 'json'));

            $this->get("api_inventory.bo.event")->create($idea);


            $response = new Response();
            $response->setStatusCode($statusCode);

            return $response;
        }
        $this->get('logger')->info('NOT CORRECT: ' . $this->serializer->serialize($form->getErrors(), 'json'));
        return View::create($form, 400);
    }

        /**
        *
        * @Route("/admin/api/idea/delete/{id}", name="api_idea_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function ideaDeleteAction(Idea $idea)
       {
           $this->get("api_inventory.bo.idea")->remove($idea);
       }


/**
    *
    * @Route("/admin/api/idea/update", name="api_idea_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function ideaUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(IdeaType::class, new Idea(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $idea = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($idea, 'json'));

           $this->get("api_inventory.bo.idea")->update($idea);


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
//     * @Route("/admin/api/idea/update", name="api_idea_update_save")
//     * Method({"PUT"})
//     */
//    public function ideaUpdateSaveAction(Idea $idea)
//    {
//       $form = $this->createForm(IdeaType::class, new Idea());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $idea = $form->getData();
//
//            $this->get("api_inventory.bo.idea")->update($idea);
//            //$response =  $this->forward('apiInventoryBundle:Idea:detail.html.twig', array('idea' => $idea));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:Idea:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/idea/delete/{id}", name="api_idea_delete")
//     */
//    public function ideaDeleteAction($id)
//    {
//        $idea = $this->get("api_inventory.bo.idea")->selectById($id);
//        return $this->render('apiInventoryBundle:Idea:delete.html.twig',array("idea"=>$idea));
//    }
//
//
}
