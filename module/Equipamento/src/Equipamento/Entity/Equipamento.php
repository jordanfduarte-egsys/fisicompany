<?php

namespace Equipamento\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Equipamento
 *
 * @ORM\Table(name="equipamento")
 * @ORM\Entity
 */
class Equipamento
{
    use \Base\Entity\TraitEntity;
    /**
     * @var integer
     *
     * @ORM\Column(name="id_equipamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEquipamento;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd", type="integer", nullable=true)
     */
    private $qtd;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255, nullable=true)
     */
    private $marca;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inclusao", type="date", nullable=true)
     */
    private $dataInclusao;
    
    public function __construct() 
    {
        $this->dataInclusao = new \DateTime();
    }

    public function getIdEquipamento()
    {
        return $this->idEquipamento;
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

    public function getQtd()
    {
        return $this->qtd;
    }

    public function setQtd($qtd)
    {
        $this->qtd = $qtd;
        return $this;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
        return $this;
    }

    public function getDataInclusao()
    {
        return $this->dataInclusao;
    }

    public function setDataInclusao(\DateTime $dataInclusao)
    {
        $this->dataInclusao = $dataInclusao;
        return $this;
    }
 
 

   
}