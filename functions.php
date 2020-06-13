<?php
	function get_json($request) {
		$json = file_get_contents($request);
		return json_decode($json);
	}

	function get_marcas($tipo) {
		$json = file_get_contents( 'http://fipeapi.appspot.com/api/1/' . $tipo . '/marcas.json' );
		return json_decode($json);
	}

	function get_marca_id($marca) {
		$marca_explode = explode('|', $marca);
		return $marca_explode[0];
	}	

	function get_marca_nome($marca) {
		$marca_explode = explode('|', $marca);
		return $marca_explode[1];
	}

	function get_veiculos($tipo, $marca) {
		$json = file_get_contents( 'http://fipeapi.appspot.com/api/1/' . $tipo . '/veiculos/' . $marca . '.json' );
		return json_decode($json);
	}

	function get_veiculo_id($veiculo) {
		$veiculo_explode = explode('|', $veiculo);
		return $veiculo_explode[0];
	}

	function get_veiculo_nome($veiculo) {
		$veiculo_explode = explode('|', $veiculo);
		return $veiculo_explode[1];
	}

	function get_modelos($tipo, $marca, $veiculo) {
		$json = file_get_contents( 'http://fipeapi.appspot.com/api/1/' . $tipo . '/veiculo/' . $marca . '/' . $veiculo . '.json' );
		return json_decode($json);
	}

	function get_preco($tipo, $marca_id, $veiculo_id, $modelo) {
		$json = file_get_contents( 'http://fipeapi.appspot.com/api/1/' . $tipo . '/veiculo/' . $marca_id . '/' . $veiculo_id . '/' . $modelo . '.json' );
		return json_decode($json);
	}
?>