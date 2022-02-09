<?php
namespace Auth\Controller;

use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\ViewModel;

use Auth\Form\Login;

class AuthController extends \Base\Controller\AbstractBaseController
{
    protected $form;
    protected $storage;
    protected $authservice;

    /**
     * Recupera o serviço de autenticação
     * @return \Auth\Service\AuthenticationService
     */
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                ->get('AuthService');
        }

        return $this->authservice;
    }

    /**
     * Recupera o Storage de login
     * @return Auth\Model\MyAuthStorage
     */
    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                ->get('Auth\Model\MyAuthStorage');
        }

        return $this->storage;
    }

    public function getForm()
    {
        if (! $this->form) {
            $login       = new Login();
            $builder    = new AnnotationBuilder();
            $this->form = $builder->createForm($login);
        }

        return $this->form;
    }

    public function loginAction()
    {        
        $this->layout('layout/auth');

        //if already login, redirect to success page
        if ($this->getAuthService()->hasIdentity()){
            return $this->redirect()->toRoute('home');
        }

        $form = $this->getForm();

        $view = new ViewModel(array(
            'form'      => $form,
            'messages'  => $this->flashmessenger()->getMessages()
        ));

        return $view;

    }

    public function authenticateAction()
    {
        $form = $this->getForm();
        $redirect = 'login';

        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid()){

                // verificando a aitenticação
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));


                $result = $this->getAuthService()->authenticate();

                foreach($result->getMessages() as $message)
                {
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'home';
                    // verifica se esta setado a opção de lembrar
                    // a autenticação
                    if ($request->getPost('rememberme') == 1 ) {
                        $this->getSessionStorage()
                             ->setRememberMe(1);

                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                    
                    // Valida outros parametros apos o login
                    if(!$this->getAuthService()->register($this->getAuthService()->getIdentity())) {
                        return $this->redirect()->toRoute('login/logout');
                    }
                }
            }
        }

        return $this->redirect()->toRoute($redirect);
    }

    public function logoutAction()
    {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();

        $this->flashmessenger()->addMessage("Logout efetuado com sucesso!");
        return $this->redirect()->toRoute('login');
    }
}