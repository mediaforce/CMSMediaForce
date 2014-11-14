<?php

namespace CmsMediaForce\Service;

use CmsBase\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class Corretor extends AbstractService
{

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "CmsMediaForce\Entity\Corretor";
    }
    
    public function insert(array $data)
    {
        $entity = new $this->entity();

        $entity->setNome($data['nome'])
            ->setArea($data['area']['nome'])
            ->setCargo($data['cargo']['nome'])
            ->setEmail($data['email']);

        if (isset($data['enderecoFoto'])) {
            $entity->setEnderecoFoto( '/' . $data['enderecoFoto']);
        }

       foreach($data['telefones'] as $telefone) {
            if ( is_array($telefone) && !empty($telefone['num']) ) {
                $telEntity = new \CmsMediaForce\Entity\Telefone();
                $telEntity->setNumero($telefone['num']);

                if ( !empty( $telefone['tipo'] ) ) {
                    $telEntity->setTipo($telefone['tipo']);
                } else {
                    $telEntity->setTipo('telefone');
                }

                $this->em->persist($telEntity);

                $entity->addTelefone($telEntity);
            }            
        }

        $this->em->persist($entity);
        $this->em->flush();
        
        return $entity;
    }
    
    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        
        $entity->setNome($data['nome'])
            ->setArea($data['area']['nome'])
            ->setCargo($data['cargo']['nome'])
            ->setEmail($data['email'])
            ->removeAllTelefones();

        if (isset($data['enderecoFoto'])) {
            $entity->setEnderecoFoto( '/' . $data['enderecoFoto']);
        }

       foreach($data['telefones'] as $telefone) {
            if ( is_array($telefone) && !empty($telefone['num']) ) {
                $telEntity = new \CmsMediaForce\Entity\Telefone();
                $telEntity->setNumero($telefone['num']);

                if ( !empty( $telefone['tipo'] ) ) {
                    $telEntity->setTipo($telefone['tipo']);
                } else {
                    $telEntity->setTipo('telefone');
                }

                $this->em->persist($telEntity);

                $entity->addTelefone($telEntity);
            }            
        }

        $this->em->persist($entity);
        $this->em->flush();
        
        return $entity;
    }
}
