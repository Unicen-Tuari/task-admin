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

  function getTask($id){
    $tasks_to_return =[];
    $select = $this->db->prepare("select * from tarea where id_tarea=?");
    $select->execute(array($id));
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
    return $this->getTask($fk_tarea);
  }

  function deleteTask($index){
    $delete = $this->db->prepare("delete from tarea where id_tarea=?");
    $delete->execute(array($index));
    $return['status']= $delete->rowCount()==1 ? 'la tarea fue borrada con exito :)': 'ERROR!';
    return $return;
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
  function updateTask($id,$task, $description){
    $insert = $this->db->prepare("UPDATE tarea SET Titulo=?, Descripcion=? WHERE id_tarea =?");
    $insert->execute(array($task,$description,$id));
  
    return $this->getTask($id);
  }

}


?>
