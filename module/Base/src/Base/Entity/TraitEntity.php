<?php

namespace Base\Entity;

use Zend\Stdlib\Hydrator;

trait TraitEntity
{
    public function __construct(array $options = array())
    {    
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    
    }
    
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}