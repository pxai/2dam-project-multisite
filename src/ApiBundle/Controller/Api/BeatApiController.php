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

use ApiBundle\Form\Type\BeatType;
use ApiBundle\Entity\Beat;

class BeatApiController extends Controller
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
     * @Route("/admin/api/beat", name="api_beat_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $beats = $this->get("api_inventory.bo.beat")->selectAll();
        return $beats;
    }

    /**
     *
     * @Route("/admin/api/beat/detail/{id}", name="api_beat_detail")
     * @Rest\View
     */
    public function beatDetailAction($id)
    {
        $beat = $this->get("api_inventory.bo.beat")->selectById($id);
        return $beat;
    }



    /**
    *
    * @Route("/admin/api/beat/create", name="api_beat_new_save")
    * @Method({"POST"})
    */
   public function beatNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(BeatType::class, new Beat());
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $beat = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($beat, 'json'));

           $this->get("api_inventory.bo.beat")->create($beat);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $beat->getId()),
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
        * @Route("/admin/api/beat/delete/{id}", name="api_beat_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function beatDeleteAction(Beat $beat)
       {
           $this->get("api_inventory.bo.beat")->remove($beat);
       }


/**
    *
    * @Route("/admin/api/beat/update", name="api_beat_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function beatUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(BeatType::class, new Beat(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $beat = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($beat, 'json'));

           $this->get("api_inventory.bo.beat")->update($beat);


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
//     * @Route("/admin/api/beat/update", name="api_beat_update_save")
//     * Method({"PUT"})
//     */
//    public function beatUpdateSaveAction(Beat $beat)
//    {
//       $form = $this->createForm(BeatType::class, new Beat());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $beat = $form->getData();
//
//            $this->get("api_inventory.bo.beat")->update($beat);
//            //$response =  $this->forward('apiInventoryBundle:Beat:detail.html.twig', array('beat' => $beat));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:Beat:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/beat/delete/{id}", name="api_beat_delete")
//     */
//    public function beatDeleteAction($id)
//    {
//        $beat = $this->get("api_inventory.bo.beat")->selectById($id);
//        return $this->render('apiInventoryBundle:Beat:delete.html.twig',array("beat"=>$beat));
//    }
//
//
}
