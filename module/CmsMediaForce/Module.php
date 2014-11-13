<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CmsMediaForce;

use Zend\Mvc\MvcEvent;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use CmsMediaForce\Auth\Adapter as AuthAdapter;

use Zend\ModuleManager\ModuleManager;

class Module
{
    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        
        $sharedEvents->attach("Zend\Mvc\Controller\AbstractActionController", 
                MvcEvent::EVENT_DISPATCH,
                array($this,'validaAuth'),100);
    }

    public function validaAuth($e)
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('CmsUser'));

        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

        $isAdmin = false;

        if (strpos($matchedRoute,'admin') !== false) {
            $isAdmin = true;
        }

        // var_dump($auth->hasIdentity()); die;

        if( !$auth->hasIdentity() and $isAdmin )
            return $controller->redirect()->toRoute("cms-auth");
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        
        return array(
          'factories' => array(
              'CmsBase\Mail\Transport' => function($sm) {
                $config = $sm->get('Config');
                
                $transport = new SmtpTransport;
                $options = new SmtpOptions($config['mail']);
                $transport->setOptions($options);
                
                return $transport;
              },

              'CmsMediaForce\Service\User' => function ($sm) {
                  return new Service\User($sm->get('Doctrine\ORM\EntityManager'),
                                          $sm->get('CmsBase\Mail\Transport'),
                                          $sm->get('View'));
              },

              'CmsMediaForce\Service\Corretor' => function ($sm) {
                  return new Service\Corretor( $sm->get('Doctrine\ORM\EntityManager') );
              },

              'CmsMediaForce\Form\Role' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repo = $em->getRepository('CmsMediaForce\Entity\Role');
                $parent = $repo->fetchParent();
                
                return new Form\Role('role',$parent);
              },

              'CmsMediaForce\Form\Post' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repo = $em->getRepository('CmsMediaForce\Entity\Categoria');
                $categoria = $repo->fetchCategoriasPost();
                
                return new Form\Post('post',$categoria);
              },

              'CmsMediaForce\Form\ArquivoTexto' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repo = $em->getRepository('CmsMediaForce\Entity\Categoria');
                $categoria = $repo->fetchCategoriasFile();
                
                return new Form\ArquivoTexto('post',$categoria);
              },

              'CmsMediaForce\Form\Privilege' => function($sm)
              {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repoRoles = $em->getRepository('CmsMediaForce\Entity\Role');
                $roles = $repoRoles->fetchParent();
                
                $repoResources = $em->getRepository('CmsMediaForce\Entity\Resource');
                $resources = $repoResources->fetchPairs();
                
                return new Form\Privilege("privilege", $roles, $resources);
              },

              'CmsMediaForce\Service\Role' => function($sm){
                return new Service\Role($sm->get('Doctrine\ORM\Entitymanager'));
              },

              'CmsMediaForce\Service\Resource' => function($sm){
                return new Service\Resource($sm->get('Doctrine\ORM\Entitymanager'));
              },

              'CmsMediaForce\Service\Privilege' => function($sm){
                return new Service\Privilege($sm->get('Doctrine\ORM\Entitymanager'));
              },

              'CmsMediaForce\Service\Post' => function($sm){
                return new Service\Post($sm->get('Doctrine\ORM\Entitymanager'));
              },

              'CmsMediaForce\Service\Link' => function($sm){
                return new Service\Link($sm->get('Doctrine\ORM\Entitymanager'));
              },

              'CmsMediaForce\Service\ArquivoTexto' => function($sm){
                return new Service\ArquivoTexto($sm->get('Doctrine\ORM\Entitymanager'));
              },

              'CmsMediaForce\Auth\Adapter' => function($sm)
              {
                  return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
              }
          )  
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'UserIdentity' => new View\Helper\UserIdentity()
            )
        );
    }
}
