<?php

return array(
    'routes' => array(
        'exercicio' => array(
            'type'    => 'Segment',
            'options' => array(
                'route'    => '/exercicio[/page/:page]',
                'defaults' => array(
                    '__NAMESPACE__' => 'Exercicio\Controller',
                    'controller'    => 'Exercicio',
                    'action'        => 'index',
                    'page'          =>  1
                ),
                'constraints' => array(
                    'page'         => '[0-9]+',
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
                'deletar' => array(
                    'type'    => 'Segment',
                    'options' => array(
                        'route'    => '/deletar/:id',
                        'constraints' => array(
                            'id'     => '[0-9]+',
                        ),
                        'defaults' => array(
                            'action'     => 'deletar',
                        ),
                    ),
                )
            )
       )
   )
);

