<?php

namespace Plano\Form;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Plano extends Form implements InputFilterProviderInterface
{

    use ProvidesObjectManager;
    use ServiceLocatorAwareTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function init()
    {
        $this->setName('Plano')
            ->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Plano\Entity\Plano'))
            ->setObject(new \Plano\Entity\Plano())
            ->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'idPlano',
            'type'=>'Zend\Form\Element\Hidden'
        ));

        $this->add(array(
            'name' => 'descPlano',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Nome'
            ),
        ));

        $this->add(array(
            'name' => 'qtdDias',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Quantidade dias'
            ),
        ));

        $this->add(array(
            'name' => 'valor',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Valor'
            ),
        ));

        $this->add(new \Zend\Form\Element\Csrf('security'));
        $this->add(array(
            'name' => 'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes' => array(
                'value'=>'Salvar',
                'class' => 'btn-success'
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'descPlano' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty'
                    )
                )
            ),
            'qtdDias' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty',
                    )
                ),
                'filters' => array(
                     array(
                         'name' => 'Zend\Filter\ToInt'
                     )
                )
            ),
            'valor' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty'
                    )
                ),
                 'filters' => array(
                      array(
                         'name' => 'Zend\Filter\ToInt'
                      )
                 )
            ),
        );
    }
}