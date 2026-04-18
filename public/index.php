<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nexa Growth</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <header class="hero">
    <div class="container">
      <div class="hero__top">
        <a class="hero__brand" href="#topo" aria-label="Pagina inicial">
          <img class="hero__logo" src="assets/images/logo.png" alt="Logotipo da marca">
        </a>
        <a class="hero__phone" href="tel:+5511997157589">(11) 99715-7589</a>
      </div>

      <div class="hero__content">
        <section class="hero__text">
          <p class="hero__eyebrow">Performance digital com foco em crescimento</p>
          <h1>Aumente suas vendas com <span>estratégias digitais</span> que realmente funcionam.</h1>
          <p>
            Somos uma agência de performance focada em gerar resultados reais. Criamos sites, campanhas e estratégias
            que atraem, convertem e escalam o seu negócio no digital.
          </p>
          <div class="hero__actions">
            <a class="hero__cta hero__cta--primary shake-horizontal" href="#contato-final">Quero atrair mais clientes</a>
            <a class="hero__cta hero__cta--secondary shake-horizontal" href="#quem-somos-titulo">Conhecer a agência</a>
          </div>
          <ul class="hero__highlights" aria-label="Principais diferenciais">
            <li>Sites otimizados para conversão</li>
            <li>Campanhas com leitura de dados em tempo real</li>
            <li>Estratégia completa para gerar demanda</li>
          </ul>
        </section>

        <aside class="hero__form-wrapper" aria-label="Formulario de contato">
          <form class="lead-form" id="lead-form" action="submit.php" method="post">
            <h2>Fale com um especialista e comece a crescer</h2>
            <p class="lead-form__intro">Preencha seus dados e nossa equipe entra em contato com voce.</p>
            <div class="lead-form__status" id="lead-form-status" aria-live="polite" hidden></div>

            <label for="nome" class="sr-only">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="NOME" maxlength="120" required>

            <label for="email" class="sr-only">E-mail</label>
            <input type="email" id="email" name="email" placeholder="E-MAIL" maxlength="160" required>

            <label for="telefone" class="sr-only">Telefone</label>
            <input type="tel" id="telefone" name="telefone" placeholder="DDD + TELEFONE" maxlength="20" required>

            <label for="mensagem" class="sr-only">Como podemos te ajudar?</label>
            <textarea id="mensagem" name="mensagem" placeholder="COMO PODEMOS TE AJUDAR?" rows="4"
              maxlength="1000"></textarea>

            <button class="shake-horizontal" type="submit">Enviar</button>
          </form>
        </aside>
      </div>
    </div>
  </header>

  <main>
    <section class="about" aria-labelledby="quem-somos-titulo">
      <div class="container">
        <div class="about__main">
          <div class="about__visual">
            <img data-scroll-animation="slide-in-left" src="assets/images/hero.png"
              alt="Ilustração representando crescimento digital e performance">
          </div>

          <div class="about__content">
            <h2 id="quem-somos-titulo">Quem Somos</h2>
            <p>
              Somos uma agência de marketing digital especializada em performance e crescimento. Nosso foco é ajudar
              empresas a aumentarem suas vendas através de estratégias inteligentes, baseadas em dados e resultados reais.
            </p>
            <p>
              Trabalhamos com criação de sites, tráfego pago e otimização de conversão, sempre buscando entregar soluções
              personalizadas para cada cliente. Mais do que presença digital, nós entregamos crescimento.
            </p>
          </div>
        </div>

        <div class="about__stats" aria-label="Indicadores da operação">
          <div class="about__stat-card">
            <strong>+120</strong>
            <span>Projetos acompanhados com foco em geração de leads</span>
          </div>
          <div class="about__stat-card">
            <strong>24h</strong>
            <span>Para iniciar uma nova campanha com equipe dedicada</span>
          </div>
          <div class="about__stat-card">
            <strong>ROI</strong>
            <span>Decisões guiadas por dados, testes e otimização contínua</span>
          </div>
        </div>
      </div>
    </section>

    <section class="benefits" aria-labelledby="beneficios-titulo">
      <div class="container">
        <h2 id="beneficios-titulo">Com este servico voce:</h2>

        <div class="benefits__grid">
          <article class="benefit-card" data-scroll-animation="tracking-in-expand">
            <h3>Mais clientes todos os dias</h3>
            <p>
              Atraia pessoas realmente interessadas no seu produto ou serviço através de estratégias digitais eficientes
              e bem direcionadas.
            </p>
          </article>

          <article class="benefit-card" data-scroll-animation="tracking-in-expand">
            <h3>Aumento nas vendas</h3>
            <p>
              Transforme visitantes em clientes com páginas otimizadas e campanhas focadas em conversão e resultados
              reais.
            </p>
          </article>

          <article class="benefit-card" data-scroll-animation="tracking-in-expand">
            <h3>Presença digital profissional</h3>
            <p>
              Tenha um site moderno, rápido e preparado para transmitir confiança e credibilidade para seus clientes.
            </p>
          </article>

          <article class="benefit-card" data-scroll-animation="tracking-in-expand">
            <h3>Estratégias baseadas em dados</h3>
            <p>
              Todas as decisões são tomadas com base em dados reais, garantindo mais eficiência e melhores resultados
              nas campanhas.
            </p>
          </article>

          <article class="benefit-card" data-scroll-animation="tracking-in-expand">
            <h3>Mais previsibilidade no crescimento</h3>
            <p>
              Tenha controle sobre seus resultados e consiga planejar o crescimento do seu negócio com mais segurança.
            </p>
          </article>

          <article class="benefit-card" data-scroll-animation="tracking-in-expand">
            <h3>Foco total no seu negócio</h3>
            <p>
              Enquanto cuidamos do marketing, você pode focar no que realmente importa: atender seus clientes e expandir
              sua empresa.
            </p>
          </article>
        </div>

        <div class="benefits__cta">
          <a class="shake-horizontal" href="#contato-final">Quero atrair mais clientes</a>
        </div>
      </div>
    </section>

    <section class="faq" aria-labelledby="faq-titulo">
      <div class="container">
        <h2 id="faq-titulo">Perguntas Frequentes</h2>

        <div class="faq__list">
          <details class="faq__item">
            <summary>Quanto tempo leva para ver resultados?</summary>
            <p>Os primeiros resultados podem aparecer já nas primeiras semanas, principalmente com campanhas de tráfego
              pago. Estratégias orgânicas levam mais tempo, mas trazem resultados mais consistentes a longo prazo.</p>
          </details>

          <details class="faq__item">
            <summary>Preciso investir em anúncios?</summary>
            <p>Não obrigatoriamente, mas o tráfego pago acelera significativamente os resultados. Avaliamos o seu
              negócio e indicamos a melhor estratégia para o seu momento.</p>
          </details>

          <details class="faq__item">
            <summary>Vocês atendem qualquer tipo de empresa?</summary>
            <p>Sim. Atendemos desde pequenos negócios até empresas maiores, sempre adaptando as estratégias de acordo
              com o perfil e os objetivos de cada cliente.</p>
          </details>

          <details class="faq__item">
            <summary>Qual o valor do investimento?</summary>
            <p>O valor do investimento varia de acordo com as necessidades e objetivos de cada cliente. Fazemos uma
              análise detalhada do seu negócio e apresentamos um plano de ação com as melhores opções para o seu
              orçamento.</p>
          </details>

          <details class="faq__item">
            <summary>Como posso começar?</summary>
            <p>É simples! Basta entrar em contato conosco através do formulário. Nossa equipe fará uma análise inicial e
              entrará em contato para entender melhor o seu negócio e indicar a melhor estratégia.</p>
          </details>
        </div>
      </div>
    </section>
  </main>

  <section class="final-cta" id="contato-final" aria-labelledby="cta-final-titulo">
    <div class="container">
      <div class="final-cta__content">
        <div class="final-cta__text">
          <h2 id="cta-final-titulo">Chegou a hora de levar o seu negócio para o próximo nível</h2>
          <p>
            Se você quer crescer no digital, gerar mais clientes e aumentar suas vendas, este é o momento de agir.
          </p>
        </div>

        <div class="final-cta__card">
          <p>
            Pare de depender apenas de indicações e comece a atrair clientes todos os dias com estratégias digitais
            eficientes. Nós cuidamos de todo o processo para que você foque no crescimento do seu negócio.
          </p>
          <a class="shake-horizontal"
            href="https://wa.me/5511997157589?text=Ol%C3%A1%2C%20quero%20aumentar%20minhas%20vendas.%20Pode%20me%20ajudar%3F"
            target="_blank" rel="noopener noreferrer">Quero aumentar minhas vendas</a>
          <small>Fale com um especialista agora mesmo e descubra como podemos aumentar seus resultados no
            digital.</small>
        </div>
      </div>
    </div>
  </section>

  <footer class="site-footer" id="topo">
    <div class="container">
      <p>Nexa Growth. Todos os direitos reservados. 2026</p>
      <p>Desenvolvido por Kaique Araujo - 11 99715-7589</p>
    </div>
  </footer>
  <script src="assets/js/main.js"></script>
</body>

</html>
