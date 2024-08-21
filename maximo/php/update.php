<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}

if (null == $id) {
    header("Location: crud.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }

    if (empty($endereco)) {
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
    }

    if (empty($telefone)) {
        $telefoneErro = 'Por favor digite o telefone!';
        $validacao = false;
    }

    if (empty($sexo)) {
        $sexoErro = 'Por favor preencha o campo de sexo!';
        $validacao = false;
    }

    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE aluno SET nome = ?, endereco = ?, telefone = ?, email = ?, sexo = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo, $id));
        Banco::desconectar();
        header("Location: crud.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM aluno WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $sexo = $data['sexo'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Atualizar Contato</title>
</head>

<body>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="well">Atualizar Contato</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="post">

                        <div class="form-group <?php echo !empty($nomeErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Nome</label>
                            <input name="nome" class="form-control" type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? htmlspecialchars($nome) : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo !empty($enderecoErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Endereço</label>
                            <input name="endereco" class="form-control" type="text" placeholder="Endereço"
                                   value="<?php echo !empty($endereco) ? htmlspecialchars($endereco) : ''; ?>">
                            <?php if (!empty($enderecoErro)): ?>
                                <span class="text-danger"><?php echo $enderecoErro; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo !empty($telefoneErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Telefone</label>
                            <input name="telefone" class="form-control" type="text" placeholder="Telefone"
                                   value="<?php echo !empty($telefone) ? htmlspecialchars($telefone) : ''; ?>">
                            <?php if (!empty($telefoneErro)): ?>
                                <span class="text-danger"><?php echo $telefoneErro; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo !empty($emailErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Email</label>
                            <input name="email" class="form-control" type="text" placeholder="Email"
                                   value="<?php echo !empty($email) ? htmlspecialchars($email) : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group <?php echo !empty($sexoErro) ? 'has-error' : ''; ?>">
                            <label class="control-label">Sexo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M"
                                    <?php echo ($sexo == "M") ? "checked" : ''; ?>>
                                <label class="form-check-label" for="sexoM">Masculino</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F"
                                    <?php echo ($sexo == "F") ? "checked" : ''; ?>>
                                <label class="form-check-label" for="sexoF">Feminino</label>
                            </div>
                            <?php if (!empty($sexoErro)): ?>
                                <span class="text-danger"><?php echo $sexoErro; ?></span>
                            <?php endif; ?>
                        </div>

                        <br/>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">Atualizar</button>
                            <a href="crud.php" class="btn btn-secondary">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-Chfqq8iS3kGd5R5xZ2b7C5sFlV6k5mFhtzJ2gptXX7N7wC/bH1LlPrjFQJQvZMWK" crossorigin="anonymous"></script>
</body>

</html
