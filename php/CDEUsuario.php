<?php
include '../bd/conexao.php';
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$form1 = $_POST['form1'];
if ($form1 == 'form1') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo'];
    echo $nome . "<br>" . $email . "<br>" . $senha;
    $sql = "INSERT INTO usuario (nome, email, senha,cargo) VALUES(?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nome, $email, $senha, $cargo));
} else {
    $editar = $_POST['alteracao'];
    if ($editar != "") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $codigo = $_POST['codigo'];
        $cargo = $_POST['cargo'];
        $sql = "UPDATE usuario SET nome=?, email=?, senha=?,cargo=? WHERE id=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $email, $senha, $codigo, $cargo));
    } else {

        $id = $_POST['codigo'];
        $sql = "DELETE FROM usuario where id = ?";
        $q = $pdo->prepare($sql);
        $s = $pdo->query('SET FOREIGN_KEY_CHECKS=0;');
        $q->execute(array($id));
    }
}
Banco::desconectar();
header("Location: ../crudUsuarios.php");
