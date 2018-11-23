<?php

namespace VeterinariaUnimonte;


class Animal extends db_connect{


    // Função estatica para adicionar animais
    // Params: $cliente_code (INT) código do cliente, $animal_data (ARRAY) um array contendo todas as informações do novo animal
    public static function adicionar_animal(int $cliente_cod, array $animal_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT

        try {
            // Chamando a classe db_connect
            $db = new db_connect;
            // Puxando a tabela pet da classe db_connect;
            $tbl_pet = $db->tbl_pet;


            // Iniciando STATEMENT

            $stmt = $db->conn->prepare("INSERT INTO $tbl_pet (COD_CLIENTE, NOME_PET, IDADE, SEXO, TIPO, PELAGEM, RACA) VALUES (:valor0, :valor1, :valor2, :valor3, :valor4, :valor5, :valor6)");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $animal_data
            $stmt->bindParam(':valor0', $cliente_cod, \PDO::PARAM_INT);
            $stmt->bindParam(':valor1', $animal_data['NOME_PET']);
            $stmt->bindParam(':valor2', $animal_data['IDADE']);
            $stmt->bindParam(':valor3', $animal_data['SEXO']);
            $stmt->bindParam(':valor4', $animal_data['TIPO']);
            $stmt->bindParam(':valor5', $animal_data['PELAGEM']);
            $stmt->bindParam(':valor6', $animal_data['RACA']);
            // Tabelas em INT precisam ser definidas como Parametro INT
            // Enviando dados ao banco de dados
            $stmt->execute();

            // STATUS = TRUE (animal adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Animal cadastrado com sucesso";

        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o animal ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }



    // Função estatica para alterar animais
    // Params: $cliente_code (INT) código do cliente, $pet_id (INT) código do animal , $animal_data (ARRAY) um array contendo todas as informações do novo animal
    public static function alterar_animal(int $cliente_cod, int $pet_id, array $animal_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT -> DECLARANDO CONEXÃO COM O BANCO DE DADOS E INSERÇÃO DE DADOS

        try {
            // Chamando a classe db_connect
            $db = new db_connect;
            // Puxando a tabela pet da classe db_connect;
            $tbl_pet = $db->tbl_pet;


            // Iniciando STATEMENT

            $stmt = $db->conn->prepare("UPDATE $tbl_pet SET NOME_PET = :valor1, IDADE = :valor2, SEXO = :valor3, TIPO = :valor4, PELAGEM = :valor5, RACA = :valor6 WHERE COD_CLIENTE = :valor7 AND COD_PET = :valor8");
            // bindParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $animal_data
            $stmt->bindParam(':valor1', $animal_data['NOME_PET']);
            $stmt->bindParam(':valor2', $animal_data['IDADE']);
            $stmt->bindParam(':valor3', $animal_data['SEXO']);
            $stmt->bindParam(':valor4', $animal_data['TIPO']);
            $stmt->bindParam(':valor5', $animal_data['PELAGEM']);
            $stmt->bindParam(':valor6', $animal_data['RACA']);
            // Valores em INT precisam ser definidas como Parametro INT
            $stmt->bindParam(':valor7', $cliente_cod, \PDO::PARAM_INT);
            $stmt->bindParam(':valor8', $pet_id, \PDO::PARAM_INT);
            // Enviando dados ao banco de dados
            $stmt->execute();

            // STATUS = TRUE (animal adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Animal alterado com sucesso";

        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o animal ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }




    // Função estatica para obter os animais de certo dono
    // Params: $cliente_code (INT) código do cliente
    public static function obter_animais(int $cliente_cod): array {


        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_pet = $db->tbl_pet;

        try {
            // Realizando select puxando todos os animais pelo id do dono
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_pet WHERE COD_CLIENTE = :cliente_cod");
            $stmt->bindParam(":cliente_cod", $cliente_cod, \PDO::PARAM_INT);
            // Enviando solicitação para o SQL
            $stmt->execute();
            // Puxando todos os animais do dono do banco de dados e colocando eles em um array dentro de um array
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




    // Função estatica para obter o animal de certo dono
    // Params: $cliente_code (INT) código do cliente, $pet_id (INT) código do animal
    public static function obter_animal(int $cliente_cod, int $pet_id): array {


        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_pet = $db->tbl_pet;

        try {
            // Realizando select puxando informações do animal pelo id dele e pelo id do cliente
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_pet WHERE COD_CLIENTE = :cliente_cod AND COD_PET = :pet_cod LIMIT 1");
            $stmt->bindParam(":cliente_cod", $cliente_cod, \PDO::PARAM_INT);
            $stmt->bindParam(":pet_cod", $pet_id, \PDO::PARAM_INT);
            // Enviando solicitação para o SQL
            $stmt->execute();
            // Puxando informações do animal e colocando elas em um array
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
    // Params: $cliente_code (INT) código do cliente, $pet_id (INT) código do pet
    public static function deletar_animal(int $cliente_code, int $pet_id): array{
        
        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_pet = $db->tbl_pet;


        try {
            $stmt = $db->conn->prepare("DELETE FROM $tbl_pet WHERE COD_CLIENTE = :cliente_code AND COD_PET = :code_pet");
            $stmt->bindParam(':cliente_cod', $cliente_code, \PDO::PARAM_INT);
            $stmt->bindParam(':code_pet', $pet_id, \PDO::PARAM_INT);
            $stmt->execute();

            $result['status'] = true;
            $result['message'] = "Animal excludo com sucesso";
        } catch (\PDOException $e) {

            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        } 

        return $result;

    }


    public static function deletar_animal_cliente(int $cliente_code): array{
        
        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_pet = $db->tbl_pet;


        try {
            $stmt = $db->conn->prepare("DELETE FROM $tbl_pet WHERE COD_CLIENTE = :cliente_cod");
            $stmt->bindParam(':cliente_cod', $cliente_code, \PDO::PARAM_INT);
            $stmt->execute();

            $result['status'] = true;
            $result['message'] = "Animal excludo com sucesso";
        } catch (\PDOException $e) {

            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        } 

        return $result;

    }


    // Função estatica para descobrir quantidade de animais de um cliente
    // Params: $cliente_code (INT) código do cliente
    public static function total_de_animais(int $cliente_code): int{
        
        // Chamando a classe db_connect
        $db = new db_connect;
        // Puxando a tabela pet da classe db_connect;
        $tbl_pet = $db->tbl_pet;

        try {

            $stmt = $db->conn->prepare("SELECT COUNT(*) FROM $tbl_pet WHERE COD_CLIENTE = :cliente_cod");
            $stmt->bindParam(':cliente_cod', $cliente_code, \PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            return 0;
        } 

    }
}



