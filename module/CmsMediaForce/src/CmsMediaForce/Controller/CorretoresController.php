<?php 

namespace CmsMediaForce\Controller;

use CmsBase\Controller\CrudController;

use Zend\View\Model\ViewModel;

class CorretoresController extends CrudController {

    public function __construct() 
    {
        $this->entity = "CmsMediaForce\Entity\Corretor";
        $this->form = "CmsMediaForce\Form\Corretor";
        $this->service = "CmsMediaForce\Service\Corretor";
        $this->controller = "corretores";
        $this->route = "cms-admin-content/default";
    }

}