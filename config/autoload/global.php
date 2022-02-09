<?php
return array(
    'mail'=> array(
        'name'=> 'gmail',
        'host'=> 'smtp.gmail.com',
        'port'=> '587',
        'connection_class'=> 'smtp',
        'connection_config'=> array(
            'username'=> 'jordan.duarte.pr@gmail.com',
            'password'=> 'residente14',
            'ssl'=> 'tls',
            'from'=> 'jordan.duarte.pr@gmail.com'
        ),
       
        
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../../module/Base/view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../../module/Base/view/error/404.phtml',
            'error/index'             => __DIR__ . '/../../module/Base/view/error/index.phtml',
            'partial/navigation'      => __DIR__ . '/../../module/Base/view/layout/partial/navigation.phtml',
            'partial/paginator'       => __DIR__ . '/../../module/Base/view/layout/partial/paginator.phtml',
            'partial/flash-messenger' => __DIR__ . '/../../module/Base/view/layout/partial/flash-messenger.phtml'
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    'controllers'=> array(
        'invokables'=> array(
            'Usuario\Controller\Usuario'=> 'Usuario\Controller\UsuarioController',
            'Plano\Controller\Plano'=> 'Plano\Controller\PlanoController',
            'TreinoCliente\Controller\TreinoCliente'=> 'TreinoCliente\Controller\TreinoClienteController',
            'Permissao\Controller\Permissao'=> 'Permissao\Controller\PermissaoController',
            'Exercicio\Controller\Exercicio'=> 'Exercicio\Controller\ExercicioController',
            'Equipamento\Controller\Equipamento'=> 'Equipamento\Controller\EquipamentoController',
            'Usuario\Controller\Usuario'=> 'Usuario\Controller\UsuarioController',
        )
    ),
);