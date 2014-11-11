<?php 

namespace CmsMediaForce;

return array(
    'router' => array(
        'routes' => array(
            'cms-admin' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                    	'__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'cms-activate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'Index',
                        'action' => 'activate'
                    )
                )
            ),
            'cms-auth' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth',
                    'defaults' => array(
                        '__NAMESPACE__' =>  __NAMESPACE__ . '\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),
            'cms-logout' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' =>  __NAMESPACE__ . '\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),
            'cms-admin-content' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/content',
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'Posts',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' =>  __NAMESPACE__ . '\Controller',
                                'controller' => 'Posts'
                            )
                        )
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/page/:page]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' =>  __NAMESPACE__ . '\Controller',
                                'controller' => 'Posts'
                            )
                        )
                    )
                )
            ),
            'cms-admin-access' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/access',
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'Users',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' =>  __NAMESPACE__ . '\Controller',
                                'controller' => 'Users'
                            )
                        )
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/page/:page]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' =>  __NAMESPACE__ . '\Controller',
                                'controller' => 'Users'
                            )
                        )
                    )
                )
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            __NAMESPACE__ . '\Controller\Index' => __NAMESPACE__ .  '\Controller\IndexController',
            __NAMESPACE__ . '\Controller\Users' => __NAMESPACE__ .  '\Controller\UsersController',
            __NAMESPACE__ . '\Controller\Auth' => __NAMESPACE__ .  '\Controller\AuthController',
            __NAMESPACE__ . '\Controller\Posts' => __NAMESPACE__ .  '\Controller\PostsController',
            __NAMESPACE__ . '\Controller\ArquivosTexto' => __NAMESPACE__ .  '\Controller\ArquivosTextoController',
            __NAMESPACE__ . '\Controller\Links' => __NAMESPACE__ .  '\Controller\LinksController',
            __NAMESPACE__ . '\Controller\Corretores' => __NAMESPACE__ .  '\Controller\CorretoresController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    
    'data-fixture' => array(
        'CmsCategoria_fixture' => __DIR__ . '/../src/CmsMediaForce/Fixture',
    ),
);