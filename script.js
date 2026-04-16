const form = document.querySelector('#lead-form');
const statusElement = document.querySelector('#lead-form-status');

const statusMessages = {
  sucesso: {
    tone: 'success',
    text: 'Mensagem enviada com sucesso. Nossa equipe vai falar com voce em breve.',
  },
  'campos-obrigatorios': {
    tone: 'error',
    text: 'Preencha nome, e-mail e telefone antes de enviar.',
  },
  'email-invalido': {
    tone: 'error',
    text: 'Informe um e-mail valido para que possamos retornar o contato.',
  },
  'dados-invalidos': {
    tone: 'error',
    text: 'Revise os dados enviados. Um ou mais campos estao fora do formato esperado.',
  },
  'metodo-invalido': {
    tone: 'error',
    text: 'Nao foi possivel processar o envio. Tente novamente pelo formulario.',
  },
  'erro-servidor': {
    tone: 'error',
    text: 'Ocorreu um erro ao salvar seu contato. Tente novamente em instantes.',
  },
};

function updateStatusFromQuery() {
  if (!form || !statusElement) {
    return;
  }

  const url = new URL(window.location.href);
  const status = url.searchParams.get('status');

  if (!status || !statusMessages[status]) {
    statusElement.hidden = true;
    statusElement.textContent = '';
    statusElement.dataset.tone = '';
    return;
  }

  const { tone, text } = statusMessages[status];
  statusElement.hidden = false;
  statusElement.textContent = text;
  statusElement.dataset.tone = tone;

  if (status === 'sucesso') {
    form.reset();
  }

  url.searchParams.delete('status');
  window.history.replaceState({}, document.title, url.pathname + url.hash);
}

updateStatusFromQuery();
