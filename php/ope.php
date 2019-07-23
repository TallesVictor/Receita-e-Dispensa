<?php
include '../bd/conexao.php';
// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];
// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
$i = 0;
$pdo = Banco::conectar();
$sql = "SELECT * FROM usuario WHERE email='$login' AND senha='$senha' AND cargo='Administrador'";
$a = $pdo->query($sql);
foreach ($a as $row) {
  $i++;
}
if ($i > 0) {
  $_SESSION['login'] = $login;
  $_SESSION['senha'] = $senha;
  header('location:../admin.php');
} else {
  echo $i;
  $a = $pdo->query($sql);
  $sql = "SELECT * FROM usuario WHERE email='$login' AND senha='$senha'";
  $a = $pdo->query($sql);
  $i = 0;
  foreach ($a as $row) {
    $i++;
  }
  if ($i > 0) {
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    header('location:../dispensa.php');
  } else {
    $loginInvalido = 1;
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('location:../telainicial.html');
  }
}
Banco::desconectar();
