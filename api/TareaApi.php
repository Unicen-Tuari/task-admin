<?php

require_once('../model/taskModel.php');
require_once('ApiBase.php');

class TareaApi extends Api{

  private $model;

  function __construct($request){
    parent::__construct($request);
    $this->model = new TaskModel();
  }

  function tarea($args){
    if($this->method == 'GET'){
      if(isset($this->args) && (count($this->args) == 1)){
        return $this->model->getTaskById($this->args[0]);
      }
      return $this->model->getTasks();
    }

  }


}


 ?>
