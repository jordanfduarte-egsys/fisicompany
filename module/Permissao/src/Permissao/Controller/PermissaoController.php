<?php
namespace Permissao\Controller;

use Zend\View\Model\ViewModel;

class PermissaoController extends \Base\Controller\AbstractBaseController
{
    /**
     * Define os dados variaveis para uso abstrato
     */
    public function __construct()
    {
        $this->entity = "\Permissao\Entity\Permissao";
        $this->form = "\Permissao\Form\Permissao";
        $this->service = "\Permissao\Service\User";
        $this->controller = "permissao";
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
            // Bind permissão modulo
            foreach ($data as $index =>$modulo) {
                if(preg_match("/permissao-/", $index) && is_array($modulo)) {
                    foreach($modulo as $action) {
                        $modulo = new \Permissao\Entity\PermissaoModulo();
                        $modulo->setNome($action);
                        $entity->addModulos($modulo);
                    }
                }
            }
            $form->bind($entity)
                 ->setData($data);

            if($form->isValid()) {
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

    /**
     * Método para edição da permissão
     * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
     */
    public function editarAction()
    {
        $formManager = $this->getServiceLocator()->get('FormElementManager');
        $form = $formManager->get('permissaoForm');
        $entity = $this->getEm()->find($this->entity, (int)$this->params()->fromRoute('id', 0));

        $values = array();
        foreach ($entity->getModulos() as $index => $action) {
            $actionName = explode("::", $action->getNome());
            $controllerName = str_replace("\\", "-", current($actionName));

            if(!isset($values[$controllerName])) {
                $values[$controllerName] = array();
            }

            $values[$controllerName][] = $action->getNome();
        }

        foreach($values as $index => $value) {
            if($form->has("permissao-" . $index)) {
                $form->get("permissao-" . $index)->setValue($value);
            }
        }

        $form->bind($entity);
        // Validação da edição
        $request = $this->getRequest();
        if($request->isPost()) {

            $data = $request->getPost()->toArray();
            // Bind permissão modulo
            foreach ($data as $index =>$modulo) {
                if(preg_match("/permissao-/", $index) && is_array($modulo)) {
                    foreach($modulo as $action) {
                        $modulo = new \Permissao\Entity\PermissaoModulo();
                        $modulo->setNome($action);
                        $entity->addModulos($modulo);
                    }
                }
            }

            $form->setData($data);

            if($form->isValid()) {
                $this->getEm()->getConnection()->beginTransaction();
                try {
                    foreach ($entity->getModulos() as $permissaoModule) {
                        $this->getEm()->remove($permissaoModule);
                    }

                    $this->getEm()->flush();
                    $this->getEm()->commit();

                    $this->flashMessenger()
                        ->setNamespace($this->controller)
                        ->addSuccessMessage("Cadastro alterado com sucesso!");

                    return $this->redirect()->toRoute($this->controller, array('controller'=>$this->controller));
                } catch(\Exception $e) {
                    // Inserindo o log de erro
                    $this->getServiceLocator()->get("Base\Service\Log")->inserir(
                        array(
                            'id_usuario' => $this->getIdentity()->getIdUsuario(),
                            'mensagem' => $e->getMessage(),
                            'descricao' => "Erro ao editar a permissão"
                    ));
                    $this->getEm()->getConnection()->rollBack();

                    $this->flashMessenger()
                        ->setNamespace($this->controller)
                        ->addErrorMessage("Erro no cadastro!");
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

            if($this->getEm()->getRepository("\Usuario\Entity\Usuario")->findBy(array('idPermissao' => $entity->getId()))) {
                throw new \Exception("Existe usuários cadastrados com a permissão ". $entity->getNome(), 1);
            }

            foreach ($entity->getModulos() as $permissaoModule) {
                $this->getEm()->remove($permissaoModule);
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
}
