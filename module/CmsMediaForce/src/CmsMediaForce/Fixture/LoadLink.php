<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use CmsMediaForce\Entity\Link;

class LoadLink extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $link = new Link;       

        $link->setDescricao('Buscador Google')
            ->setHref('https://www.google.com.br/');
                
        $manager->persist($link);       
        
        $manager->flush();
        
    }

    public function getOrder() {
        return 1;
    }
}
