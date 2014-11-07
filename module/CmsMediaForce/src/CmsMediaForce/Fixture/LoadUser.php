<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CmsMediaForce\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $visitante = $manager->getReference('CmsMediaForce\Entity\Role',1);
        $corretor = $manager->getReference('CmsMediaForce\Entity\Role',2);

        $admin = $manager->getReference('CmsMediaForce\Entity\Role',3);

        $user = new User;

        $user->setNome("Ciclano Visitante")
                ->setEmail("ciclano@teste.com")
                ->setPassword("ciclano")
                ->setRole($visitante);

        $manager->persist($user);  
        
        $user = new User;

        $user->setNome("Fulano Corretor")
                ->setEmail("fulano@teste.com")
                ->setPassword("fulano123")
                ->setRole($corretor);

        $manager->persist($user);

        $user->setNome("Beltrano Corretor")
                ->setEmail("beltrano@teste.com")
                ->setPassword("beltrano123")
                ->setRole($corretor);

        $manager->persist($user);


        $user = new User;

        $user->setNome("Arthur Admin")
                ->setEmail("arthur@teste.com")
                ->setPassword("arthur123")
                ->setRole($admin);

        $manager->persist($user);       
        
        $manager->flush();
        
    }

    public function getOrder() {
        return 2;
    }
}
