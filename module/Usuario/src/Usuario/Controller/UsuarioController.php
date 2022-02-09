<?php
namespace Usuario\Controller;

use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class UsuarioController extends \Base\Controller\AbstractBaseController
{
    /**
     * Função construtora da classe
     */
    public function __construct()
    {
        $this->entity = "\Usuario\Entity\Usuario";
        $this->form = "\Usuario\Form\Usuario";
        $this->service = "\Usuario\Service\Usuario";
        $this->controller = "usuario";
    }
    
    /**
     *  Lista os usuários
     *  
     * {@inheritDoc}
     * @see \Base\Controller\AbstractBaseController::indexAction()
     * @return Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findBY(array("status" => 1));
    
        $page = $this->params()->fromRoute('page');
    
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);
    
        $messages = $this->flashMessenger()
            ->setNamespace($this->controller)
            ->getMessages();
    
        return new ViewModel(array('data'=>$paginator,'page'=>$page, 'messages'=> $messages));
    }
    
    /**
     * Metodo para cadastro de usuário
     * 
     * {@inheritDoc}
     * @see \Base\Controller\AbstractBaseController::cadastrarAction()
     * @return Zend\View\Model\ViewModel
     */
    public function cadastrarAction()
    {
        $formManager = $this->serviceLocator->get('FormElementManager');
        $form = $formManager->get('usuarioForm');
        
        $request = $this->getRequest();
        $serviceUsuario = $this->serviceLocator->get($this->service);
    
        if($request->isPost())
        {
            $entity = new $this->entity();
            
            $file = $this->params()->fromFiles('foto');
            $data = array_merge($request->getPost()->toArray(), array('imagem'=> $file['name']));
            
            $isUploadComplete = true;
            $pathinfo = pathinfo($file['name']);
            if(!isset($pathinfo['extension'])) {
                $pathinfo['extension'] = "tst";
            }
            $data['foto'] = md5(time()) . "." . $pathinfo['extension'];
            $form->setData($data);

            $form->bind($entity)->setData($data);
            if($form->isValid()) {
                $configUpload = $this->getServiceLocator()->get('Config')['upload'];
                if(!empty($this->params()->fromFiles('foto')['name'])){
                    if(in_array($pathinfo['extension'], $configUpload['extensions'])) {                        
                        $size = new \Zend\Validator\File\Size(array('max'=> $configUpload['max_upload_size']));
                        $adapter = new \Zend\File\Transfer\Adapter\Http();
                        $adapter->setValidators(array($size), $file['name']);
                
                        if (!$adapter->isValid()){
                            $dataError = $adapter->getMessages();
                            $error = array();
                            foreach($dataError as $row) {
                                $error[] = $row;
                            }
                            $form->setMessages(array('foto'=> $error));
                            $isUploadComplete = false;
                        } else {
                            $adapter->setDestination($configUpload['src']);
                            $adapter->addFilter('File\Rename', array(
                                'target' => $configUpload['src'] .  $data['foto'],
                            ));
                
                            if (!$adapter->receive($file['name'])) {
                                $form->setMessages(
                                    array('foto'=> array("Caminho do upload do arquivo não existe. Contate o desenvolvedor do sistema!")));
                                $isUploadComplete = false;
                            }
                        }
                
                    } else {
                        $form->setMessages(
                            array('foto'=> array("Permissão do arquivo inválido. Formato permitido (" . implode(", ", $configUpload['extensions']) . ")")));
                        $isUploadComplete = false;
                    }
                } else {
                    $data['foto'] = "";
                }
                
                if($isUploadComplete) {
                    try {
                        $entity = $serviceUsuario->insert($data);
                        if($entity instanceof \Usuario\Entity\Usuario) {
                            $this->flashMessenger()
                                ->setNamespace($this->controller)
                                ->addSuccessMessage("Cadastro efetuado com sucesso!");
                        } else {
                            
                            $this->flashMessenger()
                                ->setNamespace($this->controller)
                                ->addSuccessMessage("Cadastro efetuado com sucesso. Houve um erro ao enviar o email para o cliente " . $data["nome"]);    
                        }
                        return $this->redirect()->toRoute($this->controller, array('controller'=>$this->controller));
                    } catch(\Exception $e) {
                        $this->getServiceLocator()->get("Base\Service\Log")->inserir(
                            array(
                                'id_usuario' => $this->getIdentity()->getIdUsuario(),
                                'mensagem' => $e->getMessage(),
                                'descricao' => "Erro no cadastro do ". $this->controller
                            ));
                        \Zend\Debug\Debug::dump($e->getMessage()); exit;
                    } 
                    die("OKDOSKSDO");
                }
            }
        }
    
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    /**
     * Método para edição o usuario
     * @return \Zend\Http\Response|\Zend\View\Model\ViewModel
     */
    public function editarAction()
    {
        $formManager = $this->serviceLocator->get('FormElementManager');
        $form = $formManager->get('usuarioForm');
        $entity = $this->getEm()->find($this->entity, (int)$this->params()->fromRoute('id', 0));
        $serviceUsuario = $this->serviceLocator->get($this->service);

        $form->bind($entity);
        // Validação da edição
        $request = $this->getRequest();
        if($request->isPost()) {
            
            $data = $request->getPost()->toArray();
            if($request->getFiles()) {
                $data = array_merge_recursive($data, $request->getFiles()->toArray());
            }
            $form->setData($data);

            if($form->isValid()) {
                $this->getEm()->getConnection()->beginTransaction();
                try {                    
                    $entity = $serviceUsuario->update($data);
                    
                    if($entity instanceof \Usuario\Entity\Usuario) {
                        $this->flashMessenger()
                            ->setNamespace($this->controller)
                            ->addSuccessMessage("Cadastro alterado com sucesso!");
                            return $this->redirect()->toRoute($this->controller, array('controller'=>$this->controller));
                    }
                } catch(\Exception $e) {
                    // Inserindo o log de erro
                    $this->getServiceLocator()->get("Base\Service\Log")->inserir(
                        array(
                            'id_usuario' => $this->getIdentity()->getIdUsuario(),
                            'mensagem' => $e->getMessage(),
                            'descricao' => "Erro ao editar o usuário"
                    ));
                    $this->getEm()->getConnection()->rollBack();

                    $this->flashMessenger()
                        ->setNamespace($this->controller)
                        ->addErrorMessage("Erro no cadastro!");
                }
            }
        }

        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    /**
     * Método para remoção do usuário
     * 
     * {@inheritDoc}
     * @see \Base\Controller\AbstractBaseController::deletarAction()
     */
    public function deletarAction()
    {
        try {
            $serviceUsuario = $this->serviceLocator->get($this->service);
            $entity = $serviceUsuario->remove((int)$this->params()->fromRoute('id', 0));
            
            if (!$entity instanceof $this->entity) {
                throw new \Exception("Nenhum usuário encontrado", 1);
            }
           
            $this->flashMessenger()
                ->setNamespace($this->controller)
                ->addSuccessMessage("usuário desativado com sucesso!");
    
        } catch(\Exception $e) {
            $this->flashMessenger()
                ->setNamespace($this->controller)
                ->addErrorMessage("Erro ao desativar o registro!");
        }
    
        return $this->redirect()->toRoute($this->controller, array('controller'=>$this->controller));
    }
}
