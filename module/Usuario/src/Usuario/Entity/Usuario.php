<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="usuario_id_permissao", columns={"id_permissao"}), @ORM\Index(name="usuario_id_plano", columns={"id_plano"}), @ORM\Index(name="usuario_id_treino", columns={"id_treino"})})
 * @ORM\Entity
 */
class Usuario
{
    use \Base\Entity\TraitEntity;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome = '';

    /**
     * @var string
     *
     * @ORM\Column(name="sobre_nome", type="string", length=255, nullable=false)
     */
    private $sobreNome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=100, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var \Permissao\Entity\Permissao
     *
     * @ORM\ManyToOne(targetEntity="\Permissao\Entity\Permissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_permissao", referencedColumnName="id_permissao")
     * })
     */
    private $idPermissao;

    /**
     * @var \Plano\Entity\Plano
     *
     * @ORM\ManyToOne(targetEntity="\Plano\Entity\Plano")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_plano", referencedColumnName="id_plano")
     * })
     */
    private $idPlano;

    /**
     * @var \TreinoCliente\Entity\TreinoCliente
     *
     * @ORM\ManyToOne(targetEntity="\TreinoCliente\Entity\TreinoCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_treino", referencedColumnName="id_treino_cliente")
     * })
     */
    private $idTreino;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_cadastro", type="datetime", nullable=true)
     */
    private $dtCadastro;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cod_ativacao", type="string", length=255, nullable=true)
     */
    private $codAtivacao;
    
    /**     
     * @var \Doctrine\Common\Collections\ArrayCollection;
     *  
     * @ORM\OneToMany(targetEntity="Log\Entity\LogUsuario", mappedBy="usuario", cascade={"persist"})
     */
    private $log;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;    
    
    public function __construct(array $options = array())
    {
        if($options) {
            (new Hydrator\ClassMethods)->hydrate($options, $this);
        }
        
        $this->log = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dtCadastro = new \DateTime();
        $this->status = 0;
    }
    
    public function getIdUsuario()
    {
        return $this->id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($idUsuario) {
        $this->id = $idUsuario;
        return $this;
    }

    public function getIdUsuarioSistema() {
        return $this->idUsuarioSistema;
    }

    public function setIdUsuarioSistema($idUsuarioSistema) {
        $this->idUsuarioSistema = $idUsuarioSistema;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getSobreNome() {
        return $this->sobreNome;
    }

    public function setSobreNome($sobreNome) {
        $this->sobreNome = $sobreNome;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $senha = md5($senha);
        $this->senha = $senha;
        return $this;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }  

    public function getIdPermissao() {
        return $this->idPermissao;
    }

    public function setIdPermissao($idPermissao) {
        $this->idPermissao = $idPermissao;
        return $this;
    }

    public function getIdPlano() {
        return $this->idPlano;
    }

    public function setIdPlano($idPlano) {
        $this->idPlano = $idPlano;
        return $this;
    }

    public function getIdTreino() {
        return $this->idTreino;
    }

    public function setIdTreino($idTreino) {
        $this->idTreino = $idTreino;
        return $this;
    }

    public function getDtCadastro()
    {
        return $this->dtCadastro;
    }

    public function setDtCadastro(\DateTime $dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
        return $this;
    }

    public function getCodAtivacao()
    {
        return $this->codAtivacao;
    }

    public function setCodAtivacao($codAtivacao)
    {
        $this->codAtivacao = $codAtivacao;
        return $this;
    }

    public function getLog()
    {
        return $this->log;
    }

    public function setLog($log)
    {
        $this->log = $log;
        return $this;
    }
    
    public function addLog(\Log\Entity\LogUsuario $log)
    {
        $log->setUsuario($this);
        $this->log[] = $log;
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