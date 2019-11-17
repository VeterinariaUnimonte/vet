<?php
namespace VeterinariaUnimonte;
class DbConnectSqlServer {

    public $conn;
    public $tbl_pet;
    public $tbl_cliente;
    public $tbl_funcionario;
    public $tbl_procedmento;
    public $tbl_disponilidade;
    public $tbl_especialidade;
    public $tbl_agendamento;
    public $tbl_tipo_procedimento;
    
    // Extensões necessárias: extension=php_pdo_sqlsrv_7_ts_x86.dll \
    //                        extension=php_sqlsrv_7_ts_x86.dll
    
    public function __construct() {
 
    
        $this->tbl_pet = "tab_pet";
        $this->tbl_cliente = "tab_cliente";
        $this->tbl_funcionario = "tab_funcionario";
        $this->tbl_procedimento = "tab_procedimento";
        $this->tbl_disponibilidade = "tab_disponibilidade";
        $this->tbl_especialidade = "tab_especialidade";
        $this->tbl_agendamento = "tab_agendamento";
        $this->tbl_tipo_procedimento = "tab_tipo_procedimento";
        if (file_exists('./conf/database.php')) {
            require './conf/database.php';
        } else {
            require '../conf/database.php';
        }
        $db_driver = "sqlsrv";
        $host = $conf['server'];
        $db_name = $conf['db_name'];
        $username = $conf['db_user'];
        $password = $conf['db_password'];
        try {
        
            $this->conn = new \PDO($db_driver . ":" . "Server=" . $host . ";" . "Database=" . $db_name . ";", $username, $password);
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
