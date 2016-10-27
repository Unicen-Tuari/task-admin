<?php
  require_once('controller/TaskController.php');
  require_once('config/appConfig.php');
  require_once('controller/LoginController.php');


  switch (isset($_GET[AppConfig::$ACTION]) ? $_GET[AppConfig::$ACTION] : AppConfig::$ACTION_DEFAULT ) {
      case AppConfig::$ACTION_SHOW_TASKS:
          $controllerTask = new TaskController();
          $controllerTask->getList('');
          break;
      case AppConfig::$ACTION_ADD_TASK:
          $controllerTask = new TaskController();
          $controllerTask->addTask();
          break;
      case AppConfig::$ACTION_DELETE_TASK:
          $controllerTask = new TaskController();
          $controllerTask->deleteTask();
          break;
      case AppConfig::$ACTION_TOGGLE_STATUS_TASK:
          $controllerTask = new TaskController();
          $controllerTask->toggleStatusTask();
          break;
      case AppConfig::$ACTION_LOGOUT:
      default:
          (new LoginController())->logout();
          break;
      case AppConfig::$ACTION_LOGIN:
      default:
          (new LoginController())->login();
          break;
  }

?>
