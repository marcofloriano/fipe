<?php
	/**
	 * Classe para consulta da API JSON de valores de veículos da tabela FIPE
	 * Por Marco Floriano em 11/07/2020
	 */		
	class Consulta
	{
		public $tipoVeiculo;
		const JSON_BASE_URL = "http://fipeapi.appspot.com/api/1/";

		public function __construct($tipoVeiculo)
		{
			$this->tipo = $tipoVeiculo;
		}

		public function baseUrl() {
			return self::JSON_BASE_URL;
		}

		private function getJson($request)
		{
			$json = file_get_contents($request);
			return json_decode($json);
		}

		public function getMarcas()
		{
			 $marcas = $this->getJson($this->baseUrl() . $this->tipo . '/marcas.json');
			 return $marcas;
		}
	}

	$novaConsula = new Consulta("Carros");
	echo "<br>";
	var_dump ($novaConsula->getMarcas());
	
?>