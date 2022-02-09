<?php

namespace TreinoCliente\Form;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class TreinoCliente extends Form implements InputFilterProviderInterface
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
            ->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'TreinoCliente\Entity\TreinoCliente'))
            ->setObject(new \TreinoCliente\Entity\TreinoCliente())
            ->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'idTreinoCliente',
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
                'label' => 'Treino'
            ),
        ));

        $this->add(array(
            'name' => 'status',
            'type'=>'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Status',
                'value_options' => array(
                    \TreinoCliente\Entity\TreinoCliente::TREINO_ATIVO => "Ativo",
                    \TreinoCliente\Entity\TreinoCliente::TREINO_INATIVO => "Inativo",
                )
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
            )
        );
    }
}