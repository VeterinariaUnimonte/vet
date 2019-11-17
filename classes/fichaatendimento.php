<?php

namespace VeterinariaUnimonte;


class FichaAtendimento extends DbConnect{

    public static function adicionar_ficha_atendimento(array $input, int $cod_agendamento): array {

        try {
            $db = new DbConnect;
            $tbl_ficha_atendimento = $db->tbl_ficha_atendimento;

            $stmt = $db->conn->prepare("INSERT INTO $tbl_ficha_atendimento (COD_AGENDAMENTO, QUEIXA_PRINCIPAL, MANEJO, ANTECEDENTES_MORBIDOS, INCIDENTES_PREVIOS) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5)");
            $stmt->bindParam(':valor1', $cod_agendamento, \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $input['QUEIXA_PRINCIPAL']);
            $stmt->bindParam(':valor3', $input['MANEJO']);
            $stmt->bindParam(':valor4', $input['ANTECEDENTES_MORBIDOS']);
            $stmt->bindParam(':valor5', $input['INCIDENTES_PREVIOS']);
            $stmt->execute();
            $result['status'] = true;
            $result['message'] = "Ficha de atendimento cadastrada com sucesso";

        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }


    public static function obter_ficha_atendimento(int $cod_agendamento): array {

        $db = new DbConnect;
        $tbl_ficha_atendimento = $db->tbl_ficha_atendimento;

        try {
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_ficha_atendimento WHERE COD_AGENDAMENTO = :code LIMIT 1");
            $stmt->bindParam(":code", $cod_agendamento, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $result['status'] = true;
        } catch (\PDOExcepton $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }

        return $result;


    }

}