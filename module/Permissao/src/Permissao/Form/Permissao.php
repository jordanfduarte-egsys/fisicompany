<?php

namespace Permissao\Form;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Permissao extends Form implements InputFilterProviderInterface
{

    use ProvidesObjectManager;
    use ServiceLocatorAwareTrait;

    private $listActionsService;
    private $listActions;

    public function __construct()
    {
        parent::__construct();
    }

    public function setListActions($actionsService)
    {
        $this->listActionsService = $actionsService;
    }

    public function getListActions()
    {
        if(is_array($this->listActions)) {
            return $this->listActions;
        }

        return $this->listActions = $this->listActionsService->getShowListActions();
    }

    public function init()
    {
        $this->setName('Permissao')
            ->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Permissao\Entity\Permissao'))
            ->setObject(new \Permissao\Entity\Permissao())
            ->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'idPermissao',
            'type'=>'Zend\Form\Element\Hidden'
        ));

        $this->add(array(
            'name' => 'nome',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Nome'
            ),
        ));

        // Adiciona multicheckbox para cada controller, correspondendo as suas actions
        foreach($this->getListActions() as $alias => $controller) {
            $values = [];
            foreach($controller as $param) {
                $values[$param['value']] = $param['comment'];
            }
            $label = current(explode("-", $alias));

            $this->add(array(
                'name' => 'permissao-' . $alias,
                'type'=>'Zend\Form\Element\MultiCheckbox',
                'options' => array(
                    'value_options' => $values,
                    'label' => $label
                ),
            ));
        }


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
            'name' => array(
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