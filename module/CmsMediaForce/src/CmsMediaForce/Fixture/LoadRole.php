<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CmsMediaForce\Entity\Role;

class LoadRole extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $manager->getConnection()->query(sprintf('SET FOREIGN_KEY_CHECKS=0'));
        
        $role = new Role;
        $role->setNome("Visitante");
        $manager->persist($role);
        
        
        $visitante = $manager->getReference('CmsMediaForce\Entity\Role',1);
        
        $role = new Role;
        $role->setNome("Corretor")
                ->setParent($visitante);
        $manager->persist($role);

        $role = new Role;
        $role->setNome("Admin")
                ->setIsAdmin(true);
                
        $manager->persist($role);
        
        
        $manager->flush();
        
    }

    public function getOrder() {
        return 1;
    }
}
