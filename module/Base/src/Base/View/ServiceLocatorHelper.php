<?php
namespace Base\View;

use Zend\View\Helper\AbstractHelper,
Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;

class ServiceLocatorHelper extends AbstractHelper
{
    private $serviceLocator;

    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function __invoke()
    {
        return $this->serviceLocator;
    }
}