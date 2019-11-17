<?php

namespace VeterinariaUnimonte;


class Cliente extends DbConnect{


    // Função estatica para adicionar animais
    // Params: $cliente_code (INT) código do cliente, $cliente_data (ARRAY) um array contendo todas as informações do novo cliente
    public static function adicionar_cliente(array $cliente_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT

        try {
            // Chamando a classe DbConnect
            $db = new DbConnect;
            // Puxando a tabela pet da classe DbConnect;
            $tbl_cliente = $db->tbl_cliente;


            $stmt_check = $db->conn->prepare("SELECT COUNT(*) FROM $tbl_cliente WHERE CPF = :cpf");
            $stmt_check->bindParam(':cpf', $cliente_data['CPF']);
            $stmt_check->execute();

            if ($stmt_check->fetchColumn() > 0) {
                $result['status'] = false;
                $result['message'] = "Esse CPF já está cadastrado em um dos nossos clientes.";
            } else {

            $endereco = $cliente_data['RUA'] . " " . $cliente_data['NUMERO']; 


            // Iniciando STATEMENT
              
            $stmt = $db->conn->prepare("INSERT INTO $tbl_cliente (NOME_CLIENTE, CPF, RG, CEP, ENDERECO, BAIRRO, CIDADE, UF, TELEFONE, EMAIL) VALUES (:valor1, :valor2, :valor3, :valorX, :valor4, :valor5, :valor6, :valor7, :valor8, :valor9)");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $cliente_data
            $stmt->bindParam(':valor1', $cliente_data['NOME_CLIENTE']);
            $stmt->bindParam(':valor2', $cliente_data['CPF']);
            $stmt->bindParam(':valor3', $cliente_data['RG']);
            $stmt->bindParam(':valorX', $cliente_data['CEP']);
            $stmt->bindParam(':valor4', $endereco);
            $stmt->bindParam(':valor5', $cliente_data['BAIRRO']);
            $stmt->bindParam(':valor6', $cliente_data['CIDADE']);
            $stmt->bindParam(':valor7', $cliente_data['UF']);
            $stmt->bindParam(':valor8', $cliente_data['TELEFONE']);
            $stmt->bindParam(':valor9', $cliente_data['EMAIL']);
            // Enviando dados ao banco de dados
            $stmt->execute();

            //Puxando id do cliente cadastrado no banco de dados
            $stmt2 = $db->conn->prepare("SELECT COD_CLIENTE FROM $tbl_cliente WHERE CPF = :cpf LIMIT 1");
            $stmt2->bindParam(':cpf', $cliente_data['CPF']);
            $stmt2->execute();


            $result['cliente_id'] = $stmt2->fetch(\PDO::FETCH_ASSOC)['COD_CLIENTE']; 


            // STATUS = TRUE (cliente adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Cliente cadastrado com sucesso";
            }

        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o cliente ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }



    // Função estatica para alterar clientes
    // Params: $cliente_code (INT) código do cliente, $cliente_data (ARRAY) um array contendo todas as informações do novo cliente
    public static function alterar_cliente(int $cliente_cod, array $cliente_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT -> DECLARANDO CONEXÃO COM O BANCO DE DADOS E INSERÇÃO DE DADOS

        try {
            // Chamando a classe DbConnect
            $db = new DbConnect;
            // Puxando a tabela pet da classe DbConnect;
            $tbl_cliente = $db->tbl_cliente;


            // Iniciando STATEMENT

            $endereco = $cliente_data['RUA'] . " " . $cliente_data['NUMERO']; 

            $stmt = $db->conn->prepare("UPDATE $tbl_cliente SET NOME_CLIENTE = :valor1, CPF = :valor2, RG = :valor3, CEP = :valorX, ENDERECO = :valor4, BAIRRO = :valor5, CIDADE = :valor6, UF = :valor7, TELEFONE = :valor8, EMAIL = :valor9 WHERE COD_CLIENTE = :cliente_id");
            // binParam -> método seguro para inserir dados no banco de dados sem correr riscos de SQL Injection, substituindo os :{valores} pelos valores contidos no array $cliente_data
            $stmt->bindParam(':valor1', $cliente_data['NOME_CLIENTE']);
            $stmt->bindParam(':valor2', $cliente_data['CPF']);
            $stmt->bindParam(':valor3', $cliente_data['RG']);
            $stmt->bindParam(':valorX', $cliente_data['CEP']);
            $stmt->bindParam(':valor4', $endereco);
            $stmt->bindParam(':valor5', $cliente_data['BAIRRO']);
            $stmt->bindParam(':valor6', $cliente_data['CIDADE']);
            $stmt->bindParam(':valor7', $cliente_data['UF']);
            $stmt->bindParam(':valor8', $cliente_data['TELEFONE']);
            $stmt->bindParam(':valor9', $cliente_data['EMAIL']);
            // Valores em INT precisam ser definidas como Parametro INT
            $stmt->bindParam(':cliente_id', $cliente_cod, \PDO::PARAM_INT);
            // Enviando dados ao banco de dados
            $stmt->execute();

            // STATUS = TRUE (cliente alterado com sucesso)
            $result['status'] = true;
            $result['message'] = "Cliente alterado com sucesso";

        } catch (\PDOException $e) {
            // STATUS = FALSE (ocorreu um erro ao adicionar o cliente ao banco de dados)
            $result['status'] = false;
            // MENSAGEM DE ERRO
            $result['message'] = "Error: " . $e->getMessage();
        }
        // RETORNANDO O status junto com a mensagem
        return $result;
    }




    // Função estatica para obter certo cliente
    // Params: $cliente_code (INT) código do cliente
    public static function obter_cliente(int $cliente_cod): array {


        // Chamando a classe DbConnect
        $db = new DbConnect;
        // Puxando a tabela pet da classe DbConnect;
        $tbl_cliente = $db->tbl_cliente;

        try {
            // Realizando select puxando as informações do cliente pelo id dele
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_cliente WHERE COD_CLIENTE = :cliente_cod LIMIT 1");
            $stmt->bindParam(":cliente_cod", $cliente_cod, \PDO::PARAM_INT);
            // Enviando solicitação para o SQL
            $stmt->execute();
            // Puxando todos as informações do cliente e colocando eles em um array
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


    // Função estatica para obter clientes
    // Params: Nenhum
    public static function obter_clientes(): array {


        // Chamando a classe DbConnect
        $db = new DbConnect;
        // Puxando a tabela pet da classe DbConnect;
        $tbl_cliente = $db->tbl_cliente;

        try {
            // Realizando select puxando as informações dos clientes
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_cliente ORDER BY CADASTRO DESC");
            // Enviando solicitação para o SQL
            $stmt->execute();
            // Puxando todos as informações dos clientes
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




    
    
    // Função estatica para deletar cliente pelo id
    // Params: $cliente_code (INT) código do cliente
    public static function deletar_cliente(int $cliente_code): array{
        
        // Chamando a classe DbConnect
        $db = new DbConnect;
        // Puxando a tabela pet da classe DbConnect;
        $tbl_cliente = $db->tbl_cliente;


        try {


            $stmt_check = $db->conn->prepare("SELECT COUNT(*) FROM $tbl_cliente WHERE COD_CLIENTE = :cliente_cod");
            $stmt_check->bindParam(':cliente_cod', $cliente_code, \PDO::PARAM_INT);
            $stmt_check->execute();

            if ($stmt_check->fetchColumn() == 0) {
                $result['status'] = false;
                $result['message'] = "Esse cliente não existe ou acabou de ser removido.";
            } else {


            $stmt = $db->conn->prepare("DELETE FROM $tbl_cliente WHERE COD_CLIENTE = :cliente_cod");
            $stmt->bindParam(':cliente_cod', $cliente_code, \PDO::PARAM_INT);
            $stmt->execute();


            

            $result['status'] = true;
            $result['message'] = "Cliente excludo com sucesso";
            }
        } catch (\PDOException $e) {

            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        } 

        return $result;

    }

}