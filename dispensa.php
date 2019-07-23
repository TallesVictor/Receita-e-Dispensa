<html lang="pt-br">

<head>
    <?php
    session_start();
    if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
    $logado = $_SESSION['login'];
    ?>
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
                            <h2>Bem Vindo a dispensa
                                <?php
                                $login = $_SESSION['login'];
                                $senha = $_SESSION['senha'];
                                $id;
                                include 'bd/conexao.php';
                                $pdo = Banco::conectar();
                                $sql = "SELECT * FROM usuario WHERE email='$login' AND senha='$senha'";
                                foreach ($pdo->query($sql) as $row) {
                                    echo $row['nome'];
                                    $id = $row['id'];
                                }
                                ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--me lembra de te explicar isso-->

    <!-- food_menu start-->
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm">
            <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget search_widget">
                    <form action="#" method="post" name="form1">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder='Cadastre o alimento' name="nome">
                            </div>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_4" type="submit" name="alteracao">adicionar</button>
                    </form>
                </aside>
            </div>
        </div>
        <div class="col-sm"></div>
    </div>
    <section class="food_menu gray_bg">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="section_tittle">
                        <h2>Dispensa</h2>
                        <p>Aqui está seus alimentos cadastrados</p>
                    </div>
                    <div class="menos">
                        <form method="post" action="php/CDEIngredientes.php" name="formIngredientes">
                            <table>
                                <?php

                                //Verificar se o input com name igual a nome, está vazio.
                                if (!empty($_POST['nome'])) {
                                    $nome = $_POST['nome'];
                                    $sql = "SELECT * FROM estoque WHERE idUsuario=$id and nomeIngredientes='$nome'";
                                    //Contar para VER se ja tem algum igrediente com o mesmo nome
                                    $i = 0;
                                    //Verificar se o nome existe
                                    foreach ($pdo->query($sql) as $row) {
                                        $i++;
                                    }
                                    if ($i == 0) {
                                        $sql = "INSERT INTO estoque (nomeIngredientes,quantidade,idUsuario) VALUE (?,0,$id);";
                                        $q = $pdo->prepare($sql);
                                        $q->execute(array($nome));
                                        echo "<div class='alert alert-success' role='alert'>
                                        Ingrediente cadastradado com sucesso.
                                       </div>";
                                    } else {
                                        echo "<div class='alert alert-danger' role='alert'>
                                        Ingrediente já cadastrado.
                                      </div>";
                                    }
                                }
                                $sql = "SELECT * FROM estoque WHERE idUsuario= $id";
                                $i = 0;
                                foreach ($pdo->query($sql) as $row) {
                                    $i++;
                                    $name = $row['nomeIngredientes'];
                                    $name = str_replace(' ', '', $name);
                                    if ($i > 0) {
                                        echo "        
                                             <tr>
                                                 <td>
                                                 <form method='post' action='php/CDEIngredientes.php' name='formDispensa'>
                                                    <h3>
                                                        <input type=" . '"hidden"' . " name='id' value='$id'>    
                                                        <input type=" . '"hidden"' . " name='nomePagina' value='dispensa'>
                                                        <input type=" . '"hidden"' . " name='nomeIngrediente' value=" . '"' . $row['nomeIngredientes'] . '"' . ">
                                                        <button  type='submit' name='enviar' style=' background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;'>
                                                        <div class='icons8-excluir'></div> </button>
                                                        </form>
                                                        <label id='elementos'>" . $row['nomeIngredientes'] . " </label></h3>
                                                        <input type=" . '"hidden"' . "name=" . '"' . $name . '"' . " value=" . '"' . $row['nomeIngredientes'] . '"' . ">
                                                             <button type='button' class='btn btn-outline-dark btn-sm somar' onclick=" . '"mais(' . "'quantidade$i'" . ')"' . ">+</button>
                                                        <input  name=" . '"quantidade' . $name . '"' . "class='form-control form-control-sm quantidadeIngredientes quantidade' type='number' id='quantidade$i' value=" . $row['quantidade'] . ">
                                                        <button type='button' class='btn btn-outline-dark btn-sm subtrair' onclick=" . '"menos(' . "'quantidade$i'" . ')"' . ">-</button>
                                                        </td>
                                            </tr>
                                        ";
                                    }
                                }
                                ?>
                            </table>
                            <br>
                            <input type="submit" name="enviar" class="btn btn-dark" value="Salvar Lista">
                    </div>

                    </form>
                </div>
                <!--fim mais e menos-->
            </div>
            <!--fim de me lembra de te expicar isso-->



            <!--buscar-->
            <!--fim buscar -->
            <?php

            ?>


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
            <script type="text/javascript">
                function id(el) {
                    return document.getElementById(el);
                }

                function menos(id_qnt) {
                    var qnt = parseInt(id(id_qnt).value);
                    if (qnt > 0)
                        id(id_qnt).value = qnt - 1;
                }

                function mais(id_qnt) {
                    id(id_qnt).value = parseInt(id(id_qnt).value) + 1;
                }
            </script>
</body>

</html>