<?php
return array(
    'routes' => array(
        'usuarios' => array(
            'type'    => 'Literal',
            'options' => array(
                'route'    => '/usuarios',
                'defaults' => array(
                    '__NAMESPACE__' => 'Usuario\Controller',
                    'controller'    => 'Usuario',
                    'action'        => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'cadastrar' => array(
                    'type'    => 'Literal',
                    'options' => array(
                        'route'    => '/cadastrar',
                        'defaults' => array(
                            'action' => 'cadastrar'
                        ),
                    ),
                ),
                'editar' => array(
                    'type'    => 'Segment',
                    'options' => array(
                        'route'    => '/editar/:id',
                        'constraints' => array(
                            'id'     => '[0-9]+',
                        ),
                        'defaults' => array(
                            'action'     => 'editar',
                        ),
                    ),
                ),
                'desativar' => array(
                    'type'    => 'Segment',
                    'options' => array(
                        'route'    => '/desativar/:id',
                        'constraints' => array(
                            'id'     => '[0-9]+',
                        ),
                        'defaults' => array(
                            'action'     => 'desativar',
                        ),
                    ),
                ),
                'ativacao' => array(
                    'type'    => 'Segment',
                    'options' => array(
                        'route'    => '/ativacao/:key',
                        'constraints' => array(
                            'key'     => '[0-9][a-z A-Z]+',
                        ),
                        'defaults' => array(
                            'action'     => 'ativacao',
                        ),
                    ),
                ),
            )
       )
   )
);