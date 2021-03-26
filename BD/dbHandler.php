<?php
class obj
{
  function __construct($state)
  {
    $this->state = $state;
  }
};

class dbControl
{
  private $host = "localhost";
  private $user = "root";
  private $password = '';
  private $database = 'electroshop';

  private $con;

  function __construct()
  {
    $this->con = $this->connectDB();
    if (!empty($this->con)) {
      $this->selectDB();
    }
  }
  function connectDB()
  {
    $con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    return $con;
  }
  function selectDB()
  {
    mysqli_select_db($this->con, $this->database);
  }
  /**
   * Esta funcion es utilizada para traer un solo resultado de la base de datos
   * recibe la consulta a ejecutar
   * Retorna una sola fila 
   */
  function fetchRow($query)
  {
    $result = $this->doQuery($query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row;
  }


  function escapeString($var)
  {
    return mysqli_real_escape_string($this->con, $var);
  }


  /**
   * Esta funcion ejecuta una consulta INSERT en la base de datos
   * Recibe la consulta a ejecutar
   * Retorna el id de la fila insertada
   */
  function insert($query)
  {
    $this->doQuery($query);
    return mysqli_insert_id($this->con);
  }

  /**
   * Esta funcion es utilizada para hacer ejecutar cualquier consulta en la base de datos.
   * Recibe la consulta a ejecutar
   * Retorna true en caso de consulta exitos, false en caso contrario o un result set en caso de SELECT
   */
  function doQuery($query)
  {
    return mysqli_query($this->con, $query);
  }

  /**
   * Esta funcion es utilizada para traer todos los resultados de una consulta
   * Recibe la consulta a ejecutar
   * Retorna un array asociativo con todos los resultados
   */
  function fetchAll($query)
  {
    $result = $this->doQuery($query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
}
