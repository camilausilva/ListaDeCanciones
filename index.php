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

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet"> 



</head>

<body>

    <div class="shadow-lg p-3 mb-5" id="header">
        <h2>
            MI LISTA
        </h2>
    </div>

    <div id="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filtrar por
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Nombre</a></li>
                                    <li><a class="dropdown-item" href="#">Artista/s</a></li>
                                    <li><a class="dropdown-item" href="#">Duración</a></li>
                                    <li><a class="dropdown-item" href="#">Colaboradores</a></li>
                                    <li><a class="dropdown-item" href="#">Álbum</a></li>
                                    <li><a class="dropdown-item" href="#">Track</a></li>
                                    <li><a class="dropdown-item" href="#">País</a></li>
                                    <li><a class="dropdown-item" href="#">Fecha de Salida</a></li>
                                    <li><a class="dropdown-item" href="#">Covers</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Ingrese un dato" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Buscar</button>
                        </form>
                    </div>
            </div>
        </nav>

        <table class="table table-dark" id="table">

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Artista/s</th>
                    <th>Duración</th>
                    <th>Colaboradores</th>
                    <th>Álbum</th>
                    <th>Track</th>
                    <th>País</th>
                    <th>Fecha de Salida</th>
                    <th>¿Es un Cover?</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Bohemian Rhapsody</td>
                    <td>Queen</td>
                    <td>3:45</td>
                    <td>Ninguno/a</td>
                    <td>A Night At The Opera</td>
                    <td>11</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Bohemian Rhapsody</td>
                    <td>Queen</td>
                    <td>3:45</td>
                    <td>Ninguno/a</td>
                    <td>A Night At The Opera</td>
                    <td>11</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Bohemian Rhapsody</td>
                    <td>Queen</td>
                    <td>3:45</td>
                    <td>Ninguno/a</td>
                    <td>A Night At The Opera</td>
                    <td>11</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                
            </tbody>

        </table>
    </div>

</body>
</html>