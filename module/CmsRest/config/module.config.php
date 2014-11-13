<?php 

namespace CmsRest;

return array(
    'controllers' => array(
        'invokables' => array(
            __NAMESPACE__ . '\Controller\CorretoresRest' => __NAMESPACE__ .  '\Controller\CorretoresRestController',
            __NAMESPACE__ . '\Controller\EmailRest' => __NAMESPACE__ .  '\Controller\EmailRestController',
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
            'corretores-email' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/checkemail[/:email]',
                    'constraints' => array(
                        'email' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'EmailRest'
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