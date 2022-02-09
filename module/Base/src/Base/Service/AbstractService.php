<?php

namespace Base\Service;

use Doctrine\ORM\EntityManager;
use ClassMetrods\Stdlib\Hydrator\ClassMetrods;

abstract class AbstractService
{

    protected $em;
    protected $entity;
    protected $auth;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function save(Array $data = array())
    {
        if (isset($data['id']) && !empty($data["id"])) {//traz um registro, armazena na isntancia entity
            $entity = $this->em->getReference($this->entity, $data['id']);
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
            $hydrator->hydrate($data, $entity);

            // vincula o log a entidade
            $log = new \Log\Entity\LogUsuario();
            $log->setObservacao("Realizado alteração de usuário.");
            $log->setUsuarioAcao($this->auth->getIdentity());
            $entity->addLog($log);

        } else {
            $entity = new $this->entity($data);           
            $entity->setIdPermissao($this->em->getRepository("\Permissao\Entity\Permissao")->find($data["idPermissao"]));
            if($data["idPlano"]) {
                $entity->setIdPlano($this->em->getRepository("\Plano\Entity\Plano")->find($data["idPlano"]));
            }
            if($data["idTreino"]) {
                $entity->setIdTreino($this->em->getRepository("\TreinoCliente\Entity\TreinoCliente")->find($data["idTreino"]));
            }
            // vincula o log a entidade
            $log = new \Log\Entity\LogUsuario();
            $log->setObservacao("Cadastro de um novo usuário. ");
            $log->setUsuarioAcao($this->auth->getIdentity());
            $entity->addLog($log);
        }
        $this->em->persist($entity);
        
        $this->em->flush();
        return $entity;
    }

    public function remove($id)
    {
        //vai no repositorio e busca o registro unico
        $entity = $this->em->getRepository($this->entity)->findOneBy($id);
        if($entity) {
            $entity->setStatus(0);
            $log = new \Log\Entity\LogUsuario();
            $log->setObservacao("Desativando o usuário.");
            $log->setUsuarioAcao($this->auth->getIdentity());
            $entity->addLog($log);

            $this->em->remove($entity);
            $this->em->flush();
            return $entity;
        }
        return false;
    }


}