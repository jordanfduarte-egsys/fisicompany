<?php
namespace Usuario;

return array(
    'router'=> require "router.php",
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../../' . __NAMESPACE__ . '/view',
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
        )
    ),
    'upload' => array(
        'extensions' => array('jpg','png','gif'),
        'max_upload_size' => 2000000,
        'src' =>  getcwd() . '/public/img/usuario/'
    )
);