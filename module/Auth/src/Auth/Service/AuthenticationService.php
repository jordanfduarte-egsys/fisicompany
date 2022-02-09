<?php

namespace Auth\Service;

use Zend\Authentication\AuthenticationService as ZendAuthenticationService;

use Usuario\Entity\Usuario;

class AuthenticationService extends ZendAuthenticationService
{
    private $usuario;
    
    public function __invoke()
    {
        return $this;
    }

    public function getIdentity()
    {
        $storage = $this->getStorage();

        if ($storage->isEmpty()) {
            return $this->usuario = new \Usuario\Entity\Usuario();
        }
        
		if(! $this->usuario instanceof \Usuario\Entity\Usuario) {
			$email = $storage->read();
			$this->usuario = $this->getEntityManager()->getRepository('\Usuario\Entity\Usuario')
				->findOneBy(array("email" => $email));
		}
                
        if($this->usuario instanceof \Usuario\Entity\Usuario) {
            return $this->usuario;
        } else {
            return $this->usuario = new \Usuario\Entity\Usuario();
        }
    }

    /**
     * Register a new user to the system. The user password will by hashed before
     * it will be saved to the database.
     */
    public function register(\Usuario\Entity\Usuario $user)
    {
        if(count($user->getIdPermissao()->getModulos())) {
            return true;
        }
    }

    /**
     * Reset the users password to a random value and send an e-mail to the
     * user containing the new password.
     */
    public function resetPassword(\Usuario\Entity\Usuario $user)
    {

    }

    /**
     * Delete a users account from the database. This does not really delete the
     * user, as there are too many connections to all other tables, but rather
     * deletes all personal information from the user records.
     */
    public function delete(\Usuario\Entity\Usuario $user)
    {

    }

    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}