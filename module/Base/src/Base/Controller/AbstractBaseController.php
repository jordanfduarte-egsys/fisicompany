<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

abstract class AbstractBaseController extends AbstractActionController{

    protected $em;
    protected $entity;
    protected $controller;
    protected $route;
    protected $form;
    protected $service;

    public function indexAction()
    {
        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);

        $messages = $this->flashMessenger()
            ->setNamespace($this->controller)
            ->getMessages();

        return new ViewModel(array('data'=>$paginator,'page'=>$page, 'messages'=> $messages));
    }

    public function cadastrarAction()
    {
        $formManager = $this->serviceLocator->get('FormElementManager');
        $form = $formManager->get($this->controller . 'Form');
        $request = $this->getRequest();

        if($request->isPost())
        {
            $entity = new $this->entity();

            $data = $request->getPost()->toArray();
            if($request->getFiles()) {
                $data = array_merge_recursive($data, $request->getFiles()->toArray());
            }

            $form->bind($entity)->setData($data);

            if($form->isValid())
            {
                try {
                    $this->getEm()->persist($entity);
                    $this->getEm()->flush();

                    $this->flashMessenger()
                        ->setNamespace($this->controller)
                        ->addSuccessMessage("Cadastro efetuado com sucesso!");

                    return $this->redirect()->toRoute($this->controller, array('controller'=>$this->controller));
                } catch(\Exception $e) {
                    $this->getServiceLocator()->get("Base\Service\Log")->inserir(
                        array(
                            'id_usuario' => $this->getIdentity()->getIdUsuario(),
                            'mensagem' => $e->getMessage(),
                            'descricao' => "Erro no cadastro do ". $this->controller
                        ));
                }

            }
        }

        $messages = $this->flashMessenger()
            ->setNamespace($this->controller)
            ->getMessages();

        return new ViewModel(array(
            'form' => $form,
            'messages' => $messages
        ));
    }

    public function deletarAction()
    {
        $entity = $this->getEm()->find($this->entity, (int)$this->params()->fromRoute('id', 0));

        try {
            if (!$entity instanceof $this->entity) {
                throw new \Exception("Nenhum registro encontrado", 1);
            }

            $this->getEm()->remove($entity);
            $this->getEm()->flush();
            $this->flashMessenger()
                    ->setNamespace($this->controller)
                    ->addSuccessMessage("Registro removido com sucesso!");

        } catch(\Exception $e) {
             $this->flashMessenger()
                ->setNamespace($this->controller)
                ->addErrorMessage("Erro ao remover o registro!");
        }

        return $this->redirect()->toRoute($this->controller, array('controller'=>$this->controller));
    }

    /**
     *
     * @return EntityManager
     */
    protected function getEm()
    {
        if(null === $this->em)
            $this->em = $this->getServiceLocator()->get ('Doctrine\ORM\EntityManager');

            return $this->em;
    }

    /**
     *@return \Auth\Service\AuthenticationService
     */
    protected function getIdentity()
    {
        return $this->getServiceLocator()->get('AuthService')->getIdentity();
    }
}