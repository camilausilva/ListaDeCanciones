<?php 
  include "db/connection.php";

  function getAll($tabla, $order = false, $orderBy = "")
  {
    $pdo = connect();
    try
    {
      if($order)
      {

        $stm = $pdo->prepare("SELECT * FROM {$tabla} ORDER BY {$tabla}.{$orderBy} ASC");
        $stm->execute();

      }else
      {
        $stm = $pdo->prepare("SELECT * FROM {$tabla} ");
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
      $stm = $pdo->prepare("DELETE FROM {$tabla} WHERE id=?");
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
  
?>



