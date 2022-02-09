<?php
namespace Auth;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', MvcEvent::EVENT_DISPATCH, array(
            $this,
            'onDispatchSharedEvent'
        ));        
        
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE, array($this, 'onRouteEvent'));
     }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
                'Auth\Model\MyAuthStorage' => function($sm){
                    return new \Auth\Model\MyAuthStorage('auth_');
                },
                'AuthService' => function($sm) {
                    $entityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $doctrineAuthAdapter = new \DoctrineModule\Authentication\Adapter\ObjectRepository(array(
                        'objectManager' => $entityManager,
                        'identityClass' => 'Usuario\Entity\Usuario',
                        'identityProperty' => 'email',
                        'credentialProperty' => 'senha',
                        'credentialCallable' => function($identity, $credential) {
                            return md5($credential);
                        }
                    ));

                    // my AuthenticationService uses the entity manager
                    // and the ObjectRepository
                    $authService = new \Auth\Service\AuthenticationService();
                    $authService->setEntityManager($entityManager);
                    $authService->setAdapter($doctrineAuthAdapter);
                    $authService->setStorage($sm->get('\Auth\Model\MyAuthStorage'));

                    return $authService;
                },
            ),
        );
    }

    /**
     * Procedimento executado na ocorrencia do evento MvcEvent::EVENT_ROUTE
     *
     * @param MvcEvent $e
     */
    public function onDispatchSharedEvent(MvcEvent $e)
    {
        // Verificando se o usu�rio est� autenticado
        // ==============================================

        // Lista de rotas publicas
        $whitelist = array(
            'login',
            'login/logout',
            'login/authentication'
            );

        // Rota que est� sendo executada
        $currentRoute = $e->getRouteMatch()->getMatchedRouteName();

        // Obtendo o service manager
        $serviceManager = $e->getApplication()->getServiceManager();
        // Obtendo o servi�o de autentica��o de usu�rios
        $auth = $serviceManager->get('AuthService');        
        // Verifica se existe usu�rio autenticado
        if (! $auth->hasIdentity() && ! in_array($currentRoute, $whitelist)) {
            // Obtendo a controladora alvo da requisi��o
            $controller = $e->getTarget();

            // Recuperando o plugin de par�metros
            $params = $controller->plugin('params');

            // Filtrando apenas os par�metros da rota
            $routeParams = $params->fromRoute();
            $routeParamsIgnore = array('__NAMESPACE__', 'controller', 'action', '__CONTROLLER__');

            foreach ($routeParamsIgnore as $name) {
                unset($routeParams[$name]);
            }

            // Adicionando par�metros da requisi��o solicitada para
            // redirecionar o usu�rio quando logar novamente
            $session = new \Zend\Session\Container('redirect');
            $session->route = $currentRoute;
            $session->params = array(
                'fromRoute' => $routeParams,
                'fromQuery' => $params->fromQuery()
            );

            // Obtendo o plugin de redirecionamento
            $redirect = $controller->plugin('redirect');
            return $redirect->toRoute('login');
        }
    }
    
    public function onRouteEvent(MvcEvent $e)
    {        
        // Rota que est� sendo executada
        $currentRoute = $e->getRouteMatch()->getMatchedRouteName();
        
        // Obtendo o service manager
        $serviceManager = $e->getApplication()->getServiceManager();
        // Obtendo o servi�o de autentica��o de usu�rios
        $auth = $serviceManager->get('AuthService');
        
        if($currentRoute != "login" & $auth->hasIdentity()) {
            // Usuário esta autenticado
            $permissoes = $auth->getIdentity()->getIdPermissao()->getModulos();
            $paramsAction = $e->getRouteMatch()->getParams();
            $access = false;
            foreach($permissoes as $actionName) {
                if($actionName->getNome() == $paramsAction['controller'] . "Controller::" .
                    $paramsAction['action'] . "Action") {
                        $access = true;
                        break;
                    }
            }
            if(! $access) {                
                $response = new \Zend\Http\PhpEnvironment\Response;
                $response->setStatusCode(302);
                $response->getHeaders()
                         ->addHeaderLine('Location', '/');

                return $response;
            }
        }
    }
}
