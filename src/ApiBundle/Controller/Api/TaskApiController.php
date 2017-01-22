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

use ApiBundle\Form\Type\TaskType;
use ApiBundle\Entity\Task;

class TaskApiController extends Controller
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
     * @Route("/admin/api/task/{id_frontend}", name="api_task_index")
     * @Rest\View
     */
    public function indexApiAction($id_frontend=0)
    {
        $tasks = $this->get("api_inventory.bo.task")->selectLast($id_frontend);
        return $tasks;
    }

    /**
     *
     * @Route("/admin/api/task/detail/{id}", name="api_task_detail")
     * @Rest\View
     */
    public function taskDetailAction($id)
    {
        $task = $this->get("api_inventory.bo.task")->selectById($id);
        return $task;
    }
    
    /**
    *
    * @Route("/admin/api/task/create", name="api_task_new_save")
    * @Method({"POST"})
    */
   public function taskNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(TaskType::class, new Task());
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $task = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($task, 'json'));

           $this->get("api_inventory.bo.task")->create($task);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $task->getId()),
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
     * @Route("/admin/api/form/task/create", name="api_form_task_new_save")
     * @Method({"POST"})
     */
    public function taskFormNewSaveAction(Request $request)
    {
        $statusCode = 201;
        $this->get('logger')->info($request);
        $form = $this->createForm(TaskType::class, new Task());
        $form->handleRequest($request);

        $this->get('logger')->info('Here we go.' . $this->serializer->serialize($form->getData(), 'json'));

        if ($form->isValid()) {
            $task = $form->getData();
            $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($task, 'json'));

            $this->get("api_inventory.bo.task")->create($task);


            $response = new Response();
            $response->setStatusCode($statusCode);

            // set the `Location` header only when creating new resources
            /*   if (201 === $statusCode) {
                   $response->headers->set('Location',
                       $this->generateUrl(
                           'acme_demo_user_get', array('id' => $task->getId()),
                           true // absolute
                       )
                   );
               }*/

            return $response;
        }
        $this->get('logger')->info('NOT CORRECT: ' . $this->serializer->serialize($form->getErrors(), 'json'));
        return View::create($form, 400);
    }

        /**
        *
        * @Route("/admin/api/task/delete/{id}", name="api_task_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function taskDeleteAction(Task $task)
       {
           $this->get("api_inventory.bo.task")->remove($task);
       }


/**
    *
    * @Route("/admin/api/task/update", name="api_task_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function taskUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(TaskType::class, new Task(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $task = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($task, 'json'));

           $this->get("api_inventory.bo.task")->update($task);


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
//     * @Route("/admin/api/task/update", name="api_task_update_save")
//     * Method({"PUT"})
//     */
//    public function taskUpdateSaveAction(Task $task)
//    {
//       $form = $this->createForm(TaskType::class, new Task());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $task = $form->getData();
//
//            $this->get("api_inventory.bo.task")->update($task);
//            //$response =  $this->forward('apiInventoryBundle:Task:detail.html.twig', array('task' => $task));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:Task:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/task/delete/{id}", name="api_task_delete")
//     */
//    public function taskDeleteAction($id)
//    {
//        $task = $this->get("api_inventory.bo.task")->selectById($id);
//        return $this->render('apiInventoryBundle:Task:delete.html.twig',array("task"=>$task));
//    }
//
//
}
