<?php 
	include('consulta.php');
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
				$tipo = $_GET["tipo"];
		?>
		<form method="GET" id="fipe" action="index.php">
			<select id="tipo" name="tipo">
				<option value="<?php echo $tipo ?>">
					<?php echo ucfirst($tipo) ?>					
				</option>
			</select>	
			
			<select id="marca" name="marca">
				<option value="" selected="selected">Marca do veículo</option>
				<?php
					$novaConsula = new Consulta($tipo);
					foreach ( $novaConsula->getMarcas() as $marca => $valor ) {
						echo '<option value="' . $valor->id . "|" . $valor->name . '">' . ucfirst($valor->name) . '</option>';
					}
				?>				
			</select>

			<input type="submit" value="Próximo">

		</form>

		<?php } 
			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && !isset($_GET["veiculo"])) { 
				$tipo = $_GET["tipo"];
				$novaConsula = new Consulta($tipo);
				$marca_id = $novaConsula->getMarcaId($_GET["marca"]);
				$marca_nome = $novaConsula->getMarcaNome($_GET["marca"]);
				
		?>

		<form method="GET" id="fipe" action="index.php">
			<select id="tipo" name="tipo">
				<option value="<?php echo $tipo ?>">
					<?php echo ucfirst($tipo) ?>					
				</option>
			</select>	

			<select id="marca" name="marca">
				<option value="<?php echo $marca_id . "|" . $marca_nome ?>">
					<?php echo ucfirst($marca_nome) ?>
				</option>
			</select>

			<select id="veiculo" name="veiculo">
				<option value="" selected="selected">Nome do veículo</option>
				<?php					
					foreach ($novaConsula->getVeiculos($marca_id) as $veiculo => $valor) {
						echo '<option value="' . $valor->id . "|" . $valor->name . '">' . ucfirst($valor->name) . '</option>';
					}
				?>				
			</select>

			<input type="submit" value="Próximo">

		</form>

		<?php } 
			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && isset($_GET["veiculo"]) && !isset($_GET["modelo"])) { 
				$tipo = $_GET["tipo"];
				$novaConsula = new Consulta($tipo);
				$marca_id = $novaConsula->getMarcaId($_GET["marca"]);
				$marca_nome = $novaConsula->getMarcaNome($_GET["marca"]);
				$veiculo_id = $novaConsula->getVeiculoId($_GET["veiculo"]);
				$veiculo_nome = $novaConsula->getVeiculoNome($_GET["veiculo"]);
		?>

		<form method="GET" id="fipe" action="index.php">
			<select id="tipo" name="tipo">
				<option value="<?php echo $tipo ?>">
					<?php echo ucfirst($tipo) ?>					
				</option>
			</select>	

			<select id="marca" name="marca">
				<option value="<?php echo $marca_id . "|" . $marca_nome ?>">
					<?php echo ucfirst($marca_nome) ?>
				</option>
			</select>

			<select id="veiculo" name="veiculo">
				<option value="<?php echo $veiculo_id . "|" . $veiculo_nome ?>">
					<?php echo ucfirst($veiculo_nome) ?>
				</option>
			</select>

			<select id="modelo" name="modelo">
				<option value="" selected="selected">Modelo do veículo</option>
				<?php
					// $modelos = get_modelos($tipo, $marca_id, $veiculo_id);
					foreach ($novaConsula->getModelos($marca_id, $veiculo_id) as $modelo => $valor) {
						echo '<option value="' . $valor->id . '">' . ucfirst($valor->name) . '</option>';
					}
				?>				
			</select>

			<input type="submit" value="Próximo">

		</form>

		<?php } 
			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && isset($_GET["veiculo"]) && isset($_GET["modelo"])) { 
				$tipo = $_GET["tipo"];
				$modelo = $_GET["modelo"];
				$novaConsula = new Consulta($tipo);
				$marca_id = $novaConsula->getMarcaId($_GET["marca"]);				
				$veiculo_id = $novaConsula->getVeiculoId($_GET["veiculo"]);
				$resultado = $novaConsula->getResultado($marca_id, $veiculo_id, $modelo);

		?>

		<h2>Resultado</h2>
		<p>Código FIPE: <?php echo $resultado->fipe_codigo ?> </p>
		<p>Veículo: <?php echo $resultado->veiculo ?> </p>
		<p>Marca: <?php echo $resultado->marca ?> </p>
		<p>Ano: <?php echo $resultado->ano_modelo ?> </p>
		<p>Combustível: <?php echo $resultado->combustivel ?> </p>
		<p>Preço: <?php echo $resultado->preco ?> </p>

		<?php } else { ?>

		<form method="GET" id="fipe" action="index.php">
			<select id="tipo" name="tipo">
				<option value="" selected="selected">Tipo de veículo</option>
				<option value="carros">Carros</option>
				<option value="motos">Motos</option>
				<option value="caminhoes">Caminhoẽs</option>
			</select>
			<input type="submit" value="Próximo">
		</form>

		<?php } ?>

	</div>
</body>
</html>