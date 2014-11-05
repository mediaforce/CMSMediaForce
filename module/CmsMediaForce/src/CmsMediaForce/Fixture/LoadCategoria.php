<?php

namespace CmsMediaForce\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use CmsMediaForce\Entity\Categoria;

class LoadCategoria extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $catArray = array(
            'FAQ',
            'Glossário',
            'Notificações',
            'Circulares Legias',
            'Serviços',
            'Produtos'
        );

        foreach ($catArray as $cat) {
            $categoria = new Categoria;
            $categoria->setNome($cat);
            $manager->persist($categoria);
            
        }
        
        $categoria = new Categoria;
            $categoria->setNome('Formulários')
                ->setIsFile(true);
    
            $manager->persist($categoria);    

        $manager->flush();  
    }

    public function getOrder() {
        return 1;
    }
}
