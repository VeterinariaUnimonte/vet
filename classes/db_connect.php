<?php

namespace VeterinariaUnimonte;


class db_connect {

    private $db_name;

    private $host;

    private $username;

    private $password;

    public $conn;


    public $tbl_pet;

    public $tbl_cliente;

    public $tbl_funcionario;

    public $tbl_procedmento;

    public $tbl_disponilidade;

    public $tbl_especialidade;

    public $tbl_agendamento;

    public $tbl_tipo_procedimento;




    public function __construct() {

 
    
        $this->tbl_pet = "TAB_PET";
        $this->tbl_cliente = "TAB_CLIENTE";
        $this->tbl_funcionario = "TAB_FUNCIONARIO";
        $this->tbl_procedimento = "TAB_PROCEDIMENTO";
        $this->tbl_disponibilidade = "TAB_DISPONIBILIDADE";
        $this->tbl_especialidade = "TAB_ESPECIALIDADE";
        $this->tbl_agendamento = "TAB_AGENDAMENTO";
        $this->tbl_tipo_procedimento = "TAB_TIPO_PROCEDIMENTO";


        if (file_exists('./conf/database.php')) {
            require './conf/database.php';
        } else {
            require '../conf/database.php';
        }


        $host = $conf['server'];
        $db_name = $conf['db_name'];
        $username = $conf['db_user'];
        $password = $conf['db_password'];

        try {
            $this->conn = new \PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $username, $password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    // Destruir conexão
    public function __destruct() {
        $this->conn = null;
    }

}
