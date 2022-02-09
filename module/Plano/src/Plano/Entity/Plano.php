<?php

namespace Plano\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Plano
 *
 * @ORM\Table(name="plano")
 * @ORM\Entity
 */
class Plano
{
    use \Base\Entity\TraitEntity;
    /**
     * @var integer
     *
     * @ORM\Column(name="id_plano", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPlano;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_plano", type="string", length=255, nullable=true)
     */
    private $descPlano;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd_dias", type="integer", nullable=true)
     */
    private $qtdDias;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $valor;

    public function setIdPlano($idPlano)
    {
        $this->idPlano = $idPlano;
        return $this;
    }

    public function getIdPlano()
    {
        return $this->idPlano;
    }

    public function setDescPlano($descPlano)
    {
        $this->descPlano = $descPlano;
        return $this;
    }

    public function getDescPlano()
    {
        return $this->descPlano;
    }

    public function setQtdDias($qtdDias)
    {
        $this->qtdDias = $qtdDias;
        return $this;
    }

    public function getQtdDias()
    {
        return $this->qtdDias;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    public function getValor()
    {
        return $this->valor;
    }

}