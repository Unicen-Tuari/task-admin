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
    if (isset($_POST['task']) && $_POST['task']!=''
        && isset($_POST['user']) && $_POST['user']!=''){
      $task = $_POST['task'];
      $user = $_POST['user'];
      $description = $_POST['description'];
      $this->modelTask->addTask($task,$description,$user);
      $added=true;
    }
    $this->getList($added);
  }
  public function deleteTask(){
    if (isset($_REQUEST['task'])){
      $task = $_REQUEST['task'];
      $this->modelTask->deleteTask($task);
    }
    $this->getList(false);
   }
   public function toggleStatusTask(){
     if (isset($_REQUEST['task'])){
       $task = $_REQUEST['task'];
       $this->modelTask->toggleStatusTask($task);
     }
     $this->getList(false);
   }
}


?>
