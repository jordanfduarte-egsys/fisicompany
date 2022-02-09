<?php
namespace Plano\Controller;

use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator;

class PlanoController extends \Base\Controller\AbstractBaseController
{
    /**
     * Define os dados variaveis para uso abstrato
     */
    public function __construct()
    {
        $this->entity = "\Plano\Entity\Plano";
        $this->form = "\Plano\Form\Plano";
        $this->service = "\Plano\Service\User";
        $this->controller = "plano";
    }

    /**
     * Método para edição do plano
     * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
     */
    public function editarAction()
    {
        $formManager = $this->serviceLocator->get('FormElementManager');
        $form = $formManager->get('planoForm');
        $entity = $this->getEm()->find($this->entity, (int)$this->params()->fromRoute('id', 0));


        $form->setValidationGroup(array(
           'descPlano',
           'qtdDias',
           'valor'
        ));
        $form->bind($entity);
        // Validação da edição
        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setData($request->getPost());

            if($form->isValid()) {
                $this->getEm()->getConnection()->beginTransaction();
                try {
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
                            'descricao' => "Erro ao editar o plano"
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
}
