<?php 
	include('functions.php');
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
					$marcas = get_marcas($tipo);
					foreach ($marcas as $marca => $valor) {
						echo '<option value="' . $valor->id . "|" . $valor->name . '">' . ucfirst($valor->name) . '</option>';
					}
				?>				
			</select>

			<input type="submit" value="Próximo">

		</form>

		<?php } 
			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && !isset($_GET["veiculo"])) { 
				$tipo = $_GET["tipo"];
				$marca_id = get_marca_id($_GET["marca"]);
				$marca_nome = get_marca_nome($_GET["marca"]);
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
					$veiculos = get_veiculos($tipo, $marca_id);
					foreach ($veiculos as $veiculo => $valor) {
						echo '<option value="' . $valor->id . "|" . $valor->name . '">' . ucfirst($valor->name) . '</option>';
					}
				?>				
			</select>

			<input type="submit" value="Próximo">

		</form>

		<?php } 
			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && isset($_GET["veiculo"]) && !isset($_GET["modelo"])) { 
				$tipo = $_GET["tipo"];
				$marca_id = get_marca_id($_GET["marca"]);
				$marca_nome = get_marca_nome($_GET["marca"]);
				$veiculo_id = get_veiculo_id($_GET["veiculo"]);
				$veiculo_nome = get_veiculo_nome($_GET["veiculo"]);
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
					$modelos = get_modelos($tipo, $marca_id, $veiculo_id);
					foreach ($modelos as $modelo => $valor) {
						echo '<option value="' . $valor->id . '">' . ucfirst($valor->name) . '</option>';
					}
				?>				
			</select>

			<input type="submit" value="Próximo">

		</form>

		<?php } 
			elseif(isset($_GET["tipo"]) && isset($_GET["marca"]) && isset($_GET["veiculo"]) && isset($_GET["modelo"])) { 
				$tipo = $_GET["tipo"];
				$marca_id = get_marca_id($_GET["marca"]);
				$veiculo_id = get_veiculo_id($_GET["veiculo"]);			
				$modelo = $_GET["modelo"];
				$consulta = get_preco($tipo, $marca_id, $veiculo_id, $modelo);

		?>

		<h2>Resultado</h2>
		<p>Código FIPE: <?php echo $consulta->fipe_codigo ?> </p>
		<p>Veículo: <?php echo $consulta->veiculo ?> </p>
		<p>Marca: <?php echo $consulta->marca ?> </p>
		<p>Ano: <?php echo $consulta->ano_modelo ?> </p>
		<p>Combustível: <?php echo $consulta->combustivel ?> </p>
		<p>Preço: <?php echo $consulta->preco ?> </p>

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