<?php
namespace Base\Service;

class Log
{
    private $serviceManager;
    private $dados = array(
        'id_usuario',
        'mensagem',
        'descricao'
    );


    public function __construct(\Zend\ServiceManager\ServiceManager $sm)
    {
        $this->serviceManager = $sm;
    }

    public function inserir(array $dados)
    {
        $this->dados = array_merge($this->dados, $dados);

        $logName = "data/log/log-" . date("d-m-y");

        if(!is_dir("data/log")) {
            mkdir("data/log", 0777, true);
        }

        $writer = new \Zend\Log\Writer\Stream($logName);
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $log = "\n Usuário: ". $dados['id_usuario'] . "\n";
        $log .= "Mensagem de erro: ". $dados['mensagem'] . "\n";
        $log .= "Descrição: " . $dados['descricao'] . "\n\n";

        $logger->info($log);
    }
}