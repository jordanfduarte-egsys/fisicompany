<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;


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
            'factories'=> array(
                'usuarioForm' => function($sm) {
                    $form = new \Usuario\Form\Usuario();
                    $form->setObjectManager($sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
                    $form->setServiceLocator($sm->getServiceLocator());
                    $form->init();
                    $form->setValidationGroup(array(
                        'idPermissao',
                        'nome',
                        'sobreNome'
                    ));
                    return $form;
                },
            )
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories'=> array(
                'Usuario\Mail\Transport' => function($em){
                    $config = $em->get('config');
                    $transport = new SmtpTransport();
                    $options = new SmtpOptions($config['mail']);
                    $transport->setOptions($options);
                    return $transport;
                },
                'Usuario\Service\Usuario' => function($em){
                    $view = $em->get('View');
                    return new Service\Usuario($em->get('Doctrine\ORM\EntityManager'),
                                            $em->get('Usuario\Mail\Transport'),
                                            $em->get("AuthService"),
                                            $view);
                }               
            )
        );
    }
}
