<?php
require 'banco.php';
$id=0;
if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
}
if(!empty($_POST))
{
    $id = $_POST['id'];


    // Delete do banco
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "delete from aluno where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();

    header("Location: crud.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"; rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Delete</title>
</head>

<body>
    <div class="container">
        <div class="span10 offset">
            <div class="row">
                <h3 class="well">Excluir contato</h3>
            </div>
            <form class="form-horizontal" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <div class="alert alert-danger">
                    Deseja excluir o contato?
                </div>
                <div class="form actions">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <a href="crud.php" type="btn" class="btn btn-danger">Não</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>