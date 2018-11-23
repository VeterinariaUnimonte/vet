<?php

namespace VeterinariaUnimonte;


class Especialidade extends db_connect{


    public static function obter_especialidade(int $cod_especialidade): string {

        $db = new db_connect;
        $tbl_especialidade = $db->tbl_especialidade;

        try {
            $stmt = $db->conn->prepare("SELECT DESCRICAO FROM $tbl_especialidade WHERE COD_ESPECIALIDADE = :code LIMIT 1");
            $stmt->bindParam(":code", $cod_especialidade, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result['DESCRICAO'];

        } catch (\PDOExcepton $e) {
            return "Error: " . $e->getMessage();
        }


    }


    public static function obter_especialidades(): array {

        $db = new db_connect;
        $tbl_especialidade = $db->tbl_especialidade;

        try {
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_especialidade");
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