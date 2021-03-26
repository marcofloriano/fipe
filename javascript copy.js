// Encontrando o formulário
const form  = document.getElementsByTagName('form')[0];

const tipo = document.getElementById('tipo');
const tipoError = document.querySelector('#tipo + span.error');

const marca = document.getElementById('marca');
const marcaError = document.querySelector('#marca + span.error');

/*
// Validando Tipo
tipo.addEventListener('input', function (event) {

  if ( tipo.validity.valid ) {
    tipoError.textContent = '';
    tipoError.className = 'error';
  } else {
    showError();
  }

});

// Validando Marca
marca.addEventListener('input', function (event) {

  if ( marca.validity.valid ) {
    marcaError.textContent = '';
    marcaError.className = 'error';
  } else {
    showError();
  }

});
*/

// Submetendo (ou não) o formulário
form.addEventListener('submit', function (event) {

  if(!tipo.validity.valid) {
    showError();
    event.preventDefault();
  }

  else if(!marca.validity.valid) {
    showError();
    event.preventDefault();
  }

});

// Exibindo mensagem de erro
function showError() {
  
  if(tipo.validity.valueMissing) {
    tipoError.textContent = 'Selecione o tipo de veículo';
    tipoError.className = 'error active';
  }

  else if(marca.validity.valueMissing) {
    marcaError.textContent = 'Selecione a marca do veículo';
    marcaError.className = 'error active';
  }
}