<?php

namespace Exercicio\Form;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Exercicio extends Form implements InputFilterProviderInterface
{
    use ProvidesObjectManager;
    use ServiceLocatorAwareTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function init()
    {
        $this->setName(strtolower(__CLASS__))
            ->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Exercicio\Entity\Exercicio'))
            ->setObject(new \Exercicio\Entity\Exercicio())
            ->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'idExercicio',
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
            'name' => 'imagem',
            'type'=>'Zend\Form\Element\File',
            'options' => array(
                'label' => 'Imagem'
            ),
        ));

        $this->add(array(
            'name' => 'descricao',
            'type'=>'Zend\Form\Element\TextArea',
            'options' => array(
                'label' => 'Descrição'
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
            'descricao' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty'
                    )
                )
            )
        );
    }
}