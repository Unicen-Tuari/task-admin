<?php

class TaskModel
{
  private $db;

  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=tareas;charset=utf8', 'root', '');

    //$this->tasks = ['Task1','adsda','ads','adsad','adsad','adsad','adsad','adsad','adsad','adsad','adsad','adsad'];
  }

  function getTasks(){
    $select = $this->db->prepare("select * from tarea");
    $select->execute();
    return $select->fetchAll(PDO::FETCH_ASSOC);
  }

  function addTask($task, $description, $user){
    $this->db->beginTransaction();
    $select = $this->db->prepare("select * from usuario where nombre=?");
    $select->execute(array($user));
    $usuario = $select->fetch();
    if($usuario){
      $insert = $this->db->prepare("INSERT INTO tarea(Titulo, Descripcion,id_usuario) VALUES(?,?,?)");
      $insert->execute(array($task,$description,$usuario['id_usuario']));
    }
    //$this->db->rollBack();
  }

  function deleteTask($index){
    $delete = $this->db->prepare("delete from tarea where id_tarea=?");
    $delete->execute(array($index));
  }

  function toggleStatusTask($index){
    $select = $this->db->prepare("select finalizada from tarea where id_tarea=?");
    $select->execute(array($index));
    $estadoTarea= $select->fetch();
    $nuevoEstado=!$estadoTarea['finalizada'];
    $update = $this->db->prepare("update tarea set finalizada=? where id_tarea=?");
    $update->execute(array($nuevoEstado,$index));
  }
}


?>
