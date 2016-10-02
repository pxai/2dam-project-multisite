<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/")defaults={"_format"="json"}
     */
    public function indexAction()
    {
        return $this->render('ApiBundle:Default:index.html.twig');
    }
}
