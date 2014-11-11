<?php 

namespace CmsRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Zend\File\Transfer\Adapter\Http as Zend_File_Transfer_Adapter_Http;

class CorretoresRestController extends AbstractRestfulController {
	public function getList()
    {

        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repo = $em->getRepository("CmsMediaForce\Entity\Link");
        
        $data = $repo->findArray();

        return new JsonModel(array('data'=>$data));
        
    }
    
    // Retornar o registro especifico - GET
    public function get($id)
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repo = $em->getRepository("CmsMediaForce\Entity\Link");
        
        $data = $repo->find($id)->toArray();
        
        return new JsonModel(array('data'=>$data));
        
    }
    
    // Insere registro - POST
    public function create($data)
    {   
        $linkService = $this->getServiceLocator()->get("CmsMediaForce\Service\Link");
        
        if($data)
        {
            $link = $linkService->insert($data);
            if($link)
            {
                return new JsonModel(array('data'=>array('id'=>$link->getId(),'success'=>true)));
            }
            else
            {
                return new JsonModel(array('data'=>array('success'=>false)));
            }
        }
        else
            return new JsonModel(array('data'=>array('success'=>false)));
    }
    
    // alteracao - PUT
    public function update($id, $data)
    {
        return new JsonModel(array('data'=>'update'));
    }
    
    // delete - DELETE
    public function delete($id)
    {
        return new JsonModel(array('data'=>'delete'));
    }
}