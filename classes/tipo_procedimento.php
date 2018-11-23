<?php

namespace VeterinariaUnimonte;


class Tipo_procedimento extends db_connect{


    public static function obter_tipo_procedimento(int $cod_tipo_procedimento): string {

        $db = new db_connect;
        $tbl_tipo_procedimento = $db->tbl_tipo_procedimento;

        try {
            $stmt = $db->conn->prepare("SELECT DESCRICAO FROM $tbl_tipo_procedimento WHERE COD_TIPO_PROCEDIMENTO = :code LIMIT 1");
            $stmt->bindParam(":code", $cod_tipo_procedimento, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result['DESCRICAO'];

        } catch (\PDOExcepton $e) {
            return "Error: " . $e->getMessage();
        }


    }


    public static function obter_tipo_procedimentos(): array {

        $db = new db_connect;
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