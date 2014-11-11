<?php 

namespace CmsMediaForce\Controller;

use CmsBase\Controller\CrudController;

use Zend\View\Model\ViewModel;

class LinksController extends CrudController {

    public function __construct() 
    {
        $this->entity = "CmsMediaForce\Entity\Link";
        $this->form = "CmsMediaForce\Form\Link";
        $this->service = "CmsMediaForce\Service\Link";
        $this->controller = "links";
        $this->route = "cms-admin-content/default";
    }

}