<?php
require 'api.php';
require '../model/taskModel.php';

class TareaApi extends Api
{

  private $model;

  public function __construct($request)
  {
    parent::__construct($request);
    $this->model = new TaskModel();
  }

  public function tarea($argumentos){
    switch ($this->method) {
      case 'GET':
        if(count($argumentos) == 0)
            return $this->model->getTasks();
        else
            return $this->model->getTask($argumentos[0]);
        break;
      case 'POST':
       if(count($argumentos) == 0)
         return $this->model->addTask($_POST['task'],$_POST['description'],[]);
        break;
        case 'DELETE':
            if(count($argumentos) > 0)
                return $this->model->deleteTask($argumentos[0]);
        break;
       case 'PUT':
//          if(count($argumentos) > 0)
            //parse_str(file_get_contents('php://input'), $this->params);
            $put_args=[];
            parse_str(file_get_contents('php://input'), $put_args);
            print_r($put_args);
          return $this->model->updateTask($argumentos[0],$put_args['task'],$_REQUEST['description']);
        default:
        return "Metodo no implementado";
        break;
    }
  }
}


 ?>
