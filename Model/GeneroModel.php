<?php

class GeneroModel
{

  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;'
    .'dbname=db_generos;charset=utf8'
    , 'root', '');
  }

    function GetGeneroSeleccionado($PARAMS = ''){
      $sentencia = $this->db->prepare( "select * from genero WHERE id_genero = ?");
      $sentencia->execute(array($PARAMS[0]));
      return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    function GetGeneros(){
      $sentencia = $this->db->prepare( "select * from genero");
      $sentencia->execute();
      return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    function GetNombreDeGeneroDePelicula($id_genero){
      $sentencia = $this->db->prepare("select * from genero where id_genero=?");
      $sentencia->execute(array($id_genero));
      return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    function borrarGenero($id_genero){
      $sentencia = $this->db->prepare( "delete from genero where id_genero=?");
      $sentencia->execute(array($id_genero));
      header(HOMEADMIN);
    }

    function AgregarGeneroModel($nombreGenero){
      $sentencia = $this->db->prepare( "insert into genero (nombre) values (?)");
      $sentencia->execute(array($nombreGenero));
      header(HOMEADMIN);
    }

    function ActualizarNombreGenero($nombre, $id_genero){
      $sentencia = $this->db->prepare("update genero set nombre=? where id_genero=?");
      $sentencia->execute(array($nombre, $id_genero[0]));
      header(HOMEADMIN . "/generoAdmin");
    }

}
  ?>
