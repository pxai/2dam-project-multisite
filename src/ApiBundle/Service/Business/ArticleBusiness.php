<?php

namespace ApiBundle\Service\Business;

use ApiBundle\Entity\Article;
use ApiBundle\Service\DAO\ArticleDAO;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ArticleBusiness extends GenericBusiness {

    public function selectLast($id,$total=20) {
        return $this->entityDAO->selectLast($id,$total);
    }

    public function selectUser($id) {
        return $this->entityDAO->selectUser($id);
    }
}
