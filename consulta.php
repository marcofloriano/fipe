<?php	
	/**
	 * Classe para consulta da API JSON de valores de veículos da tabela FIPE
	 * Por Marco Floriano em 11/07/2020
	 * http://fipeapi.appspot.com/
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

		public function getMarcaId($marca)
		{
			$marca_explode = explode('|', $marca);
			return $marca_explode[0];
		}

		public function getMarcaNome($marca)
		{
			$marca_explode = explode('|', $marca);
			return $marca_explode[1];
		}

		public function getVeiculos($marca)
		{
			$veiculos = $this->getJson($this->baseURL() . $this->tipo . '/veiculos/' . $marca . '.json');
			return $veiculos;
		}

		public function getVeiculoId($veiculo)
		{
			$veiculo_explode = explode('|', $veiculo);
			return $veiculo_explode[0];
		}

		public function getVeiculoNome($veiculo)
		{
			$veiculo_explode = explode('|', $veiculo);
			return $veiculo_explode[1];
		}

		public function getModelos($marca, $veiculo)
		{
			$modelos = $this->getJson($this->baseURL() . $this->tipo . '/veiculo/' . $marca . '/' . $veiculo . '.json' );
			return $modelos;
		}

		public function getResultado($marca_id, $veiculo_id, $modelo)
		{
			$resultado = $this->getJson($this->baseURL() . $this->tipo . '/veiculo/' . $marca_id . '/' . $veiculo_id . '/' . $modelo . '.json' );
			return $resultado;
		}
	}

?>