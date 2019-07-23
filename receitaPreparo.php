<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Esqueci</title>
  <link rel="icon" href="icon.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <!-- themify CSS -->
  <link rel="stylesheet" href="css/themify-icons.css">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="css/flaticon.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/magnific-popup.css">
  <!-- swiper CSS -->
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/gijgo.min.css">
  <link rel="stylesheet" href="css/nice-select.css">
  <link rel="stylesheet" href="css/all.css">
  <!-- style CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!--::header part start::-->
  <header class="main_menu">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand"> <img src="logo.png" alt="logo"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="dispensa.php">Dispensa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="receita.php">Receitas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="lista.php">Lista</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="graficos.php">Gráficos</a>
                </li>

              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- Header part end-->
  <!-- breadcrumb start-->

  <!--------------------------------------------------AAA------------------------------------------------->
  <?php include 'bd/conexao.php';
  $pdo = Banco::conectar();
  $id = $_POST['id'];
  $sql = "SELECT receitas.nome ,ingredientes.produto , itens_receita.quantidade , 
itens_receita.unidade, receitas.modoPreparo
FROM ingredientes, itens_receita, receitas
WHERE receitas.id = itens_receita.idReceita 
AND itens_receita.idIngrediente = ingredientes.id 
AND receitas.id = " . $id . "
ORDER BY receitas.id;"; ?>

  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2><?php foreach ($pdo->query($sql) as $row) { $nome = $row['nome']; } 
              echo $nome; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--------------------------------------------------AAA------------------------------------------------->
  <!--------------------------------------------------BBB------------------------------------------------->
  <!-- breadcrumb start-->

  <!-- food_menu start-->
  <section class="food_menu gray_bg">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="section_tittle">
            <h2>Receita:</h2>
            <div align="center">
              <?php
              foreach ($pdo->query($sql) as $row) {
                echo '<p>' . $row['produto'] . ' ' . $row['quantidade'] . ' ' . $row['unidade'] . '</p>';
              } ?>
              <br>
              <h5><b>Modo de preparo</b></h5>
              <p><?php foreach ($pdo->query($sql) as $row) { $modoPreparo = $row['modoPreparo']; } 
              echo ($modoPreparo); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>









  <!-- jquery plugins here-->
  <!-- jquery -->
  <script src="js/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="js/swiper.min.js"></script>
  <!-- swiper js -->
  <script src="js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- swiper js -->
  <script src="js/slick.min.js"></script>
  <script src="js/gijgo.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
</body>

</html>