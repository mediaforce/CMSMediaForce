<?php

namespace CmsMediaForce\Controller;

use Zend\View\Model\ViewModel;

use CmsBase\Controller\CrudController;

class UsersController extends CrudController 
{

    public function __construct() 
    {
        $this->entity = "CmsMediaForce\Entity\User";
        $this->form = "CmsMediaForce\Form\User";
        $this->service = "CmsMediaForce\Service\User";
        $this->controller = "users";
        $this->route = "cms-admin/default";
    }

     public function editAction()
    {
        $form = new $this->form();;
        $request = $this->getRequest();
        
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        
        if($this->params()->fromRoute('id',0))
        {
            $array = $entity->toArray();
            unset($array['password']);
            $form->setData($array);
        }
            
        
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
