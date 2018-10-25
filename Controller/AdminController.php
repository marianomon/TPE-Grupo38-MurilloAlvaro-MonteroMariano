<?php
require_once "../view/PeliculasView.php";
require_once "../model/PelisModel.php";
require_once "SecuredController.php";
require_once "../model/GeneroModel.php";


class AdminController extends SecuredController
{
  private $view;
  private $model;
  private $GeneroModel;
  private $Titulo;

  function __construct()
  {
    parent::__construct();

    $this->view = new PeliculasView();
    $this->Titulo = "Bienvenido Administrador!!";
    $this->model = new PelisModel();
    $this->GeneroModel = new GeneroModel();
  }

  function PelisAdmin(){
      $Peliculas = $this->model->GetPeliculas();
      $Generos = $this->GeneroModel->GetGeneros();
      $this->view->MostrarAdmin($this->Titulo, $Peliculas, $Generos);
  }

  function MostrarPeliculaAdmin($param){

    $Peliculas = $this->model->MostrarPeliculaAdmin($param[0]);
    $Generos = $this->GeneroModel->GetGeneros();
    $NombreGeneroDePelicula = $this->GeneroModel->GetNombreDeGeneroDePelicula($param[1]);
    $this->view->MostrarPeliculaAdmin($this->Titulo, $Peliculas, $Generos, $NombreGeneroDePelicula);
  }

  function FormularioEditarGenero(){
  $Generos = $this->GeneroModel->GetGeneros();
  $this->view->MostrarFormularioEditarGenero($this->Titulo, $Generos);
  }

  function EditarGenero($id_genero){
    $nombreEditado = $_POST["EditadoNombreGenero"];
    $this->GeneroModel->ActualizarNombreGenero($nombreEditado, $id_genero[0]);
  }

  function borrarGenero($id_genero){
    $this->GeneroModel->borrarGenero($id_genero[0]);
  }

  function GenerarGeneroAdmin($PARAMS){
    $Peliculas = $this->model->GetPeliculasFiltradas($PARAMS);
    $Generos = $this->GeneroModel->GetGeneros();
    $GeneroSeleccionado = $this->GeneroModel->GetGeneroSeleccionado($PARAMS);
    $this->view->GeneroFiltradoAdmin($this->Titulo, $Peliculas, $Generos, $GeneroSeleccionado);
  }

  function BorrarPelicula($param){
    $this->model->BorrarPelicula($param[0]);
  }

  function ActualizarPelicula($ParamPeli){
    $nombre = $_POST["EditadoNombre"];
    $sinopsis = $_POST["EditadoSinopsis"];
    $actores = $_POST["EditadoActores"];
    if (isset($_POST["EditadoGenero"])) {
      $genero = $_POST["EditadoGenero"];
    }else {
      $genero = '';
    }
    $genero = $_POST["EditadoGenero"];
    $iFrame = $_POST["EditadoiFrame"];
    $this->model->ActualizarMovie($ParamPeli[0], $ParamPeli[1], $nombre, $sinopsis, $actores, $iFrame);

  }

  function Logout(){
    session_start();
    session_destroy();
    header(HOME);
  }

  function FormularioAgregarPelicula(){
    $Generos = $this->model->GetGeneros();
    $this->view->MostrarFormularioAgregarPelicula($this->Titulo, $Generos);
  }

  function AgregarPelicula(){
    $nombre = $_POST["nombre"];
    $genero = $_POST["genero"];
    $sinopsis = $_POST["sinopsis"];
    if (isset($_POST["EstrenoCheck"])) {
      $estreno = 1;
    }else {
      $estreno = 0;
    }
    $actores = $_POST["actores"];
    $iFrame = $_POST["iFrame"];

    $this->model->AgregarPeliculamodel($genero,$nombre,$sinopsis,$actores,$estreno,$iFrame);
  }

  function MostrarEstrenosAdmin(){
    $PeliculasEstrenos = $this->model->BuscarEstrenos();
    $Generos = $this->GeneroModel->GetGeneros();
    $this->view->MostrarEstrenosViewAdmin($this->Titulo, $PeliculasEstrenos, $Generos);
  }

  function FormularioAgregarGenero(){
    $Generos = $this->GeneroModel->GetGeneros();
    $this->view->MostrarFormularioAgregarGenero($this->Titulo, $Generos);
  }

  function AgregarGenero(){
    $nombreGenero = $_POST["nombreGenero"];
    $this->GeneroModel->AgregarGeneroModel($nombreGenero);
  }
}



 ?>
