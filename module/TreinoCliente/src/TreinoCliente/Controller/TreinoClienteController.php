<?php

namespace TreinoCliente\Controller;

use Zend\View\Model\ViewModel;
use Zend\Validator\File\Size;

class TreinoClienteController extends \Base\Controller\AbstractBaseController
{

    /**
     * Define os dados variaveis para uso abstrato
     */
    public function __construct()
    {
        $this->entity = "\TreinoCliente\Entity\TreinoCliente";
        $this->form = "\TreinoCliente\Form\TreinoCliente";
        $this->service = "\TreinoCliente\Service\TreinoCliente";
        $this->controller = "treino";
    }

    /**
     * Método para edição do plano
     * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
     * @desc Editar Treino
     */
    public function editarAction()
    {        
        $formManager = $this->serviceLocator->get('FormElementManager');
        
        $form = $formManager->get('treinoForm');
        $entity = $this->getEm()->find($this->entity, (int)$this->params()->fromRoute('id', 0));    

        $form->bind($entity);
        // Validação da edição
        $request = $this->getRequest();
        if($request->isPost()) {
            $file = $this->params()->fromFiles('imagem');
            $data = array_merge($request->getPost()->toArray(), array('imagem'=> $file['name']));
            
            $pathinfo = pathinfo($file['name']);
            if(!isset($pathinfo['extension'])) {
                $pathinfo['extension'] = "tst";
            }
            $data['imagem'] = md5(time()) . "." . $pathinfo['extension'];
            $form->setData($data);
            
            if($form->isValid()) {
                $configUpload = $this->getServiceLocator()->get('Config')['upload'];
                
                if(in_array($pathinfo['extension'], $configUpload['extensions'])) {
                    $size = new Size(array('max'=> $configUpload['max_upload_size']));
                    $adapter = new \Zend\File\Transfer\Adapter\Http();
                    $adapter->setValidators(array($size), $file['name']);
                    
                    if (!$adapter->isValid()){
                        $dataError = $adapter->getMessages();
                        $error = array();
                        foreach($dataError as $key=>$row) {
                            $error[] = $row;
                        }                    
                        $form->setMessages(array('imagem'=> $error));
                    } else {                        
                        $adapter->setDestination($configUpload['src']);
                        $adapter->addFilter('File\Rename', array(
                            'target' => $configUpload['src'] .  $data['imagem'],
                        ));
                        
                        if ($adapter->receive($file['name'])) {
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
                                        'descricao' => "Erro ao editar o treino"
                                    ));
                                $this->getEm()->getConnection()->rollBack();
                            }
                        } else {
                            $form->setMessages(
                                array('imagem'=> array("Caminho do upload do arquivo não existe. Contate o desenvolvedor do sistema!")));
                        }
                    }
                
                } else {
                    $form->setMessages(
                        array('imagem'=> array("Permissão do arquivo inválido. Formato permitido (" . implode(", ", $configUpload['extensions']) . ")")));
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