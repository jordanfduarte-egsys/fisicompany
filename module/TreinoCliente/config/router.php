<?php

return array(
    'routes' => array(
        'treino' => array(
            'type'    => 'Literal',
            'options' => array(
                'route'    => '/treino',
                'defaults' => array(
                    '__NAMESPACE__' => 'TreinoCliente\Controller',
                    'controller'    => 'TreinoCliente',
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

