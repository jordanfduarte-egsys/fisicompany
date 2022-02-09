<?php
namespace Usuario\Service;

use Doctrine\ORM\EntityManager;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Base\Service\AbstractService;

class Usuario extends AbstractService
{
    protected $trasposrt;
    protected $view;
    
    public function __construct(EntityManager $em, SmtpTransport $transport, $auth,  $view)
    {
        parent::__construct($em);
        $this->entity = '\Usuario\Entity\Usuario';
        $this->auth = $auth;
        $this->transport = $transport;
        $this->view = $view;
    }
    
    public function insert(array $data)
    {
        // Valida se o usuario existe
        
//         $data["senha"] = md5("123@mudar");
         $data["codAtivacao"] = base64_encode(time() . $data["nome"] . $data["sobreNome"]);
        
//         $entity = parent::save($data);
        $data["email"] = "jordanjoga10@gmail.com";
        $dataMail = array('nome'=> $data['nome'], 'activateKey'=> $data["codAtivacao"]);
        $entity = true;
        
        if($entity) {
            $mail = new \Base\Mail\Mail($this->transport, $this->view, 'add-user');
            $mail->setSebject('Confirmação de cadastro')
                ->setTo($data['email'])
                ->setData($dataMail)
                ->prepare()
                ->send();
                die("OKDKOKSDO");
            return $entity;
        }
        die("OKDKOKSDO");
    }
    
    public function update(array $data)
    {
        $entity = parent::save($data);
        if($entity) {
            return $entity;
        }
    }
}