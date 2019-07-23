<?php
include '../bd/conexao.php';
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$nomePagina = $_POST['nomePagina'];
if ($_POST['nomePagina'] == 'crudReceita') {

  if (isset($_POST['formInput'])) {

    $quantidadeIngredientes = $_POST['quantidadeIngredientesInput'];
    $nome = $_POST['nome'];
    $modoPreparo = $_POST['modoPreparo'];
    $tempoPreparo = $_POST['tempoPreparo'];
    $rendimento = $_POST['rendimento'];

    if ($_POST['formInput'] == 'verificacao') {
      //Cadastrar

      //inserindo em receitas
      $sql = "INSERT INTO receitas (nome, modoPreparo, tempoPreparo, rendimento) VALUES(?,?,?,?);";
      $q = $pdo->prepare($sql);
      $q->execute(array($nome, $modoPreparo, $tempoPreparo, $rendimento));

      $sql = "SELECT id FROM receitas WHERE id = (SELECT MAX(id) FROM receitas)";
      foreach ($pdo->query($sql) as $row) {
        $idReceita = $row['id'];
      }

      for ($i = 1; $i <= $quantidadeIngredientes; $i++) {
        $ingrediente = $_POST['ingrediente' . $i];
        $quantidade = $_POST['quantidade' . $i];
        $unidade = $_POST['unidade' . $i];

        //armazenando idIngrediente 
        $sql = "SELECT id FROM ingredientes WHERE produto = '$ingrediente'";
        foreach ($pdo->query($sql) as $row) {
          $idIngrediente = $row['id'];
        }

        //inserindo em itens_receita
        $sql = "INSERT INTO itens_receita (quantidade, unidade, idReceita, idIngrediente) VALUES(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($quantidade, $unidade, $idReceita, $idIngrediente));
      }
    }
  } else if (isset($_POST['formTabela'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $ingrediente = $_POST['ingrediente'];
    $quantidade = $_POST['quantidade'];
    $unidade = $_POST['unidade'];
    $modoPreparo = $_POST['modoPreparo'];
    $tempoPreparo = $_POST['tempoPreparo'];
    $rendimento = $_POST['rendimento'];
    $idItem = $_POST['idItem'];

    echo $_POST['formTabela'];
    if ($_POST['formTabela'] == "editar") {
      //Editar

      echo $id . "|| " . $nome . "|| " . $ingrediente . "|| " . $quantidade . "|| " . $unidade . "|| " .  $modoPreparo . "|| " . $tempoPreparo . "|| " . $rendimento . "|| " . $idItem;

      //atualizando receitas
      $sql = "UPDATE receitas SET modoPreparo=?, tempoPreparo=?, rendimento=? WHERE id=?;";
      $q = $pdo->prepare($sql);
      $q->execute(array($modoPreparo, $tempoPreparo, $rendimento, $id));

      //atualizando itens_receita
      $sql = "UPDATE itens_receita SET idReceita=(SELECT id FROM receitas WHERE nome=?),
    idIngrediente=(SELECT id FROM ingredientes WHERE produto=?), quantidade=?, unidade=?  WHERE id=$idItem";
      $q = $pdo->prepare($sql);
      $q->execute(array($nome, $ingrediente, $quantidade, $unidade));
    } else if ($_POST['formTabela'] == "apagar") {
      //Apagar

      //apagando itens_receita
      $sql = "DELETE FROM itens_receita WHERE id=?;";
      $q = $pdo->prepare($sql);
      $q->execute(array($idItem));

      //armazenando quantidadeReceitas
      $sql = "SELECT MAX(id) as id FROM receitas;";
      foreach ($pdo->query($sql) as $row) {
        $quantidadeReceitas = $row['id'];
      }

      //checagem/apagando receitas vazias
      for ($i = 1; $i <= $quantidadeReceitas; $i++) {
        $sql = "SELECT * FROM itens_receita WHERE idReceita=$i;";
        foreach ($pdo->query($sql) as $row) {
          $verificacaoReceita = $row['idReceita'];
        }
        if (empty($verificacaoReceita)) {
          $sql = "DELETE FROM receitas WHERE id=?;";
          $q = $pdo->prepare($sql);
          $q->execute(array($i));
        }
      }
    }
  }
}

Banco::desconectar();
//Chamar outra pagina
header("Location: ../crudReceita.php");
