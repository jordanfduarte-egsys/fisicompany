<?php
namespace Log\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * LogUsuario
 *
 * @ORM\Table(name="log_usuario")
 * @ORM\Entity
 */
class LogUsuario
{
    use \Base\Entity\TraitEntity;
    /**
     * @var integer
     *
     * @ORM\Column(name="id_log_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="string", nullable=false)
     */
    private $observacao;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_acao", type="datetime", nullable=false)
     */
    private $dtAcao;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\Usuario", inversedBy="log", cascade={"persist"})
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario", unique=false, nullable=true)
     */
    private $usuario;
    
    /**
     * @var \Usuario\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_acao", referencedColumnName="id_usuario")
     * })
     */
    private $usuarioAcao;
    

    public function __construct()
    {
        $this->dtAcao = new \DateTime();
    }
    public function getId()
    {
        return $this->id;
    }

    public function getObservacao()
    {
        return $this->observacao;
    }

    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getUsuarioAcao()
    {
        return $this->usuarioAcao;
    }

    public function setUsuarioAcao($usuarioAcao)
    {
        $this->usuarioAcao = $usuarioAcao;
        return $this;
    }
  
}