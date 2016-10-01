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

use ApiBundle\Form\Type\ClassType;
use ApiBundle\Entity\AClass;

class ClassApiController extends Controller
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
     * @Route("/admin/api/class", name="api_class_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $classes = $this->get("api_inventory.bo.class")->selectAll();
        return $classes;
    }

    /**
     *
     * @Route("/admin/api/class/detail/{id}", name="api_class_detail")
     * @Rest\View
     */
    public function classDetailAction($id)
    {
        $class = $this->get("api_inventory.bo.class")->selectById($id);
        return $class;
    }



    /**
    *
    * @Route("/admin/api/class/create", name="api_class_new_save")
    * @Method({"POST"})
    */
   public function classNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(ClassType::AClass, new AClass());
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $class = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($class, 'json'));

           $this->get("api_inventory.bo.class")->create($class);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $class->getId()),
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
        * @Route("/admin/api/class/delete/{id}", name="api_class_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function classDeleteAction(AClass $class)
       {
           $this->get("api_inventory.bo.class")->remove($class);
       }


/**
    *
    * @Route("/admin/api/class/update", name="api_class_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function classUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(ClassType::AClass, new AClass(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $class = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($class, 'json'));

           $this->get("api_inventory.bo.class")->update($class);


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
//     * @Route("/admin/api/class/update", name="api_class_update_save")
//     * Method({"PUT"})
//     */
//    public function classUpdateSaveAction(class $class)
//    {
//       $form = $this->createForm(classType::class, new class());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $class = $form->getData();
//
//            $this->get("api_inventory.bo.class")->update($class);
//            //$response =  $this->forward('apiInventoryBundle:class:detail.html.twig', array('class' => $class));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:class:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/class/delete/{id}", name="api_class_delete")
//     */
//    public function classDeleteAction($id)
//    {
//        $class = $this->get("api_inventory.bo.class")->selectById($id);
//        return $this->render('apiInventoryBundle:class:delete.html.twig',array("class"=>$class));
//    }
//
//
}
