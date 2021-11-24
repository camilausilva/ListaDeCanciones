<?php 
    $borrar = "";

	include "db/crud.php";
    $pdo = connect();

    if(isset($_POST["delete"])) {
        $borrar = delete('artistas_canciones', $_POST["delete"]);
        $borrar .= delete('canciones_albumes', $_POST["delete"]);
        $borrar .= delete('canciones_usuarios', $_POST["delete"]);
        $borrar .= delete('canciones', $_POST["delete"]);
    }

	$canciones = getAll('canciones');

?>

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

    <!--FONT AWESOME-->
    <script src="https://kit.fontawesome.com/5f64a46e85.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/ListaDeCanciones/assets/css/font-awesome-animation.css">

</head>

<body>

    <div class="shadow-lg p-3 mb-5" id="header">
        <h2>
            LISTA DE CANCIONES
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

                                <!-- <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                </select> -->

                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filtrar por
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Título</a></li>
                                    <li><a class="dropdown-item" href="#">Artista(s)</a></li>
                                    <li><a class="dropdown-item" href="#">Duración</a></li>
                                    <li><a class="dropdown-item" href="#">Colaboradores</a></li>
                                    <li><a class="dropdown-item" href="#">Álbum</a></li>
                                    <li><a class="dropdown-item" href="#">Género</a></li>
                                    <li><a class="dropdown-item" href="#">Pista</a></li>
                                    <li><a class="dropdown-item" href="#">País</a></li>
                                    <li><a class="dropdown-item" href="#">Fecha</a></li>
                                    <li><a class="dropdown-item" href="#">Covers</a></li>
                                    <!-- <li><a class="dropdown-item" href="#">Favorito</a></li> -->
                                </ul>


                            </li>

                            &nbsp;
                            &nbsp;

                            <a type="button" class="btn btn-outline-light btn-sm" href="index.php">
                                Restaurar
                            </a>

                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Ingrese un dato" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Buscar</button>
                        </form>

                        &nbsp;
                        &nbsp;

                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fa fa-plus"></i>
                        </button>

                    </div>
            </div>
        </nav>

        <table class="table table-dark table align-middle" id="table">

            <thead>
                <tr>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Duración</th>
                    <th>Álbum</th>
                    <th>Pista</th>
                    <th>Año</th>
                    <th>Género</th>
                    <th>País</th>
                    <th>¿Es un cover?</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($canciones as $cancion): 
                    $artistas_canciones = $pdo->query("SELECT * FROM artistas_canciones WHERE idCanciones = " . $cancion['idCanciones']);
                    $albumes = $pdo->query("SELECT * FROM canciones_albumes WHERE idCanciones = " . $cancion['idCanciones']);

                    ?> 

                    <tr>

                        <!-- TITULO -->
                        <td>
                            <?php echo $cancion['titulo']; ?>
                        </td>

                        <!-- ARTISTAS -->
                        <td>
                            <?php 
                                $artistas = getAll("artistas INNER JOIN artistas_canciones ON artistas_canciones.idArtistas = artistas.idArtistas INNER JOIN paises ON paises.id = artistas.pais WHERE artistas_canciones.idCanciones = " . $cancion['idCanciones']);
                                
                                if(count($artistas) > 0) {
                                  echo $artistas[0]['nombre'];
                                    if(count($artistas) > 1){
                                        echo ' ft. ';
                                        $colab = "";
                                        for($i = 1; $i < count($artistas); $i++){
                                            $colab .= $artistas[1]['nombre'] . " / ";
                                        }
                                        echo substr($colab, 0, -3);
                                    }
                                }
                            ?>
                        </td>

                        <!-- DURACION -->
                        <td>
                            <?php echo $cancion['duracion']; ?>
                        </td>

                        <!-- ALBUM -->
                        <td>
                            <?php 
                                $albumes = getAll("albumes 
                                                INNER JOIN canciones_albumes ON canciones_albumes.idAlbumes = albumes.idAlbumes 
                                                WHERE canciones_albumes.idCanciones = " . $cancion['idCanciones']);
                                if(empty($albumes) || $albumes[0]['titulo'] == "") {
                                    echo "-";
                                } else {
                                    echo $albumes[0]['titulo'];
                                }
                            ?>
                        </td>

                        <!-- PISTA -->
                        <td>
                            <?php  
                                if(empty($albumes) || $albumes[0]['titulo'] == "") {
                                    echo "-";
                                } else {
                                    echo $albumes[0]['pista'];
                                }
                            ?>
                        </td>

                        <!-- LANZAMIENTO -->
                        <td>
                            <?php
                                if(empty($albumes) || $albumes[0]['lanzamiento'] == 0000) {
                                    echo "-";
                                } else {
                                    echo $albumes[0]['lanzamiento'];
                                }
                            ?>
                        </td>

                        <!-- GENERO -->
                        <td>
                            <?php
                                $genero = getAll("generos INNER JOIN canciones ON canciones.genero = generos.idGeneros WHERE canciones.idCanciones = " . $cancion['idCanciones']);
                                echo $genero[0]['nombreGenero']; 
                            ?>
                        </td>

                        <!-- NACIONALIDAD -->
                        <td>
                            <?php
                                echo '<img src=https://ipdata.co/flags/' . strtolower($artistas[0]['iso']) . '.png width=30px height=20px> ';
                                echo $artistas[0]['nombrePais'];
                            ?>
                        </td>

                        <!-- COVER -->
                        <td align="center">
                            <?php

                                if($cancion['cover']){ ?>
                                    <?php $artistaOriginal = getAll("artistas INNER JOIN canciones ON canciones.artistaOriginal = artistas.idArtistas WHERE canciones.idCanciones = " . $cancion['idCanciones'])?>
                                    <i class="fas fa-check"></i> (<?php echo $artistaOriginal[0]['nombre'] ?>)
                                <?php    
                                }
                            ?>
                        </td>

                        <!-- USUARIO -->
                        <td>
                            <?php
                                $usuario = getAll("usuarios 
                                                INNER JOIN canciones_usuarios ON canciones_usuarios.idUsuario = usuarios.idUsuario 
                                                WHERE canciones_usuarios.idCanciones = " . $cancion['idCanciones']);
                                if(empty($usuario)) {
                                    echo "?";
                                } else {
                                    echo $usuario[0]['user'];
                                    if($usuario[0]['favorito'])
                                        echo ' ❤';
                                }
                            ?>
                        </td>

                    <!-- ACCIONES -->
                    <td>

                        <!-- EDIT -->
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="far fa-edit" id="icon"></i> 
                        </button>
                        
                        <!-- DELETE -->
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $cancion['idCanciones'] ?>">
                            <i class="far fa-trash-alt" id="icon"></i> 
                        </button>

                    </td>

                    </tr>

                        <!-- DELETE MODAL -->

                        <div class="modal fade" id="deleteModal<?php echo $cancion['idCanciones'] ?>" aria-hidden="true" aria-labelledby="deleteModalLabel<?php echo $cancion['idCanciones'] ?>" tabindex="-1">
                        
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo $cancion['idCanciones'] ?>">BORRAR UNA CANCIÓN</h5>
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                    </div>

                                    <div class="modal-body">
                                        ¿Realmente desea ELIMINAR "<?php echo $cancion['titulo'] ?>"?
                                    </div>

                                    <div class="modal-footer">

                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-dismiss="modal">
                                            No, me arrepiento
                                        </button>


                                        <form action="#" method="POST">
                                            <button class="btn btn-primary" data-bs-toggle="modal" value="<?php echo $cancion['idCanciones'] ?>" name="delete"> 
                                                Sí, deseo eliminarla
                                            </button>                                            
                                        </form>

                                    </div>

                                </div>
                            </div>

                        </div>


                        <!-- BORRADO -->



                <?php endforeach;?>
                
            </tbody>
            
        </table>

            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-left">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav> -->

    </div>

    <!-- ADD MODAL -->

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">ACTUALIZAR DATOS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form>
                    <div class="mb-3">

                        <label for="inputTitulo" class="col-form-label">Título:</label>
                        <input type="text" class="form-control" id="inputTitulo">

                        <label for="inputArtista" class="col-form-label">Artista(s):</label>
                        <select class="form-select" aria-label="Default select example" id="inputArtista">
                            
                            <option selected>Artista(s)</option>

                            <?php 

                            $artistasActuales = getAll("artistas");

                            foreach($artistasActuales as $artistaActual): ?>

                                <option value="<?php echo $artistaActual["idArtistas"] ?>">
                                    <?php echo $artistaActual["nombre"] ?>
                                </option>

                            <?php
                            endforeach;
                            ?>
                            
                        </select>


                        <label for="inputDuracion" class="col-form-label">Duración:</label>
                        <input type="text" class="form-control" id="inputDuracion">

                        <label for="inputAlbum" class="col-form-label">Álbum:</label>
                        <textarea class="form-control" id="inputAlbum"></textarea>

                        <label for="inputPista" class="col-form-label">Pista:</label>
                        <input type="text" class="form-control" id="inputPista">

                        <label for="inputAnio" class="col-form-label">Año:</label>
                        <input type="text" class="form-control" id="inputAnio">

                        <label for="inputGenero" class="col-form-label">Género:</label>
                        <select class="form-select" aria-label="Default select example" id="inputGenero">
                            <option selected>Seleccionar Género</option>
                            <option value="1">Death Metal Melódico Progresivo</option>
                            <option value="2">Funk Rock</option>
                            <option value="3">Groove Metal</option>
                            <option value="4">Hardcore Melódico</option>
                            <option value="5">Grunge</option>
                            <option value="6">Rock Alternativo</option>
                            <option value="7">Indie Rock</option>
                            <option value="8">Hardcore Melódico</option>
                        </select>
                


                        <label for="inputCover" class="col-form-label">¿Es un Cover?</label>
                        &nbsp;
                        &nbsp;
                        <span class="custom-checkbox">
                            <input type="checkbox" id="inputCover" name="options[]" value="1">
                            <label for="inputCover"></label>
                        </span>

                    </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal2" aria-hidden="true" aria-labelledby="addModalLabel2" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel2">CANCIÓN ELIMINADA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Se ha ACTUALIZADO la Lista de Canciones
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Aceptar</button>
            </div>

        </div>
    </div>

</div>


</body>

</html>