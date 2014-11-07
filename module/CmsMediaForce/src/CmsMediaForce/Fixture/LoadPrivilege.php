<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use CmsMediaForce\Entity\Privilege;

class LoadPrivilege extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $role1 = $manager->getReference('CmsMediaForce\Entity\Role',1);
        $resource1 = $manager->getReference('CmsMediaForce\Entity\Resource',1);
        
        $role2 = $manager->getReference('CmsMediaForce\Entity\Role',2);
        $resource2 = $manager->getReference('CmsMediaForce\Entity\Resource',2);
        
        $role3 = $manager->getReference('CmsMediaForce\Entity\Role',3);
        $resource3 = $manager->getReference('CmsMediaForce\Entity\Resource',3);
        
        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                ->setRole($role1)
                ->setResource($resource1);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                ->setRole($role1)
                ->setResource($resource2);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Visualizar")
                ->setRole($role1)
                ->setResource($resource3);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Editar")
                ->setRole($role1)
                ->setResource($resource1);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Editar")
                ->setRole($role1)
                ->setResource($resource2);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Editar")
                ->setRole($role1)
                ->setResource($resource3);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Criar/Excluir")
                ->setRole($role1)
                ->setResource($resource1);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Criar/Excluir")
                ->setRole($role1)
                ->setResource($resource2);        
        $manager->persist($privilege);

        $privilege = new Privilege;
        $privilege->setNome("Criar/Excluir")
                ->setRole($role1)
                ->setResource($resource3);        
        $manager->persist($privilege);
        
        $manager->flush();  
        
    }

    public function getOrder() {
        return 3;
    }
}
