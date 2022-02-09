<?php
namespace Auth;

return array(
    'router' => require 'router.php',
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Auth\Controller\Auth'    => 'Auth\Controller\AuthController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/auth' => __DIR__ . '/../view/layout/layout.phtml',
        ),
    ),    
    'doctrine' => array(
        'driver'=> array(
            __NAMESPACE__.'_driver'=> array(
                'class'=> 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache'=> 'array',
                'paths'=> array(__DIR__.'/../src/'.__NAMESPACE__.'/Entity')
            ),
            'orm_default'=> array(
                'drivers'=>array(
                    __NAMESPACE__.'\Entity'=> __NAMESPACE__.'_driver'
                ),
            ),
        ),
    )
);
