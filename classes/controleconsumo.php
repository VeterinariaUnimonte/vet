<?php

namespace VeterinariaUnimonte;


class ControleConsumo extends DbConnect{

    public static function adicionar_item_consumo(array $input): array {

        try {
            $db = new DbConnect;
            $tbl_controque_consumo = $db->tbl_controque_consumo;

            $stmt = $db->conn->prepare("INSERT INTO $tbl_controque_consumo (NOME_ITEM, QUANTIDADE) VALUES (:valor1, :valor2)");
            $stmt->bindParam(':valor1', $input['NOME_ITEM']);
            $stmt->bindParam(':valor2', $input['QUANTIDADE'], \PDO::PARAM_INT);
            $stmt->execute();
            $result['status'] = true;
            $result['message'] = "Item cadastrada com sucesso";

        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }


    public static function obter_consumo(): array {

        $db = new DbConnect;
        $tbl_controque_consumo = $db->tbl_controque_consumo;

        try {
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_controque_consumo ORDER BY COD_ITEM ASC");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $result['status'] = true;
            } else {
                $result['status'] = false;
            }
        } catch (\PDOExcepton $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }

        return $result;

    }


    public static function deletar_item_consumo(int $cod_item): array{
        
        $db = new DbConnect;
        $tbl_controque_consumo = $db->tbl_controque_consumo;

        try {
            $stmt = $db->conn->prepare("DELETE FROM $tbl_controque_consumo WHERE COD_ITEM = :code");
            $stmt->bindParam(':code', $cod_item, \PDO::PARAM_INT);
            $stmt->execute();
            $result['status'] = true;
            $result['message'] = "Item excluido com sucesso";
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        } 

        return $result;

    }

}