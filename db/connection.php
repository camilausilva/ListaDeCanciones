<?PHP

  function connect()
  { 
    /*
    $host = "localhost";      // Poner el hostname de phpmyadmin del servidor de mysql
    //$dbName = "base_tp_lab";  // Nombre de la base de datos
    $dbName = "tp_final_db";  // Nombre de la base de datos
    $usuario = "root";        // Nombre de usuario
    $pass = "";               // Contrasena
    */
    
    $host = "localhost";      // Poner el hostname de phpmyadmin del servidor de mysql
    $dbName = "grupo3";  // Nombre de la base de datos
    $usuario = "dbadmin";     // Nombre de usuario
    $pass = ".admindb";       // Contrasena
    
    try 
    {
      $pdo = new PDO("mysql:host={$host};dbname={$dbName}", $usuario, $pass);
      $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      return $pdo;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }

  }
?>