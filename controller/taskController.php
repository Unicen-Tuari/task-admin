<?php
require('view/taskView.php');
require('model/taskModel.php');

class TaskController
{
  private $modelTask;
  private $viewTask;

  public function __construct()
  {
    $this->modelTask = new TaskModel();
    $this->viewTask = new TaskView();
  }

  public function getList($added){
    $tasks = $this->modelTask->getTasks();
    $this->viewTask->show($tasks, $added);
  }

  public function addTask(){
    $added = false;
    //print_r($_FILES['image']);
    if (isset($_POST['task']) && $_POST['task']!=''){
      $imagenes = [];
      if(isset($_FILES['image'])){
      for($i=0; $i<count($_FILES['image']['name']);$i++)
      {
        if(($_FILES['image']['size'][$i]>0) && ($this->esImagen($_FILES['image']['type'][$i])))
        {
            $image_name = $_FILES['image']['name'][$i];
            $image_tmp = $_FILES['image']['tmp_name'][$i];
            $image['name']=$image_name;
            $image['tmp_name']=$image_tmp;
            $imagenes[] = $image;
        }
      }

      }
      $task = $_POST['task'];
      $description = $_POST['description'];
      $this->modelTask->addTask($task,$description,$imagenes);
      $added=true;
    }
    $tasks = $this->modelTask->getTasks();
    $this->viewTask->showTasks($tasks, $added);
  }
  public function deleteTask(){
    if (isset($_REQUEST['task'])){
      $task = $_REQUEST['task'];
      $this->modelTask->deleteTask($task);
    }
    $tasks = $this->modelTask->getTasks();
    $this->viewTask->showTasks($tasks, false);
   }
   public function toggleStatusTask(){
     if (isset($_REQUEST['task'])){
       $task = $_REQUEST['task'];
       $this->modelTask->toggleStatusTask($task);
     }
     $tasks = $this->modelTask->getTasks();
     $this->viewTask->showTasks($tasks, false);
   }

    private function esImagen($file_type){
      return ($file_type =='image/jpeg' || $file_type =='image/png' );
  }
}


?>
