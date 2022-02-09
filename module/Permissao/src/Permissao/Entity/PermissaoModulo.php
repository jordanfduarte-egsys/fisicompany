<?php

namespace Permissao\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermissaoModulo
 *
 * @ORM\Table(name="permissao_modulo", indexes={@ORM\Index(name="permissao_id_permissao", columns={"id_permissao"})})
 * @ORM\Entity
 */
class PermissaoModulo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_permissao_modulo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPermissaoModulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var \Permissao
     *
     * @ORM\ManyToOne(targetEntity="\Permissao\Entity\Permissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_permissao", referencedColumnName="id_permissao")
     * })
     */
    private $idPermissao;


    public function getIdPermissaoModulo()
    {
        return $this->idPermissaoModulo;
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

    public function getIdPermissao()
    {
        return $this->idPermissao;
    }

    public function setIdPermissao(\Permissao\Entity\Permissao $idPermissao)
    {
        $this->idPermissao = $idPermissao;
        return $this;
    }
}