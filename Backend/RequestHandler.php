<?php
//headers que permiten requests al mismo servidor, potencialmente no necesarios cuando este distribuido 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
//header que permite utilzar json 
header('content-type: application/json; charset=utf-8');
//clase para crear objetos vacios
class obj
{
  function __construct($state)
  {
    $this->state = $state;
  }
};

class requestHandler
{
  public $ch = null;

  //Este constructor inicializa una nueva request de curl y se la asigna a la variable ch
  function __construct()
  {
    $this->ch = curl_init();
  }

  /**
   * Esta funcion recibe la URL del archivo que hace el select en la base de datos.
   * El json del retornado por el request debe tener una propiedad state que diga el estado
   * de la consulta y una propiedad data con las filas retornadas.
   * La funcion retorna un json con una propiedad status = false si la consulta falla
   * o status = true en caso contrario junto con una propiedad data
   * que contiene todas las filas retornadas por el archivo
   */
  function getRequest($url)
  {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    // --- Petición GET.
    curl_setopt($this->ch, CURLOPT_HTTPGET, TRUE);
    // --- Para recibir respuesta de la conexión.
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
    // --- Respuesta
    $values = curl_exec($this->ch);
    curl_close($this->ch);

    if ($values === false) {
      $response = new obj(false);
      return json_encode($response);
    } else {
      return ($values);
    }
  }

  /**
   * Esta funcion recibe la URL del archivo que hace insert en la base de datos
   * y un objeto (no json) con todos los valores que se insertan.
   * El json del retornado por el request debe tener una propiedad state que diga el estado
   * de la consulta.
   * La funcion retorna un json con una propiedad state = false si la request falla
   * o status = true en caso contrario junto con todos los demas datos de la bd
   */
  function postRequest($url, $values)
  {
    curl_setopt($this->ch, CURLOPT_URL, $url);
    // --- Datos que se van a enviar por POST.
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($values));
    // --- Petición POST.
    curl_setopt($this->ch, CURLOPT_POST, 1);
    // --- HTTPGET a false porque no se trata de una petición GET.
    curl_setopt($this->ch, CURLOPT_HTTPGET, FALSE);
    // -- HEADER a false.
    curl_setopt($this->ch, CURLOPT_HEADER, FALSE);
    // --- Para recibir respuesta de la conexión.
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
    // --- Respuesta.
    $values = curl_exec($this->ch);

    curl_close($this->ch);

    if ($values === false) {
      $response = new obj(false);
      return  json_encode($response);
    } else {
      return $values;
    }
  }
}

// $data = new obj();
// $handler = new requestHandler();
// $data->nombre = 'kechus';
// //$handler->postRequest('http://localhost/BD/postvalues.php', $data);

// $handler->getRequest('http://localhost/BD/getvalues.php');
