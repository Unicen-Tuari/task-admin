<?php
  require_once('controller/TaskController.php');
  require_once('config/appConfig.php');
  require_once('controller/LoginController.php');

  $controllerTask = new TaskController();

  switch (isset($_GET[AppConfig::$ACTION]) ? $_GET[AppConfig::$ACTION] : AppConfig::$ACTION_DEFAULT ) {
      case AppConfig::$ACTION_SHOW_TASKS:
          $controllerTask->getList('');
          break;
      case AppConfig::$ACTION_ADD_TASK:
          $controllerTask->addTask();
          break;
      case AppConfig::$ACTION_DELETE_TASK:
          $controllerTask->deleteTask();
          break;
      case AppConfig::$ACTION_TOGGLE_STATUS_TASK:
          $controllerTask->toggleStatusTask();
          break;
      case AppConfig::$ACTION_LOGIN:
          (new LoginController())->login();
          break;
      default:
          $controllerTask->getList('');
          break;
  }

?>
