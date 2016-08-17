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
    if (isset($_POST['task']) && $_POST['task']!=''){
      $task = $_POST['task'];
      $this->modelTask->addTask($task);
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

}


?>
