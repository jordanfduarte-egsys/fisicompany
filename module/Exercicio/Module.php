<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Exercicio;

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
                'exercicioForm' => function($sm) {
                    $form = new \Exercicio\Form\Exercicio();
                    $form->setObjectManager($sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
                    $form->setServiceLocator($sm->getServiceLocator());
                    $form->init();
                    $form->setValidationGroup(array(
                        'nome',
                        'descricao',
                        'imagem'
                    ));
                    return $form;
                },
            ),
        );
    }
}
