<?php

namespace VeterinariaUnimonte;


class TipoProcedimento extends DbConnect{


    public static function obter_tipo_procedimento(int $COD_TIPO_PROCEDIMENTO): string {

        $db = new DbConnect;
        $tbl_tipo_procedimento = $db->tbl_tipo_procedimento;

        try {
            $stmt = $db->conn->prepare("SELECT DESCRICAO FROM $tbl_tipo_procedimento WHERE COD_TIPO_PROCEDIMENTO = :code LIMIT 1");
            $stmt->bindParam(":code", $COD_TIPO_PROCEDIMENTO, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result['DESCRICAO'];

        } catch (\PDOExcepton $e) {
            return "Error: " . $e->getMessage();
        }


    }


    public static function obter_tipo_procedimentos(): array {

        $db = new DbConnect;
        $tbl_tipo_procedimento = $db->tbl_tipo_procedimento;

        try {
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_tipo_procedimento");
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $result['status'] = true;

        } catch (\PDOExcepton $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;


    }

}