<?php
namespace Permissao;

class Module
{
   
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

    public function getFormElementConfig()
    {


        return array(
            'factories' => array(
                'permissaoForm' => function($sm) {
                    $form = new \Permissao\Form\Permissao();
                    $form->setObjectManager($sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
                    $form->setServiceLocator($sm->getServiceLocator());
                    $form->setListActions(new \Base\Service\ListActions($sm->getServiceLocator()));
                    $form->init();
                    $form->setValidationGroup(array(
                        'nome',
                    ));
                    return $form;
                },                
             ),
          );
    }
}
