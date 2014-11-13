<?php 

namespace CmsRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Zend\File\Transfer\Adapter\Http as Zend_File_Transfer_Adapter_Http;

class CorretoresRestController extends AbstractRestfulController {

	public function getList()
    {

        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repo = $em->getRepository("CmsMediaForce\Entity\Corretor");
        
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
        $result = false;

        if (isset($data['foto']) && !empty($data['foto'])) {
            $result = $this->saveImage($data['foto'], $data['email']);
            $data['enderecoFoto'] = $result ;
        }
        $erro = "";

        try {
            $corretorService = $this->getServiceLocator()->get('CmsMediaForce\Service\Corretor');

            if ($data) {
                $corretor = $corretorService->insert($data);

                if ($corretor) {
                    return new JsonModel(array('data'=>array('id'=>$corretor->getId(),'success'=>true, 'data' => $data )));
                } else {
                    return new JsonModel(array('data'=>array('success'=>false, 'data' => $data )));
                }
            
            } else {
                return new JsonModel(array('data'=>array('success'=>false, 'data' => $data )));
            }
        } catch (\Exception $e) {
            $erro = "deu erro";
        }
        return new JsonModel(array('data'=>array('success'=>false, 'data' => $data )));
    }
    
    private function saveImage($base64img, $nome){
        try {
            chdir('public');
            define('UPLOAD_DIR', 'img/corretores/');
            $base64img = str_replace('data:image/jpeg;base64,', '', $base64img);
            $data = base64_decode($base64img);
            $file = UPLOAD_DIR . $nome . '.jpg';
            file_put_contents($file, $data);
            return $file;
        }catch (\Exception $e) {
            return "error";
        }
       
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