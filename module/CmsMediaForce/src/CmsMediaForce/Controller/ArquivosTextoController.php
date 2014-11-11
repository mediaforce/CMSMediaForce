<?php 

namespace CmsMediaForce\Controller;

use CmsBase\Controller\CrudController;

use Zend\View\Model\ViewModel;

use Zend\File\Transfer\Adapter\Http as Zend_File_Transfer_Adapter_Http;

class ArquivosTextoController extends CrudController {
	public function __construct() 
    {
        $this->entity = "CmsMediaForce\Entity\ArquivoTexto";
        $this->form = "CmsMediaForce\Form\ArquivoTexto";
        $this->service = "CmsMediaForce\Service\ArquivoTexto";
        $this->controller = "arquivostexto";
        $this->route = "cms-admin-content/default";
    }

    public function newAction()
    {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            chdir('public');

            $postArr = $request->getPost()->toArray();
            $file = $request->getFiles()->toArray()['arquivo'];

            $categoria = $this->getEm()->find('CmsMediaForce\Entity\Categoria', intval($postArr['categoria']) );
            
            $baseFile = 'files';
            $folder = $baseFile . '\\' . \CmsBase\Helper\SlugHelper::slug($categoria->getNome());

            if (!is_dir($folder)) {
                mkdir($folder);
            }            

            $imageAdapter = new Zend_File_Transfer_Adapter_Http();
            $imageAdapter->setDestination($folder);

            if(is_uploaded_file($file['tmp_name'])){


                if (!$imageAdapter->receive('arquivo')){

                    $messages = $imageAdapter->getMessages['arquivo'];

                    //A Imagem Não Foi Recebida Corretamente
                }else{

                    $filename = $imageAdapter->getFileName('arquivo');

                    $form->setData($request->getPost());

                    if($form->isValid())
                    {
                        $service = $this->getServiceLocator()->get($this->service);
                        $postArr['filename'] = $filename;

                        $service->insert($postArr);
                        
                        return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
                    }
                }
            } else {
                $form->isValid();
            }          

        }
        
        return new ViewModel(array('form'=>$form));
    }

    public function editAction()
    {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        
        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());
        
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            chdir('public');

            $postArr = $request->getPost()->toArray();
            $file = $request->getFiles()->toArray()['arquivo'];

            $categoria = $this->getEm()->find('CmsMediaForce\Entity\Categoria', intval($postArr['categoria']) );
            
            $baseFile = 'files';
            $folder = $baseFile . '\\' . \CmsBase\Helper\SlugHelper::slug($categoria->getNome());

            if (!is_dir($folder)) {
                mkdir($folder);
            }            

            $imageAdapter = new Zend_File_Transfer_Adapter_Http();
            $imageAdapter->setDestination($folder);

            if(is_uploaded_file($file['tmp_name'])){


                if (!$imageAdapter->receive('arquivo')){

                    $messages = $imageAdapter->getMessages['arquivo'];

                    //A Imagem Não Foi Recebida Corretamente
                }else{

                    $filename = $imageAdapter->getFileName('arquivo');

                    $form->setData($request->getPost());

                    if($form->isValid())
                    {
                        $service = $this->getServiceLocator()->get($this->service);
                        $postArr['filename'] = $filename;

                        $service->update($postArr);
                        
                        return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
                    }
                }
            } else {
                $form->isValid();
            }          

        }
        
        return new ViewModel(array('form'=>$form));
    }
}