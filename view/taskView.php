<?php
require('libs/Smarty.class.php');

class TaskView {
  private $smarty;

  public function __construct(){
    $this->smarty = new Smarty;
  }

  public function show($tasks, $added){
    $this->smarty->assign('tasks',$tasks);
    $this->smarty->assign('added',$added);
    $this->smarty->display('task.tpl');
  }

  public function showTasks($tasks, $added){
    $this->smarty->assign('tasks',$tasks);
    $this->smarty->assign('added',$added);
    $this->smarty->display('taskList.tpl');
  }

}


?>
