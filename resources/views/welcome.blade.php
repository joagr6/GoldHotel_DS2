<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gold Hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    /* NAVBAR */
    nav {
      display: flex;
      height: 80px;
      width: 100%;
      background-color: black;
      align-items: center;
      justify-content: space-between;
      padding: 0 50px;
      position: fixed;
      top: 0;
      z-index: 999;
    }

    .logo {
      font-size: 25px;
      color: #fff;
      font-weight: bold;
    }

    nav ul {
      display: flex;
      list-style: none;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-size: 18px;
      font-weight: 500;
      padding: 8px 15px;
      border-radius: 5px;
      transition: 0.3s;
    }

    nav ul li a:hover {
      background: #fff;
      color: #000;
    }

/* BANNER */
.bannerPrincipal {
  margin-top: 80px;
  position: relative;
  width: 100%;
  height: 70vh; /* altura reduzida, ocupa 70% da altura da tela */
  overflow: hidden;
}

.bannerPrincipal img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* mantém proporção e cobre toda a largura */
  filter: brightness(75%);
}


    .textoBanner {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
      text-align: center;
    }

    .textoBanner h1 {
      font-size: 48px;
      font-weight: 600;
    }

    .textoBanner p {
      font-size: 20px;
    }

    /* CARROSSEL DE QUARTOS */
    .ofertasTitulo {
      font-size: 28px;
      font-weight: 600;
      margin: 60px 0 30px;
      text-align: center;
    }

    .card img {
      height: 220px;
      object-fit: cover;
    }

    #carouselQuartos {
      position: relative;
    }

    /* BOTÕES DO CARROSSEL */
    .carousel-control-prev, .carousel-control-next {
      width: 5%;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0, 0, 0, 0.6);
      border-radius: 50%;
      padding: 20px;
    }

    .carousel-control-prev {
      left: -60px;
    }

    .carousel-control-next {
      right: -60px;
    }

    /* MAPA */
    .mapaContainer {
      text-align: center;
      margin: 60px auto;
      padding: 20px;
      max-width: 90%;
      background: #fffdf7;
      border-radius: 20px;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    }

    .mapaContainer h3 {
      font-size: 26px;
      font-weight: 600;
      color: #333;
      margin-bottom: 15px;
    }

    iframe {
      width: 100%;
      height: 400px;
      border: 0;
      border-radius: 15px;
      box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.2);
    }

    /* RODAPÉ */
    footer {
      background-color: #f7f4ef;
      color: #000;
      padding: 40px 0;
    }

    footer h5 {
      font-weight: 600;
      font-size: 18px;
    }

    footer ul {
      list-style: none;
      padding: 0;
    }

    footer ul li {
      margin: 6px 0;
    }

    footer ul li a {
      text-decoration: none;
      color: #000;
      transition: 0.3s;
    }

    footer ul li a:hover {
      color: #007bff;
    }

    footer .copyright {
      text-align: center;
      margin-top: 20px;
      border-top: 1px solid #ccc;
      padding-top: 10px;
      font-size: 14px;
    }

    .linhaBranca {
      width: 100%;
      height: 5px;
      background-color: #f7f4ef;
    }
  </style>
</head>
<body>

<nav>
  <div class="logo">GOLD HOTEL</div>
  <ul>
    <li><a href="{{ route('home') }}">Home</a></li>
    @if (Route::has('login'))
      <li><a href="{{ route('login') }}">Login Hóspede</a></li>
      <li><a href="{{ route('login') }}">Login Admin</a></li>
    @else
      <li><a href="#">Login</a></li>
    @endif
    @if (Route::has('hospede.cadastro'))
      <li><a href="{{ route('hospede.cadastro') }}">Cadastrar-se</a></li>
    @endif
  </ul>
</nav>

<div class="linhaBranca"></div>

<div class="bannerPrincipal">
  <img src="./images./quarto.main.jpeg" alt="Hotel banner">
  <div class="textoBanner">
    <h1>Estadias em Copacabana</h1>
    <p>Conforto, luxo e vista para o mar do Rio de Janeiro.</p>
  </div>
</div>

<div class="container my-5">
  <h2 class="ofertasTitulo">Nossos Quartos</h2>

  <div id="carouselQuartos" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <!-- PÁGINA 1 -->
      <div class="carousel-item active">
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <img src="./images./punta.cana.jpg" alt="Quarto Luxo Mar">
              <div class="card-body">
                <h5 class="card-title">Suíte Vista Mar</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 920</strong> / diária</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img src="./images./ipojuca.jpg" alt="Quarto Premium">
              <div class="card-body">
                <h5 class="card-title">Suíte Premium</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 730</strong> / diária</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img src="https://images.unsplash.com/photo-1560347876-aeef00ee58a1?auto=format&fit=crop&w=800&q=60" alt="">
              <div class="card-body">
                <h5 class="card-title">Standard Casal</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 480</strong> / diária</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=800&q=60" alt="">
              <div class="card-body">
                <h5 class="card-title">Suíte Executiva</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 650</strong> / diária</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- PÁGINA 2 -->
      <div class="carousel-item">
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=60" alt="">
              <div class="card-body">
                <h5 class="card-title">Suíte Familiar</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 820</strong> / diária</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img src="./images./varanda.jpg" alt="">
              <div class="card-body">
                <h5 class="card-title">Deluxe Varanda</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 890</strong> / diária</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img src="./images./solteiro.jpeg" alt="">
              <div class="card-body">
                <h5 class="card-title">Econômico Solteiro</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 350</strong> / diária</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img src="./images./cobertura.jpeg" alt="">
              <div class="card-body">
                <h5 class="card-title">Cobertura Master</h5>
                <p class="card-text">Copacabana - Rio de Janeiro</p>
                <p><strong>R$ 1.450</strong> / diária</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- BOTÕES FORA DO CARROSSEL -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselQuartos" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselQuartos" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>

  </div>
</div>

<!-- ====== MAPA ====== -->
<div class="mapaContainer">
  <h3>Localização do Gold Hotel</h3>
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.268882757548!2d-43.18236522468104!3d-22.903539038630574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997f5b5f8ef8d1%3A0xd7a6bba2a91d85d0!2sCopacabana%20Beach!5e0!3m2!1spt-BR!2sbr!4v1694469808906!5m2!1spt-BR!2sbr"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>

<footer>
  <div class="copyright mt-4">
    <p>&copy; 2025 Gold Hotel - Todos os direitos reservados.</p>
  </div>
</footer>

</body>
</html>
