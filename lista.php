<html lang="pt-br">

<head>
    <?php
    //Retirar o espaço das palavras do name
    // Fazer um vetor, utilizando SELECT, para armezenar os nomes dos ingredientes. http://www.mauricioprogramador.com.br/posts/substituir-string-str_replace
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
                        <a class="navbar-brand" > <img src="logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav">
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
                            <h2>Sua Lista,
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
                                ?>! <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAABpFBMVEVHcEz///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8sEZlaAAAAi3RSTlMA+BHZiAj5B+UG28sO2vbJF4nkTfsT1xIBztwVKYpQt7bNRypwcgRGA8rm7CvojPwNwQ8Qs1rjZ25I67llW+pJxSztb5UuIDALhwXpw1FOsrF9UgJ/gH61vr9kWWjMS0XQFNjRDJLE9/VtkxbI3xvuCtY7i0+NOsDned1YV0RKeMfPL5YiIyHGuDG030waJwAAAq9JREFUSMfFVmdT20AQlS0juWFj3LCNcYVgejPF9E4ooYbeO4SW3kN6e386WF22ZGkyk8l92aJ7c7fa3bdHEP9p2d2uOd+UwzHlm3O57dr76bcRDyTLE31nKQgoGi4FDKvzFeXGyUljecXymgFo7yxSR8StgG29Repq7dkCiu+pHTECxBQ+dn0CzmklRIkNp2fVSl+qhx1wPsr3j1nhG1S78SiJ4rFcZ4hEak89SuMxgiU5cdjwY6LQv5y4gFMezxf4/IUT5iVxLrX7cTqoleRRB+KSawVxpl0YSVjFnFYiVq0NqdpFUqirUuzoqdcPqOGP6YVNV4mXxZDm1G6s62uLDkS4NDUahEq0uGrMJkm1y20j5WlllAqsCltM2R4xEWr2SzxgZAPmBZ85u8VMqNkP8ZSRUQ4qbCkl1OwZtDGyGOXyi9wn1Ow6kIyshVcM12SWhy+395BhJAWLXvKhYfhbyBD8eiEh9OWFr7HqsM/IFTzTC1nALJfKZdYx4FShU7vtmE9lmCuYNdYRwE9FuqK7EWC1Zrj5smSL7VsGbTf5iJvf6PvKaH7KY+eLv4dVfg0hdZWLuEphaJxVNxEVWmyL0xKXuE7LEb3XuExwLRbABs8WZoE7SiLAwHsRsPMRiPKct412WqSLAE8XZR0ZINgQTzQ1JbqevwH6esp4ujhAp5SUhgWj6XW9OJFe3R5KeIikpdTnGBWtxSfh6XqDoX7a9WJR9I6fQDZJRkB6NcrLiqNcGr8oSOOHzlwaJ0L7SIXUEf6BvGFBEN+tID+rIcatCiOJGXyOZJUiGVeeKA4+drzu9ufT6vYBcESrnN91N8RjHUZZEJuBAkM8e1Dy7qlANS/N1HktFu/gwlIzlX0q0IUJIR1plD1IVjZo7W5tcYfbfLUUVft4Nqzn2fNv1h/mMa1hHT1A+gAAAABJRU5ErkJggg=="></h2>
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
                                <input type="text" class="form-control" placeholder='Adicionar mais alimentos' name="nome">
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
                        <h2>Lista</h2>
                        <h5>Caso você deseje que algum ingrediente não apareça na sua lista, favor deixar a quantidade negativa.</h5>
                    </div>

                    <div class="menos">
                        <form method="post" action="php/imagem.php" name="formIngredientes" target="_blank">
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
                                $sql = "SELECT * FROM estoque WHERE quantidade=0 AND idUsuario= $id";
                                $i = 0;
                                foreach ($pdo->query($sql) as $row) {
                                    $i++;
                                    $name = $row['nomeIngredientes'];
                                    $name = str_replace(' ', '', $name);
                                    if ($i > 0) {
                                        echo "        
                                             <tr>
                                                 <td>
                                                    <h3>
                                             
                                                        <input type=" . '"hidden"' . " name='nomeIngrediente$i' value=" . '"' . $row['nomeIngredientes'] . '"' . ">
                                                        
                                                        <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAZlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAABHcEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAbzgd7AAAAInRSTlNNrO37vKtlAFMM6qXovUiqSUZH7LvuC6SjZGP8rq3rpum6iyEHpwAAAHtJREFUCNdVz9kOgyAQBdABBgoC7lq3Vv3/nyyITOx9IDkhs8HrPxAfo6y3ymTX3w4Z8qJMrtdKA4CWoo02RQUpzJlg1enbms/Bew85+A7uJVmewRbJPv4rTvXDcvXPBR83xvmlYNf8TTRpv/bgyPzgGtp/nnBaRrrnkR/d9wZkF0iOUAAAAABJRU5ErkJggg=='>
                                                        <label id='elementos' value=" . $row['nomeIngredientes'] . ">" . $row['nomeIngredientes'] . " </label></h3>
                                                             <button type='button' class='btn btn-outline-dark btn-sm somar' onclick=" . '"mais(' . "'quantidade$i'" . ')"' . ">+</button>
                                                        <input  name=" . '"quantidade' . $i . '"' . "class='form-control form-control-sm quantidadeIngredientes quantidade' type='number' id='quantidade$i' value=" . $row['quantidade'] . ' onkeypress="return onlynumber();">' . "
                                                        <button type='button' class='btn btn-outline-dark btn-sm subtrair' onclick=" . '"menos(' . "'quantidade$i'" . ')"' . ">-</button>
                                                        </td>
                                                       
                                            </tr>
                                        ";
                                    }
                                }
                                if ($i == 0) {
                                    echo '<h2>Sem ingredientes</h2>';
                                }
                                echo " <input type=" . '"hidden"' . " name='quantidade' value=$i>"
                                ?>
                            </table>
                            <br>
                            <input type="submit" name="enviar" class="btn btn-dark" value="Gerar Imagem">
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
                    if (qnt > -20)
                        id(id_qnt).value = qnt - 1;
                }

                function mais(id_qnt) {
                    id(id_qnt).value = parseInt(id(id_qnt).value) + 1;
                }

                function onlynumber(evt) {
                    var theEvent = evt || window.event;
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode(key);
                    //var regex = /^[0-9.,]+$/;
                    var regex = /^[0-9.]+$/;
                    if (!regex.test(key)) {
                        theEvent.returnValue = false;
                        if (theEvent.preventDefault) theEvent.preventDefault();
                    }
                }
            </script>
</body>

</html>