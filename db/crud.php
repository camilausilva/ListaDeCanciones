<?php 
  include "db/connection.php";

  function getAll($tabla, $order = false, $orderBy = "") 
  {
    $pdo = connect();
    try 
    {
      if($order)
      {

        $stm = $pdo->prepare("SELECT DISTINCT * FROM {$tabla} ORDER BY {$tabla}.{$orderBy}");
        $stm->execute();

      }else
      {
        $stm = $pdo->prepare("SELECT DISTINCT * FROM {$tabla}");
        $stm->execute();
      }

      return $stm->fetchAll();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }

  function getByID($tabla,$id)
  {
    $pdo = connect();
    try
    {
      $stm = $pdo->prepare("SELECT * FROM {$tabla} WHERE id=?");
      $stm->execute([$id]);
      return $stm->fetch();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }

  function delete($tabla,$id) 
  {
    $pdo = connect();
    try
    {
      $stm = $pdo->prepare("DELETE FROM {$tabla} WHERE idCanciones=?");
      $stm->execute([$id]);
      return $stm->fetch();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }

  function searchBy( $tabla, $tipo, $busqueda)
  {
    $pdo = connect();
    try
    {
      $stm = $pdo->prepare("SELECT * FROM {$tabla} WHERE {$tipo} LIKE ? ORDER BY {$tipo} ASC");
      $stm->execute([ 
        $busqueda
      ]);
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }

  function insertOrUpdateCanciones($titulo, $duracion, $genero, $cover, $artistaOriginal = null, $id = 0) {

    $pdo = connect();
    try
    {
      $stm = "";
      if ($id == 0){
        $stm = $pdo->prepare("INSERT INTO canciones (titulo,duracion,genero,cover,artistaOriginal) VALUES (?,?,?,?,?)");
        $stm->execute([$titulo, $duracion, $genero, $cover, $artistaOriginal]);
      } else {
        $stm = $pdo->prepare("UPDATE canciones 
                                      SET titulo = ?, 
                                      SET duracion = ?, 
                                      SET genero = ?, 
                                      SET cover = ?, 
                                      SET artistaOriginal = ?,
                              WHERE idCanciones=?");
        $stm->execute([$titulo, $duracion, $genero, $cover, $artistaOriginal,$id]);
      }
      return $stm->fetch();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }

  }


  function insertOrUpdateAlbumes($titulo, $lanzamiento, $id = 0) {

    $pdo = connect();
    try
    {
      $stm = "";
      if ($id == 0){
        $stm = $pdo->prepare("INSERT INTO albumes(titulo,lanzamiento) values(?,?)");
        $stm->execute([$titulo, $lanzamiento]);
      } else {
        $stm = $pdo->prepare("UPDATE albumes 
                                      SET titulo = ?, 
                                      SET lanzamiento = ?
                              WHERE idAlbumes=?");
        $stm->execute([$titulo, $lanzamiento, $id]);
      }
      return $stm->fetch();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
    
  }

  function insertOrUpdateTablasIntermedias($idCancion, $idExtra, $pista_fav = null, $nombreTabla = "artistas_canciones", $esUpdate = false) {

    $pdo = connect();
    try
    {
      $stm = "";

      if ($pista_fav == null){
        
        if($esUpdate) {

          $stm = $pdo->prepare("UPDATE {$nombreTabla}
          SET idArtistas = ?
          WHERE idCanciones=?");
          $stm->execute([$idExtra, $idCancion]);

        } else {

          $stm = $pdo->prepare("INSERT INTO {$nombreTabla}(idArtistas,idCanciones) values(?,?)");
          $stm->execute([$idExtra, $idCancion]);

        }

      } else {

        if($esUpdate) {

          if($nombreTabla == "canciones_albumes") {

            $stm = $pdo->prepare("UPDATE {$nombreTabla}
            SET idAlbumes = ?,
            SET pista = ?
            WHERE idCanciones=?");

          } else {

            $stm = $pdo->prepare("UPDATE {$nombreTabla}
            SET idUsuario = ?,
            SET favorito = ?
            WHERE idCanciones=?");

          }

          $stm->execute([$idExtra, $pista_fav, $idCancion]);
          

        } else {

          if($nombreTabla == "canciones_albumes") {
            $stm = $pdo->prepare("INSERT INTO {$nombreTabla}(idAlbumes,idCanciones,pista) values(?,?,?)");
          } else {
            $stm = $pdo->prepare("INSERT INTO {$nombreTabla}(idUsuario,idCanciones,favorito) values(?,?,?)");
          }

          $stm->execute([$idExtra, $idCancion, $pista_fav]);

        }

      }

      return $stm->fetch();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
    
  }


?>