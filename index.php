<?php 
	include "db/crud.php";
    $pdo = connect();
	
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
                                </ul>
                            </li>
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
                                $artistas = getAll("artistas INNER JOIN artistas_canciones ON artistas_canciones.idArtistas = artistas.idArtistas WHERE artistas_canciones.idCanciones = " . $cancion['idCanciones']);
                                
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
                                $albumes = getAll("albumes INNER JOIN canciones_albumes ON canciones_albumes.idAlbumes = albumes.idAlbumes WHERE canciones_albumes.idCanciones = " . $cancion['idCanciones']);
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
                            <?php echo $cancion['genero']; ?>
                        </td>

                        <!-- NACIONALIDAD -->
                        <td>
                            <?php 
                                if(count($artistas) > 0) {
                                    echo $artistas[0]['nacionalidad'];                          
                                }
                            ?>
                        </td>

                        <!-- COVER -->
                        <td>
                            <?php 
                                if($cancion['cover'] == 1){ ?> 
                                    <i class="fas fa-check"></i> 
                                <?php    
                                }
                            ?>

                        <!-- <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                            <label for="checkbox1"></label>
                        </span> -->

                        </td>

                        <!-- USUARIO -->
                        <td>
                            <?php
                                $usuario = getAll("usuarios INNER JOIN canciones_usuarios ON canciones_usuarios.idUsuario = usuarios.idUsuario WHERE " . $cancion['idCanciones']);
                                if(empty($usuario)) {
                                    echo "?";
                                } else {
                                    echo $usuario[0]['user'];
                                }
                            ?>
                        </td>

                    <!-- ACCIONES -->
                    <td>

                        <!-- EDIT -->
                        <a class="btn btn-light">
                            <i class="far fa-edit" id="icon"></i>                            
                        </a>
                        
                        <!-- DELETE -->
                        <a href="#deleteModal" data-toggle="modal" class="btn btn-light">
                            <i class="far fa-trash-alt" id="icon"></i>    
                        </a>

                    </td>

                    </tr>
                <?php endforeach;?>
                
            </tbody>

        </table>
    </div>

</body>
</html>