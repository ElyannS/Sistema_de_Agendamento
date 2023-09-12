<?php 
namespace App\Model;

use App\Model\Model;

class Agendamento extends Model {
	
	private $table = "agendamento";
	protected $fields = [
		"id",
		"barbeiro_id",
		"servico_id",
		"data_agendamento",
		"telefone_cliente",
        "nome_cliente"
	];

	function insertAgendamento($campos)
		{
			$this->insert($this->table, $campos);
		}

	function updateAgendamento($valores, $where)
		{	
			$this->update($this->table, $valores, $where);
		}

	function deleteAgendamento($coluna, $valor)
		{
			$this->delete($this->table, $coluna, $valor);
		}
		function selectAgendament($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}
	function selectAgendamento():array
		{
			$sql = "SELECT A.*, B.nome AS nomebarbeiro, S.titulo AS servicoNome FROM agendamento AS A 
			INNER JOIN barbeiros AS B ON B.id = A.barbeiro_id
			INNER JOIN servicos AS S ON S.id = A.servico_id";
			return $this->querySelect($sql);
		}
	function selectAgendamentoData($data): array
		{
			$sql = "SELECT agendamento.*, servicos.titulo AS nome_servico FROM agendamento 
    	    INNER JOIN servicos ON agendamento.servico_id = servicos.id 
	        WHERE DATE(agendamento.data_agendamento) = :data";
			$stmt = $this->querySelect($sql, array(':data' => $data));
			return $stmt;

		}

	function selectAgendamentos($campos, $where):array
		{
			return $this->select($this->table, $campos, $where);
		}
	function getAgendamentoById($id)
		{
		
			$sql = "SELECT * FROM ".$this->table." WHERE id = :id";
			$stmt = $this->querySelect($sql, array(':id' => $id));
			return $stmt;
		}

    function getAgendamentosByDataHora($dataHora)
		{
			$sql = "SELECT * FROM ".$this->table." WHERE data_agendamento IN (:data, :proxima_data)";
			$stmt = $this->querySelect($sql, array(':data' => $dataHora, ':proxima_data' => date('Y-m-d H:i', strtotime('+30 minutes', strtotime($dataHora)))));
			return $stmt;
		}


	
	
}