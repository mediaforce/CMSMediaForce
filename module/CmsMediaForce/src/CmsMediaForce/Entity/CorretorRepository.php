<?php

namespace CmsMediaForce\Entity;

use Doctrine\ORM\EntityRepository;

class CorretorRepository extends EntityRepository {
	public function findArray()
    {
        $corretores = $this->findAll();
        $a = array();
        foreach($corretores as $corretor)
        {
            $a[$corretor->getId()]['id'] 			= $corretor->getId();
            $a[$corretor->getId()]['nome'] 			= $corretor->getNome();
            $a[$corretor->getId()]['area'] 			= $corretor->getArea();
            $a[$corretor->getId()]['cargo'] 		= $corretor->getCargo();
            $a[$corretor->getId()]['email'] 		= $corretor->getEmail();
            $a[$corretor->getId()]['enderecoFoto'] 	= $corretor->getEnderecoFoto();

            $strTelefone = "";
            foreach($corretor->getTelefones() as $telefone) {
            	$strTelefone .= $telefone->getNumero() . '  ';
            	$a[$corretor->getId()]['telefones'] = $strTelefone;
            }
            // $a[$corretor->getId()]['telefones'] 	= $corretor->getHref();
        }
        
        return $a;
    }
}
