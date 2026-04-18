const form = document.querySelector('#lead-form');
const statusElement = document.querySelector('#lead-form-status');
const aboutSection = document.querySelector('.about');
const aboutVisual = document.querySelector('[data-scroll-animation="slide-in-left"]');
const benefitsSection = document.querySelector('.benefits');
const benefitCards = document.querySelectorAll('[data-scroll-animation="tracking-in-expand"]');
const faqItems = document.querySelectorAll('.faq__item');

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

function setupAboutVisualAnimation() {
  if (!aboutSection || !aboutVisual) {
    return;
  }

  const animationClass = aboutVisual.dataset.scrollAnimation;
  let hasAnimated = false;

  function resetAnimation() {
    aboutVisual.classList.remove(animationClass);
    hasAnimated = false;
  }

  function playAnimation() {
    if (hasAnimated) {
      return;
    }

    aboutVisual.classList.remove(animationClass);
    void aboutVisual.offsetWidth;
    aboutVisual.classList.add(animationClass);
    hasAnimated = true;
  }

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            playAnimation();
          }
        });
      },
      {
        threshold: 0.35,
      }
    );

    observer.observe(aboutSection);
  } else {
    playAnimation();
  }

  window.addEventListener(
    'scroll',
    () => {
      if (window.scrollY <= 0) {
        resetAnimation();
      }
    },
    { passive: true }
  );
}

setupAboutVisualAnimation();

function setupBenefitsCardsAnimation() {
  if (!benefitsSection || benefitCards.length === 0) {
    return;
  }

  const animationDuration = 700;
  let hasAnimated = false;
  let animationTimeouts = [];

  function clearAnimationTimeouts() {
    animationTimeouts.forEach((timeoutId) => window.clearTimeout(timeoutId));
    animationTimeouts = [];
  }

  function resetAnimation() {
    clearAnimationTimeouts();

    benefitCards.forEach((card) => {
      card.classList.remove(card.dataset.scrollAnimation);
    });

    hasAnimated = false;
  }

  function playAnimation() {
    if (hasAnimated) {
      return;
    }

    clearAnimationTimeouts();

    benefitCards.forEach((card, index) => {
      const timeoutId = window.setTimeout(() => {
        card.classList.remove(card.dataset.scrollAnimation);
        void card.offsetWidth;
        card.classList.add(card.dataset.scrollAnimation);
      }, animationDuration * index);

      animationTimeouts.push(timeoutId);
    });

    hasAnimated = true;
  }

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            playAnimation();
          }
        });
      },
      {
        threshold: 0.2,
      }
    );

    observer.observe(benefitsSection);
  } else {
    playAnimation();
  }

  window.addEventListener(
    'scroll',
    () => {
      if (window.scrollY <= 0) {
        resetAnimation();
      }
    },
    { passive: true }
  );
}

setupBenefitsCardsAnimation();

function setupFaqAnimation() {
  if (faqItems.length === 0) {
    return;
  }

  faqItems.forEach((item) => {
    item.addEventListener('click', () => {
      item.classList.remove('tilt-in-top-1');
      void item.offsetWidth;
      item.classList.add('tilt-in-top-1');
    });
  });
}

setupFaqAnimation();
