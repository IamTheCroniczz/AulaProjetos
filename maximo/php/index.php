<?php

    if (!isset($_SESSION['login'])) {

        if (isset($_POST['acao'])) {
            $login = 'julio@mesquita.com';
            $senha = '1234';

            $loginForm = $_POST['login'];
            $senhaForm = $_POST['senha'];

            if ($login == $loginForm && $senha == $senhaForm) {
                //Logado com sucesso!
                $_SESSION['login'] = $login;
                header('Location: crud.php');
            } else { 
                //Algum erro ocorreu.
                echo 'Dados inválidos.';
            }
        }
    }
    //     include('login.php');
    // } else {
        
    //     include('home.php');
    //     header('Location: index.php');
    // }

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"; rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Adicionar Contato</title>
</head>


    <body>
        
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="text-center">Faça Login</h3>
                    </div>
        <form method="post">
            <input type="text" name="login">
            <input type="password" name="senha">
            <input class="btn btn-primary" type="submit" name="acao" value="Enviar!">
        </form>
    </body>

</html>