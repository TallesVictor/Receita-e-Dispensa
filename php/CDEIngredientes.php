<?php
include '../bd/conexao.php';
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$nomePagina = $_POST['nomePagina'];
if ($nomePagina == 'crudIngredientes') {
    $form1 = $_POST['form1'];
    if ($form1 == 'form1') {
        //Cadastrar
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];
        $sql = "INSERT INTO ingredientes (produto, categoria) VALUES(?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $categoria));
    } else {
        $editar = $_POST['alteracao'];
        if ($editar != "") {
            //Editar
            $nome = $_POST['produto'];
            $categoria = $_POST['categoria'];
            $codigo = $_POST['codigo'];
            $sql = "UPDATE ingredientes SET produto=?, categoria=? WHERE id=?";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome, $categoria, $codigo));
        } else {
            //Deletar
            $id = $_POST['codigo'];
            $sql = "DELETE FROM ingredientes where id = ?";
            $q = $pdo->prepare($sql);
            $s = $pdo->query('SET FOREIGN_KEY_CHECKS=0;');
            $q->execute(array($id));
        }
    }
} else
    //Tela Dispensa
    if ($nomePagina == 'dispensa') {
        $nome = $_POST['nomeIngrediente'];
        $form = $_POST['enviar'];
        $id = $_POST['id'];
        //Contador para armazenar no vetor
        $i = 0;
        //Salvar a lista
        if ($form == 'Salvar Lista') {
            $sql = "SELECT * FROM estoque WHERE idUsuario=$id";
            foreach ($pdo->query($sql) as $row) {
                $nomeIngr[$i] = $row['nomeIngredientes'];
                $nomeIngredienteQtd[$i] = str_replace(' ', '', $nomeIngr[$i]);
                $nomeIngredienteQtd[$i] = 'quantidade' . $nomeIngredienteQtd[$i];
                $quantidadeIngrediente[$i] = $_POST[$nomeIngredienteQtd[$i]];
                //fazer a alteração do numero dos ingredientes na lista
                $sql = "UPDATE estoque SET quantidade=? WHERE  nomeIngredientes=? AND  idUsuario=?";
                $q = $pdo->prepare($sql);
                $q->execute(array($quantidadeIngrediente[$i], $nomeIngr[$i], $id));
                //Somar para o vetor
                $i++;
            }
        } else {
            //Deletar Ingredientes do estoque
            if (!empty($nome)) {
                $sql = "DELETE FROM estoque WHERE nomeIngredientes = ? and idUsuario=? LIMIT 1";
                $q = $pdo->prepare($sql);
                $s = $pdo->query('SET FOREIGN_KEY_CHECKS=0;');
                $q->execute(array($nome, $id));
            }
        }
    }

Banco::desconectar();
//Chamar outra pagina
if ($nomePagina == 'dispensa') {
    if ($form == 'Salvar Lista') {
        header("Location: ../lista.php");
    } else
        header("Location: ../dispensa.php");
} else if ($nomePagina == 'crudIngredientes') {
    header("Location: ../crudIngredientes.php");
}
