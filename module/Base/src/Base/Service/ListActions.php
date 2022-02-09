<?php
namespace Base\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @todo serviço para identificação das actions de cada controller válida
 * @author Jordan Duarte
 * @package Base\Service *
 */
class ListActions
{
   private $serviceLocator;
   
   public function __construct(ServiceLocatorInterface $sm)
   {       
       $this->serviceLocator = $sm;
       
   }
   
   public function getShowListActions()
   {
       $controllers = $this->serviceLocator->get("Config");
       $methodsNotAvaliables = ['getMethodFromAction', 'notFoundAction'];
       $permissionModule = [];      
      
       foreach($controllers['controllers']['invokables'] as $controller) {
           $reflection = new \ReflectionClass($controller);
           foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
               $methodName = $method->getName();

               if (in_array($methodName, $methodsNotAvaliables)) {
                   continue;
               }

               if (substr_compare($methodName, 'Action', -strlen('Action')) === 0) {
                   $comment = $method->getDocComment();

                   $pattern = "/@desc(.*)\n/";
                   preg_match($pattern, $comment, $comment);

                   if(count($comment) == 2) {
                       $comment = trim(end($comment));
                   } else {
                       $comment = $methodName;
                   }

                   $permissionModule[str_replace("\\", "-", $controller)][] = array(
                       'action' => $methodName,
                       'comment' => $comment,
                       'controllerName' => $method->getFileName(),
                       'value' => $controller . "::" . $methodName,
                       'namespace' => $method->getNamespaceName()
                   );
               }
           }
       }
       
       //Adiciona a permissão de cliente       
       $permissionModule["AcessoController"][] = array(
           'action' => 'clienteAction',
           'comment' => 'Acesso á informações do cliente',
           'controllerName' => null,
           'value' => "AcessoController::clienteAction",
           'namespace' => ""
           );

       return $permissionModule;
   }
}