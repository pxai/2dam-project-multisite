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

use ApiBundle\Form\Type\ArticleType;
use ApiBundle\Entity\Article;

class ArticleApiController extends Controller
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
     * @Route("/admin/api/article", name="api_article_index")
     * @Rest\View
     */
    public function indexApiAction()
    {
        $articles = $this->get("api_inventory.bo.article")->selectAll();
        return $articles;
    }

    /**
     * @Route("/admin/api/article/last/{id}", name="api_article_last", defaults={"id":0})
     * @Rest\View
     */
    public function lastArticleAction($id)
    {
        $articles = $this->get("api_inventory.bo.article")->selectLast($id);
        return $articles;
    }
    /**
     *
     * @Route("/admin/api/article/detail/{id}", name="api_article_detail")
     * @Rest\View
     */
    public function articleDetailAction($id)
    {
        $article = $this->get("api_inventory.bo.article")->selectById($id);
        return $article;
    }



    /**
    *
    * @Route("/admin/api/article/create", name="api_article_new_save")
    * @Method({"POST"})
    */
   public function articleNewSaveAction(Request $request)
   {
     $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(ArticleType::class, new Article());
     $form->handleRequest($request);

       $article = $form->getData();
     $this->get('logger')->info('Here we go.');

       if ($form->isValid()) {
           $article = $form->getData();
           //$this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($article, 'json'));
           $this->get('logger')->info('ITS CORRECT: ' . $request->getUser());

           $this->get("api_inventory.bo.article")->create($article);


           $response = new Response();
           $response->setStatusCode($statusCode);

           // set the `Location` header only when creating new resources
        /*   if (201 === $statusCode) {
               $response->headers->set('Location',
                   $this->generateUrl(
                       'acme_demo_user_get', array('id' => $article->getId()),
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
        * @Route("/admin/api/article/delete/{id}", name="api_article_delete")
        * @Method({"DELETE"})
        * @Rest\View(statusCode=204)
        */
       public function articleDeleteAction(Article $article)
       {
           $this->get("api_inventory.bo.article")->remove($article);
       }


/**
    *
    * @Route("/admin/api/article/update", name="api_article_update_save")
    * @Method({"PUT"})
    * @Rest\View(statusCode=204)
    */
   public function articleUpdateSaveAction(Request $request)
   {
      $statusCode = 201;
        $this->get('logger')->info($request);
     $form = $this->createForm(ArticleType::class, new Article(),array('method' => 'PUT'));
     $form->handleRequest($request);

     $this->get('logger')->info('Here we go with update.');

       if ($form->isValid()) {
           $article = $form->getData();
           $this->get('logger')->info('ITS CORRECT: ' . $this->serializer->serialize($article, 'json'));

           $this->get("api_inventory.bo.article")->update($article);


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
//     * @Route("/admin/api/article/update", name="api_article_update_save")
//     * Method({"PUT"})
//     */
//    public function articleUpdateSaveAction(Article $article)
//    {
//       $form = $this->createForm(ArticleType::class, new Article());
//       $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $article = $form->getData();
//
//            $this->get("api_inventory.bo.article")->update($article);
//            //$response =  $this->forward('apiInventoryBundle:Article:detail.html.twig', array('article' => $article));
//            return $this->indexAction();
//        } else {
//
//            $response = $this->render('apiInventoryBundle:Article:update.html.twig', array('form'=> $form->createView()));
//        }
//        return $response;
//
//    }
//
//    /**
//     *
//     * @Route("/admin/api/article/delete/{id}", name="api_article_delete")
//     */
//    public function articleDeleteAction($id)
//    {
//        $article = $this->get("api_inventory.bo.article")->selectById($id);
//        return $this->render('apiInventoryBundle:Article:delete.html.twig',array("article"=>$article));
//    }
//
//
}
