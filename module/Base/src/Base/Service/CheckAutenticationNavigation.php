<?php
namespace Base\Service;

class CheckAutenticationNavigation
{
    private static $identity;
    private static $permissions = array();

    public static function check(\Zend\View\Helper\Navigation $navigator, $identity)
    {
        self::$identity = $identity->getIdentity();

        foreach(self::$identity->getIdPermissao()->getModulos() as $permissao) {
            self::$permissions[] = $permissao->getNome();
        }

        foreach($navigator->getContainer() as $i => $child) {
            $action = $child->toArray();
            if($child->hasPages()) {
                foreach($child->getPages() as $k => $parent) {
                    $actionParent = $parent->toArray();
                    if(isset($actionParent['permissao']) && !in_array($actionParent['permissao'], self::$permissions)) {
                        $page = $navigator->findBy('permissao', $actionParent['permissao']);
                        $navigator->removePage($page, true);
                    }
                }

            } else {
                if(isset($action['permissao']) && !in_array($action['permissao'], self::$permissions)) {
                    $page = $navigator->findBy('permissao', $action['permissao']);
                    $navigator->removePage($page);
                }
            }
        }
        
        return $navigator;
    }
}