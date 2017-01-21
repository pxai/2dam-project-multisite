<?php

namespace ApiBundle\Service\Business;

use ApiBundle\Entity\Task;
use ApiBundle\Service\DAO\TaskDAO;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class TaskBusiness extends GenericBusiness {
    
    
   public function selectLast($id) {
        return $this->entityDAO->selectLast($id);
   }
}
