<?php

namespace Exercicio\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercicio
 *
 * @ORM\Table(name="exercicio")
 * @ORM\Entity
 */
class Exercicio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_exercicio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="imagem", type="string", length=255, nullable=false)
     */
    private $imagem;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", nullable=false)
     */
    private $descricao;

    public function getId()
    {
        return $this->id;
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

    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }
}