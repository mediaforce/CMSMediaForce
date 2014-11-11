<?php

namespace CmsMediaForce\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

use CmsBase\Service\AbstractService,
    CmsBase\Helper\SlugHelper;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use CmsMediaForce\Entity\DadosCadConteudo;

class Post extends AbstractService
{

    public function __construct(EntityManager $em) 
    {
        parent::__construct($em);
        
        $this->entity = "CmsMediaForce\Entity\Post";
    }
    
    public function insert(array $data) {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('CmsUser'));


        if ( $auth->hasIdentity() ) {
            $entity = new $this->entity;

            $categoria = $this->em->getReference('CmsMediaForce\Entity\Categoria', intval($data['categoria']));
            $usuario = $this->em->getReference('CmsMediaForce\Entity\User', intval($auth->getIdentity()->getId()));

            $entity->setTitulo(ucwords($data['titulo']))
                ->setConteudo($data['conteudo']);

            $dadosCad = new DadosCadConteudo;

            $dadosCad->setSlug(SlugHelper::slug($entity->getTitulo()))
                ->setCategoria($categoria)
                ->setCriadoPor($usuario);

            if ($data['expirar'] == 'sim') {
                $data['expiresAt'] = \DateTime::createFromFormat('Y-m-d', $data['expiresAt']);
                $dadosCad->setIsExpired(true)
                    ->setExpiresAt($data['expiresAt']);
            } else {
                $data['expiresAt'] = new \DateTime("now");
            }

            $this->em->persist($dadosCad);

            $entity->setDadosCad($dadosCad);

            $this->em->persist($entity);
            $this->em->flush();

            return $entity;
        }

        return false;        
    }
    
    public function update(array $data)
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('CmsUser'));


        if ( $auth->hasIdentity() ) {

            $entity = $this->em->getReference($this->entity, $data['id']);

            $categoria = $this->em->getReference('CmsMediaForce\Entity\Categoria', intval($data['categoria']));
            $usuario = $this->em->getReference('CmsMediaForce\Entity\User', intval($auth->getIdentity()->getId()));

            $entity->setTitulo(ucwords($data['titulo']))
                ->setConteudo($data['conteudo']);

            $dadosCad = $this->em->getReference('CmsMediaForce\Entity\DadosCadConteudo',$entity->getDadosCad()->getId());

            $dadosCad->setSlug(SlugHelper::slug($entity->getTitulo()))
                ->setCategoria($categoria)
                ->setCriadoPor($usuario);

            if ($data['expirar'] == 'sim') {
                $data['expiresAt'] = \DateTime::createFromFormat('Y-m-d', $data['expiresAt']);
                $dadosCad->setIsExpired(true)
                    ->setExpiresAt($data['expiresAt']);
            } else {
                $data['expiresAt'] = new \DateTime("now");
            }

            $this->em->persist($dadosCad);

            $entity->setDadosCad($dadosCad);

            $this->em->persist($entity);
            $this->em->flush();

            return $entity;
        }

        return false; 
    }
}
