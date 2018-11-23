<?php

namespace VeterinariaUnimonte;


class Procedimento extends db_connect{


    // Função estatica para adicionar funcionários
    // Params: $funcionario_data (ARRAY) um array contendo todas as informações do novo funcionário
    public static function adicionar_procedimento(array $procedimento_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT

        try {
            // Chamando a classe db_connect
            $db = new db_connect;
            // Puxando a tabela pet da classe db_connect;
            $tbl_procedimento = $db->tbl_procedimento;

            // Iniciando STATEMENT


            $valor = str_replace("R$ ", "", $procedimento_data['VALOR_PROCEDIMENTO']);
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);
            


            $stmt = $db->conn->prepare("INSERT INTO $tbl_procedimento (COD_TIPO_PROCEDIMENTO, DESCRICAO, JEJUM, VALOR_PROCEDIMENTO, OBSERVACAO) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5)");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $funcionario_data
            $stmt->bindParam(':valor1', $procedimento_data['COD_TIPO_PROCEDIMENTO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $procedimento_data['DESCRICAO']);
            $stmt->bindParam(':valor3', $procedimento_data['JEJUM']);
            $stmt->bindParam(':valor4', $valor);
            $stmt->bindParam(':valor5', $procedimento_data['OBSERVACAO']);
            $stmt->execute();
            $result['status'] = true;
            $result['message'] = "Procedimento cadastrado com sucesso";
        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o Procedimento ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }



    // Função estatica para alterar funcionários
    // Params: $funcionario_cod (INT) código do funcionário, $funcionario_data (ARRAY) um array contendo todas as informações do novo funcionário
    public static function alterar_procedimento(int $procedimento_cod, array $procedimento_data): array {


        try {
            // Chamando a classe db_connect
            $db = new db_connect;
            // Puxando a tabela pet da classe db_connect;
            $tbl_procedimento = $db->tbl_procedimento;



            $valor = str_replace("R$ ", "", $procedimento_data['VALOR_PROCEDIMENTO']);
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);

            // Iniciando STATEMENT

            $stmt = $db->conn->prepare("UPDATE $tbl_procedimento SET COD_TIPO_PROCEDIMENTO = :valor1, DESCRICAO = :valor2, JEJUM = :valor3, VALOR_PROCEDIMENTO = :valor4, OBSERVACAO = :valor5 WHERE COD_PROCEDIMENTO = :procedimento_id");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $funcionario_data
            $stmt->bindParam(':valor1', $procedimento_data['COD_TIPO_PROCEDIMENTO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $procedimento_data['DESCRICAO']);
            $stmt->bindParam(':valor3', $procedimento_data['JEJUM']);
            $stmt->bindParam(':valor4', $valor);
            $stmt->bindParam(':valor5', $procedimento_data['OBSERVACAO']);

            $stmt->bindParam(':procedimento_id', $procedimento_cod, \PDO::PARAM_INT);

            $stmt->execute();

            $result['status'] = true;
            $result['message'] = "Procedimento alterado com sucesso";

        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o funcionário ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }




    // Função estatica para obter certo funcionário
    // Params: $funcionario_cod (INT) código do funcionário
    public static function obter_procedimento(int $procedimento_cod): array {


        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_procedimento = $db->tbl_procedimento;

        try {
            // Realizando select puxando as informações do funcionário pelo id dele
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_procedimento WHERE COD_PROCEDIMENTO = :procedimento_cod LIMIT 1");
            $stmt->bindParam(":procedimento_cod", $procedimento_cod, \PDO::PARAM_INT);
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


    public static function obter_procedimentos_por_tipo(int $cod_tipo_procedimento): array {


        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_procedimento = $db->tbl_procedimento;

        try {
            // Realizando select puxando as informações do funcionário pelo id dele
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_procedimento WHERE COD_TIPO_PROCEDIMENTO = :cod_tipo_procedimento");
            $stmt->bindParam(":cod_tipo_procedimento", $cod_tipo_procedimento, \PDO::PARAM_INT);
            // Enviando solicitação para o SQL
            $stmt->execute();
            // Puxando todos as informações do funcionário e colocando elas em um array
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
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


    public static function obter_procedimentos(): array {


        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_procedimento = $db->tbl_procedimento;

        try {
            // Realizando select puxando as informações dos funcionário
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_procedimento");
            // Enviando solicitação para o SQL
            $stmt->execute();
            // Puxando todos as informações dos funcionário e colocando elas em um array
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
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


    public static function deletar_procedimento(int $procedimento_cod): array{
        
        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_procedimento = $db->tbl_procedimento;


        try {
            $stmt = $db->conn->prepare("DELETE FROM $tbl_procedimento WHERE COD_PROCEDIMENTO = :procedimento_cod");
            $stmt->bindParam(':procedimento_cod', $procedimento_cod, \PDO::PARAM_INT);
            $stmt->execute();

            $result['status'] = true;
            $result['message'] = "Procedimento excluido com sucesso";
        } catch (\PDOException $e) {

            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        } 

        return $result;

    }

}