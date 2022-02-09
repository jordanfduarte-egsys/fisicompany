<?php

namespace Permissao\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Permissao
 *
 * @ORM\Table(name="permissao")
 * @ORM\Entity
 */
class Permissao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_permissao", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPermissao;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var \Permissao\Entity\PermissaoModulo
     *
     * @ORM\OneToMany(targetEntity="Permissao\Entity\PermissaoModulo", mappedBy="idPermissao", cascade={"persist"})
     */
    protected $modulos;

    public function _construct()
    {
        $this->modulos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdPermissao()
    {
        return $this->idPermissao;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function addModulos(\Permissao\Entity\PermissaoModulo $modulo)
    {
        $modulo->setIdPermissao($this);
        $this->modulos[] = $modulo;
        return $this;
    }

    public function getModulos()
    {
        return $this->modulos;
    }
}