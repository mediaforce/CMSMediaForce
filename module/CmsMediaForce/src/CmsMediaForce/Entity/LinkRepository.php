<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\EntityRepository;

class LinkRepository extends EntityRepository {
	public function findArray()
    {
        $links = $this->findAll();
        $a = array();
        foreach($links as $link)
        {
            $a[$link->getId()]['id'] = $link->getId();
            $a[$link->getId()]['descricao'] = $link->getDescricao();
            $a[$link->getId()]['href'] = $link->getHref();
        }
        
        return $a;
    }
}
