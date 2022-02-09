<?php
return array(
    'routes' => array(
        'login' => array(
            'type'    => 'Literal',
            'options' => array(
                'route'    => '/login',
                'defaults' => array(
                    '__NAMESPACE__' => 'Auth\Controller',
                    'controller'    => 'Auth',
                    'action'        => 'login',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'authenticate' => array(
                    'type'    => 'Literal',
                    'options' => array(
                        'route'    => '/authenticate',
                        'defaults' => array(
                            'action' => 'authenticate'
                        ),
                    ),
                ),

                'logout' => array(
                    'type'    => 'Literal',
                    'options' => array(
                        'route'    => '/logout',
                        'defaults' => array(
                            'action' => 'logout'
                        ),
                    ),
                ),
            ),
        )
    )
);