<?php

class TaskModel
{
  private $db;

  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=tareas1;charset=utf8', 'root', '');
  }

  function getTasks(){
    $tasks_to_return =[];
    $select = $this->db->prepare("select * from tarea");
    $select->execute();
    $tasks = $select->fetchAll(PDO::FETCH_ASSOC);
    foreach ($tasks as $key => $task) {
      $select = $this->db->prepare("select * from imagen where fk_tarea=?");
      $select->execute(array($task['id_tarea']));
      $images = $select->fetchAll(PDO::FETCH_ASSOC);
      $task['imagenes'] = $images;
      $tasks_to_return[]=$task;
    }
    return $tasks_to_return;
  }

  function addTask($task, $description,$images){
    $insert = $this->db->prepare("INSERT INTO tarea(Titulo, Descripcion) VALUES(?,?)");
    $insert->execute(array($task,$description));
    $fk_tarea = $this->db->lastInsertId();

    foreach ($images as $image) {
      $path_image =  $this->copyImage($image);
      $insert = $this->db->prepare("INSERT INTO imagen(path, fk_tarea) VALUES(?,?)");
      $insert->execute(array($path_image,$fk_tarea));
    }
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

  function copyImage($image){
    $path = 'images/'.uniqid().$image["name"];
    move_uploaded_file($image["tmp_name"], $path);
    return $path;
  }

  function getTaskById($id){
    $select = $this->db->prepare("select * from tarea where id_tarea = ?");
    $select->execute(array($id));
    $task = $select->fetch(PDO::FETCH_ASSOC);

      $select = $this->db->prepare("select * from imagen where fk_tarea=?");
      $select->execute(array($task['id_tarea']));
      $images = $select->fetchAll(PDO::FETCH_ASSOC);
      $task['imagenes'] = $images;


    return $task;
  }
}


?>
