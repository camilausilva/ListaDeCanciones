<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP Final | Grupo 3</title>

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--CSS-->
    <link href="/ListaDeCanciones/assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <h3 class="text-center text-white pt-5">INICIAR SESIÓN</h3>
                        <form id="login-form" class="form" action="#" method="post">
                            <div class="form-group">
                                <label for="username" class="text" id="usertext">Nombre de Usuario:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password" class="text" id="usertext">Contraseña:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="ingresar" class="btn btn-outline-secondary btn-md" value="Ingresar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

</body>
</html>

<?php

    include "db/crud.php";

    if(isset($_POST["username"]) && isset($_POST["password"])) {
            $user = $_POST["username"];   
            $pass = crypt($_POST["password"], 'ed9dea59b704b36b18bacd15f63d9f8a
                                                6aea4afedd4902d759bfabbab9760b94
                                                5c6c8e904decae4a1747fcf9aed6c1f4
                                                fbdc7f1511bc461c58290443c6ebe29a
                                                71bd067ffe5767a8ca59b5251e9ed9d4
                                                cf82700c1d81a49693dfded77cf40825
                                                250411dc131f9e24c67b0c87a14c1553
                                                871347f1be169f3db8f90b42e371bcf0
                                                b6b6bd8b20ab852f3d54cf6ef27ff91c
                                                b7ee8f0a1aec0f0cacfd8711d5c15507');

            $query = getAll("usuarios WHERE user = '" . $user . "' AND password = '" . $pass . "'");
            if(!empty($query)) {
                session_start();
                $_SESSION["id"] = $query[0]["idUsuario"];
                $_SESSION["user"] = $user;
                header('Location: index.php');
            } else {
            ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alerta">
                Usuario o Contraseña INCORRECTOS
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            }
    }

?>