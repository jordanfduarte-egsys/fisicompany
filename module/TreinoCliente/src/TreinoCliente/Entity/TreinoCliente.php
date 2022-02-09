<?php

namespace TreinoCliente\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TreinoCliente
 *
 * @ORM\Table(name="treino_cliente")
 * @ORM\Entity
 */
class TreinoCliente
{
    const TREINO_ATIVO = 1;
    const TREINO_INATIVO = 0;
    /**
     * @var integer
     *
     * @ORM\Column(name="id_treino_cliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTreinoCliente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_treino_sistema", type="integer", nullable=true)
     */
    private $idTreinoSistema;

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
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    public function getIdTreinoCliente()
    {
        return $this->idTreinoCliente;
    }

    public function getIdTreinoSistema()
    {
        return $this->idTreinoSistema;
    }

    public function setIdTreinoSistema($idTreinoSistema)
    {
        $this->idTreinoSistema = $idTreinoSistema;
        return $this;
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

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}