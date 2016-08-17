<?php

class TaskModel
{
  private $tasks;

  function __construct()
  {
    $this->tasks = ['Task1','adsda','ads','adsad','adsad','adsad','adsad','adsad','adsad','adsad','adsad','adsad'];
  }

  function getTasks(){
    return $this->tasks;
  }

  function addTask($task){
    $this->tasks[] = $task;
  }

  function deleteTask($index){
    unset($this->tasks[$index]);
  }
}


?>
