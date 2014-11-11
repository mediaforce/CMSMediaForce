<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use CmsMediaForce\Entity\Categoria;

class LoadCategoria extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $catOnlyPost= array(
            'FAQ',
            'Glossário',
        );

        $catOnlyFile = array(
            'Formulários',
        );

        $catBoth = array(
            'Circulares',
            'Notificações',
        );

        $catNone = array(
            'Links',
            'Corretores',
            'Newsletters'
        );

        foreach ($catOnlyPost as $cat) {
            $categoria = new Categoria;
            $categoria->setNome($cat)
                ->setIsPost(true);

            $manager->persist($categoria);
            
        }

        foreach ($catOnlyFile as $cat) {
            $categoria = new Categoria;
            $categoria->setNome($cat)
                ->setIsFile(true);
                
            $manager->persist($categoria);
            
        }

        foreach ($catBoth as $cat) {
            $categoria = new Categoria;
            $categoria->setNome($cat)
                ->setIsFile(true)
                ->setIsPost(true);
                
            $manager->persist($categoria);
            
        }

        foreach ($catNone as $cat) {
            $categoria = new Categoria;
            $categoria->setNome($cat);

            $manager->persist($categoria);
            
        }

        $manager->flush();  
    }

    public function getOrder() {
        return 1;
    }
}
