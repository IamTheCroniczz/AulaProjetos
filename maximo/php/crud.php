<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"; rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Read</title>

</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <!-- Cabecçalho da pagina -->
            <div class="row">
                <h2>AULA DE PWBE - CRUD <span class="badge text-bg-secondary">v 1.0.0 - SENAI</span></h2>

            </div>

        </div>
        <!-- Aqui o conteudo do Banco -->
        <div class="row">
            <p>
                <a class="btn btn-success" href="add.php">Add</a>
            </p>
            <!-- aqui entra dados da tabela -->
            <table class="table table-striped">
                <!-- Titulos da tabela -->
                <thead>
                    <tr>
                        <!-- Entitulando colunas da tabela -->
                        <th scope="col">ID</th>
                        <th scope="col">NOME</th>
                        <th scope="col">ENDERECO</th>
                        <th scope="col">TELEFONE</th>
                        <th scope="col">E-MAIL</th>
                        <th scope="col">SEXO</th>
                        <th scope="col">ACAO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'banco.php';
                    $pdo = Banco::conectar();
                    $sql = 'SELECT * FROM aluno ORDER BY id DESC';

                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo '<td>' . $row['nome'] . '</td>';
                        echo '<td>' . $row['endereco'] . '</td>';
                        echo '<td>' . $row['telefone'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['sexo'] . '</td>';
                        echo '<td width=250>';
                        echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
                        echo ' ';
                        echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Excluir</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    Banco::desconectar();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>