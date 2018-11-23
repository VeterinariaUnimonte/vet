<?php

namespace VeterinariaUnimonte;


class Disponibilidade extends db_connect{


    // Função estatica para adicionar funcionários
    // Params: $disponibilidade_data (ARRAY) um array contendo todas as informações do novo funcionário
    public static function adicionar_disponibilidade(array $disponibilidade_data, int $funcionario_cod): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT

        try {
            // Chamando a classe db_connect
            $db = new db_connect;
            // Puxando a tabela pet da classe db_connect;
            $tbl_disponibilidade = $db->tbl_disponibilidade;


            // Iniciando STATEMENT
            $dias_semana = "";
            $semana = array($disponibilidade_data['domingo'], $disponibilidade_data['segunda'], $disponibilidade_data['terca'], $disponibilidade_data['quarta'], $disponibilidade_data['quinta'], $disponibilidade_data['sexta'], $disponibilidade_data['sabado']);
            foreach ($semana as $dia) {
                if (!empty($dia)) {
                    $dias_semana .= $dia . ", ";
                }
            }

            $dias_semana = substr($dias_semana, 0, -2);


            $stmt = $db->conn->prepare("INSERT INTO $tbl_disponibilidade (COD_FUNCIONARIO, DIAS_SEMANA, HORARIOS, DURACAO, ATENDER_FERIADOS, EXCECOES) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6)");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $funcionario_data
            $stmt->bindParam(':valor1', $funcionario_cod, \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $dias_semana);
            $stmt->bindParam(':valor3', $disponibilidade_data['HORARIOS']);
            $stmt->bindParam(':valor4', $disponibilidade_data['DURACAO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor5', $disponibilidade_data['ATENDER_FERIADOS'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor6', $disponibilidade_data['EXCECOES']);
            // Enviando dados ao banco de dados
            $stmt->execute();

            // STATUS = TRUE (disponibilidade adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Disponibilidade cadastrada com sucesso";

        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar a Disponibilidade ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }



    // Função estatica para alterar funcionários
    // Params: $disponibilidade_cod (INT) código do funcionário, $disponibilidade_data (ARRAY) um array contendo todas as informações do novo funcionário
    public static function alterar_disponibilidade(array $disponibilidade_data, int $funcionario_cod): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT -> DECLARANDO CONEXÃO COM O BANCO DE DADOS E INSERÇÃO DE DADOS

        try {
            // Chamando a classe db_connect
            $db = new db_connect;
            // Puxando a tabela pet da classe db_connect;
            $tbl_disponibilidade = $db->tbl_disponibilidade;



            // Iniciando STATEMENT

            $dias_semana = "";
            $semana = array($disponibilidade_data['domingo'], $disponibilidade_data['segunda'], $disponibilidade_data['terca'], $disponibilidade_data['quarta'], $disponibilidade_data['quinta'], $disponibilidade_data['sexta'], $disponibilidade_data['sabado']);
            foreach ($semana as $dia) {
                if (!empty($dia)) {
                    $dias_semana .= $dia . ", ";
                }
            }

            $dias_semana = substr($dias_semana, 0, -2);



            $stmt = $db->conn->prepare("UPDATE $tbl_disponibilidade SET DIAS_SEMANA = :valor2, HORARIOS = :valor3, DURACAO = :valor4, ATENDER_FERIADOS = :valor5, EXCECOES = :valor6 WHERE COD_FUNCIONARIO = :valor1");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $funcionario_data
            $stmt->bindParam(':valor1', $funcionario_cod, \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $dias_semana);
            $stmt->bindParam(':valor3', $disponibilidade_data['HORARIOS']);
            $stmt->bindParam(':valor4', $disponibilidade_data['DURACAO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor5', $disponibilidade_data['ATENDER_FERIADOS'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor6', $disponibilidade_data['EXCECOES']);
            // Enviando dados ao banco de dados
            $stmt->execute();

            // STATUS = TRUE (disponibilidade adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Disponibilidade alterada com sucesso";

        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o funcionário ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }

    
    // Função estatica para verificar disponibilidade
    // Params: $funcionario_cod (INT) código do funcionário
    public static function verificar_disponibilidade(int $funcionario_cod, array $disponibilidade_data): bool {

        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_disponibilidade = $db->tbl_disponibilidade;

        try {
            // Realizando select puxando as informações do funcionário pelo id dele
            $stmt = $db->conn->prepare("SELECT COUNT(*) FROM $tbl_disponibilidade WHERE COD_FUNCIONARIO = :valor1 AND SEMANA_ANO = :valor2 AND ANO = :valor3 AND MES = :valor4 AND DIA = :valor5 AND HORA = :valor6 LIMIT 1");
            $stmt->bindParam(':valor1', $funcionario_cod, \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $disponibilidade_data['SEMANA_ANO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor3', $disponibilidade_data['ANO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor4', $disponibilidade_data['MES'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor5', $disponibilidade_data['DIA'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor6', $disponibilidade_data['HORA']);

            // Enviando solicitação para o SQL
            $stmt->execute();


            // Verificando disponibilidade
            if ($stmt->fetchColumn() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (\PDOExcepton $e) {
            // Status falso porque não foi possível conectar ao banco de dados
            return False;
        }


    }

    
    // Função estatica para obter certo funcionário
    // Params: $funcionario_cod (INT) código do funcionário
    public static function obter_disponibilidade(int $funcionario_cod): array {


        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_disponibilidade = $db->tbl_disponibilidade;

        try {
            // Realizando select puxando as informações do funcionário pelo id dele
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_disponibilidade WHERE COD_FUNCIONARIO = :funcionario_id");
            $stmt->bindParam(':funcionario_id', $funcionario_cod, \PDO::PARAM_INT);
            // Enviando solicitação para o SQL
            $stmt->execute();
            // Puxando todos as informações do funcionário e colocando elas em um array
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            // Status verdadeiro pois foi possível obter os dados do banco de dados
            $result['status'] = true;

        } catch (\PDOExcepton $e) {
            // Status falso porque não foi possível conectar ao banco de dados
            $result['status'] = false;
            // Porque não foi possivel ao banco de dados?
            $result['message'] = "Error: " . $e->getMessage();
        }

        return $result;


    }






    // Função estatica para deletar animal pelo id e pelo id do dono
    // Params: $funcionario_code (INT) código do funcionário
    public static function deletar_disponibilidade(int $disponibilidade_cod, int $funcionario_cod): array{
        
        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_disponibilidade = $db->tbl_disponibilidade;


        try {
            $stmt = $db->conn->prepare("DELETE FROM $tbl_disponibilidade WHERE COD_DISPONIBILIDADE = :disponibilidade_id AND COD_FUNCIONARIO = :funcionario_id");
            $stmt->bindParam(':disponibilidade_id', $disponibilidade_cod, \PDO::PARAM_INT);
            $stmt->bindParam(':funcionario_id', $funcionario_cod, \PDO::PARAM_INT);
            $stmt->execute();

            $result['status'] = true;
            $result['message'] = "Disponibilidade removida com sucesso";
        } catch (\PDOException $e) {

            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        } 

        return $result;

    }

}