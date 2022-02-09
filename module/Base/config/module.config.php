<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Base;

return array(
	'navigation' => require "navigation.config.php",
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../../' . __NAMESPACE__ . '/view',
        ),
     ),
);
