<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;

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

    /**
     * Configura��o de servi�os
     * @return multitype:multitype:NULL  |\Base\Service\Log
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Base\Service\Log' => function($service) {
                    return new \Base\Service\Log($service);
                },
                'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            ),
            'Base/Service/ListActions' => function($sm) {
                $listActions = new \Base\Service\ListActions($sm->getServiceLocator());
                return $listActions->getShowListActions();
            }
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'serviceLocatorHelper' => function($sm){
                    return new \Base\View\ServiceLocatorHelper($sm->getServiceLocator());
                }
            )
        );
    }
}
