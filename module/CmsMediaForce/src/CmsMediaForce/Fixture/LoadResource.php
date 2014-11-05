<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use CmsMediaForce\Entity\Resource;

class LoadResource extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $resource = new Resource;
        $resource->setNome("Formulários");
                
        $manager->persist($resource);
        
        $resource = new Resource;
        $resource->setNome("Notificações");
                
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("Circulares");
                
        $manager->persist($resource);        
        
        $manager->flush();
        
    }

    public function getOrder() {
        return 2;
    }
}
