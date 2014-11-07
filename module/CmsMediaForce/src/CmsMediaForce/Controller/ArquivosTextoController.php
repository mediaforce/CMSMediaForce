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
        $this->route = "cms-admin-content";
    }

    public function newAction()
    {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            echo '<div style="padding: 220px;">';

            
            $postArr = $request->getPost()->toArray();
            var_dump($request->getFiles());
            $categoria = $this->getEm()->getRepository('CmsMediaForce\Entity\Categoria', intval($postArr['categoria']) );
            
            var_dump($categoria->getNome());

            $folder = \CmsBase\Helper\SlugHelper::slug($categoria->getNome());
            echo "   CATEGORIA CATEGORIA CATEGORIA    =  ", $folder;

            $imageAdapter = new Zend_File_Transfer_Adapter_Http();
            $imageAdapter->setDestination('public\img');


            echo "</div>";
            die;

            $form->setData($request->getPost());

            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
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
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }
}