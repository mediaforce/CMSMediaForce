<?php

namespace CmsMediaForce\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

use CmsBase\Service\AbstractService;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

class Link extends AbstractService
{

    public function __construct(EntityManager $em) 
    {
    	$this->entity = "CmsMediaForce\Entity\Link";
        parent::__construct($em);       
        
    }
    
}
