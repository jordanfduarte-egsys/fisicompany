<?php

namespace Equipamento\Form;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Equipamento extends Form implements InputFilterProviderInterface
{

    use ProvidesObjectManager;
    use ServiceLocatorAwareTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function init()
    {
        $this->setName('Equipamento')
            ->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Equipamento\Entity\Equipamento'))
            ->setObject(new \Equipamento\Entity\Equipamento())
            ->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'idEquipamento',
            'type'=>'Zend\Form\Element\Hidden'
        ));

        $this->add(array(
            'name' => 'nome',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Nome'
            ),
        ));

        $this->add(array(
            'name' => 'qtd',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Quantidade'
            ),
        ));

        $this->add(array(
            'name' => 'marca',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'marca'
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
            'nome' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty'
                    )
                )
            ),
            'qtd' => array(
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
            'marca' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty'
                    )
                )
            ),
        );
    }
}