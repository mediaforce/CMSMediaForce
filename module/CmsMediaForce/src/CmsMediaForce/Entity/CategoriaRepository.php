<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends EntityRepository {
    public function fetchCategoriasPost()
    {
        $entities = $this->findAll();
        $array = array();
        
        foreach($entities as $entity)
        {
            if ($entity->isPost()) {
                $array[$entity->getId()] = $entity->getNome();
            }
            
        }
        
        return $array;
    }
    
    public function fetchCategoriasFile()
    {
        $entities = $this->findAll();
        $array = array();
        
        foreach($entities as $entity)
        {
            if ($entity->isFile()) {
                $array[$entity->getId()] = $entity->getNome();
            }
            
        }
        
        return $array;
    }
}
