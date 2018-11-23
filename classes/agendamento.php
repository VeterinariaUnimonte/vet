<?php

namespace VeterinariaUnimonte;


class Agendamento extends db_connect{




    public static function listar_horarios(int $cod_funcionario, string $date): array {

        $horarios_reservados = self::horarios_nao_disponiveis($cod_funcionario, $date);

        $disponibilidade_funcionario = Disponibilidade::obter_disponibilidade($cod_funcionario);

        $excepts = str_replace(", ", "\n", $disponibilidade_funcionario['EXCECOES']);

        $date_converted = strtotime($date);



        if ($date_converted < strtotime(date('Y-m-d'))) {
            $result['reason'] = "Não é possível agendar nesse dia porque esse dia já passou.";
            return $result;
        }


        $dia_semana = date('w', $date_converted);

        $result['status'] = false;
        if ($disponibilidade_funcionario['ATENDER_FERIADOS'] == 1) {
            $excepts .= "\n" . file_get_contents("../json/feriados.txt");
        }


        if (substr_count($excepts, "\n") > 0) {

            $split_excepts = explode("\n", $excepts);
            foreach ($split_excepts as $except) {

                if ($date == $except) {
                    $result['reason'] = "O funcionário não atende nesse dia porque esse dia é feriado/ocasião especial.";
                    return $result;
                }
            }
        } else if (strlen($excepts) > 0) {
            if ($date == $excepts) {
                $result['reason'] = "O funcionário não atende nesse dia porque esse dia é feriado/ocasião especial.";
                return $result;
            }
        }


        if (substr_count($disponibilidade_funcionario['DIAS_SEMANA'], $dia_semana) == 0) {
            $result['reason'] = "O funcionário não atende nesse dia da semana.";
            return $result;
        }

       $result['html'] = "";  
       if (substr_count($disponibilidade_funcionario['HORARIOS'], ", ") > 0) {
       $work_times = explode(", ", $disponibilidade_funcionario['HORARIOS']);
       foreach ($work_times as $times) {

        $time = explode("-", $times);

        $start_time = strtotime($date . " " . $time[0] . ":00");



        $end_time = strtotime($date . " " . $time[1] . ":00");

        while ($start_time < $end_time) {

            $form_value = date("H:i:s", $start_time);
            $form_text = date("H:i", $start_time);

            if ($horarios_reservados['status'] == true) {
            $exist = array_count_values(array_column($horarios_reservados, 'HORA'));
            if (!isset($exist[$form_value])) {
            //if  ($exist[$form_value] == 0) {
            $result['html'] .= '<option value="'.$form_value.'">'.$form_text.'</option>\n';
            //} 
        }
        } else {
            $result['html'] .= '<option value="'.$form_value.'">'.$form_text.'</option>\n';
        }

            $start_time = strtotime('+'.$disponibilidade_funcionario['DURACAO'].' minutes', $start_time);

        }

       }


    } else {
        $time = explode("-",  $disponibilidade_funcionario['HORARIOS']);

        $start_time = strtotime($date . " " . $time[0] . ":00");



        $end_time = strtotime($date . " " . $time[1] . ":00");

        while ($start_time < $end_time) {

            $form_value = date("H:i:s", $start_time);
            $form_text = date("H:i", $start_time);

            if ($horarios_reservados['status'] == true) {
                $exist = array_count_values(array_column($horarios_reservados, 'HORA'));
                if  ($exist[$form_value] == 0) {
                $result['html'] .= '<option value="'.$form_value.'">'.$form_text.'</option>\n';
                } 
            } else {
                $result['html'] .= '<option value="'.$form_value.'">'.$form_text.'</option>\n';
            }

            $start_time = strtotime('+'.$disponibilidade_funcionario['DURACAO'].' minutes', $start_time);

        }


    }


       if (empty($result['html'])) {
           $result['reason'] = "Nenhum horário está disponível para esse dia.";
           return $result;
       }

        $result['status'] = true;

        return $result;






    }

    public static function horarios_nao_disponiveis(int $cod_funcionario, string $date): array {

        $db = new db_connect;
        $tbl_agendamento = $db->tbl_agendamento;

        try {
            $stmt = $db->conn->prepare("SELECT HORA FROM $tbl_agendamento WHERE COD_FUNCIONARIO = :code AND DATA = :DIA");
            $stmt->bindParam(":code", $cod_funcionario, \PDO::PARAM_INT);
            $stmt->bindParam(":DIA", $date);
            $stmt->execute();
            $totale = $stmt->fetchColumn();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($totale == 0) {
                $result['status'] = false;
            } else {
                $result['status'] = true;
            }

        } catch (\PDOExcepton $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;


    }

     
    public static function obter_agendamentos(int $cod_funcionario): array {

        $db = new db_connect;
        $tbl_agendamento = $db->tbl_agendamento;

        try {
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_agendamento WHERE COD_FUNCIONARIO = :code");
            $stmt->bindParam(":code", $cod_funcionario, \PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $result['status'] = true;

        } catch (\PDOExcepton $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;


    }


    public static function obter_agendamento(int $cod_agendamento): array {

        $db = new db_connect;
        $tbl_agendamento = $db->tbl_agendamento;

        try {
            $stmt = $db->conn->prepare("SELECT * FROM $tbl_agendamento WHERE COD_AGENDAMENTO = :code LIMIT 1");
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





    public static function adicionar_agendamento(array $agendamento_data): array {


        // try: Tentando Conexão / catch: Caso não foi possível (realizar a conexão/inserir os dados), retorna a mensagem de erro junto com um status: false

        // STMT = STATEMENT

        try {
            // Chamando a classe db_connect
            $db = new db_connect;
            // Puxando a tabela pet da classe db_connect;
            $tbl_agendamento = $db->tbl_agendamento;

            $data_split = explode("/", $agendamento_data['DATA']);

            $data = $data_split[2] . "-" . $data_split[1] . "-" . $data_split[0];

            $stmt_check = $db->conn->prepare("SELECT COUNT(*) FROM $tbl_agendamento WHERE COD_FUNCIONARIO = :valor1 AND DATA = :valor2 AND HORA = :valor3");
            $stmt_check->bindParam(':valor1', $agendamento_data['COD_FUNCIONARIO']);
            $stmt_check->bindParam(':valor2', $data);
            $stmt_check->bindParam(':valor3', $agendamento_data['HORA']);
            $stmt_check->execute();

            if ($stmt_check->fetchColumn() > 0) {
                $result['status'] = false;
                $result['message'] = "Esse horário não está disponível.";
            } else {


            $stmt = $db->conn->prepare("INSERT INTO $tbl_agendamento (COD_PROCEDIMENTO, COD_FUNCIONARIO, COD_CLIENTE, DATA, HORA) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5)");
            
            $stmt->bindParam(':valor1', $agendamento_data['COD_PROCEDIMENTO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor2', $agendamento_data['COD_FUNCIONARIO'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor3', $agendamento_data['COD_CLIENTE'], \PDO::PARAM_INT);
            $stmt->bindParam(':valor4', $data);
            $stmt->bindParam(':valor5', $agendamento_data['HORA']);

            $stmt->execute();


            // STATUS = TRUE (funcionário adicionado com sucesso)
            $result['status'] = true;
            $result['message'] = "Agendamento cadastrado com sucesso";
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

}