<?php 
    session_start();

    $insert = "";
    $borrar = "";

	include "db/crud.php";
    $pdo = connect();

    if(isset($_POST["insert"])) {

        //Valores por defecto
        $cover = 0;
        $fav = 0;
        $artistaOriginal = null;
        

        if (isset($_POST["cover"])) {
            $cover = $_POST["cover"];
        	if ($cover) {
        	    $artistaOriginal = $_POST["artistaOriginal"];
        	}
        }

        if(isset($_POST['fav'])) {
            $fav = $_POST['fav'];
        }

        // echo $fav;
        // echo $_SESSION['id'];
    
        //INSERT DE LA TABLA canciones
         $insert = insertOrUpdateCanciones(
             $_POST["titulo"], 
             $_POST["duracion"], 
             $_POST["genero"], 
             $cover,
             $artistaOriginal
         );
              
        //INSERT DE LA TABLA albumes
         $insert .= insertOrUpdateAlbumes(
             $_POST["album"],
             $_POST["anio"]
         );
        
        $cancionCreada = getAll("canciones", true, "idCanciones DESC");
        $albumCreado = getAll("albumes", true, "idAlbumes DESC");

        //INSERT DE LA TABLA artistas_canciones
         $insert .= insertOrUpdateTablasIntermedias(
             $cancionCreada[0]["idCanciones"],
             $_POST["artistas"]
         );

        //INSERT DE LA TABLA canciones_albumes
         $insert .= insertOrUpdateTablasIntermedias(
             $cancionCreada[0]["idCanciones"],
             $albumCreado[0]["idAlbumes"],
             0,
             $_POST["pista"],
             "canciones_albumes"
         );
        
        //INSERT DE LA TABLA canciones_usuarios
         $insert .= insertOrUpdateTablasIntermedias(
             $cancionCreada[0]["idCanciones"],
             $_SESSION['id'],
             0,
             $fav,
             "canciones_usuarios"
         );

    }

    if(isset($_POST["delete"])) {
        $borrar = delete('artistas_canciones', $_POST["delete"]);
        $borrar .= delete('canciones_albumes', $_POST["delete"]);
        $borrar .= delete('canciones_usuarios', $_POST["delete"]);
        $borrar .= delete('canciones', $_POST["delete"]);
    }

    // foreach($_POST as $post):
    //     echo $post;
    // endforeach;

     if(isset($_POST["ft"])) {
         //INSERT DE LA TABLA artistas_canciones
         $insert .= insertOrUpdateTablasIntermedias(
             $_POST["ft"],      //idCanciones
             $_POST["artistas"] //idArtistas
         );
     }

    //REFRESH
	$canciones = getAll('canciones WHERE idCanciones IN (
                                                SELECT idCanciones
                                                FROM canciones_usuarios
                                                WHERE idUsuario = ' . $_SESSION['id'] . 
                        ')');

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

    <!-- JS -->
    <script src="assets/js/app.js"></script>

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet"> 

    <!--FONT AWESOME-->
    <script src="https://kit.fontawesome.com/5f64a46e85.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/ListaDeCanciones/assets/css/font-awesome-animation.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>

    <div class="shadow-lg p-3 mb-5" id="header">
        <h2>
            LISTA DE CANCIONES DE <?php echo $_SESSION["user"] ?>
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
                                    <li><a class="dropdown-item" href="#">T??tulo</a></li>
                                    <li><a class="dropdown-item" href="#">Artista(s)</a></li>
                                    <li><a class="dropdown-item" href="#">Duraci??n</a></li>
                                    <li><a class="dropdown-item" href="#">Colaboradores</a></li>
                                    <li><a class="dropdown-item" href="#">??lbum</a></li>
                                    <li><a class="dropdown-item" href="#">G??nero</a></li>
                                    <li><a class="dropdown-item" href="#">Pista</a></li>
                                    <li><a class="dropdown-item" href="#">Pa??s</a></li>
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

                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal" title="Agregar Canci??n">
                            <i class="fa fa-plus"></i>
                        </button>

                    </div>
            </div>
        </nav>

        <table class="table table-dark table align-middle" id="table">

            <thead>
                <tr>
                    <th>T??tulo</th>
                    <th>Artista</th>
                    <th>Duraci??n</th>
                    <th>??lbum</th>
                    <th>Pista</th>
                    <th>A??o</th>
                    <th>G??nero</th>
                    <th>Pa??s</th>
                    <th>??Es un cover?</th>
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
                                            $colab .= $artistas[$i]['nombre'] . " , ";
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
                                    if($usuario[0]['favorito']) {
                                        ?> <i class="fas fa-heart text-danger"></i> <?php
                                    }
                                }
                            ?>
                        </td>

                    <!-- ACCIONES -->
                    <td>

                        <!-- FEATURING -->
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#ftModal<?php echo $cancion['idCanciones'] ?>" title="Ingresar Featuring">
                            <i class="fas fa-user-plus"></i>
                        </button>

                        <!-- EDIT -->
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal" title="Modificar Canci??n">
                            <i class="far fa-edit"></i> 
                        </button>
                        
                        <!-- DELETE -->
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $cancion['idCanciones'] ?>"  title="Eliminar Canci??n">
                            <i class="far fa-trash-alt"></i> 
                        </button>



                    </td>

                    </tr>

                        <!-- DELETE MODAL -->

                        <div class="modal fade" id="deleteModal<?php echo $cancion['idCanciones'] ?>" aria-hidden="true" aria-labelledby="deleteModalLabel<?php echo $cancion['idCanciones'] ?>" tabindex="-1">
                        
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo $cancion['idCanciones'] ?>">BORRAR UNA CANCI??N</h5>
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                    </div>

                                    <div class="modal-body">
                                        ??Realmente desea ELIMINAR "<?php echo $cancion['titulo'] ?>"?
                                    </div>

                                    <div class="modal-footer">

                                        <form action="#" method="POST">
                                            <button class="btn btn-primary" data-bs-toggle="modal" value="<?php echo $cancion['idCanciones'] ?>" name="delete"> 
                                                S??, deseo eliminarla
                                            </button>                                            
                                        </form>

                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-dismiss="modal">
                                            No, me arrepiento
                                        </button>

                                    </div>

                                </div>
                            </div>

                        </div>


                        <!------------------------------------------------------------>
                        <!------------------------- FT MODAL ------------------------->
                        <!------------------------------------------------------------>

                        <div class="modal fade" id="ftModal<?php echo $cancion['idCanciones'] ?>" aria-hidden="true" aria-labelledby="ftModalLabel<?php echo $cancion['idCanciones'] ?>" tabindex="-1">
                        
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                
                                    <form action="#" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ftModalLabel<?php echo $cancion['idCanciones'] ?>">INGRESAR FEATURING</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            
                                            <label for="inputArtistas" class="col-form-label">Colabor?? con:</label>
                                            <select class="form-select" aria-label="Default select example" id="selectArtistas" name="artistas">
                                                
                                                <option value="null" selected>Seleccionar Artista</option>

                                                <?php 

                                                $artistasColaboradores = getAll("artistas
                                                                        WHERE idArtistas NOT IN (
                                                                            SELECT idArtistas FROM artistas_canciones
                                                                            WHERE artistas_canciones.idCanciones = " . $cancion['idCanciones'] . 
                                                                        ")");
                                                                        
                                                foreach($artistasColaboradores as $artistaColaborador): ?>

                                                    <option value="<?php echo $artistaColaborador["idArtistas"] ?>">
                                                        <?php echo $artistaColaborador["nombre"] ?>
                                                    </option>

                                                <?php
                                                endforeach;
                                                ?>
                                    
                                            </select>

                                        </div>

                                        <div class="modal-footer">

                                            
                                                <button class="btn btn-primary" data-bs-toggle="modal" value="<?php echo $cancion['idCanciones'] ?>" name="ft"> 
                                                    Guardar Cambios
                                                </button>                                            
                                            

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>


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


    <!------------------------------------------------------------->
    <!------------------------- ADD MODAL ------------------------->
    <!------------------------------------------------------------->

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">INGRESAR DATOS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="#" method="POST">
                        <div class="mb-3">

                            <!-- TITULO -->
                            <label for="inputTitulo" class="col-form-label">T??tulo:</label>
                            <input type="text" class="form-control" id="inputTitulo" name="titulo">

                            <!-- ARTISTAS -->
                            <label for="inputArtistas" class="col-form-label">Artista(s):</label>
                            <!-- <input type="text" class="form-control-plaintext" readonly id="inputArtistas"> -->
                            <select class="form-select" aria-label="Default select example" id="selectArtistas" name="artistas">
                                
                                <option value="null" selected>Seleccionar Artista</option>

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

                            <label for="inputDuracion" class="col-form-label">Duraci??n:</label>
                            <input type="text" class="form-control" id="inputDuracion" name="duracion">

                            <label for="inputAlbum" class="col-form-label">??lbum:</label>
                            <input type="text" class="form-control" id="inputAlbum" name="album">

                            <label for="inputPista" class="col-form-label">Pista:</label>
                            <input type="number" min="1" class="form-control" id="inputPista" name="pista">

                            <label for="inputAnio" class="col-form-label">A??o:</label>
                            <select class="form-select" aria-label="Default select example" id="inputAnio" name="anio">

                                <option value="null" selected>Seleccionar A??o</option>

                                    <?php
                                    for ($contador = 2022; $contador > 1899; $contador--) { ?>
                                        <option value="<?php echo $contador ?>">
                                            <?php echo $contador ?>
                                        </option>
                                    <?php
                                    };
                                    ?>   

                            </select>

                            <label for="inputGenero" class="col-form-label">G??nero:</label>
                                <select class="form-select" aria-label="Default select example" id="inputGenero" name="genero">
                                    <option value="null" selected>Seleccionar G??nero</option>

                                        <?php
                                        $generos = getAll("generos");

                                        foreach($generos as $genero): ?>

                                            <option value="<?php echo $genero["idGeneros"] ?>">
                                                <?php echo $genero["nombreGenero"] ?>
                                            </option>

                                        <?php
                                        endforeach;
                                        ?>   

                                </select>


                            <label for="inputCover" class="col-form-label">??Es un Cover?</label>
                            &nbsp;
                            &nbsp;
                            <span class="custom-checkbox">
                                <input type="checkbox" id="inputCover" name="cover" value="1">
                            </span>

                            <label for="inputFav" class="col-form-label">??Me gusta!</label>
                            &nbsp;
                            &nbsp;
                            <span class="custom-checkbox">
                                <input type="checkbox" id="inputFav" name="fav" value="1">
                            </span>

                            <select class="form-select" aria-label="Default select example" id="selectArtistaOriginal" name="artistaOriginal">
                                
                                <option value="null" selected>??Cu??l es el/la Artista Original?</option>

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




                        </div>
                    
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-toggle="modal" value="0" name="insert">
                                Guardar Cambios
                            </button>
                        </div>

                    </form>

                </div>



            </div>
        </div>
    </div>


</div>


</body>

</html>