<!doctype html>
<html lang="pt-br">

<head>
  <?php
  session_start();
  if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('location:login.php');
  }
  $login = $_SESSION['login'];
  $senha = $_SESSION['senha'];
  $id;
  //Verificação de Administrador
  include 'bd/conexao.php';
  $pdo = Banco::conectar();
  $sql = "SELECT * FROM usuario WHERE email='$login' AND senha='$senha'";
  foreach ($pdo->query($sql) as $row) {
    $cargo = $row['cargo'];
  }
  if ($cargo != "Administrador") {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('location:login.php');
  } else
    $logado = $_SESSION['login'];
  ?>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dingo</title>
  <link rel="icon" href="img/favicon.png">
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
            <a class="navbar-brand" href="index.html"> <img src="img/logo.png" alt="logo"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.html">Nossa Hitória</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="dispensa.php">Dispença</a>
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

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    CRUD
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="crudIngredientes.php">CRUD Ingredientes</a>
                    <a class="dropdown-item" href="crudReceita.php">CRUD Receita</a>
                    <a class="dropdown-item" href="crudUsuarios.php">CRUD Usuarios</a>
                  </div>
                </li>
              </ul>
            </div>
            <div class="menu_btn">
              <a class="btn_1 d-none d-sm-block" href="php/sair.php">Sair</a>
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
              <h2>CRUD ingredientes</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->


  <style type="text/css">
    table a:link {
      color: #666;
      font-weight: bold;
      text-decoration: none;
    }

    table a:visited {
      color: #999999;
      font-weight: bold;
      text-decoration: none;
    }

    table a:active,
    table a:hover {
      color: #bd5a35;
      text-decoration: underline;
    }

    table {
      font-family: Arial, Helvetica, sans-serif;
      color: #666;
      font-size: 12px;
      text-shadow: 1px 1px 0px #fff;
      background: #eaebec;
      margin: 20px;
      border: #ccc 1px solid;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border-radius: 3px;
      -moz-box-shadow: 0 1px 2px #d1d1d1;
      -webkit-box-shadow: 0 1px 2px #d1d1d1;
      box-shadow: 0 1px 2px #d1d1d1;
    }

    table th {
      padding: 21px 25px 22px 25px;
      border-top: 1px solid #fafafa;
      border-bottom: 1px solid #e0e0e0;
      background: #ededed;
      background: -webkit-gradient(linear, left top, left bottom, from(#ededed),
          to(#ebebeb));
      background: -moz-linear-gradient(top, #ededed, #ebebeb);
    }

    table th:first-child {
      text-align: left;
      padding-left: 20px;
    }

    table tr:first-child th:first-child {
      -moz-border-radius-topleft: 3px;
      -webkit-border-top-left-radius: 3px;
      border-top-left-radius: 3px;
    }

    table tr:first-child th:last-child {
      -moz-border-radius-topright: 3px;
      -webkit-border-top-right-radius: 3px;
      border-top-right-radius: 3px;
    }

    table tr {
      text-align: center;
      padding-left: 20px;
    }

    table td:first-child {
      text-align: left;
      padding-left: 20px;
      border-left: 0;
    }

    table td {
      padding-top: 5px;
      border-top: 1px solid #ffffff;
      border-bottom: 1px solid #e0e0e0;
      border-left: 1px solid #e0e0e0;
      background: #fafafa;
      background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb),
          to(#fafafa));
      background: -moz-linear-gradient(top, #fbfbfb, #fafafa);
    }

    table tr.even td {
      background: #f6f6f6;
      background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8),
          to(#f6f6f6));
      background: -moz-linear-gradient(top, #f8f8f8, #f6f6f6);
    }

    table tr:last-child td {
      border-bottom: 0;
    }

    table tr:last-child td:first-child {
      -moz-border-radius-bottomleft: 3px;
      -webkit-border-bottom-left-radius: 3px;
      border-bottom-left-radius: 3px;
    }

    table tr:last-child td:last-child {
      -moz-border-radius-bottomright: 3px;
      -webkit-border-bottom-right-radius: 3px;
      border-bottom-right-radius: 3px;
    }

    table tr:hover td {
      background: #f2f2f2;
      background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2),
          to(#f0f0f0));
      background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0);
    }
  </style>

  <form method="post" name="form1" action="php/CDEIngredientes.php">
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label>Nome:</label>
            <input type='hidden' name='nomePagina' value='crudIngredientes'>
            <input type="hidden" name='form1' value='form1'>
            <input type="text" class="form-control" id="nome" name="nome" size="20" placeholder="Nome do alimento" Required />
          </div>
          <div class="form-group">
            <label>Categoria:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" size="3" placeholder="Categoria do alimento" Required />
          </div>
          <button type="submit" class="btn btn-primary" name="cadastrar" value="cadastrar">Cadastrar</button>
  </form>
  </div>
  <div class="col-sm">
  </div>
  <div class="col-sm">
  </div>
  </div>
  </div>
  <table cellpadding="3" cellspacing="4">

    <tr>
      <td> Nome</td>
      <td> Categoria </td>
      <td> Ação </td>

    </tr>
    <?php
    $sql = 'SELECT * FROM ingredientes ORDER BY id ';
    foreach ($pdo->query($sql) as $row) {
      echo "<tr>
      <form name=form2 method='post' action='php/CDEIngredientes.php' >    
      <td>
          <div class='input-group input-group-sm mb-3'>
            <input type='text' required class='form-control tabelaInput' id='produto' name='produto' size='20' value=" . $row['produto'] . ">
          </div>
        </td>
        <td>
          <div class='input-group input-group-sm mb-3'>
            <input type='text' required class='form-control tabelaInput'  id='categoria' name='categoria' size='20' value=" . $row['categoria'] . " >
          </div>
        </td>
        <td>
          <button type='submit' class='btn btn-secondary btn-sm' name='alteracao' value='editar'>Editar</button>
         <button type='submit' class='btn btn-secondary btn-sm' name='alteracao' value=''>Apagar</button>
        </td>
        <input type='hidden' name='codigo' value=" . $row['id'] . ">
        <input type='hidden' name='nomePagina' value='crudIngredientes'>
        <input type='hidden' name='form1' value='ss'>
      </form>
    </tr>";
    }
    Banco::desconectar();
    ?>
  </table>
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