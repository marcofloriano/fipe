<?php
	/**
	 * Classe para geração do formulário para consulta de veículos da tabela FIPE
	 * Por Marco Floriano em 18/07/2020
	 */

	class Formulario {

		public function tipoDeVeiculo() { ?>
			<form method="GET" id="fipe" action="index.php">
				<select id="tipo" name="tipo">
					<option value="" selected="selected">Tipo de veículo</option>
					<option value="carros">Carros</option>
					<option value="motos">Motos</option>
					<option value="caminhoes">Caminhoẽs</option>
				</select>
				<input type="submit" value="Próximo">
			</form>
		<?php }

		public function marcaDoVeiculo($tipo) { ?>
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

		public function nomeDoVeiculo($tipo, $marca_id, $marca_nome, $novaConsula) { ?>
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

		public function modeloDoVeiculo($tipo, $marca_id, $marca_nome, $veiculo_id, $veiculo_nome, $novaConsula) { ?>
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

		public function resultado($tipo, $modelo, $novaConsula, $marca_id, $veiculo_id) {
			$resultado = $novaConsula->getResultado($marca_id, $veiculo_id, $modelo);
			?>
				<h2>Resultado</h2>
				<p>Código FIPE: <?php echo $resultado->fipe_codigo ?> </p>
				<p>Veículo: <?php echo $resultado->veiculo ?> </p>
				<p>Marca: <?php echo $resultado->marca ?> </p>
				<p>Ano: <?php echo $resultado->ano_modelo ?> </p>
				<p>Combustível: <?php echo $resultado->combustivel ?> </p>
				<p>Preço: <?php echo $resultado->preco ?> </p>

			<?php }

	}
?>