<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </head>
  <body>

<style>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}.partedahome {
  width: 100%;
  height: 80px;
}

nav {
  display: flex;
  height: 80px;
  width: 100%;
  background-color: #000000;
  align-items: center;
  justify-content: space-between;
  padding: 0 50px 0 100px;
  flex-wrap: wrap;
  position: fixed;
  z-index: 999;
}

.logo {
  font-size: 25px;
  color: #fff;
  margin-left: -40px;
  font-weight: 90;
}

nav ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
}

nav ul li {
  margin: 0 5px;
}

nav ul li a {
  color: #f2f2f2;
  text-decoration: none;
  font-size: 18px;
  font-weight: 500;
  padding: 8px 15px;
  border-radius: 5px;
  letter-spacing: 1px;
  transition: all 0.3s ease;
}

nav ul li a.active,
nav ul li a:hover {
  background: #ffffff;
}

nav .menu-btn i {
  color: #fff;
  cursor: pointer;
  display: none;
  font-size: 25px;
}

.BotaoAnimais:hover, .BotaoSobre:hover, .BotaoHome:hover {
  background-color: #ffffff;
  color: #000;
  transition: 1.0s;
  transform: scale(1.1); 
  cursor: pointer;
}
.linhaBranca{
  width: 100%;
  height: 2px;
  background-color: #fff;
  z-index: 999;
  position: fixed;
}
.ImagensCarrousel{
  width: 100%;
  height: 750px;
}
.ImagensCarrousel img{
  width: 100%;
  height: 750px;
}
/*____________*/
.ofertasTitulo{
  width: 100%;
  height: 50px;
  background-color: #000;
  color: #fff;
  font-size: 25px;
  text-transform: uppercase;
  font-weight: 150px;
  padding-left: 50px;
  padding-top: 5px;
  
}
.ParteBranca{
  width: 92%;
  height: 80%;
  background-color: #f2f2f2;
  border-radius: 50px;
}
.ParteBranca img{
  width: 60%;
  height: 50%;
  object-fit: cover;
}
.PartePreco{
  width: 50%;
  margin-left: 15%;
  margin-right: 5%;
}
.PartePreco button{
  width: 90%;
  height: 50%;
}
.precodiaria{
  font-size: 26px;
  text-decoration: none;
  color: #000;
}
.diaria{
  font-size: 15px;
  text-decoration: none;
  color: #000;
}
.ParteOfertas{
  display: flex;
  background-color: #000;
}
.OfertasdaSemana{
  width: 100%;
  height: 450px;
}
.parte1ofertas{
  width: 33.3%;
  height: 450px;
  justify-content: center;
  display: flex;
}
.parte2ofertas{
  width: 33.4%;
  height: 450px;
  justify-content: center;
  display: flex;
}
.parte3ofertas{
  width: 33.3%;
  height: 450px;
  justify-content: center;
  display: flex;
}
.TituloCaixa{
  color: #000;
  font-size: 22px;
  padding-left: 8%;
  margin-top: 4px;
}
.ParteBranca img{
  margin-left: 8%;
}
.ParteInterna{
  width: 100%;
  display: flex;
}
.ParteEscrita{
  width: 50%;
}
.ParteEscrita ul{
  margin-left: 12%;
  margin-top: -4px;
  padding-top: 14px;
  font-size: 18px;
}

.linhaPreta{
  width: 100%;
  height: 15px;
  background-color: #000;
}
/*)))))))))))))))))))))*/
.cafemanha{
    width: 100%;
    height: auto;
    display: flex;
}
.itenscafe{
  font-size: 20px;
  margin-left: 50px;
}
.cafeimg{
    width: 75%;
    height: 400px;
    display: flex;
    background-color: #ffffff;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s ease; 
}
.cafeimg img{
  width: 40%;
  height: 70%;
  object-fit: cover;
  margin-left: 40px;
}
.cafetexto{
    width: 35%;
    height: 400px;
    display: flex;
    background-color: #ffffff;
}
.cafetexto ul li{
  font-size: 20px;
  margin-left: 45px;
}
.partetitlediv{
    width: 100%;
    height: 100px;
    background-color: rgb(255, 255, 255);
}
.textocafe{
    font-size: 30px;
    display: block;
    margin-left: 50px;
    margin-top: -5px;
}
.titlecafe{
    font-size: 40px;
    margin-left: 50px;
    margin-top: 20px;
    text-transform: uppercase;
}


.valor{
    align-items: center;
    justify-content: center;
    display: flex;
    font-size: 20px;
    text-transform: uppercase;
}

.SimulaReserva{
  padding-top: 50px;
    width: 100%;
    height: 600px;
    align-items: center;
    justify-content: center;
    display: flex;
}

  H1{
    margin-left: 35px;
    text-transform: uppercase;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
  }
  .aaa{
    width: 400px;
    height: 40px;
    background-color: #ffff;
    border-radius: 10px;
    font-size: 18px;
    margin-left: 60px;
    margin-top: 5px;
    padding-left: 15px;
  }
  label{
    display: flex;
    padding-right: 30px;
    margin-left: 60px;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 15px;
  }
.colorblack, .colorblackbutton{
  transition: background-color 0.3s;
}
.colorblack:hover{
  background-color: rgb(196, 197, 195);
}
.colorblackbutton:hover{
  background-color: #63724F;
}
.calcularvalor{
  width: 150px;
  height: 50px;
  background-color: #96ad79;
  margin-left: 100px;
}
.Limparformulario{
  width: 150px;
  height: 50px;
  background-color: #96ad79;
  margin-top: 20px;
  margin-left: 20px;
}
.buttondecalculos{
  width: 100%;
  height: 100px;
}
.valordasreservas{
  width: 350px;
  height: 150px;
  font-size: 30px;
  margin-left: 50px;
}
button{
  border-radius: 10px;
}
/*______________*/
.rodape{
    width: 100%;
    background-color: #000000   ;
    color: #fff;
    align-items: center;
    justify-content: center;
    display: flex;
}
.parteMapa{
  width: 100%;
  height: 440px;
  display: flex;
}
.partemapa1{
  width: 50%;
  align-items: center;
  justify-content: center;
  display: flex;
}
.partemapa1 iframe{
  width: 80%;
  height: 380px;
}
.partemapa2{
  width: 50%;
  padding-top: 50px;
}
.partemapa2 span{
  font-size: 40px;
  margin-left: 50px;
  text-transform: uppercase;
}
.partemapa2 p{
  font-size: 20px;
  display: block;
  margin-left: 50px;
}


/* Media query para telas menores */
@media (max-width: 768px) {
    
  nav {
   
    height: 80px;
    align-items: center;
  }
  nav ul {
      display: none;
      flex-direction: column;
      width: 100%;
  }

  nav ul.active {
      display: flex;
  }

  nav .menu-btn i {
      display: block;
  }
/* -------------------------- */
  .ImagensCarrousel{
    width: 100%;
    height: 400px;
  }
  .ImagensCarrousel img{
    width: 100%;
    height: 400px;
    }
  /* ___________________ */
  .OfertasdaSemana{
    width: 100%;
    height: 1200px;
  }
  .ParteOfertas{
    display: block;
    background-color: #000;
  }
  .parte1ofertas{
    width: 100%;
    height: 420px;
  }
  .parte2ofertas{
    width: 100%;
    height: 420px;
    margin-top: -50px;
  }
  .parte3ofertas{
    width: 100%;
    height: 420px;
    margin-top: -50px;
  }
  
/*--------------------- */

.cafemanha{
  width: 100%;
  height: 600px;
  display: block;
}

.cafeimg{
  width: 100%;
  height: 300px;
  display: flex;
  background-color: #ffffff;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background-color 0.3s ease; 
}
.cafeimg img{
width: 40%;
height: 70%;
object-fit: cover;
margin-left: 40px;
}
.cafetexto{
  width: 100%;
  height: 300px;
  display: flex;
  background-color: #ffffff;
}
/* _________________________ */

.aaa{
  width: 350px;
  border-radius: 10px;
  font-size: 18px;
  margin-left: 9%;
  margin-right: 9%;
}

.calcularvalor{
  width: 150px;
  height: 50px;
  background-color: #96ad79;
  margin-left: 40px;
}
.Limparformulario{
  width: 150px;
  height: 50px;
  background-color: #96ad79;
  margin-top: 20px;
  margin-left: 20px;
}

/* ___________________________ */
.parteMapa{
  height: 520px;
  display: block;
}
.partemapa1{
  width: 100%;
  align-items: center;
  justify-content: center;
  display: flex;
}
.partemapa1 iframe{
  width: 80%;
  height: 250px;
  margin-top: 20px;
}
.partemapa2{
  width: 100%;
  padding-top: 20px;
}
.partemapa2 span{
  font-size: 30px;
  margin-left: 50px;
  text-transform: uppercase;
}
}

</style>

    <div class="partedahome">
      <nav>
          <div class="logo"> GOLD HOTEL </div>
          <div class="menu-btn">
              <i class="fas fa-bars"></i>
          </div>
          <ul>
              <li><a class="BotaoHome">HOME</a></li>
              <li><a class="BotaoSobre" href="{{ route('hospede.login') }}">LOGIN</a></li>
              <li><a class="BotaoAnimais" href="{{ route('hospede.cadastro') }}" >CADASTRAR-SE</a></li>
          </ul>
      </nav>
    </div>

    <div class="linhaBranca"></div>
    <DIV class="ImagensCarrousel">
            <div id="carouselExample" class="carousel slide">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="../img/principal1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="../Img/principal2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="../Img/principal3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
    </DIV>

    <div class="OfertasdaSemana">
      <div class="ofertasTitulo">Opções de Quarto</div>
      <div class="ParteOfertas">
          <div class="parte1ofertas">
            <div class="ParteBranca">
                  <p class="TituloCaixa">Apartamento vista Mar </p>
                  <img src="./Img/suitemar.jpg">
                  <div class="ParteInterna">
                    <div class="ParteEscrita">
                      <ul>
                        <li>Cama King</li>
                        <li>Vista Mar</li>                     
                        <li>Café da manhã</li>
                      </ul>
                    </div>
                    <div class="PartePreco">
                      <a class="precodiaria">R$ 357</a>
                      <a class="diaria">/diária</a><br>
                      <button>Ver detalhes</button>
                    </div>
                  </div>
            </div>
          </div>

          <div class="parte2ofertas">
            <div class="ParteBranca">
                  <p class="TituloCaixa">Apartamento vista Jardim</p>
                  <img src="./Img/suitejardim.jpg">
                  <div class="ParteInterna">
                    <div class="ParteEscrita">
                      <ul>
                        <li>Wife</li>
                        <li>Estacionemento</li>                     
                        <li>sem café</li>
                      </ul>
                    </div>
                    <div class="PartePreco">
                      <a class="precodiaria">R$ 294</a>
                      <a class="diaria">/diária</a><br>
                      <button>Ver detalhes</button>
                    </div>
                  </div>
            </div>
          </div>

          <div class="parte3ofertas">
            <div class="ParteBranca">
              <p class="TituloCaixa">Apartamento Luxo</p>
              <img src="./Img/suiteluxo.jpg">
              <div class="ParteInterna">
                <div class="ParteEscrita">
                  <ul>
                    <li>Hidromasagem</li>
                    <li>Estacionamento</li>
                    <li>Café da manhã</li>
                  </ul>
                </div>
                <div class="PartePreco">
                  <a class="precodiaria">R$ 378</a>
                  <a class="diaria">/diária</a><br>
                  <button>Ver detalhes</button>
                </div>
              </div>
        </div>  
      </div>
    </div>
    </div>
  
<div class="cafemanha">
  <div class="cafetexto">
          <div class="partetitlediv">
          <p class="titlecafe">Café da manhã</p>
          <P class="textocafe">Diversas opções</P>
          <ul>
            <li>Bolo Salgado</li>
            <li>Bolo Doce</li>
            <li>Omelete</li>
            <li>Sucos</li>
            <li>Café Gourmet</li>
            <li>Frutas</li>
          </ul>
  </div>
  </div>
        <div class="cafeimg">
          <img src="./Img/cafe1.jpg" alt="" width="">
          <img src="./Img/cafe2.jpg" alt="">
        </div>
    </div>
  </div>

  <div class="linhaPreta"></div>
 
      <div class="SimulaReserva">
            
          <div class="PrincipalFomrs">

                  <h1>Faça sua Reserva</h1>
                
                  <label for="nome">Nome do Hóspede:</label>
                  <input class="aaa colorblack form-input" type="text" id="nome" required>
              
                  <label for="Email">Quantidade de Pessoas: </label>
                  <input class="aaa colorblack form-input" type="number" id="qtdPessoas"required>
              
                  <label for="idade">Quantidade de Dias: </label>
                  <input class="aaa colorblack form-input" type="number" id="qtdDias" required>
              
                  <label for="tipo">Tipo de acomodação:</label>
                  <select class="aaa colorblack form-input"  name="tipo" id="tipodeaco" required>
                      <option value="VMar">Apartamento vista Mar</option>
                      <option value="VJardim">Apartementp vista Jardim</option>
                      <option value="Luxo">Apartamento Luxo</option>

                  </select>
                  <br>

                  <button class="calcularvalor" onclick="vhamaasfuncoes()">Calcular  Valor</button>
                  <button class="Limparformulario" onclick="limparFormulario()">Limpar Simulação</button>
                  <div class="valordasreservas">Valor reservas: </div>

          </div>
        </div>
      </div>

      <div class="linhaPreta"></div>
      <div class="parteMapa">
        <div class="partemapa1">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5956.511292539504!2d-48.4343492781542!3d-27.41432846073468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1spt-BR!2sbr!4v1718154933642!5m2!1spt-BR!2sbr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="partemapa2">
          <span>Nossa Localização</span>
          <p>Estamos localizados em Florianopolis, Santa Catarina, Praia das Canavieiras. </p>
          <p>Rua Canva, 99 XD </p>
        </div>
      </div>
       
      <div class="rodape">
        <P> &#169Todos os direitos reservados</P>
      </div>


    <Script src="./js.js"></Script>
  </body>
</html>