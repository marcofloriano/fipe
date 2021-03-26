const formTipoDeVeiculo  = document.getElementById('tipoDeVeiculo');
const formMarcaDoVeiculo  = document.getElementById('marcaDoVeiculo');
const formNomeDoVeiculo  = document.getElementById('nomeDoVeiculo');
const formModeloDoVeiculo  = document.getElementById('modeloDoVeiculo');

if(formTipoDeVeiculo) {
  const tipo = document.getElementById('tipo');
  const tipoError = document.querySelector('#tipo + span.error');

  const usuario = document.getElementById('usuario');
  const usuarioError = document.querySelector('#usuario + span.error');

  usuario.addEventListener('input', function (event) {
    if ( usuario.validity.valid ) {
      usuarioError.textContent = '';
      usuarioError.className = 'error';
    } else {
      showError();
    }  
  });

  tipo.addEventListener('input', function (event) {
    if ( tipo.validity.valid ) {
      tipoError.textContent = '';
      tipoError.className = 'error';
    } else {
      showError();
    }  
  });

  formTipoDeVeiculo.addEventListener('submit', function (event) {
    if( !usuario.validity.valid ) {
      showError();
      event.preventDefault();
    }

    else if( !tipo.validity.valid ) {
      showError();
      event.preventDefault();
    }
  });

  function showError() {
    if(usuario.validity.valueMissing) {
      usuarioError.textContent = 'Informe seu usuário';
      usuarioError.className = 'error active';
    }
    else if (tipo.validity.valueMissing) {
      tipoError.textContent = 'Selecione o tipo de veículo';
      tipoError.className = 'error active';
    }
  } 
}

else if(formMarcaDoVeiculo) {
  const marca = document.getElementById('marca');
  const marcaError = document.querySelector('#marca + span.error');

  formMarcaDoVeiculo.addEventListener('submit', function (event) {
    if(!marca.validity.valid) {
      showError();
      event.preventDefault();
    }
  });

  function showError() {
    if(marca.validity.valueMissing) {
      marcaError.textContent = 'Selecione a marca do veículo';
      marcaError.className = 'error active';
    }
  }
}

else if(formNomeDoVeiculo) {
  const veiculo = document.getElementById('veiculo');
  const veiculoError = document.querySelector('#veiculo + span.error');

  formNomeDoVeiculo.addEventListener('submit', function (event) {
    if(!veiculo.validity.valid) {
      showError();
      event.preventDefault();
    }
  });

  function showError() {
    if(veiculo.validity.valueMissing) {
      veiculoError.textContent = 'Selecione o nome do veículo';
      veiculoError.className = 'error active';
    }
  }
}

else if(formModeloDoVeiculo) {
  const modelo = document.getElementById('modelo');
  const modeloError = document.querySelector('#modelo + span.error');

  formModeloDoVeiculo.addEventListener('submit', function (event) {
    if(!modelo.validity.valid) {
      showError();
      event.preventDefault();
    }
  });

  function showError() {
    if(modelo.validity.valueMissing) {
      modeloError.textContent = 'Selecione o modelo do veículo';
      modeloError.className = 'error active';
    }
  }
}