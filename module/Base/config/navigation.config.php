<?php
return array(
    'default' => array(
        array(
            'label' => 'Home',
            'uri' => '/',
            'permissao' => 'Application\Controller\IndexController::indexAction'
        ),
        array(
            'label' => 'Cliente',
            'route' => 'usuarios',
            'permissao' => 'Usuario\Controller\UsuarioController::indexAction',
        ),
        array(
            'label' => 'Cadastros',
            'uri' => '#',
            'pages' => array(
                        array(
                            'label' => 'Planos',
                            'route' => 'plano',
                            'title' => 'Cadastro de planos',
                            'permissao' => 'Plano\Controller\PlanoController::indexAction'
                        ),
                        array(
                            'label' => 'Treino',
                            'route' => 'treino',
                            'title' => 'Cadastro de treinos',
                            'permissao' => 'TreinoCliente\Controller\TreinoClienteController::indexAction'
                        ),
                        array(
                            'label' => 'Permissão',
                            'route' => 'permissao',
                            'title' => 'Cadastro de permissões',
                            'permissao' => 'Permissao\Controller\PermissaoController::indexAction'
                        ),
                        array(
                            'label' => 'Usuarios',
                            'route' => 'usuarios',
                            'title' => 'Cadastro de usuários',
                            'permissao' => 'Usuario\Controller\UsuarioController::indexAction'
                        ),
                        array(
                            'label' => 'Exercicios',
                            'route' => 'exercicio',
                            'title' => 'Cadastro de exercícios',
                            'permissao' => 'Exercicio\Controller\ExercicioController::indexAction'
                        ),
                    )
        ),
        array(
            'label' => 'Gerenciar',
            'uri' => '#',
            'permissao' => null
        ),
        array(
            'label' => 'Relatórios',
            'uri' => '#',
            'permissao' => null
        ),
        array(
            'label' => 'Configurações',
            'uri' => '#',
            'permissao' => null
        ),
        array(
            'label' => 'Sobre',
            'uri' => '#',
            'permissao' => null
        ),
         array(
            'label' => 'Sair',
            'uri' => '/login/logout',
            'permissao' => null
        ),
    )
);