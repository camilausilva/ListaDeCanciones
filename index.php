<?php 
	require_once "db/crud.php";
	
	$canciones = getAll('canciones', true, "idCanciones");
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
<<<<<<< Updated upstream
                                    <li><a class="dropdown-item" href="#">Nombre</a></li>
                                    <li><a class="dropdown-item" href="#">Artista(s)</a></li>
=======
                                    <li><a class="dropdown-item" href="#">Título</a></li>
                                    <li><a class="dropdown-item" href="#">Artista/s</a></li>
>>>>>>> Stashed changes
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

                        <!-- <a href="#addEmployeeModal" class="btn btn-light add-new" data-toggle="modal"></a> -->
                        <!-- <button type="button" class="btn btn-light add-new">/button> -->

                    </div>
            </div>
        </nav>

        <table class="table table-dark table-hover table align-middle" id="table">

            <thead>
                <tr>
<<<<<<< Updated upstream
                    <th>Nombre</th>
                    <th>Artista(s)</th>
                    <th>Duración</th>
                    <th>Colaboradores</th>
                    <th>Álbum</th>
                    <th>Género</th>
                    <th>Pista</th>
                    <th>País</th>
                    <th>Fecha</th>
                    <th>¿Es un cover?</th>
=======
                    <th>Título <i class="fa fa-sort"></i></th>
                    <th>Artista/s <i class="fa fa-sort"></i></th>
                    <th>Duración <i class="fa fa-sort"></i></th>
                    <th>Álbum <i class="fa fa-sort"></i></th>
                    <th>Track</th>
                    <th>País <i class="fa fa-sort"></i></th>
                    <th>Fecha de Salida <i class="fa fa-sort"></i></th>
                    <th>¿Es un Cover?</th>
                    <th>Acciones</th>
>>>>>>> Stashed changes
                </tr>
            </thead>

            <tbody>
<<<<<<< Updated upstream
                <?php foreach($canciones as $cancion): ?>
                    <tr>
                        <td><?php echo $cancion['titulo']; ?></td>
                        <td><?php echo $cancion['idArtistas']; ?></td> <!-- debería aparecer el nombre acá-->
                        <td><?php echo $cancion['duracion']; ?></td>
                        <td>
                            <?php if($cancion['colaboradores'] == ""){
                                    echo '-';
                                  } else {
                                      echo $cancion['colaboradores'];
                                  }        
                            ?>
                        </td>
                        <td>ALBUM</td>
                        <td><?php echo $cancion['genero']; ?></td>
                        <td>PISTA</td>
                        <td>NACIONALIDAD</td>
                        <td>FECHA</td>
                        <td>
                            <?php 
                                if($cancion['cover'] == 1){
                                    echo 'Si' . ' (' . $cancion['artistaOriginal'] . ')';
                                } else{
                                    echo 'No';
                                }
                            ?>
                        </td>
                    </tr>
                <?php endforeach;?>

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
                    <td>-</td>
=======

                <tr>

                    <!-- TÍTULO -->
                    <td>
                        Bohemian Rhapsody
                    </td>
                    
                    <!-- ARTISTA/S -->
                    <td>
                        Queen
                    </td>

                    <!-- DURACIÓN -->
                    <td>
                        3:45
                    </td>

                    <!-- ÁLBUM -->
                    <td>
                        A Night At The Opera
                    </td>

                    <!-- Nº TRACK -->
                    <td>
                        11
                    </td>

                    <!-- PAÍS -->
                    <td>
                        -
                    </td>

                    <!-- FECHA DE SALIDA -->
                    <td>
                        -
                    </td>
                    
                    <!-- ¿ES UN COVER? -->
                    <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                            <label for="checkbox1"></label>
                        </span>
                    </td>

                    <!-- ACCIONES -->
                    <td>

                        <!-- <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit"></i>
                            <i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit"></i>
                        </a> -->

                        <!-- EDIT -->
                        <a class="btn btn-light">
                            <i class="far fa-edit" id="icon"></i>                            
                        </a>

                        <!-- DELETE -->
                        <a href="#deleteEmployeeModal" data-toggle="modal" class="btn btn-light">
                            <i class="far fa-trash-alt" id="icon"></i>    
                        </a>
                        

                    </td>

>>>>>>> Stashed changes
                </tr>

            </tbody>

        </table>

    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Cabeza del Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">AGREGAR UNA CANCIÓN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Cuerpo del Modal -->
                <div class="modal-body">

                    <label for="titulo" class="col-form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo">

                    <label for="artista" class="col-form-label">Artista/s:</label>
                    <input type="text" class="form-control" id="artista">

                    <label for="duracion" class="col-form-label">Duración:</label>
                    <input type="text" class="form-control" id="duracion">

                    <label for="album" class="col-form-label">Álbum:</label>
                    <input type="text" class="form-control" id="album">

                    <label for="track" class="col-form-label">Track:</label>
                    <input type="text" class="form-control" id="track">

                    <label for="pais" class="col-form-label">País:</label>
                    <input type="text" class="form-control" id="pais">

                    <label for="fechasalida" class="col-form-label">Fecha de Salida:</label>
                    <input data-provide="datepicker">
                    <input type="text" class="form-control" id="fechasalida">

                    <label for="cover" class="col-form-label">¿Es un Cover?</label>
                    <input type="text" class="form-control" id="cover">

                </div>

                <!-- Pie del Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>

            </div>
        </div>
    </div>

</body>

</html>