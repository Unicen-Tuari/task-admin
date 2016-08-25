<?php
  require('controller/TaskController.php');
  require('config/appConfig.php');
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
      default:
          $controllerTask->getList('');
          break;
  }

?>
