<?php 

namespace CmsRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Zend\File\Transfer\Adapter\Http as Zend_File_Transfer_Adapter_Http;

class EmailRestController extends AbstractRestfulController {

	public function getList()
    {

        return new JsonModel(array( 'data' => 'teste'));
        
    }
    
    // Retornar o registro especifico - GET
    public function get($email)
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repo = $em->getRepository("CmsMediaForce\Entity\Link");
        
        //$data = $repo->find($id)->toArray();
        
        return new JsonModel(array('data'=> array('isUnique' => false)));
        
    }
    
    // Insere registro - POST
    public function create($data)
    {   
        $isUnique = false;

        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repo = $em->getRepository("CmsMediaForce\Entity\Corretor");
        $corretor = null;
        if (isset($data['id']) && !is_null($data['id']) && !empty($data['id'])) {
            $corretor = $repo->find(intval($data['id']));
        }

        if (isset($data['email']) && !is_null($data['email']) && !empty($data['email'])) {
            if (!is_null($corretor)) {

            } else {
               $corretor = $repo->findOneByEmail($data['email']);

               if (is_null($corretor)) {
                    $isUnique = true;
               }

            }
        }
        return new JsonModel(array('isUnique' => $isUnique));
    }
    
    // alteracao - PUT
    public function update($id, $data)
    {
        return null;
    }
    
    // delete - DELETE
    public function delete($id)
    {
        return null;
    }
}