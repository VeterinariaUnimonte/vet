<?php

namespace VeterinariaUnimonte;


class ExameFisico extends DbConnect{

    public static function adicionar_exame_fisico(array $input, int $cod_agendamento): array {

        try {
            $db = new DbConnect;
            $tbl_exame_fisico = $db->tbl_exame_fisico;

            $stmt = $db->conn->prepare("INSERT INTO $tbl_exame_fisico (COD_AGENDAMENTO, MUCOSAS, HIDRATACAO, LINFONODOS, TEMPERATURA, PALPACAO_ABD, ACP, POSTURA, CONSCIENCIA, OBS_GERAIS, EXAMES_COMP, DIAGNOSTICO, TRATAMENTO, PRESCRITO) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6, :valor7, :valor8, :valor9, :valor10, :valor11, :valor12, :valor13, :valor14)");
            $stmt->bindParam(':valor1', $cod_agendamento, \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $input['MUCOSAS']);
            $stmt->bindParam(':valor3', $input['HIDRATACAO']);
            $stmt->bindParam(':valor4', $input['LINFONODOS']);
            $stmt->bindParam(':valor5', $input['TEMPERATURA']);
            $stmt->bindParam(':valor6', $input['PALPACAO_ABD']);
            $stmt->bindParam(':valor7', $input['ACP']);
            $stmt->bindParam(':valor8', $input['POSTURA']);
            $stmt->bindParam(':valor9', $input['CONSCIENCIA']);
            $stmt->bindParam(':valor10', $input['OBS_GERAIS']);
            $stmt->bindParam(':valor11', $input['EXAMES_COMP']);
            $stmt->bindParam(':valor12', $input['DIAGNOSTICO']);
            $stmt->bindParam(':valor13', $input['TRATAMENTO']);
            $stmt->bindParam(':valor14', $input['PRESCRITO']);
            $stmt->execute();
            $result['status'] = true;
            $result['message'] = "Exame fisico cadastrada com sucesso";

        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }


    public static function obter_exame_fisico(int $cod_agendamento): array {

        $db = new DbConnect;
        $tbl_exame_fisico = $db->tbl_exame_fisico;

        try {
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_exame_fisico WHERE COD_AGENDAMENTO = :code LIMIT 1");
            $stmt->bindParam(":code", $cod_agendamento, \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(\PDO::FETCH_ASSOC);
                $result['status'] = true;
            } else {
                $result['status'] = false;
                $result['message'] = "Nenhum exame fisico encontrado para esse agendamento";
            }
        } catch (\PDOExcepton $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }

        return $result;


    }

}