<?php 

namespace CmsRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

use Zend\File\Transfer\Adapter\Http as Zend_File_Transfer_Adapter_Http;

class UploadRestController extends AbstractRestfulController {
	public function getList()
    {

        return new JsonModel(array('data'=>'getList'));
        
    }
    
    // Retornar o registro especifico - GET
    public function get($id)
    {
        return new JsonModel(array('data'=>'get'));
        
    }
    
    // Insere registro - POST
    public function create($data)
    {   
        chdir('public');

        $request = $this->getRequest();
        $baseFile = 'files';

        $imageAdapter = new Zend_File_Transfer_Adapter_Http();
        $imageAdapter->setDestination($baseFile);

        $file = $request->getFiles()->toArray()['userImage'];

        $isUpload = false;

        if(is_uploaded_file($file['tmp_name'])) {

            if (!$imageAdapter->receive('userImage')){

                $messages = $imageAdapter->getMessages['userImage'];

                //A Imagem Não Foi Recebida Corretamente
            }else{

                $filename = $imageAdapter->getFileName('userImage');

                $html = "<img src='/" . str_replace('\\', '/', $filename) ."'>";
            }
        }


        return new JsonModel(array('tipo'=>'POST DATA', 'html' => $html));
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