<?php
	require __DIR__ . '/vendor/autoload.php';
	include('consulta.php');
	include('formulario.php');
	

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	$request = Request::createFromGlobals();
	$response = new Response();

	$form = new Formulario();
?>
<!DOCTYPE html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="styles.css">
	<script src="javascript.js"></script>
</head>
<html>
<body>
	<div class="main">		
		<h1><a href='index.php'>Consulta FIPE</a></h1>
		<?php
		
		/* Debug */
		try {

			//dump($_GET['name']);
			//dump($request->query->get('name'));
			//dump($request);
			//dump($request->query->all());

			//$response->setContent("Hello World!");
			// $response->prepare($request);
			// $response->send();

		} catch (Exception $e) {

			echo $e->getMessage();

		}

		/* Consulta FIPE */

		if( $request->query->get('tipo') && !$request->query->get('marca') ) {
			$form->marcaDoVeiculo( $request->query->get('tipo') );
		}

		elseif( $request->query->get('tipo') && $request->query->get('marca') && !$request->query->get('veiculo') ) { 
			$tipo = $request->query->get('tipo');
			$novaConsula = new Consulta($tipo);
			$marca_id = $novaConsula->getMarcaId($request->query->get('marca'));
			$marca_nome = $novaConsula->getMarcaNome($request->query->get('marca'));

			$form->nomeDoVeiculo($tipo, $marca_id, $marca_nome, $novaConsula);				
		}

		elseif( $request->query->get('tipo') && $request->query->get('marca') && $request->query->get('veiculo') && !$request->query->get('modelo') ) { 
			$tipo = $request->query->get('tipo');
			$novaConsula = new Consulta($tipo);
			$marca_id = $novaConsula->getMarcaId($request->query->get('marca'));
			$marca_nome = $novaConsula->getMarcaNome($request->query->get('marca'));
			$veiculo_id = $novaConsula->getVeiculoId($request->query->get('veiculo'));
			$veiculo_nome = $novaConsula->getVeiculoNome($request->query->get('veiculo'));

			$form->modeloDoVeiculo($tipo, $marca_id, $marca_nome, $veiculo_id, $veiculo_nome, $novaConsula );
		} 

		elseif( $request->query->get('tipo') && $request->query->get('marca') && $request->query->get('veiculo') && $request->query->get('modelo') ) { 
			$tipo = $request->query->get('tipo');
			$modelo = $request->query->get('modelo');
			$novaConsula = new Consulta($tipo);
			$marca_id = $novaConsula->getMarcaId($request->query->get('marca'));				
			$veiculo_id = $novaConsula->getVeiculoId($request->query->get('veiculo'));

			$form->resultado($tipo, $modelo, $novaConsula, $marca_id, $veiculo_id);
			
		} 

		else { 
			
			$form->tipoDeVeiculo(); 
		} 

		?>
	</div>
</body>
</html>