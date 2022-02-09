<?php
namespace Usuario\Form;

use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Usuario extends Form implements InputFilterProviderInterface
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
            ->setHydrator(new DoctrineHydrator($this->getObjectManager(), 'Usuario\Entity\Usuario'))
            ->setObject(new \Usuario\Entity\Usuario())
            ->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'type'=>'Zend\Form\Element\Hidden'
        ));

        $this->add(array(
            'name' => 'idPermissao',
            'type'=>'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                    'object_manager' => $this->getObjectManager(),
                    'target_class'   => 'Permissao\Entity\Permissao',
                    'property'       => 'nome',
                    'label'          => 'Permissão'
                ),
        ));

        $this->add(array(
            'name' => 'nome',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Nome'
            ),
        ));

        $this->add(array(
            'name' => 'sobreNome',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Sobre Nome'
            ),
        ));
        
        $this->add(array(
            'name' => 'email',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Email'
            ),
        ));
        
        $this->add(array(
            'name' => 'senha',
            'type'=>'Zend\Form\Element\Password',
            'options' => array(
                'label' => 'Senha'
            ),
        ));
        
        $this->add(array(
            'name' => 'foto',
            'type'=>'Zend\Form\Element\File',
            'options' => array(
                'label' => 'Foto'
            ),
        ));
        
        $this->add(array(
            'name' => 'idTreino',
            'type'=>'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'object_manager' => $this->getObjectManager(),
                'target_class'   => 'TreinoCliente\Entity\TreinoCliente',
                'property'       => 'nome',
                'label'          => 'Treino'
            ),
        ));
        
        $this->add(array(
            'name' => 'idPlano',
            'type'=>'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'object_manager' => $this->getObjectManager(),
                'target_class'   => 'Plano\Entity\Plano',
                'property'       => 'descPlano',
                'label'          => 'Plano'
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
            'idPermissao' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty'
                    )
                )
            ),
            'nome' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty',
                    )
                )
            ),
            'sobreNome' => array(
                'allow_empty' => false,
                'required' => true,
                'validators' => array(
                    array(
                        'name' => '\Zend\Validator\NotEmpty'
                    )
                )
            ),
            'senha' => array(
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