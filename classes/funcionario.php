<?php

namespace VeterinariaUnimonte;


class Funcionario extends DbConnect{


    // Função estatica para adicionar funcionários
    // Params: $funcionario_data (ARRAY) um array contendo todas as informações do novo funcionário
    public static function adicionar_funcionario(array $funcionario_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT

        try {
            // Chamando a classe DbConnect
            $db = new DbConnect;
            // Puxando a tabela pet da classe DbConnect;
            $tbl_funcionario = $db->tbl_funcionario;

            $stmt_check = $db->conn->prepare("SELECT COUNT(*) FROM $tbl_funcionario WHERE CPF = :cpf");
            $stmt_check->bindParam(':cpf', $funcionario_data['CPF']);
            $stmt_check->execute();

            if ($stmt_check->fetchColumn() > 0) {
                $result['status'] = false;
                $result['message'] = "Esse CPF já está cadastrado em um dos nossos funcionários.";
            } else {

            // Iniciando STATEMENT

            $stmt = $db->conn->prepare("INSERT INTO $tbl_funcionario (COD_ESPECIALIDADE, NOME_FUNCIONARIO, CPF, RG, TELEFONE, TIPO, EMAIL) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6, :valor7)");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $funcionario_data
            $stmt->bindParam(':valor1', $funcionario_data['COD_ESPECIALIDADE'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $funcionario_data['NOME_FUNCIONARIO']);
            $stmt->bindParam(':valor3', $funcionario_data['CPF']);
            $stmt->bindParam(':valor4', $funcionario_data['RG']);
            $stmt->bindParam(':valor5', $funcionario_data['TELEFONE']);
            $stmt->bindParam(':valor6', $funcionario_data['TIPO']);
            $stmt->bindParam(':valor7', $funcionario_data['EMAIL']);
            // Enviando dados ao banco de dados
            $stmt->execute();


            $stmt2 = $db->conn->prepare("SELECT COD_FUNCIONARIO FROM $tbl_funcionario WHERE CPF = :cpf LIMIT 1");
            $stmt2->bindParam(':cpf', $funcionario_data['CPF']);
            $stmt2->execute();


            $result['funcionario_id'] = $stmt2->fetch(\PDO::FETCH_ASSOC)['COD_FUNCIONARIO'];


            // STATUS = TRUE (funcionário adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Funcionário cadastrado com sucesso";
            }
        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o Funcionário ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }



    // Função estatica para alterar funcionários
    // Params: $funcionario_cod (INT) código do funcionário, $funcionario_data (ARRAY) um array contendo todas as informações do novo funcionário
    public static function alterar_funcionario(int $funcionario_cod, array $funcionario_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT -> DECLARANDO CONEXÃO COM O BANCO DE DADOS E INSERÇÃO DE DADOS

        try {
            // Chamando a classe DbConnect
            $db = new DbConnect;
            // Puxando a tabela pet da classe DbConnect;
            $tbl_funcionario = $db->tbl_funcionario;


            // Iniciando STATEMENT

            $stmt = $db->conn->prepare("UPDATE $tbl_funcionario SET COD_ESPECIALIDADE = :valor1, NOME_FUNCIONARIO = :valor2, CPF = :valor3, RG = :valor4, TELEFONE = :valor5, TIPO = :valor6, EMAIL = :valor7 WHERE COD_FUNCIONARIO = :funcionario_id");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $funcionario_data
            $stmt->bindParam(':valor1', $funcionario_data['COD_ESPECIALIDADE'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $funcionario_data['NOME_FUNCIONARIO']);
            $stmt->bindParam(':valor3', $funcionario_data['CPF']);
            $stmt->bindParam(':valor4', $funcionario_data['RG']);
            $stmt->bindParam(':valor5', $funcionario_data['TELEFONE']);
            $stmt->bindParam(':valor6', $funcionario_data['TIPO']);
            $stmt->bindParam(':valor7', $funcionario_data['EMAIL']);
            // Valores em INT precisam ser definidas como Parametro INT
            $stmt->bindParam(':funcionario_id', $funcionario_cod, \PDO::PARAM_INT);
            // Enviando dados ao banco de dados
            $stmt->execute();

            // STATUS = TRUE (funcionário adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Funcionário alterado com sucesso";

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
    public static function obter_funcionario(int $funcionario_cod): array {


        // Chamando a classe DbConnect
        $db = new DbConnect;
        // Puxando a tabela pet da classe DbConnect;
        $tbl_funcionario = $db->tbl_funcionario;

        try {
            // Realizando select puxando as informações do funcionário pelo id dele
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_funcionario WHERE COD_FUNCIONARIO = :funcionario_cod LIMIT 1");
            $stmt->bindParam(":funcionario_cod", $funcionario_cod, \PDO::PARAM_INT);
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


    public static function obter_funcionarios(): array {


        // Chamando a classe DbConnect
        $db = new DbConnect;
        // Puxando a tabela pet da classe DbConnect;
        $tbl_funcionario = $db->tbl_funcionario;

        try {
            // Realizando select puxando as informações dos funcionário
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_funcionario");
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



    // Função estatica para deletar animal pelo id e pelo id do dono
    // Params: $funcionario_code (INT) código do funcionário
    public static function deletar_funcionario(int $funcionario_code): array{
        
        // Chamando a classe DbConnect
        $db = new DbConnect;
        // Puxando a tabela pet da classe DbConnect;
        $tbl_funcionario = $db->tbl_funcionario;


        try {
            $stmt = $db->conn->prepare("DELETE FROM $tbl_funcionario WHERE COD_FUNCIONARIO = :funcionario_code");
            $stmt->bindParam(':funcionario_code', $funcionario_code, \PDO::PARAM_INT);
            $stmt->execute();

            $result['status'] = true;
            $result['message'] = "Funcionário excluido com sucesso";
        } catch (\PDOException $e) {

            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        } 

        return $result;

    }

}