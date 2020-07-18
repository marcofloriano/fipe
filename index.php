<?php 
	include('consulta.php');
	include('formulario.php');

	$form = new Formulario();
?>
<!DOCTYPE html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="styles.css">

</head>
<html>
<body>
	<div class="main">		
		<h1><a href='/fipe'>Consulta FIPE</a></h1>
		<?php
			if(isset($_GET["tipo"]) && !isset($_GET["marca"])) {
				$form->marcaDoVeiculo($_GET["tipo"]);
			}

			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && !isset($_GET["veiculo"])) { 
				$tipo = $_GET["tipo"];
				$novaConsula = new Consulta($tipo);
				$marca_id = $novaConsula->getMarcaId($_GET["marca"]);
				$marca_nome = $novaConsula->getMarcaNome($_GET["marca"]);

				$form->nomeDoVeiculo($tipo, $marca_id, $marca_nome, $novaConsula);				
			}

			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && isset($_GET["veiculo"]) && !isset($_GET["modelo"])) { 
				$tipo = $_GET["tipo"];
				$novaConsula = new Consulta($tipo);
				$marca_id = $novaConsula->getMarcaId($_GET["marca"]);
				$marca_nome = $novaConsula->getMarcaNome($_GET["marca"]);
				$veiculo_id = $novaConsula->getVeiculoId($_GET["veiculo"]);
				$veiculo_nome = $novaConsula->getVeiculoNome($_GET["veiculo"]);

				$form->modeloDoVeiculo($tipo, $marca_id, $marca_nome, $veiculo_id, $veiculo_nome, $novaConsula );
			} 

			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && isset($_GET["veiculo"]) && isset($_GET["modelo"])) { 
				$tipo = $_GET["tipo"];
				$modelo = $_GET["modelo"];
				$novaConsula = new Consulta($tipo);
				$marca_id = $novaConsula->getMarcaId($_GET["marca"]);				
				$veiculo_id = $novaConsula->getVeiculoId($_GET["veiculo"]);

				$form->resultado($tipo, $modelo, $novaConsula, $marca_id, $veiculo_id);
				
			} 

			else { 
				
				$form->tipoDeVeiculo(); 
			} 
		?>

	</div>
</body>
</html>