<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use CmsMediaForce\Entity\Resource;

class LoadResource extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        
        $resource = new Resource;
        $resource->setNome("postagens");
                
        $manager->persist($resource);
        
        $resource = new Resource;
        $resource->setNome("usuarios");
                
        $manager->persist($resource);

        $resource = new Resource;
        $resource->setNome("acl");
                
        $manager->persist($resource);        
        
        $manager->flush();
        
    }

    public function getOrder() {
        return 2;
    }
}
