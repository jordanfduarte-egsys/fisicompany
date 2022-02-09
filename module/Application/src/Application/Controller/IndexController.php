<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;

class IndexController extends \Base\Controller\AbstractBaseController
{
    public function indexAction()
    {        
        return new ViewModel();
    }
}
