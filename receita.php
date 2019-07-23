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
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2>Receitas</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--::chefs_part start::-->
  <!-- food_menu start-->


  <!--------------------------------------------------AAA------------------------------------------------->

  <!--------------------------------------------------<UTIL>------------------------------------------------->
  <?php include 'bd/conexao.php';
  if (isset($_POST['formBuscar'], $_POST['checkBox'])) {
    $buscar = $_POST['buscarInput'];
    $checkBox = $_POST['checkBox'];
  } ?>
  <form method="post" name="form1" action="receita.php">

    <input type='hidden' name='nomePagina' value='receita'>
    <input type='hidden' name='formBuscar' value='formBuscar'>
    <!--------------------------------------------------</UTIL>------------------------------------------------->

    <section class="food_menu gray_bg">
      <div class="container-fluid">
        <div class="row justify-content-between">
          <div class="col-lg-5">
            <div class="section_tittle">
              <h2>Receitas</h2>
              <p>Busque pela receita que deseja</p>
            </div>
          </div>
          <!--buscar-->
          <div class="col-lg-4">
            <div class="blog_right_sidebar">
              <aside class="single_sidebar_widget search_widget">
                <div class="form-group">
                  <div class="input-group mb-3">
                    <!--------------------------------------------------<UTIL>------------------------------------------------->

                    <input type="text" class="form-control" name="buscarInput" placeholder='Pesquise sua receita' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                    <!--------------------------------------------------</UTIL>------------------------------------------------->

                    <div class="input-group-append">
                      <button class="btn" type="button"><i class="ti-search"></i></button>
                    </div>
                  </div>
                </div>

                <!--------------------------------------------------<UTIL>------------------------------------------------->
                <p>Sua pesquisa vai ser por: </p>
                <div class="custom-control custom-checkbox">

                  <input type="radio" class="custom-control-input" name="checkBox" value="porIngrediente" id="checkBoxIngrediente">
                  <label class="custom-control-label" for="checkBoxIngrediente">Ingredientes</label>

                </div>
                <p>ou</p>
                <div class="custom-control custom-checkbox">

                  <input type="radio" class="custom-control-input" name="checkBox" value="porNome" checked id="checkBoxReceitas">
                  <label class="custom-control-label" for="checkBoxReceitas">Receitas prontas</label>

                </div>
                <button class="button rounded-0 primary-bg text-white w-100 btn_4" type="submit" name="">buscar</button>
  </form>
  <!--------------------------------------------------</UTIL>------------------------------------------------->

  </aside>
  </div>
  </div>
  <!--fim buscar -->


  <!--------------------------------------------------<UTIL>------------------------------------------------->

  <div class="col-lg-12">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active single-member" id="Special" role="tabpanel" aria-labelledby="Special-tab">
        <div class="row">

          <!--------------------------------------------------COlUNA 1------------------------------------------------->
          <?php
          $pdo = Banco::conectar();
          if (isset($checkBox, $buscar)) {
            if ($checkBox == "porNome") {
              $sql = "SELECT * FROM receitas WHERE nome LIKE '%$buscar%' GROUP BY nome;";
            } else if ($checkBox == "porIngrediente") {
              $sql = "SELECT receitas.id ,receitas.nome, receitas.imagem
        FROM ingredientes, itens_receita, receitas  
        WHERE receitas.id = itens_receita.idReceita 
        AND itens_receita.idIngrediente = ingredientes.id 
        AND ingredientes.produto LIKE '%$buscar%'
        GROUP BY nome ORDER BY receitas.nome;";
            }
          } else {
            $sql = 'SELECT * FROM receitas ORDER BY nome;';
          }
          foreach ($pdo->query($sql) as $row) {

            $sql2 = "SELECT ingredientes.produto , itens_receita.quantidade , 
            itens_receita.unidade 
        FROM ingredientes, itens_receita, receitas
        WHERE receitas.id = itens_receita.idReceita 
        AND itens_receita.idIngrediente = ingredientes.id 
        AND receitas.id = " . $row['id'] . "
        ORDER BY receitas.id LIMIT 1;";
            foreach ($pdo->query($sql2) as $row2) {

              $sql3 = "SELECT ingredientes.produto , itens_receita.quantidade , 
              itens_receita.unidade
        FROM ingredientes, itens_receita, receitas
        WHERE receitas.id = itens_receita.idReceita 
        AND itens_receita.idIngrediente = ingredientes.id 
        AND receitas.id = " . $row['id'] . "
        ORDER BY receitas.id LIMIT 1,1;";
              foreach ($pdo->query($sql3) as $row3) {

                echo '
                <div class="col-sm-6 col-lg-6">
                  <div class="single_food_item media">
                  <img src="data:image/jpeg;base64,'.base64_encode( $row['imagem'] ).' " class="img-thumbnail" style="width: auto; max-height: 100%; height: 150px" alt="...">
                    <div class="media-body align-self-center">
                      <h3>' . $row['nome'] . '</h3>
              <p>' . $row2['produto'] . ' ' . $row2['quantidade'] . ' ' . $row2['unidade'] . '</p>
              <p>' . $row3['produto'] . ' ' . $row3['quantidade'] . ' ' . $row3['unidade'] . '</p>
                <br>
                <form method="post" name="form2" id="form2" action="receitaPreparo.php">
                <input type="hidden" name="id" value="' . $row['id'] . '">
                <button type="submit" class="btn btn-outline-warning" >Veja mais <img src="img/icon/left_2.svg"></button>
              </form>
              </div>
            </div>
          </div>';
              }
            }
          }
          $pdo = Banco::desconectar(); ?>
        </div>
      </div>
    </div>
  </div>

  </section>
  <!-- food_menu part end-->
  <!--::chefs_part end::-->

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