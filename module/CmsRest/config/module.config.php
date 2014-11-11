<?php 

namespace CmsRest;

return array(
    'controllers' => array(
        'invokables' => array(
            __NAMESPACE__ . '\Controller\CorretoresRest' => __NAMESPACE__ .  '\Controller\CorretoresRestController',
        )
    ),
    'router' => array(
        'routes' => array(
            'upload-images-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/upload/images[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'UploadRest'
                    )
                )
            ),
            'corretores-rest' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/corretores[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'CorretoresRest'
                    )
                )
            ),
        )
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
);